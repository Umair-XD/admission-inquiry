<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Inquiry;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class InquiryListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }

    public function processRequest(): JsonResponse
    {
        $status = $this->get('status', 'active');
        $user   = auth()->user();

        $query = Inquiry::with(['department', 'course', 'degrees'])
            ->where('status', $status);

        // Staff with a department assigned can only see their department's inquiries
        if ($user->role === 'staff' && $user->department_id) {
            $query->where('department_id', $user->department_id);
        }

        $draw = (int) $this->get('draw', 1);
        $start = (int) $this->get('start', 0);
        $length = (int) $this->get('length', 10);
        $search = $this->get('search')['value'] ?? '';
        $orderCol = $this->get('columns')[$this->get('order')[0]['column'] ?? 0]['data'] ?? 'id';
        $orderDir = $this->get('order')[0]['dir'] ?? 'desc';

        $total = (clone $query)->count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('cnic', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $filtered = (clone $query)->count();

        $allowed = ['id', 'name', 'cnic', 'phone', 'age'];
        $col = in_array($orderCol, $allowed) ? $orderCol : 'id';
        $dir = $orderDir === 'asc' ? 'asc' : 'desc';

        $records = $query->withCount('comments')->orderBy($col, $dir)->skip($start)->take($length)->get();

        $data = $records->map(function ($inquiry) {
            $matric = $inquiry->degrees->where('degree_id', 1)->first();
            $inter = $inquiry->degrees->where('degree_id', 2)->first();
            $bs = $inquiry->degrees->where('degree_id', 3)->first();
            $ms = $inquiry->degrees->where('degree_id', 4)->first();

            // Details cell
            $initial = strtoupper(substr($inquiry->name, 0, 1));
            $details = '<div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:36px;height:36px;font-size:.8rem;">'.$initial.'</div>
                <div>
                    <div class="fw-semibold text-dark small">'.e($inquiry->name).'</div>
                    <div class="text-muted" style="font-size:.75rem;"><i class="fa-solid fa-id-card me-1"></i>'.e($inquiry->cnic).'</div>
                    <div class="text-muted" style="font-size:.75rem;"><i class="fa-solid fa-phone me-1"></i>'.e($inquiry->phone).'</div>
                </div>
            </div>';

            // Department / Course
            $dept   = $inquiry->department?->name;
            $course = $inquiry->course?->name;
            if ($dept && $course) {
                $deptCourse = '<div class="small fw-medium">'.e($dept).' <span class="text-muted fw-normal">('.e($course).')</span></div>';
            } elseif ($dept) {
                $deptCourse = '<div class="small fw-medium">'.e($dept).'</div>';
            } else {
                $deptCourse = '<span class="text-muted small">Not set</span>';
            }

            // Academic summary
            $academic = '<div style="font-size:.75rem;" class="d-flex flex-column gap-1">';
            if ($matric) {
                $academic .= '<span><span class="text-muted">Matric:</span> <span class="badge bg-light text-dark border">'.$matric->obtained.'/'.$matric->total.'</span></span>';
            }
            if ($inter) {
                $academic .= '<span><span class="text-muted">Inter P1:</span> <span class="badge bg-light text-dark border">'.$inter->part1_obtained.'/'.$inter->part1_total.'</span> <span class="text-muted">P2:</span> <span class="badge bg-light text-dark border">'.$inter->part2_obtained.'/'.$inter->part2_total.'</span></span>';
            }
            if ($bs) {
                $academic .= '<span><span class="text-muted">BS:</span> <span class="badge bg-light text-dark border">'.$bs->obtained.'/'.$bs->total.'</span></span>';
            }
            if ($ms) {
                $academic .= '<span><span class="text-muted">MS:</span> <span class="badge bg-light text-dark border">'.$ms->obtained.'/'.$ms->total.'</span></span>';
            }
            if ($inquiry->entry_obtained) {
                $academic .= '<span><span class="text-muted">Entry:</span> <span class="badge bg-light text-dark border">'.$inquiry->entry_obtained.'/'.$inquiry->entry_total.'</span></span>';
            }
            if (! $matric && ! $inter && ! $bs && ! $ms && ! $inquiry->entry_obtained) {
                $academic .= '<span class="text-muted">—</span>';
            }
            $academic .= '</div>';

            // Status
            $statusMap = [
                'active'   => ['color' => 'warning',   'label' => 'In Process'],
                'inactive' => ['color' => 'success',   'label' => 'Admitted'],
                'archive'  => ['color' => 'secondary', 'label' => 'Archived'],
            ];
            $sm = $statusMap[$inquiry->status] ?? ['color' => 'secondary', 'label' => ucfirst($inquiry->status)];
            $statusCell = '<span class="badge rounded-pill bg-'.$sm['color'].'-subtle text-'.$sm['color'].'" style="font-size:.75rem;">'.$sm['label'].'</span>';

            // Change status
            if (auth()->user()->can('inquiry.status')) {
                $changeStatus = '<form class="s2-status-form" action="'.route('inquiry.status.update', $inquiry->id).'" method="POST">
                    '.csrf_field().'<input type="hidden" name="_method" value="PUT">
                    <select name="status" class="form-select form-select-sm s2-status" style="min-width:130px">
                        <option value="active" '.($inquiry->status === 'active' ? 'selected' : '').'>In Process</option>
                        <option value="inactive" '.($inquiry->status === 'inactive' ? 'selected' : '').'>Admitted</option>
                        <option value="archive" '.($inquiry->status === 'archive' ? 'selected' : '').'>Archived</option>
                    </select></form>';
            } else {
                $changeStatus = '<span class="text-muted small">—</span>';
            }

            // Actions
            $authUser = auth()->user();
            $commentsCount = $inquiry->comments_count ?? 0;
            $commentsBtn = '<button class="btn btn-sm btn-outline-info me-1" onclick="openCommentsModal('.$inquiry->id.')" title="Comments">
                <i class="fa-solid fa-comments"></i>'.($commentsCount > 0 ? ' <span class="badge bg-info rounded-pill" style="font-size:.65rem;">'.$commentsCount.'</span>' : '').'
                </button>';
            $actions = '<button class="btn btn-sm btn-outline-secondary me-1" onclick="openViewInquiryModal('.$inquiry->id.')" title="View"><i class="fa-solid fa-eye"></i></button>'
                      .$commentsBtn;
            if ($authUser->can('inquiry.edit')) {
                $actions .= '<button class="btn btn-sm btn-outline-primary me-1" onclick="openEditModal('.$inquiry->id.')" title="Edit"><i class="fa-solid fa-pen"></i></button>';
            }
            if ($authUser->can('inquiry.delete')) {
                $deleteUrl = route('inquiry.delete', $inquiry->id);
                $actions .= '<form action="'.$deleteUrl.'" method="POST" style="display:inline"
                    onsubmit="confirmDelete(this,\'Delete this inquiry?\'); return false;">
                    '.csrf_field().'<input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                </form>';
            }

            return [
                'id' => $inquiry->id,
                'details' => $details,
                'dept_course' => $deptCourse,
                'age' => $inquiry->age,
                'academic' => $academic,
                'status' => $statusCell,
                'change' => $changeStatus,
                'actions' => $actions,
            ];
        });

        return response()->json([
            'draw' => $draw,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $filtered,
            'aaData' => $data->values(),
        ]);
    }
}

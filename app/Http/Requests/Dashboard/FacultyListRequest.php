<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Faculty;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class FacultyListRequest extends FormRequest
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
        $query = Faculty::query();
        $draw = (int) $this->get('draw', 1);
        $start = (int) $this->get('start', 0);
        $length = (int) $this->get('length', 10);
        $search = $this->get('search')['value'] ?? '';
        $orderCol = $this->get('columns')[$this->get('order')[0]['column'] ?? 0]['data'] ?? 'id';
        $orderDir = $this->get('order')[0]['dir'] ?? 'asc';

        $total = (clone $query)->count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('designation', 'like', "%$search%")
                    ->orWhere('specialization', 'like', "%$search%")
                    ->orWhere('personal_email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            });
        }

        $filtered = (clone $query)->count();

        $allowed = ['id', 'first_name', 'designation', 'experience'];
        $col = in_array($orderCol, $allowed) ? $orderCol : 'id';
        $dir = $orderDir === 'asc' ? 'asc' : 'desc';

        $records = $query->with('user.department')->orderBy($col, $dir)->skip($start)->take($length)->get();

        $data = $records->map(function ($f) {
            $initial = strtoupper(substr($f->first_name, 0, 1));
            $avatar = $f->profile_picture
                ? '<img src="'.asset('faculty_pictures/'.$f->profile_picture).'" width="40" height="40" class="rounded-circle object-fit-cover border flex-shrink-0">'
                : '<div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:40px;height:40px;font-size:.85rem;">'.$initial.'</div>';

            $member = '<div class="d-flex align-items-center gap-2">'.$avatar.'
                <div>
                    <div class="fw-semibold small text-dark">'.e($f->first_name.' '.$f->last_name).'</div>
                    <div class="text-muted" style="font-size:.75rem;">'.e($f->specialization).'</div>
                </div></div>';

            $contact = '<div class="small"><i class="fa-solid fa-envelope me-1 text-muted"></i>'.e($f->personal_email).'</div>
                <div class="small text-muted"><i class="fa-solid fa-envelope me-1"></i>'.e($f->official_email).'</div>
                <div class="small text-muted"><i class="fa-solid fa-phone me-1"></i>'.e($f->phone).'</div>';

            $exp = '<span class="badge bg-light text-dark border">'.$f->experience.' yr'.($f->experience != 1 ? 's' : '').'</span>';

            $authUser  = auth()->user();
            $deptName  = $f->user?->department?->name ?? '<span class="text-muted small">None</span>';
            $deptId    = $f->user?->department_id ?? '';

            $actions = '<button class="btn btn-sm btn-outline-secondary me-1" onclick="openViewFacultyModal('.$f->id.')" title="View"><i class="fa-solid fa-eye"></i></button>';
            if ($authUser->can('faculty.edit')) {
                $actions .= '<button class="btn btn-sm btn-outline-success me-1"
                    onclick="openAssignDept('.$f->id.',\''.$deptId.'\')" title="Assign Department">
                    <i class="fa-solid fa-building me-1"></i>'.$deptName.'</button>
                <button class="btn btn-sm btn-outline-primary me-1"
                    onclick="openFacultyModal('.$f->id.')" title="Edit">
                    <i class="fa-solid fa-pen"></i></button>';
            }
            if ($authUser->can('faculty.delete')) {
                $deleteUrl = route('faculty.delete', $f->id);
                $actions .= '<form action="'.$deleteUrl.'" method="POST" style="display:inline"
                    onsubmit="confirmDelete(this,\'Delete this faculty member?\'); return false;">
                    '.csrf_field().'<input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                </form>';
            }

            return [
                'id'          => $f->id,
                'member'      => $member,
                'contact'     => $contact,
                'designation' => '<span class="badge bg-primary-subtle text-primary">'.e($f->designation).'</span>',
                'degree'      => e($f->degree),
                'experience'  => $exp,
                'actions'     => $actions,
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

<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StudentListRequest extends FormRequest
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
        $query = Student::query();
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
                    ->orWhere('mobile', 'like', "%$search%");
            });
        }

        $filtered = (clone $query)->count();

        $allowed = ['id', 'name', 'age', 'created_at'];
        $col = in_array($orderCol, $allowed) ? $orderCol : 'id';
        $dir = $orderDir === 'asc' ? 'asc' : 'desc';

        $records = $query->orderBy($col, $dir)->skip($start)->take($length)->get();

        $data = $records->map(function ($s) {
            $initial = strtoupper(substr($s->name, 0, 1));
            $details = '<div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:40px;height:40px;font-size:.85rem;">'.$initial.'</div>
                <div>
                    <div class="fw-semibold small text-dark">'.e($s->name).'</div>
                    <div class="text-muted" style="font-size:.75rem;"><i class="fa-solid fa-id-card me-1"></i>'.e($s->cnic).'</div>
                    <div class="text-muted" style="font-size:.75rem;"><i class="fa-solid fa-phone me-1"></i>'.e($s->mobile).'</div>
                </div></div>';

            $academic = '<div style="font-size:.75rem;" class="d-flex flex-column gap-1">';
            if ($s->matric_marks) {
                $academic .= '<span><span class="text-muted">Matric:</span> <span class="badge bg-light text-dark border">'.$s->matric_marks.'</span></span>';
            }
            if ($s->part1_marks) {
                $academic .= '<span><span class="text-muted">Part 1:</span> <span class="badge bg-light text-dark border">'.$s->part1_marks.'</span></span>';
            }
            if ($s->part2_marks) {
                $academic .= '<span><span class="text-muted">Part 2:</span> <span class="badge bg-light text-dark border">'.$s->part2_marks.'</span></span>';
            }
            if ($s->entry_test_marks) {
                $academic .= '<span><span class="text-muted">Entry:</span> <span class="badge bg-light text-dark border">'.$s->entry_test_marks.'</span></span>';
            }
            if (! $s->matric_marks && ! $s->part1_marks && ! $s->part2_marks && ! $s->entry_test_marks) {
                $academic .= '<span class="text-muted">—</span>';
            }
            $academic .= '</div>';

            return [
                'id' => $s->id,
                'details' => $details,
                'age' => $s->age,
                'address' => '<span title="'.e($s->address).'" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:.85rem;">'.e($s->address).'</span>',
                'academic' => $academic,
                'created' => $s->created_at->format('d M Y'),
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

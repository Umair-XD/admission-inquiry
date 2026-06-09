<?php

namespace App\Http\Requests\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UserListRequest extends FormRequest
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
        $query = User::with('roles');
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
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $filtered = (clone $query)->count();

        $allowed = ['id', 'name', 'email', 'created_at'];
        $col = in_array($orderCol, $allowed) ? $orderCol : 'id';
        $dir = $orderDir === 'asc' ? 'asc' : 'desc';

        $records = $query->orderBy($col, $dir)->skip($start)->take($length)->get();

        $authId = auth()->id();

        $data = $records->map(function ($user) use ($authId) {
            $initial = strtoupper(substr($user->name, 0, 1));
            $youBadge = $user->id === $authId
                ? ' <span class="badge bg-secondary-subtle text-secondary rounded-pill" style="font-size:.7rem;">You</span>'
                : '';

            $userCell = '<div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:36px;height:36px;font-size:.8rem;">'.$initial.'</div>
                <div>
                    <div class="fw-medium small">'.e($user->name).$youBadge.'</div>
                </div></div>';

            $roleBadges = '';
            foreach ($user->roles as $role) {
                $cls = match ($role->name) {
                    'super_admin' => 'bg-danger-subtle text-danger',
                    'admin' => 'bg-primary-subtle text-primary',
                    default => 'bg-secondary-subtle text-secondary',
                };
                $roleBadges .= '<span class="badge rounded-pill '.$cls.' me-1">'.ucwords(str_replace('_', ' ', $role->name)).'</span>';
            }
            if (! $roleBadges) {
                $roleBadges = '<span class="text-muted small">—</span>';
            }

            $editBtn = '<button class="btn btn-sm btn-outline-primary me-1" onclick="openUserModal('.$user->id.')" title="Edit"><i class="fa-solid fa-pen"></i></button>';

            $deleteBtn = '';
            if ($user->id !== $authId) {
                $deleteBtn = '<form action="'.route('access.users.destroy', $user->id).'" method="POST" style="display:inline" onsubmit="return confirm(\'Delete '.addslashes($user->name).'?\')">'
                    .csrf_field().'<input type="hidden" name="_method" value="DELETE">'
                    .'<button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button></form>';
            }

            return [
                'id' => $user->id,
                'user' => $userCell,
                'email' => '<span class="text-muted small">'.e($user->email).'</span>',
                'role' => $roleBadges,
                'created' => $user->created_at->format('d M Y'),
                'actions' => $editBtn.$deleteBtn,
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

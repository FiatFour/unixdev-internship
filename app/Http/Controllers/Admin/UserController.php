<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $s = $request->s;
        $name = $request->name;
        $role = $request->role;

        $lists = User::select('*')->search($request->s, $request)->paginate(20); // PER_PAGE

        $roles = $this->getRole();
//        dd($users);
        return view('admin.users.index', [
            'lists' => $lists,
            'roles' => $roles,
            's' => $s,
            'name' => $name,
            'role' => $role,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = new User();
        $page_title = __('manage.add') . __('users.page_title');
//        $departments = Department::select('id', 'name')->get();
//        $departmentId = [];
        $roles = $this->getRole();
        return view(
            'admin.users.form',
            [
                'user' => $user,
                'page_title' => $page_title,
//                'departments' => $departments,
//                'departmentId' => $departmentId,
                'roles' => $roles,
            ]
        );
    }

    public function getRole()
    {
        $roles = collect([
            (object)[
                'id' => RoleEnum::MANAGER,
                'name' => __('roles.status_' . RoleEnum::MANAGER),
                'value' => RoleEnum::MANAGER,
            ],
            (object)[
                'id' => RoleEnum::EMPLOYEE,
                'name' => __('roles.status_' . RoleEnum::EMPLOYEE),
                'value' => RoleEnum::EMPLOYEE,
            ],
        ]);

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => [
                'required', 'string', 'max:255', 'email',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'password' => [
                'required', 'string', 'min:8',
            ],
        ], [], [
            'password' => __('users.password'),
            'name' => __('users.name'),
            'email' => __('users.email'),
//            'departmentId' => __('users.department'),
            'role' => __('users.role'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $user = User::firstOrNew(['id' => $request->id]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
//        $user->departmentId = $request->departmentId;
        $user->password = Hash::make($request->password);
        $user->save();

        $redirect_route = route('admin.users.index');
        return $this->responseValidateSuccess($redirect_route);
    }

    public function edit(User $user)
    {
        $roles = $this->getRole();
        if ($user == null) {
            return redirect()->route('users.index');
        }

        $page_title = __('manage.edit') . __('users.page_title');
        return view('admin.users.form',
            [
                'page_title' => $page_title,
                'user' => $user,
                'roles' => $roles
            ]
        );
    }

    public function show(User $user)
    {
        $roles = $this->getRole();
        if ($user == null) {
            return redirect()->route('admin.users.index');
        }
        $page_title = __('manage.show') . __('users.page_title');
        $view = true;
        return view('admin.users.form', [
                'page_title' => $page_title,
                'view' => $view,
                'user' => $user,
                'roles' => $roles
            ]
        );
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return $this->responseEmpty('User');
        }

        $user->delete();
        return $this->responseDeletedSuccess('User', 'admin.users.index');
    }
}

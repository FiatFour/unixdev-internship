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
        $lists = User::select('*')->search($request->s, $request)->paginate(PER_PAGE); // PER_PAGE
        $roles = $this->getRole();
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
        $page_title = __('lang.add') . __('users.page_title');
        $roles = $this->getRole();
        $departments = Department::select('id', 'name')->get();

        return view(
            'admin.users.form',
            [
                'user' => $user,
                'page_title' => $page_title,
                'roles' => $roles,
                'departments' => $departments,
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
//            'password' => [
//                'required', 'string', 'min:8',
//            ],
            'role' => [
                'required',
            ],
        ], [], [
            'password' => __('users.password'),
            'name' => __('users.name'),
            'email' => __('users.email'),
            'role' => __('users.role'),
        ]);

        if ($validator->fails()) {
            return $this->responseValidateAllFailed($validator);
        }


        $user = User::firstOrNew(['id' => $request->id]);
//        if($user->created_at = null){
//            $user->created_at = date('Y-m-d H:i:s');
//        }
//        $user->updated_at = date('Y-m-d H:i:s');
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->department_id = $request->departmentId;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
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
        $departments = Department::select('id', 'name')->get();

        $page_title = __('lang.edit') . __('users.page_title');
        return view('admin.users.form',
            [
                'page_title' => $page_title,
                'user' => $user,
                'departments' => $departments,
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
        $page_title = __('lang.view') . __('users.page_title');
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

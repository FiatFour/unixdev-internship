<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeDepartment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $s = $request->s;
        $name = $request->name;
        $manager = $request->manager;

        $lists = Department::select('departments.*', 'users.name as manager_name')
            ->latest('departments.id')
            ->leftJoin('users', 'users.id',
                'departments.manager_id')
            ->search($request->s, $request)->paginate(PER_PAGE);

        $managers = Department::select('users.id', 'users.name')
            ->latest('departments.id')
            ->leftJoin('users', 'users.id',
                'departments.manager_id')
            ->get();

        return view('admin.departments.index', [
            'lists' => $lists,
            's' => $s,
            'name' => $name,
            'manager' => $manager,
            'managers' => $managers,
        ]);
    }

    public function create()
    {
        $department = new Department();
        $page_title = __('lang.add') . __('departments.page_title');

//        $employees = User::select('users.id', 'users.name', 'departments.manager_id')
//            ->leftJoin('departments', 'users.id', '!=', 'departments.manager_id')
//            ->where([
//                ['users.role', '!=', RoleEnum::ADMIN],
//            ])
//            ->get();
        $employees = User::select('users.id', 'users.name')
            ->where('role', '!=', RoleEnum::ADMIN)->get();

        $managers = User::select('users.id', 'users.name', 'departments.manager_id')
            ->leftJoin('departments', 'users.id', '!=', 'departments.manager_id')
            ->where([
                ['users.role', '=', RoleEnum::MANAGER],
                ['departments.manager_id', '!=', 'users.id']
            ])
            ->get();

        $employeeId = [];
        return view(
            'admin.departments.form',
            [
                'employees' => $employees,
                'department' => $department,
                'page_title' => $page_title,
                'employeeId' => $employeeId,
                'managers' => $managers,
            ]
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('users', 'name')->ignore($request->id),
            ],
            'managerId' => [
                'required'
            ],
//            'employeeId' => [
//                'required',
//                'array',
//                'min:1',
//            ],
        ], [], [
            'name' => __('departments.name'),
            'managerId' => __('departments.manager'),
//            'employeeId' => __('departments.select_employee'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $department = Department::firstOrNew(['id' => $request->id]);
        $department->name = $request->name;
        $department->manager_id = $request->managerId;
        $department->save();

        EmployeeDepartment::where('department_id', $request->id)->delete();
        if (!empty($department->id)) {
            foreach ($request->employeeId as $index => $employeeId) {
                $employeeIdValue = $employeeId;
                $employeeDepartment = new EmployeeDepartment();
                $employeeDepartment->user_id = $employeeIdValue;
                $employeeDepartment->department_id = $department->id;
                $employeeDepartment->save();
            }
        }


//        foreach ($request->employeeId as $index => $employeeId) {
//            $employeeIdValue = $employeeId; // Assuming $request->employeeId is an array of user IDs
//            EmployeeDepartment::firstOrCreate([
//                'department_id' => $department->id,
//                'user_id' => $employeeIdValue
//            ]);
//        }

        $redirect_route = route('admin.departments.index');
        return $this->responseValidateSuccess($redirect_route);
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

    public function show(Department $department)
    {
        $roles = $this->getRole();
        if ($department == null) {
            return redirect()->route('admin.departments.index');
        }

//        $employees = User::select('users.id', 'users.name', 'departments.manager_id')
//            ->leftJoin('departments', 'users.id', '!=', 'departments.manager_id')
//            ->where('role', '!=', RoleEnum::ADMIN)->get();

        $employees = User::select('users.id', 'users.name')
            ->where('role', '!=', RoleEnum::ADMIN)->get();

        $managers = User::select('users.id', 'users.name', 'departments.manager_id')
            ->leftJoin('departments', 'users.id', '!=', 'departments.manager_id')
            ->where('users.role', RoleEnum::MANAGER)
            ->get();

        $employeeId = $this->getEmployeeId($department->id);
        $page_title = __('lang.view') . __('departments.page_title');
        $view = true;
        return view('admin.departments.form', [
                'page_title' => $page_title,
                'view' => $view,
                'department' => $department,
                'roles' => $roles,
                'employees' => $employees,
                'employeeId' => $employeeId,
                'managers' => $managers,
            ]
        );
    }

    public function getEmployeeId($deparment_id)
    {
        return User::leftJoin('employee_departments', 'employee_departments.user_id', '=', 'users.id')
            ->where('employee_departments.department_id', $deparment_id)
            ->pluck('users.id')
            ->toArray();
    }

    public function edit(Department $department)
    {
        $roles = $this->getRole();
        if ($department == null) {
            return redirect()->route('admin.departments.index');
        }

        $employees = User::select('users.id', 'users.name')
            ->where('role', '!=', RoleEnum::ADMIN)->get();

        $managers = User::select('users.id', 'users.name', 'departments.manager_id')
            ->leftJoin('departments', 'users.id', '!=', 'departments.manager_id')
            ->where('users.role', RoleEnum::MANAGER)
            ->get();

        $employeeId = $this->getEmployeeId($department->id);
        $page_title = __('lang.edit') . __('departments.page_title');
        return view('admin.departments.form', [
                'page_title' => $page_title,
                'department' => $department,
                'roles' => $roles,
                'employees' => $employees,
                'employeeId' => $employeeId,
                'managers' => $managers,
            ]
        );
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        EmployeeDepartment::where('department_id', $department->id)->delete();

        if (empty($department)) {
            return $this->responseEmpty('Department');
        }

        $department->delete();
        return $this->responseDeletedSuccess('Department', 'admin.departments.index');
    }


}

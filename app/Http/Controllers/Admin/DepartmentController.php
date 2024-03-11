<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\EmployeeDepartment;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $lists = Department::select('departments.*', 'users.name AS manager_name')
            ->latest('departments.id')
            ->leftJoin('users', 'users.id',
                'departments.manager_id')
            ->get(); // PER_PAGE
        return view('admin.departments.index', [
            'lists' => $lists
        ]);
    }

    public function create()
    {
        $department = new Department();
        $page_title = __('manage.add') . __('departments.page_title');

        $employees = User::select('users.id', 'users.name', 'departments.manager_id')
            ->join('departments', 'users.id', '!=', 'departments.manager_id')
            ->where('role', '!=', RoleEnum::ADMIN)->get();

        $managers = User::select('users.id', 'users.name', 'departments.manager_id')
            ->join('departments', 'users.id', '!=', 'departments.manager_id')
            ->where('users.role', RoleEnum::MANAGER)
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
        $department = Department::firstOrNew(['id' => $request->id]);
        $department->name = $request->name;
        $department->manager_id = $request->managerId;
        $department->save();


//        foreach ($request->employeeId as $index => $employeeId) {
//            $employeeDepartment = EmployeeDepartment::firstOrNew([
//                'department_id' => $department->id,
//                'user_id' => $employeeId
//            ]);
//            $employeeDepartment->save();
//        }

        foreach ($request->employeeId as $index => $employeeId) {
            $employeeDepartment = EmployeeDepartment::firstOrNew(
                ['department_id' => $department->id],
                ['user_id' => $employeeId]
            );
            $employeeDepartment->save();
        }

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

}

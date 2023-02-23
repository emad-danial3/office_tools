<?php

namespace App\Traits;

use App\Models\Department;
use App\Models\Locations;
use App\User;
use Illuminate\Support\Facades\DB;

trait DepartmentTrait
{
    public function createNewDepartment($request)
    {
        DB::beginTransaction();
        $department = new Department();
        $department->name = $request['name'];
        $department->manager_name = $request['manager_name'];
        $department->manager_email = $request['manager_email'];
        $department->status = $request['status'];
        $department->save();
        DB::commit();
        $department = Department::find($department->id);
        return $department;
    }

    public function editDepartment($request)
    {
        DB::beginTransaction();
        $department = Department::findOrFail($request['department_id']);

        $department->status =$request['status'];
        $department->name =$request['name'];
        $department->manager_name = $request['manager_name'];
        $department->manager_email = $request['manager_email'];

        $department->save();

        DB::commit();
        $department = Department::find($department->id);
        return $department;
    }
}

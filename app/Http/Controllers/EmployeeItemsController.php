<?php

namespace App\Http\Controllers;
use App\Department;
use Illuminate\Http\Request;

class EmployeeItemsController extends Controller
{
    public static function getDefinedEmployeeDetails($employee_details){
        $items = [];
        foreach($employee_details as $employee){
            $department   = Department::getSpecificDepartment($employee->department_id);
            $item = new \stdClass();
            $item->id              = $employee->id;
            $item->name            = $employee->name;
            $item->contact         = $employee->contact;
            $item->address         = $employee->address;
            $item->department_name = $department->name;
            $item->status          = ($employee->status == 1) ? 'ACTIVE' : 'INACTIVE';
            array_push($items, $item);
        }
        return $items;
    }

    public static function getSingleDefinedEmployeeDetails($employee_details){  
        $department   = Department::getSpecificDepartment($employee_details->department_id);
        $item = new \stdClass();
        $item->id              = $employee_details->id;
        $item->name            = $employee_details->name;
        $item->contact         = $employee_details->contact;
        $item->address         = $employee_details->address;
        $item->department_name = $department->name;
        $item->department_id   = $department->id;
        $item->status          = ($employee_details->status == 1) ? 'ACTIVE' : 'INACTIVE';
        $item->status_value    = $employee_details->status;
        return $item;
    }
}

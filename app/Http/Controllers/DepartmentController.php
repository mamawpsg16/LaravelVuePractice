<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
class DepartmentController extends Controller
{
    public function index(){
    	$task_details  = Department::getDepartments();

    	return response()->json($task_details);
    }

    public function addDepartment(Request $request){
    	$data 		  = $request->all();
    	$new_task     = Department::addDepartment($data);
    	return response()->json($new_task);
    }

    public function updateDepartment(Request $request){
    	$data 		   = $request->all();
    	$updated_task  = Department::updateDepartment($data);
    	return response()->json($updated_task);
    }

	 //Search for GradeType - Multiselect options
	 public function getDepartments(Request $request)
	 {   
		 $data                   = $request->all();
		 if (isset($data['query'])) {
			 $query                  = $data['query'];
			 $departments           = Department::getDepartmentsLimit($query);
		 }else{
			 $departments           = Department::getDepartmentsLimitDefault();
		 }
		 return response()->json($departments);
	 }
}

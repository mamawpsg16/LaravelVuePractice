<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
class EmployeeController extends Controller
{
    public function index(){
    	$employee_details  		    = Employee::getEmployees();
		$defined_employee_details   = EmployeeItemsController::getDefinedEmployeeDetails($employee_details);

    	return response()->json($defined_employee_details);
    }

    public function addEmployee(Request $request){
    	$data 		  = $request->all();
    	$new_employee     = Employee::addEmployee($data);
    	return response()->json($new_employee);
    }

    public function getEmployeeDetails(Request $request){
    	$data 		   	   = $request->all();
    	$employee_details  = Employee::getEmployeeDetails($data);
		$defined_employee_details   = EmployeeItemsController::getSingleDefinedEmployeeDetails($employee_details);
    	return response()->json($defined_employee_details);
    }

    public function updateEmployee(Request $request){
    	$data 		   	   = $request->all();
    	$updated_employee_details  = Employee::updateEmployee($data);
		$defined_employee_details   = EmployeeItemsController::getSingleDefinedEmployeeDetails($updated_employee_details);
    	return response()->json($defined_employee_details);
    }
    public function deleteEmployee(Request $request){
    	$id 		    = $request->all();
    	$result  		= Employee::deleteEmployee($id);
    	return response()->json(['message'=>'Successfully deleted']);
    }

	 //Search for Employee
	 public function getEmployees(Request $request)
	 {   
		 $data                   = $request->all();
		 if (isset($data['query'])) {
			$query               = $data['query'];
			$employees           = Employee::getEmployeesLimit($query);
		 }else{
			$employees           = Employee::getEmployeesLimitDefault();
		 }
		 return response()->json($employees);
	 }


}

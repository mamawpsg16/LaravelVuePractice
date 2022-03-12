<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StatusController;
use App\Employee;
use App\GlobalModel;
class EmployeeController extends Controller
{
    public function index(){
    	$employee_details  		    = Employee::getEmployees();
		$defined_employee_details   = EmployeeItemsController::getDefinedEmployeeDetails($employee_details);

    	return response()->json($defined_employee_details);
    }
    public function employeeList(Request $request){
		$all            = Employee::getEmployeeTotal();
        //total count of data
        $total_data     = $all;
        //total filter 
        $total_filtered = $total_data;
        //set_time_limit(seconds)
        $limit          = $request->input('length');
		//start
		$start          = $request->input('start');
		//order
		// $order          = $columns[$request->input('order.0.column')];
		//direction
		$dir           = $request->input('order.0.dir');
		$search_value  = $request->input('search.value');
		if (!empty($search_value)) {
            $posts          = Employee::getEmployeeNameSearch($search_value,$start, $limit, $dir);
			$total_data     = count($posts);
            $total_filtered = $total_data;
        }else{
			//if no search
			$posts      = Employee::getEmployeeList($start, $limit, $dir); 
        }
		$data = array();
		if(!empty($posts))
		{
			$counter    = $start + 1;
			foreach ($posts as $post)
			{
				$department                      = GlobalModel::getSingleDataTable('departments',$post->department_id);
				$status                          = StatusController::checkStatus($post->status);
				$nested_data['#']                = '<span style="font-size: 12px ;  text-align: center;">'.$counter++.'</span>';
				$nested_data['name']             = '<p style="text-align: center;">'.$post->name.'</p>';
				$nested_data['address']          = '<p style="text-align: center;">'.$post->address.'</p>';
				$nested_data['contact']      	 = '<p style="text-align: center;">'.$post->contact.'</p>';
				$nested_data['department']       = '<p style="text-align: center;">'.$department->name.'</p>';
				$nested_data['status']           = '<p style="text-align: center;">'.$status.'</p>';
				$nested_data['actions']           = '<button class="btn btn-primary btn-sm" value="'.$post->id.'" title="View Employee Details">
				<slot><i class="fa fa-eye"></i></slot></button>';
				$data[]                          = $nested_data;

			}
		}
			$json_data=array(
								"draw"            => intval($request->input('draw')),  
								"recordsTotal"    => intval($total_data),  
								"recordsFiltered" => intval($total_filtered), 
								"data"            => $data   
							);
	
			return response()->json($json_data); 
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

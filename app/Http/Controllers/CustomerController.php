<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
    	$customer_details  		    = Customer::getCustomers();
		$defined_customer_details   = CustomerItemsController::getDefinedCustomerDetails($customer_details);
    	return response()->json($defined_customer_details);
    }

    public function addCustomer(Request $request){
    	$data 		  = $request->all();

		$customer_details = 
							[
								'employee_id'		=> $data['employee_id'],
								'contact'	 		=> $data['contact'],
								'name' 				=> $data['name'],
								'address' 			=> $data['address'],
								'date' 				=> date('Y-m-d',strtotime($data['date'])),
								'total_amount' 		=> $data['total_amount'],
								'discounted_amount'	=> $data['total_discounted_amount'],
								'created_at' 		=> date('Y-m-d H:i:s')
							];

    	$customer_id     = Customer::addCustomer($customer_details);

		foreach ($data['items'] as $key => $value) {
			$customer_items = 
							[
								'customer_id'		=> $customer_id,
								'inventory_id' 		=> $value['selected_inventory']['id'],
								'description'		=> $value['description'],
								'quantity'			=> $value['quantity'],
								'total_price'		=> $value['total_price'],
								'unit_price'		=> $value['unit_price'],
								'discount_rate'		=> $value['discount_rate'],
								'discount'			=> $value['discount'],
								'discounted_amount'	=> $value['discounted_amount'],
								'created_at' 		=> date('Y-m-d H:i:s')
							];
			$add_customer_item  = Customer::addCustomerItems($customer_items);
		}
    	return response()->json($customer_id);
    }

    public function getCustomerDetails(Request $request){
    	$data 		   	   = $request->all();
    	$customer_details  = Customer::getCustomerDetails($data);
		$main_details      = CustomerItemsController::getSingleDefinedCustomerDetails($customer_details);
		$customer_items    = Customer::getCustomerItemsDetails($customer_details->id);
		$defined_items     = CustomerItemsController::getDefinedCustomerItemsDetails($customer_items);
    	return response()->json(['customer_details'=>$main_details,'item_details'=>$defined_items]);
    }

    public function updateCustomer(Request $request){
    	$data 		   	   = $request->all();
		// dd($data['items']);
		$date 			   = json_decode($data['date']);
		$customer_details = 
							[
								'id'         	    => $data['id'],
								'employee_id'		=> $data['employee_id'],
								'contact'	 		=> $data['contact'],
								'name' 				=> $data['name'],
								'address' 			=> $data['address'],
								'date' 				=> date('Y-m-d H:i:s',strtotime($date)),
								'total_amount' 		=> $data['total_amount'],
								'discounted_amount'	=> $data['total_discounted_amount'],
								'updated_at' 		=> date('Y-m-d H:i:s')
							];

    	$customer_details = Customer::updateCustomer($customer_details);
		$delete_items     = Customer::deleteCustomerItems($data['id']);
		foreach ($data['items'] as $key => $value) {
			$item 		= 
							[
								'customer_id'       => $data['id'],
								'inventory_id' 		=> $value['selected_inventory']['id'],
								'description'		=> $value['description'],
								'quantity'			=> $value['quantity'],
								'total_price'		=> $value['total_price'],
								'unit_price'		=> $value['unit_price'],
								'discount_rate'		=> $value['discount_rate'],
								'discount'			=> $value['discount'],
								'discounted_amount'	=> $value['discounted_amount'],
								'created_at' 		=> date('Y-m-d H:i:s')
							];
			$add_customer_item  = Customer::addCustomerItems($item);
		}
		$main_details      = CustomerItemsController::getSingleDefinedCustomerDetails($customer_details);
		$customer_items    = Customer::getCustomerItemsDetails($data['id']);
		$defined_items     = CustomerItemsController::getDefinedCustomerItemsDetails($customer_items);
    	return response()->json(['customer_details'=>$main_details,'item_details'=>$defined_items]);
    }
    public function deleteCustomer(Request $request){
    	$id 		    = $request->all();
    	$delete_main  	= Customer::deleteCustomer($id);
    	$delete_items  	= Customer::deleteCustomerItems($id);
    	return response()->json(['message'=>'Successfully deleted']);
    }
}

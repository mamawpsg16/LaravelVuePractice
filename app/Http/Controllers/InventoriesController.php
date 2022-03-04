<?php

namespace App\Http\Controllers;
use App\Inventory;
use Illuminate\Http\Request;
use File;

class InventoriesController extends Controller
{
    public function index(){
    	$inventory_details  		 = Inventory::getInventories();
    	return response()->json($inventory_details);
    }

    public function addInventory(Request $request){
    	$data 		  = $request->all();
    	$new_inventory     = Inventory::addInventory($data);
    	return response()->json($new_inventory);
    }

    public function getInventoryDetails(Request $request){
    	$data 		   	   = $request->all();
    	$inventory_details  = Inventory::getInventoryDetails($data);
		if(isset($inventory_details->image_name)){
			$inventory_details->image_path = asset('inventory').'/'.$inventory_details->image_name;;
		}else{
			$inventory_details->image_path = '';
		}
    	return response()->json($inventory_details);
    }

    public function updateInventory(Request $request){
    	$data 		   	   = $request->all();
    	$updated_inventory_details  = Inventory::updateInventory($data);
		if(!empty($updated_inventory_details->image_name)){
			$updated_inventory_details->image_path = asset('inventory').'/'.$updated_inventory_details->image_name;
		}else{
			dd('else');
			$updated_inventory_details->image_path = '';
		}
    	return response()->json($updated_inventory_details);
    }
    public function deleteInventory(Request $request){
    	$id 		    = $request->all();
    	$result  		= Inventory::deleteInventory($id);
    	return response()->json();
    }

	//Search for Employee
	public function getInventories(Request $request)
	{   
		$data                   = $request->all();
		if (isset($data['query'])) {
		   $query               = $data['query'];
		   $inventories           = Inventory::getInventoriesLimit($query);
		}else{
		   $inventories           = Inventory::getInventoriesLimitDefault();
		}
		return response()->json($inventories);
	}

	public function uploadInventoryImage(Request $request){
		// asign time and concat to image extension
		$image_name = time().'.'.$request->file('image')->getClientOriginalExtension();
		// make destionation path in public folder
		$destinationPath = public_path().'/inventory/';
		// check if the path is not already exists
		if (!File::exists($destinationPath)) {
			File::makeDirectory($destinationPath, 0777, true, true);
		}
		$request->file('image')->move(public_path('/inventory/'), $image_name);
		$path = asset('inventory').'/'.$image_name;
		return response()->json(['path'=>$path,'image_name'=>$image_name]);
	}
}

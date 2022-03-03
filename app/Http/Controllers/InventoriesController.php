<?php

namespace App\Http\Controllers;
use App\Inventory;
use Illuminate\Http\Request;

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
    	return response()->json($inventory_details);
    }

    public function updateInventory(Request $request){
    	$data 		   	   = $request->all();
    	$updated_inventory_details  = Inventory::updateInventory($data);
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
}

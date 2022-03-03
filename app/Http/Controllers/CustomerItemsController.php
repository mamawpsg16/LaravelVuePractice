<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Inventory;
class CustomerItemsController extends Controller
{
    public static function getDefinedCustomerDetails($customer_details){
        $items = [];
        foreach ($customer_details as $key => $customer) {
            $item                    = new \stdClass();
            $employee                = Employee::getEmployeeDetails($customer->employee_id);
            $item->id                = $customer->id;    
            $item->name              = $customer->name;
            $item->employee_name     = $employee->name;
            $item->address           = $customer->address;
            $item->contact           = $customer->contact;
            $item->date              = $customer->date;
            $item->discounted_amount = $customer->discounted_amount;
            $item->total_amount      = $customer->total_amount;
            $item->status            = ($customer->status === 1) ? 'ACTIVE' : 'INACTIVE';
            $item->status_value      = $customer->status;
            array_push($items,$item);
        }
        return $items;
    }
    public static function getSingleDefinedCustomerDetails($customer_details){
        $item                    = new \stdClass();
        $employee                = Employee::getEmployeeDetails($customer_details->employee_id);
        $item->id                = $customer_details->id;    
        $item->name              = $customer_details->name;
        $item->employee_name     = $employee->name;
        $item->employee_id       = $employee->id;
        $item->address           = $customer_details->address;
        $item->contact           = $customer_details->contact;
        $item->date              = $customer_details->date;
        $item->discounted_amount = $customer_details->discounted_amount;
        $item->total_amount      = $customer_details->total_amount;
        $item->status            = ($customer_details->status === 1) ? 'ACTIVE' : 'INACTIVE';
        $item->status_value      = $customer_details->status;
        return $item;
    }

    public static function getDefinedCustomerItemsDetails($customer_items){
        $items = [];
        foreach ($customer_items as $key => $customer_item) {
            $item = new \stdClass();
            $inventory =  Inventory::getInventoryDetails($customer_item->inventory_id);
            $item->id                = $customer_item->id;    
            $item->customer_id       = $customer_item->customer_id;    
            $selected_inventory      = Inventory::getSingleInvetoryForMultiSelect($inventory->id);
            $item->selected_inventory = $selected_inventory;
            $item->inventory_id      = $inventory->id;
            $item->inventory_name    = $inventory->code.' : '.$inventory->name;
            $item->discounted_method = ((int)$customer_item->discount_rate != 0 ) ? true : false;
            $item->description       = $customer_item->description;
            $item->quantity          = (int)$customer_item->quantity;
            $item->total_price       = number_format($customer_item->total_price,2);
            $item->unit_price        = number_format($customer_item->unit_price,2);
            $item->discount_rate     = (int)$customer_item->discount_rate;
            $item->discount          = number_format($customer_item->discount,2);
            $item->discounted_amount = number_format($customer_item->discounted_amount,2);
            array_push($items,$item);
        }
        return $items;
    }
}

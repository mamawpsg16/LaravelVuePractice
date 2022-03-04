<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', 'TaskController@index');
Route::post('/addTask', 'TaskController@addTask');
Route::post('/updateTask/{id}', 'TaskController@updateTask');
Route::post('/deleteTask/{id}', 'TaskController@deleteTask');

Route::get('/departments', 'DepartmentController@index');
Route::post('/addDepartment', 'DepartmentController@addDepartment');
Route::post('/updateDepartmentStatus/{id}', 'DepartmentController@updateDepartment');
Route::post('/getDepartments', 'DepartmentController@getDepartments');


Route::get('/getEmployeeLists', 'EmployeeController@index');
Route::post('/addEmployee', 'EmployeeController@addEmployee');
Route::post('/getEmployeeDetails/{id}', 'EmployeeController@getEmployeeDetails');
Route::post('/updateEmployee/{id}', 'EmployeeController@updateEmployee');
Route::post('/deleteEmployee/{id}', 'EmployeeController@deleteEmployee');
Route::post('/getEmployees', 'EmployeeController@getEmployees');


Route::get('/getInventoryLists', 'InventoriesController@index');
Route::post('/addInventory', 'InventoriesController@addInventory');
Route::post('/getInventoryDetails/{id}', 'InventoriesController@getInventoryDetails');
Route::post('/updateInventory/{id}', 'InventoriesController@updateInventory');
Route::post('/deleteInventory/{id}', 'InventoriesController@deleteInventory');
Route::post('/getInventories', 'InventoriesController@getInventories');
Route::post('/uploadInventoryImage', 'InventoriesController@uploadInventoryImage');

Route::get('/getCustomerLists', 'CustomerController@index');
Route::post('/addCustomer', 'CustomerController@addCustomer');
Route::post('/getCustomerDetails/{id}', 'CustomerController@getCustomerDetails');
Route::post('/updateCustomer/{id}', 'CustomerController@updateCustomer');
Route::post('/deleteCustomer/{id}', 'CustomerController@deleteCustomer');


<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\Department as DepartmentResource;
use App\Http\Resources\Employee as EmployeeResource;


//class EmployeeController extends Controller
class EmployeeController extends BaseController
{
    //	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function department()
    {
        $products = Department::all();    
        return $this->sendResponse(DepartmentResource::collection($products), 'Departments retrieved successfully.');
    }
	
	
	public function employeeList($department_id=null)
    {		
		if(!empty($department_id)){
			$products = Employee::where('department_id',$department_id)->get();
        } else { 		
			$products = Employee::all();  
		}
        return $this->sendResponse(EmployeeResource::collection($products), 'Employees retrieved successfully.');
    }
	
	
	public function addemployee(Request $request)
    {
        $input = $request->all();   
		//echo "<pre>"; print_r($input['department_id']); die;
        /*$validator = Validator::make($input, [
            'department_id ' => 'required',
            'name' => 'required',
			'salary' => 'required'
        ]);  
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } */  
        $product = Employee::create($input);   
        return $this->sendResponse(new EmployeeResource($product), 'Employee created successfully.');
    } 
	
	
	
	public function transferEmployee(Request $request, Employee $product)
    {
        $input = $request->all();   
        /*$validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }*/   
        //$product->id = $input['id'];
        //$product->department_id = $input['department_id'];
        //$product->save();		
		
		$data = Employee::find($input['id']);
		if(!empty($data)){		
			Employee::where('id', $input['id'])->update(['department_id' => $input['department_id']]);		
			return $this->sendResponse(new EmployeeResource($product), 'Employee transferred successfully.');
		} else {
			return $this->sendResponse(new EmployeeResource($product), 'Employee not found.');			
		}				
    }
	
	
	public function removeEmployee(Request $request, Employee $product)
    {
        $input = $request->all();   
        /*$validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }*/   
        //$product->id = $input['id'];
        //$product->department_id = $input['department_id'];
        //$product->save();		
		
		$emp = Employee::find($input['id']);
		$department = Department::find($input['department_id']);
		if(empty($emp)){
			return $this->sendResponse(new EmployeeResource($product), 'Employee not found.');	
		} else if(empty($department)){
			return $this->sendResponse(new DepartmentResource($product), 'Department not found.');	
		} else { 		
			Employee::where('id', $input['id'])->update(['department_id' =>0]);		
			return $this->sendResponse(new EmployeeResource($product), 'Employee removed successfully.');
		} 			
    }
	
	
}

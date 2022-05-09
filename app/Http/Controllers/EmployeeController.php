<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Department;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
    }

    public function empInfo()
    {
        $emp = Employee::all();
        foreach ($emp as $key) {
            $role =  Role::find($key['roleID']);
            $key->role = $role->role;
            $key->dept = Department::find($role->deptID)->name;
        }
        return $emp;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'accNo' => 'required',
            'address' => 'required',
            'roleID' => 'required',
            'base_salary' => 'required',
            'joinedDate' => 'required',
        ]);
        return Employee::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = 'active';
        $condition = [
            ['empID','=', $id],
            ['status','=', $status]
        ];
        $emp = Employee::where($condition)->first();
        if($emp === null){
            return 'not found';
        }else return $emp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $status = 'active';
        $condition = [
            ['empID','=', $id],
            ['status','=', $status]
        ];
        $emp = Employee::where($condition)->first();
        if($emp === null){
            return 'not found';
        }else{
            // $emp = Employee::update($request->all());
            $emp->where($condition)->update($request->all());
            return $emp;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = 'active';
        $condition = [
            ['empID','=', $id],
            ['status','=', $status]
        ];
        $emp = Employee::where($condition)->first();
        if($emp === null){
            return 'not found';
        }else{
            return Employee::where($condition)->delete();
        }
    }
}

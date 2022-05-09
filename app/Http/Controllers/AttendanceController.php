<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Attendance::all();
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
            'attDate' => 'required',
            'punched_in' => 'required',
            'punched_out' => 'required',
            'empID' => 'required',
            'status' => 'required',
        ]);
        return Attendance::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Attendance::find($id);
    }

    /**
     * Display all the attendaces of specified date.
     *
     * @param  date  $date
     * @return \Illuminate\Http\Response
     */
    public function searchByDate($month)
    {
        $finalAttendees = array();
        $att = array();
        $emp = Employee::where('status','active')->get();
        $att = Attendance::whereMonth('attDate',$month)->get();
        $ara = array_values(json_decode($att, true));
        usort($ara,function($a,$b){
            return strtotime($a['attDate']) - strtotime($b['attDate']);
        });
        foreach($emp as $key){
            $empID = $key['empID'];
            // $ara = array_values(json_decode($att, true));
            $attByEmp = Arr::where($ara,function($value,$key) use ($empID){
                return $value['empID'] == $empID;
            });
            $key->attendance =array_values($attByEmp);
        }

        // $emp_arr = array_values(json_decode($emp, true));
        
        return $emp;
    }

    /**
     * Display attendance and employee info
     *
     * @param  date  $date
     * @return \Illuminate\Http\Response
     */
    // public function searchByDate($date)
    // {
    //     // return 'hello'.$date;
    //     $condition = ['attDate', '=',$date];
    //     return Attendance::where('attDate',$date)->get();
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

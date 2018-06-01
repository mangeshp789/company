<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\company;
use App\department;
use App\employment;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function display(Request $request)
    {
         $get_all_data = company::with('department_all.employment_all')->orderBy('id','desc')->get();
         $department = department::lists('name','id');
         $company = company::lists('name','id');

        return view('display',compact('get_all_data','department','company')); 
    }

    public function create(Request $request)
    {
       $created_id = company::create(['name'=>$request->company])->id;
       if($created_id){
         $dep_id = department::create(['name'=>$request->department,'company_id'=>$created_id])->id;
            if($dep_id){
                $dep_id = employment::create(['name'=>$request->emp_name,'depart_id'=>$dep_id])->id;  
            }
       }

         $get_all_data = company::with('department_all.employment_all')->orderBy('id','desc')->get();
         $department = department::lists('name','id');
         $company = company::lists('name','id');

         //$display = view('display',compact('get_all_data','department','company'))->render();
       return Response::JSON(["msg"=>"Create Success",'status'=>true,'get_all_data'=>$get_all_data]);

    }
}

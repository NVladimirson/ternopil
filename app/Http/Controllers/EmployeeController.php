<?php

namespace App\Http\Controllers;

use App\Models\CompanyModel;
use App\Models\EmployeeModel;
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
        // $employees = EmployeeModel::orderByDesc('updated_at')->paginate(25);
        return view('employee.index');
    }
    // { "data": "first_name" },
    // { "data": "last_name" },
    // { "data": "company" },
    // { "data": "email" },
    // { "data": "phone" },
    // { "data": "website" },
    // { "data": "created_at" },
    // { "data": "updated_at" },
    // { "data": "actions" },
    public function datatable(Request $request){
        $employees = EmployeeModel::where('id','>',0);
        
        return datatables()
        ->eloquent($employees)
        ->addColumn('first_name', function (EmployeeModel $employee){
         return $employee->first_name;
        })
        ->addColumn('last_name', function (EmployeeModel $employee){
            return $employee->second_name;
        })
        ->addColumn('company', function (EmployeeModel $employee){
            $company = CompanyModel::find($employee->company_id);
            return '<a href="'.route('companies.show',['company' => $company->id]).'">'.$company->title.'</a>';
        })
        ->addColumn('email', function (EmployeeModel $employee){
            return $employee->email;
        })
        ->addColumn('phone', function (EmployeeModel $employee){
            return $employee->phone;
        })
        ->addColumn('website', function (EmployeeModel $employee){
            return $employee->website;
        })
        ->addColumn('created_at', function (EmployeeModel $employee){
            return $employee->created_at;
        })
        ->addColumn('updated_at', function (EmployeeModel $employee){
            return $employee->updated_at;
        })
        ->addColumn('actions', function (EmployeeModel $employee){
            return 
            "<div>
            <a href=\"".route('employees.show',[$employee->id])."\" class=\"btn btn-sm btn-primary m-r-5\">
            <i class=\"fas fa-eye\"></i></a>
            <a href=\"".route('employees.edit',[$employee->id])."\" class=\"btn btn-sm btn-warning m-r-5\">
            <i class=\"fas fa-pen\"></i></a>
            <a id=\"".$employee->id."\" href=\"#\" class=\"btn btn-sm btn-danger m-r-5 delete-employee\">
            <i class=\"far fa-times-circle\"></i>
            </div>";
        })
         ->rawColumns(['company','actions'])
        ->toJson();


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'second_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_id' => 'required',
            //'website' => 'required',
        ]);
    
        EmployeeModel::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->company_id,
            'website' => $request->website,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
    
        return redirect()->route('companies.index')
            ->with('success', 'Новая компания добавлена в БД.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = EmployeeModel::find($id);
        return view ('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = EmployeeModel::with('company')->find($id);
        $companies = CompanyModel::orderByDesc('updated_at')->get();
        return view ('employee.edit',compact('employee','companies'));
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
        $request->validate([
            'first_name' => 'required',
            'second_name' => 'required',
            'company_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            // 'website' => 'required',
          ]);
    
          $employee = EmployeeModel::find($id);
          $employee->update([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'company_id' => $request->company_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'updated_at' => now()
          ]);
    
        return redirect()->route('employees.index')
            ->with('success', 'Данные компании изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $first_name = EmployeeModel::find($id)->first_name;
        $second_name = EmployeeModel::find($id)->second_name;
        EmployeeModel::where('id', $id)->delete();
  
        return response()->json([
            'name' => $first_name.' '.$second_name,
        ]);
    }
}

<?php

namespace App\Http\Controllers;
use DataTables;
use App\Models\CompanyModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('company.index');
    }
    // { "data": "title" },
    // { "data": "email" },
    // { "data": "logo" },
    // { "data": "created_at" },
    // { "data": "updated_at" },
    // { "data": "actions" },
    public function datatable(Request $request){
        $companies = CompanyModel::where('id','>',0);
        
        return datatables()
        ->eloquent($companies)
        ->addColumn('title', function (CompanyModel $company){
          return $company->title;
        })
        ->addColumn('email', function (CompanyModel $company){
          return $company->email;
        })
        ->addColumn('logo', function (CompanyModel $company){
          return '<img src="'.asset('assets/logos/'.$company->logo).'" style="max-height:100px;max-width:100px">';
        })
        ->addColumn('created_at', function (CompanyModel $company){
          return $company->created_at;
        })
        ->addColumn('updated_at', function (CompanyModel $company){
          return $company->updated_at;
        })
        ->addColumn('actions', function (CompanyModel $company){
          // <a id="{{$firm->id}}" href="#" aria-placeholder="Удалить" class="delete-firm">
          return 
          "<div>
          <a href=\"".route('companies.show',[$company->id])."\" class=\"btn btn-sm btn-primary m-r-5\">
          <i class=\"fas fa-eye\"></i></a>
          <a href=\"".route('companies.edit',[$company->id])."\" class=\"btn btn-sm btn-warning m-r-5\">
          <i class=\"fas fa-pen\"></i></a>
          <a id=\"".$company->id."\" href=\"#\" class=\"btn btn-sm btn-danger m-r-5 delete-company\">
          <i class=\"far fa-times-circle\"></i>
          </div>";
        })
         ->rawColumns(['logo','actions'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

      return view('company.create');
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
        'title' => 'required',
        'email' => 'required',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = time().'.'.$request->logo->extension();  
     
    $request->logo->move(public_path('assets/logos'), $imageName);


    CompanyModel::create([
        'title' => $request->title,
        'email' => $request->email,
        'logo' => $imageName,
        'created_at' => now(),
        'updated_at' => now()
    ]);

      $details = [
        'title' => 'Test Mail',
        'body' => 'Company has been creaeted'
      ];
  
     \Mail::to(auth()->user()->email)->send(new \App\Mail\MyTestMail($details));

    return redirect()->route('companies.index')
        ->with('success', 'Новая компания добавлена в БД. Сообщение послано по адресу: '.auth()->user()->email);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = CompanyModel::find($id);
        return view ('company.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $company = CompanyModel::find($id);
      return view('company.edit', compact('company'));
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
        'title' => 'required',
        'email' => 'required',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $imageName = time().'.'.$request->logo->extension();  
     
      $request->logo->move(public_path('assets/logos'), $imageName);

      $company = CompanyModel::find($id);

      $company->update([
        'title' => $request->title,
        'email' => $request->email,
        'logo' => $imageName,
        'updated_at' => now()
      ]);

    return redirect()->route('companies.index')
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
      $count = EmployeeModel::where('company_id', $id)->get()->count();
      EmployeeModel::where('company_id', $id)->delete();
      $company = CompanyModel::find($id);
      $title = $company->title;
      $company->delete();

      return response()->json([
          'name' => $title,
          'deleted_employees' => $count,
      ]);
    }
}

@extends('layouts.main')
@section('content')
<div id="layoutSidenav_content">
   <main>
   <div class="container-fluid">
   <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Изменить данные пользователя</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-12">

<div class="card-header">
    <svg class="svg-inline--fa fa-chart-area fa-w-16 mr-1" 
    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chart-area" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M500 384c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H12c-6.6 0-12-5.4-12-12V76c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v308h436zM372.7 159.5L288 216l-85.3-113.7c-5.1-6.8-15.5-6.3-19.9 1L96 248v104h384l-89.9-187.8c-3.2-6.5-11.4-8.7-17.4-4.7z"></path></svg><!-- <i class="fas fa-chart-area mr-1"></i> Font Awesome fontawesome.com -->
    Информация о пользователе:
 </div>
<div class="card-body">
    <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="POST" >
    @method('PATCH')
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Имя:</strong>
                    <input type="text" name="first_name" class="form-control" required placeholder="Телефон" value="{{$employee->first_name}}"> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Фамилия:</strong>
                    <input type="text" name="second_name" class="form-control" required placeholder="Телефон" value="{{$employee->second_name}}"> 
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Компания:</strong>
                    <input type="text" name="employee" class="form-control" required placeholder="Телефон" value="{{$employee->phone}}"> 
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" class="form-control" required placeholder="Телефон" value="{{$employee->email}}"> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Телефон:</strong>
                    <input type="text" name="phone" class="form-control" required placeholder="Телефон" value="{{$employee->phone}}"> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Вебсайт:</strong>
                    <input type="text" name="website" class="form-control" required placeholder="Телефон" value="{{$employee->website}}"> 
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Компания:</strong>
                    <!-- <input type="text" name="name" class="form-control" required placeholder="Наименование"> -->
                    <select class="form-control" name="company_id">
                    <!-- <option value="" selected disabled hidden required><b>Выберите компанию</b></option> -->
                    @if($companies)
                        @foreach($companies as $company)
                        @if($company->id == $employee->company_id)
                        <option selected value="{{$company->id}}">{{$company->title}} (ID: {{$company->id}})</option>
                        @else
                        <option value="{{$company->id}}">{{$company->title}} (ID: {{$company->id}})</option>
                        @endif
                        @endforeach
                    @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Создать контакт компании</button>
        </div>
        </div>

    </form>
    </div>
    </div>
   </main>
</div>
@endsection
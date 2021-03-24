@extends('layouts.main')
@section('content')
<div id="layoutSidenav_content">
   <main>
      <div class="container-fluid">
         <h1 class="mt-4">Компания</h1>
         <div class="row">
            <div class="col-xl-12">
               <div class="card mb-4">
                  <div class="card-header">
                     <i class="fas fa-chart-area mr-1"></i>
                     Задание 1
                  </div>
                  <div class="card-body">
                     <p>
                        1. Написать SQL-запрос, возвращающий название фирмы и ее телефон. В результате
                        должны быть представлены все фирмы по одному разу. Если у фирмы нет телефона,
                        нужно вернуть пробел или прочерк. Если у фирмы несколько телефонов, нужно
                        вернуть любой из них.
                     </p>

                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-4">
               <div class="card mb-4">
                  <img src="/assets/img/firms.png">
               </div>
            </div>
            <div class="col-xl-4">
               <div class="card mb-4">
                  <img src="/assets/img/phones.png">
               </div>
            </div>
            <div class="col-xl-4">
               <div class="card mb-4">
                  <img src="/assets/img/joined_by_phone.png">
               </div>
            </div>
         </div>
      </div>

     
   </main>
</div>
@endsection
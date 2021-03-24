@extends('layouts.main')
@section('content')
<div id="layoutSidenav_content">
   <main>
   <div class="container-fluid">
   <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Создать новую компанию</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('firms.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
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
    Информация о компании:
 </div>
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
        <p id="demo"></p>
        </div>
        <div class="col-md-6">
        <input name="date_from" class="date_picker form-control" id="datetimepicker" required>
            </div>
    </div>


    </div>
    </div>
   </main>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.js" crossorigin="anonymous"></script>
<script>
   $(document).ready( function () {
     $("#datetimepicker").datetimepicker(
         {
            
            //'setDate': new Date(),
             //'defaultDate': new Date('21.10.2021 01:00'),

            format: 'dd.mm.yyyy hh:ii',

        }
    
    
     );
     $("#datetimepicker").val('{{$right_date_formatted}}');

     $("#datetimepicker").change(function ()  {
        let time = $("#datetimepicker").val();
        let url = '{{ route("setDate") }}';
        $.ajax({
        type: "POST",
        data:{
        // _method:"DELETE",
        "_token": "{{ csrf_token() }}",
        "time": time
        },
        url: url,
        success: function(response){
            alert('Время изменено')
            document.location.reload();
    }
});
    })
    // $('#datetimepicker').datetimepicker({
	// 				format: 'DD.MM.YYYY'
	// 			});
   } );
</script>

<script>
// Set the date we're counting down to
//var countDownDate = new Date("Jan 5, 2022 15:37:25").getTime();
//var countDownDate = new Date("2030-02-04 13:00:00").getTime();
var countDownDate = new Date("{{$left_date}}").getTime();
// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);

</script>
@endsection
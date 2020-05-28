@extends('layouts.appadmin')
@section('content-title')
{{ Auth::user()->name }} 

@endsection

@section('content-subtitle')
Dashboard
@endsection

@section('content')


<style type="text/css">
 th{ text-align: center;}
 .laundrylist td{color: #222d32;}

</style>
    <div class="row ">
        <div class="col-md-12 ">

         <div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">PAYMENT RESPONSE</h3>
</div>
<div class="panel-body">
 <a class="visible-xs visible-sm visible-md btn btn-primary" data-toggle="modal" href="#reqlaundry"><i class="fa fa-bar-chart-o fa-fw"></i> <span>Request Laundry</span></a>

</div>

                            <div>
                               @if($status == "success")
                               <h1>Transaction Successful</h1>
<P>Hi {{$laundry->user->name}} </p> 
<p>The laundry transaction you made  was successful,  transaction total ammount is {{$preturn}}</p>

                               @elseif($status == "decline")
                               <h1>Transaction Decline</h1>
<P>Hi {{$laundry->user->name}} </p> 
<p>The laundry transaction you made  was Declined,  transaction total ammount is {{$preturn}}</p>

                               @elseif($status == "failed")
                               <h1>Transaction Failed</h1>
<P>Hi {{$laundry->user->name}} </p> 
<p>The laundry transaction you made  was not successful,  transaction total ammount is {{$preturn}}</p>

                               @endif
                            </div>
                            <!-- /.table-responsive -->
               <div class="panel-footer"> </div>
</div>



        </div>
    </div>

    

<script type="text/javascript">
    var url="{{route('view.laundry')}}";
    var token = '{{ csrf_token() }}';
</script>

@endsection

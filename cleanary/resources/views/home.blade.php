@extends('layouts.appadmin')
@section('content-title')


@endsection

@section('content-subtitle')

@endsection

@section('content')


<style type="text/css">
 th{ text-align: center;}
 .laundrylist td{ text-align: center;color: #222d32;}

</style>
    <div class="row ">
        <div class="col-md-12 ">

         <div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">PENDING LAUNDRY</h3>
</div>
<div class="panel-body">
 <a class="visible-xs visible-sm visible-md btn btn-primary" data-toggle="modal" href="#reqlaundry"><i class="fa fa-bar-chart-o fa-fw"></i> <span>Request Laundry</span></a>

</div>

                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover" style="text-align: center;">
                                    <thead>
                                        <tr style="background-color:#7fd625; color:white; ">
                                            
                                            <th>Reference</th>
                                            <th>Number of clothes</th>
                                            <th>Detail</th>
                                            <th>price &#8358;</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pls as $pl)
                                        <tr class="laundrylist">
                                           
                                            <td >{{$pl->txref}}</td>
                                            <td >{{$pl->totalnum}}</td>
                                            <td ><a data-toggle="modal" class="btn btn-sm btn-success"  href="javascript:void(0)" onclick="vlaundry('{{$pl->id}}')" ><b>Detail</b></a></td>
                                            <td >&#8358;{{$pl->totalprice}}</td>
                                            <td >{{$pl->created_at->diffForHumans()}}</td>
                                            <td > {{$pl->lstatus}}</td>
                                        </tr>
                                       @endforeach
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
               <div class="panel-footer"> {{$pls->links()}}</div>
</div>


            <div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">LAUNDRY HISTORY</h3>
</div>
<div class="panel-body">
This is a Basic panel
</div>

                            <div class="table-responsive">
                                <table class="table  table-bordered table-hover" style="text-align: center;">
                                    <thead>
                                        <tr style="background-color:#7fd625; color:white;">
                                            
                                            <th>Reference</th>
                                            <th>Number of clothes</th>
                                            <th>Detail</th>
                                            <th>price &#8358;</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lhs as $lh )
                                        <tr class="laundrylist">
                                            
                                               <td >{{$lh->txref}}</td>
                                            <td >{{$lh->totalnum}}</td>
                                            <td ><a data-toggle="modal" class="btn btn-sm btn-success"  href="javascript:void(0)" onclick="vlaundry('{{$lh->id}}')" ><b>Detail</b></a></td>
                                            <td >&#8358;{{$lh->totalprice}}</td>
                                            <td >{{$lh->created_at->diffForHumans()}}</td>
                                            <td > {{$lh->lstatus}}</td>
                                        </tr>
                                        @endforeach
                                       
                                       
                                    </tbody>
                                </table>
                                 
                            </div>
                            <!-- /.table-responsive -->
                <div class="panel-footer">{{ $lhs->links() }}</div>
</div>

       

            


        </div>
    </div>

    

<script type="text/javascript">
    var url="{{route('view.laundry')}}";
    var token = '{{ csrf_token() }}';


</script>
<script>
    $(document).ready(function () {
      $('.dropdown-button').dropdown({
        constrainWidth: false,
        hover: true,
        belowOrigin: true,
        alignment: 'left'
      });

      // JAVASCRIPT START HERE //

      // INIT DATEPICKER
      $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15,
        closeOnSelect: true
      });

      // INIT TIMEPICKER
      $('.timepicker').pickatime({
        default: 'now',
        twelvehour: true,
        donetext: 'ok',
        cleartext: 'clear',
        canceltext: 'cancel',
        autoclose: true
      });

      // INIT AUTOCOMPLETE
      $('.autocomplete').autocomplete({
        data: {
          "Apple": null,
          "Orange": null,
          "Banana": null,
          "Grapes": null,
          "Strawberries": null,
          "Pears": null,
          "Plumbs": null,
        },
        limit: 20,
        minLength: 2
      });

    });
  </script>

@endsection

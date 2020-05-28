@extends('admin.layout.auth')

@section('content')


<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> @yield('title') </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
    <div class="row justify-content-center">
        <div class="col-md-8">

         <div class="panel panel-info">
<div class="panel-heading">
<h3 class="panel-title">Awaiting Requested  Laundry</h3>
</div>
<div class="panel-body">
This are list of requested laundry to be confirm
</div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>Refrence</th>
                                            <th>Number of cloth</th>
                                            <th>Detail</th>
                                            <th>price &#8358;</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rls as $rl)
                                        <tr class="laundrylist">
                                           
                                            <td>{{$rl->txref}}</td>
                                            <td>{{$rl->totalnum}}</td>
                                            <td><a href="{{ route('viewlaundry',['id' => $rl->id])}}" >Detail</a></td>
                                            <td>&#8358;{{$rl->totalprice}}</td>
                                            <td>{{$rl->created_at->diffForHumans()}}</td>
                                            <td> {{$rl->lstatus}}</td>
                                        </tr>
                                       @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
               <div class="panel-footer">@Cleanary</div>
</div>


            

            


        </div>
    </div>

<script type="text/javascript">
    var url='{{route("view.laundry")}}';
    var token = '{{Session::token()}}';
</script>

@endsection

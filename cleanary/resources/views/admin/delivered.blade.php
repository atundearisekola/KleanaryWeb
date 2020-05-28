@extends('branchadmin.layout.auth')

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
<h3 class="panel-title"> Laundries to be Picked</h3>
</div>
<div class="panel-body">
This are list of Delivered laundries
</div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>Refrence</th>
                                            <th>Number of clothes</th>
                                            <th>Detail</th>
                                            <th>price &#8358;</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pickls as $pl)
                                        <tr class="laundrylist">
                                           
                                            <td>{{$pl->txref}}</td>
                                            <td>{{$pl->totalnum}}</td>
                                            <td><a href="{{ route('single.pickup',['id' => $pl->id])}}" >Detail</a></td>
                                            <td>&#8358;{{$pl->totalprice}}</td>
                                            <td>{{$pl->created_at->diffForHumans()}}</td>
                                            <td> {{$pl->lstatus}}</td>
                                        </tr>
                                       @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
               <div class="panel-footer">{{ $pickls->links() }}</div>
</div>


            s
       

            


        </div>
    </div>

<script type="text/javascript">
    var url='{{route("view.laundry")}}';
    var token = '{{Session::token()}}';
</script>

@endsection

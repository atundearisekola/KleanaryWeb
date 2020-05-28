@extends('branchadmin.layout.auth')

@section('title')

@endsection

@section('content')

	           

                <dl class="list-group">
     <dt class="list-group-item active">Laundry ~</dt>
      <dt class="list-group-item">Username <span id="ref" ><h2>{{$singlep->user->name}}</h2></span></dt>
<dt class="list-group-item">Gender <span id="ref" >{{$singlep->user->gender}}</span></dt>
     
  <dt class="list-group-item">Reference <span id="ref" >{{$singlep->txref}}</span></dt>
  <dt class="list-group-item">Total Laundry <span id="totalnum" >{{$singlep->totalnum}}</span></dt>
  <dt class="list-group-item">Total Price <span id="totalprice" >{{$singlep->totalprice}}</span></dt>
  <dt class="list-group-item">Laundry Status <span id="lstatus" >{{$singlep->lstatus}}</span></dt>
     <dt class="list-group-item">Requested Date <span id="createdat" >{{$singlep->created_at}} - {{$singlep->created_at->diffForHumans()}}</span></dt>
        <dt class="list-group-item">State <span id="state" >{{$singlep->state}}</span></dt>
        <dt class="list-group-item">Sub-Urban <span id="localgov" >{{$singlep->localgov}}</span></dt>
    <dt class="list-group-item">Delivery Address <span id="addr" >{{$singlep->addr}}</span></dt>
    <dt class="list-group-item">Country <span id="country" >{{$singlep->country}}</span></dt>
    <dt class="list-group-item">Short Note <span id="shortnote" >{{$singlep->shortnote}}</span></dt>

     <dt class="list-group-item active">Laundry</dt>

     <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="kv">
                            
                        </table>
                        <script type="text/javascript">JustDisplay('{{$singlep->kleanaryinput}}');</script>
    <dt class="list-group-item">T-Shirt: <span id="tshirt" >{{$singlep->tshirt}}</span></dt>
    <dt class="list-group-item">Trouser <span id="trouser" >{{$singlep->trouser}}</span></dt>
<dt class="list-group-item">Bedshit: <span id="bedshit" >{{$singlep->bedshit}}</span></dt>
<dt class="list-group-item">Tie: <span id="tie" >{{$singlep->tie}}</span></dt>
<dt class="list-group-item">Shoes: <span id="shoes" >{{$singlep->shoes}}</span></dt>
<dt class="list-group-item">Bags: <span id="bags" >{{$singlep->bags}}</span></dt>
    <dt class="list-group-item">Towel: <span id="towel" >{{$singlep->towel}}</span></dt>
    <dt class="list-group-item active">Favorites</dt>
<dt class="list-group-item">Starch: <span id="favstarch" >{{$singlep->favstarch}}</span></dt>
<dt class="list-group-item">Perfume: <span id="favperfume" >{{$singlep->favperfume}}</span></dt>

 <dt class="list-group-item active">Todos</dt>
 <dt class="list-group-item">
 <div class="btn-group" id="todobtn" >
 <a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary('tododisplay','{{$singlep->favperfume}}')">All Image</a>
<a href="javascript:void(0)" id="starchbtn" class="btn btn-primary" onclick="showGallary('tododisplay','{{$singlep->favperfume}}')">Starch</a>
<a href="javascript:void(0)" id="perfumebtn" class="btn btn-primary" onclick="showGallary('tododisplay','{{$singlep->favperfume}}')">Perfume</a>
<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary('tododisplay','{{$singlep->favperfume}}')">Iron</a>
</div>
  <div id="tododisplay"></div>
</dt>
<dt class="list-group-item">
    @if($singlep->lstatus == 'confirmed')
    <a  class="btn btn-primary" href="{{ route('picklaundry',['id' => $singlep->id])}}" >Pick Laundry</a>

    @elseif($singlep->lstatus =='picked')

    <a class="btn btn-primary" href="{{ route('deliverlaundry',['id' => $singlep->id])}}" >Deliver Laundry</a>

    @else

    @endif
</dt>

  </dl>

          
            
                                            
   
                 
              

@endsection

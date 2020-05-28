@extends('admin.layout.auth')

@section('title')
{{ Auth::guard('admin')->user()->name }} 
@endsection

@section('content')

	            

                <dl class="list-group">
     <dt class="list-group-item active">Laundry ~</dt>
  <dt class="list-group-item">Username <span id="ref" ><h2>{{$singlel->user->name}}</h2></span></dt>
  <dt class="list-group-item">Reference <span id="ref" >{{$singlel->txref}}</span></dt>
  <dt class="list-group-item">Gender <span id="ref" >{{$singlel->user->gender}}</span></dt>
  <dt class="list-group-item">Total Laundry <span id="ref" >{{$singlel->totalnum}}</span></dt>
  <dt class="list-group-item">Total Price <span id="totalprice" >{{$singlel->totalprice}}</span></dt>
  <dt class="list-group-item">Laundry Status <span id="lstatus" >{{$singlel->lstatus}}</span></dt>
    <dt class="list-group-item">Requested Date <span id="createdat" >{{$singlel->created_at}} - {{$singlel->created_at->diffForHumans()}}</span></dt>
     
    
  </dl>



                 <form action="{{route('confirm.equest')}}" method="post" enctype="multipart/form-data">
                 @csrf
<div class="form-group center-block offset-md-4">

  <div class="form-group row">
                            

                            <div class="col-md-6">
                               <div id="map" style="width: 320px; height: 480px;"></div>
                            </div>
                        </div>

                          <div class="form-group row">
                            

                            <div class="col-md-6">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Country') }}</span>
                                <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{$singlel->country}}" required autofocus>
                                    </div>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row">
                           

                            <div class="col-md-6">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('State') }}</span>
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{$singlel->state}}" required autofocus>
                             </div>
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row">
                            

                            <div class="col-md-6">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Sub Urban') }}</span>
                                <input id="localgov" type="text" class="form-control{{ $errors->has('localgov') ? ' is-invalid' : '' }}" name="localgov" value="{{$singlel->localgov}}" required autofocus>
                                   </div>
                                @if ($errors->has('localgov'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('localgov') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

<div class="form-group row">
                          

                            <div class="col-md-6">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Address') }}</span>
                                <input id="addr" type="text" class="form-control{{ $errors->has('addr') ? ' is-invalid' : '' }}" name="addr" value="{{$singlel->addr}}" onchange="codeAddress()" required autofocus>
                             </div>
                                @if ($errors->has('addr'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            

                            <div class="col-md-6">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Picker') }}</span>
                                <select id="picker"  class="form-control{{ $errors->has('picker') ? ' is-invalid' : '' }}" name="picker"  required autofocus>
                                <option>Select Picker</option>
                                @foreach($pickers as $picker)
                                <option value="{{$picker->id}}">{{$picker->branchname}}</option>

                                @endforeach

                                </select>
                                   </div>
                                @if ($errors->has('picker'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('picker') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <textarea id="shortnote" name="shortnote" class="form-control" >{{$singlel->shortnote}}</textarea>
                        <select id="lstatus" name="lstatus" class="form-control"> 
                            <option value="confirmed">confirmed</option>
                             <option value="canceled">canceled</option>
                        </select>
                         <input id="id" hidden="hidden" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{$singlel->id}}"  required >
                      <input type="submit"  class="btn btn-block btn-info" value="Ok">

                    

</form>
    <hr>

    <dl>
     <dt class="list-group-item active">Laundry</dt>
     <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="kv">
                            
                        </table>
     <script type="text/javascript">JustDisplay('{{$singlel->kleanaryinput}}');</script>

    
    <dt class="list-group-item">T-Shirt: <span id="tshirt" >{{$singlel->tshirt}}</span></dt>
    <dt class="list-group-item">Trouser <span id="trouser" >{{$singlel->trouser}}</span></dt>
<dt class="list-group-item">Bedshit: <span id="bedshit" >{{$singlel->bedshit}}</span></dt>
<dt class="list-group-item">Tie: <span id="tie" >{{$singlel->tie}}</span></dt>
<dt class="list-group-item">Shoes: <span id="shoes" >{{$singlel->shoes}}</span></dt>
<dt class="list-group-item">Bags: <span id="bags" >{{$singlel->bags}}</span></dt>
    <dt class="list-group-item">Towel: <span id="towel" >{{$singlel->towel}}</span></dt>
    <dt class="list-group-item active">Favorites</dt>
<dt class="list-group-item">Starch: <span id="favstarch" >{{$singlel->favstarch}}</span></dt>
<dt class="list-group-item">Perfume: <span id="favperfume" >{{$singlel->favperfume}}</span></dt>

 <dt class="list-group-item active">Todos</dt>
 <dt class="list-group-item">
 <div class="btn-group" id="todobtn" >
 <a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary('{{$singlel->user_id}}','{{$singlel->laundryimg}}')">All Image</a>
<a href="javascript:void(0)" id="starchbtn" class="btn btn-primary" onclick="showGallary('{{$singlel->user_id}}','{{$singlel->todostarch}}')">Starch</a>
<a href="javascript:void(0)" id="perfumebtn" class="btn btn-primary" onclick="showGallary('{{$singlel->user_id}}','{{$singlel->todoperfume}}')">Perfume</a>
<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary('{{$singlel->user_id}}','{{$singlel->todoiron}}')">Iron</a>
 
</div>
  <div id="tododisplay">hi</div>
</dt>

  </dl>

          
            
                                            
   
                 
               


@endsection

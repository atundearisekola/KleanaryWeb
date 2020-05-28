@extends('admin-lte::layouts.main')

@if (auth()->check())
@section('user-avatar', 'http://127.0.0.1:8000/img/header-bg.jpg' . md5(auth()->user()->email) . '?d=mm')
@section('user-name', auth()->user()->name)
@endif

@section('breadcrumbs')

@endsection

@section('sidebar-menu')
<ul class="sidebar-menu">
  <li class="active">
    <a href="{{ route('home') }}">
      <i class="fa fa-home"></i>
      <span>Home</span>
    </a>
  </li>
   <li  class="hidden-sm hidden-md">
                            <a data-toggle="modal" href="#reqlaundry"><i class="fa fa-bar-chart-o fa-fw"></i> <span>Request Laundry</span></a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{route('getfav')}}"><i class="fa fa-table fa-fw"></i> <span>Add Favorite</span></a>
                        </li>
                        <li>
                            <a href="{{ route('acountsetup') }}"><i class="fa fa-edit fa-fw"></i> <span>Account Setup</span></a>
                        </li>
</ul>

@endsection
@section('modals')

  <!-- Portfolio Modals -->
@if(Auth::user()) 
   


 <div id="reqlaundry" class="modal modal-fixed-footer">
      <div class="modal-content">
       <div class="modal-header label-success">
<button type="button" class="close"
data-dismiss="modal" aria-hidden="true">
&times;
</button>
<h4 class="modal-title" id="myModalLabel">
REQUEST LAUNDRY</h4>
</div>
          
                <div class="modal-body ">
                 <form action="{{route('make.request')}}" method="post" enctype="multipart/form-data">
                 @csrf
<div class="form-group center-block offset-md-4">

 <div class="form-group row">
                           
                            <div class="col-md-12">
                            <div class="input-group">
                                  <div class="file-field input-field">
        <div class="btn">
          <span>Upload File</span>
                                    <input type="file"  id="laundryimg"  name="laundryimg[]" multiple="multiple" />
                                </div>
        <div class="file-path-wrapper">
          <input type="text" class="file-path">
        </div>
      </div>
                                </div>

                                @if ($errors->has('laundryimg'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('laundryimg') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                           
                            <div class="col-md-12">
                            <div class="input-group">
                            
                                 
                                 <select id="kvalue" class="form-control">
                                     <option value="" disabled selected>Select Laundry</option>
                                       @foreach($klists as $klist)
            <option value="{{$klist['kname']}}|{{$klist['kprice']}}">{{$klist['kname']}} - &#8358;{{$klist['kprice']}}</option>
            
                                       @endforeach
                                 </select>
                               
                                <input  id="kqty" type="number" onfocus="revertdone()" class="form-control {{ $errors->has('tshirt') ? ' is-invalid' : '' }}" name="tshirt" value="{{ old('tshirt') !='' ? old('tshirt') : '0'}}"  autofocus>
                                <span class="input-group-addon  "><a href="javascript:void(0)" class="btn btn-block btn-lg btn-info" onclick="AddtoKleanary()">Add</a></span>
                                <p id="statustshirt"></p>
                                </div>

                                @if ($errors->has('tshirt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tshirt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover" style="text-align: center;" id="kv">
                            
                        </table>

                       

                        <hr />
                        <dt class="list-group-item active">Favorite</dt>
                        <div class="input-group" >
<label class="input-group-addon label-success ">Perfume
<select class="form-control" id="favperfume" onfocus="revertdone()" name="favperfume">
   <option value="{{ Auth::user()->favperf }}">{{ Auth::user()->favperf }}</option>
            @foreach($perflists as $perflist)
            <option value="{{$perflist['perfname']}},{{$perflist['perfprice']}}">{{$perflist['perfname']}} - &#8358;{{$perflist['perfprice']}}</option>
            
            @endforeach
    
</select>
</label>

<label class="input-group-addon label-success">Starch
<select class="form-control" id="favstarch" onfocus="revertdone()" name="favstarch">
    <option value="{{ Auth::user()->favstarch }}">{{ Auth::user()->favstarch }}</option>
            @foreach($starlists as $starlist)
            <option value="{{$starlist['starchname']}},{{$starlist['starchprice']}}">{{$starlist['starchname']}} - &#8358;{{$starlist['starchprice']}}</option>
            
            @endforeach
</select>
</label>

</div>
  <div class="input-group">
                                 <span class="input-group-addon label-primary ">{{ __('Location') }}</span>
<a class="btn btn-info" href="javascript:void(0)" id="lcbtn" onclick="ShowHide('clocation','lcbtn')">Change</a></div>
<div id="clocation">
    

                        <div class="form-group row">
                            

                            <div class="col-md-12">
                               <div id="map" style="width: 320px; height: 480px;"></div>
                            </div>
                        </div>

                          <div class="form-group row">
                            

                            <div class="col-md-12">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Country') }}</span>
                                <select id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ Auth::user()->country  }}" required autofocus>
                                  <option value="Nigeria">Nigeria</option>
                                 </select>
                                    </div>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row">
                           

                            <div class="col-md-12">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('State') }}</span>
                                <select id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" value="{{ Auth::user()->state  }}" required autofocus>
                             <option value="Lagos">Lagos</option>
                             </select>

                             </div>
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group row">
                            

                            <div class="col-md-12">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Local Government') }}</span>
                                <select id="localgov" type="text" class="form-control{{ $errors->has('localgov') ? ' is-invalid' : '' }}" name="localgov" value="{{ Auth::user()->localgov  }}" required autofocus>
                                  <option>Ajeromi Ifelodun LG</option>
                                  <option>Alimosho LG</option>
                                  </select>
                                   </div>
                                @if ($errors->has('localgov'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('localgov') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                          

                            <div class="col-md-12">
                             <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Address') }}</span>
                                <input id="addr" type="text" class="form-control{{ $errors->has('addr') ? ' is-invalid' : '' }}" name="addr" value="{{ Auth::user()->addr  }}" onchange="codeAddress()" required autofocus>
                             </div>
                                @if ($errors->has('addr'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
</div>


     
    <hr />
    <dt class="list-group-item active">TODO</dt>
    <div id="preview"></div>
    <div id="mainst"><h4>Starch</h4><a class="btn btn-info" href="javascript:void(0)" id="stbtn" onclick="ShowHide('starch','stbtn')">Minimize</a><div id="starch"></div></div>
    <div id="mainper"><h4>Perfume</h4><a class="btn btn-info" href="javascript:void(0)" id="pbtn" onclick="ShowHide('perfume','pbtn')">Minimize</a><div id="perfume"></div></div>
    <div id="mainiron"><h4>Iron</h4><a class="btn btn-info" href="javascript:void(0)" id="stbtn" onclick="ShowHide('iron','ibtn')">Minimize</a><div id="iron"></div></div>
    
    
    
    
    <div class="btn-group" >
<a href="javascript:void(0)" id="starchbtn" class="btn btn-primary" onclick="preview('starch')">Add Starch</a>
<a href="javascript:void(0)" id="perfumebtn" class="btn btn-primary" onclick="preview('perfume')">Add Perfume</a>
<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="preview('iron')">Iron</a>
<input type="text" hidden name="starchinput" id="starchinput">
<input type="text" hidden name="perfumeinput" id="perfumeinput">
<input type="text" hidden name="ironinput" id="ironinput">
<input type="text" hidden name="kleanaryin" id="kleanaryinput">
</div>



</div>

<div id="reqdiv">
          <div>
              
          </div>
           
           <div id="summary">
               <p></p>
           </div>
              
          </div>     


</form>

          
            
         <a href="javascript:void(0)" class="btn btn-block btn-info" onclick="DoneBall()" id="doneball">Done</a>                                        
   
                 
                </div>
        
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
      </div>
    </div>




<!-- view modal -->
    <div id="viewlaundry" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-content">
       <div class="modal-header">
<button type="button" class="close"
data-dismiss="modal" aria-hidden="true">&times;
</button>

</div>
         
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <div class="panel panel-success">
<div class="panel-heading">
<h3 class="panel-title">Laundry Detail</h3>
</div>
<div class="panel-body">
<table class="table  table-bordered table-hover ">
     
  <tr ><td>Reference </td><td ><b><p id="txrefv"></p></td></tr>
  <tr ><td>Total Price </td><td ><b id="totalpricev" ></b></td></tr>
  <tr ><td>Laundry Status </td><td ><b id="lstatusv" ></b></td></tr>
    <tr ><td>Requested Date </td><td ><b id="createdatv" ></b></td></tr>
        <tr ><td>State </td><td ><b id="statev" ></b></td></tr>
        <tr ><td>Sub-Urban</td> <td><b id="localgovv" ></b></td></tr>
    <tr ><td>Delivery Address </td><td><b id="addrv" ></b></td></tr>
      <tr><td>Country</td><td><b id="countryv" ></b></td></tr>
      <tr ><td>Short Note </td><td><b id="shortnotev" ></b></td></tr>
      
  </table>
  </div>
   <div class="panel-heading">
<h3 class="panel-title">Laundries</h3>
</div>
<div class="panel-body">
<table class="table table-striped table-bordered table-hover">
<tbody id="singlekv"></tbody>
    <!-- 
     <tr ><td>T-Shirt: </td><td id="tshirtv" ></td></tr>
      <tr ><td>Trouser </td><td id="trouserv" ></td></tr>
  <tr ><td>Bedshit: </td><td id="bedshitv" ></td></tr>
  <tr ><td>Tie: </td><td id="tiev" ></td></tr>
  <tr ><td>Shoes: </td><td id="shoesv" ></td></tr>
  <tr ><td>Bags: </td><td id="bagsv" ></td></tr>
  <tr ><td>Towel: </td><td id="towelv" ></td></tr>
  -->
  </table>
 </div>
     <div class="panel-heading">
<h3 class="panel-title">Favorities</h3>
</div>
<div class="panel-body">
<table class="table  table-bordered table-hover">
     
     <tr ><td>Starch:</td> <td id="favstarchv" ></td></tr>
<tr ><td>Perfume: </td><td id="favperfumev" ></td></tr>
</table>
</div>
 <dl>
 <dt class="list-group-item active">Todos</dt>
 <dt class="list-group-item">
 <div class="btn-group" id="todobtnv" >
 
</div>
  <div id="tododisplay"></div>
</dt>

  </dl>
</div>
<div class="panel-footer">@Cleanary</div>
</div>
        
      </div>
      <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
      </div>
    </div>
 
   
    </div>
    <style type="text/css">
     html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0; background: #ecf0f5;}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:700}dfn{font-style:italic}h1{font-size:2em;margin:.67em 0}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-.5em}sub{bottom:-.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{-webkit-box-sizing:content-box;box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace,monospace;font-size:1em}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type=button],input[type=reset],input[type=submit]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type=checkbox],input[type=radio]{-webkit-box-sizing:border-box;box-sizing:border-box;padding:0}input[type=number]::-webkit-inner-spin-button,input[type=number]::-webkit-outer-spin-button{height:auto}input[type=search]{-webkit-appearance:textfield;-webkit-box-sizing:content-box;box-sizing:content-box}input[type=search]::-webkit-search-cancel-button,input[type=search]::-webkit-search-decoration{-webkit-appearance:none}fieldset{border:1px solid silver;margin:0 2px;padding:.35em .625em .75em}textarea{overflow:auto}optgroup{font-weight:700}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}
     .imgdiv{
        border: solid grey;
        padding: 2px;
        margin: 5px;
        
        }
        #clocation{display: none;}
        #mainst,#mainper,#mainiron{display: none;}
        .card{text-align: center;  }
        .navbar li a{color: #fff;}
        .navbar-primary li a {color: #222d32;}
        .navbar-primary {background-color: #3c8dbc;
position: absolute;
top: 0;
left: 0; padding-top: 50px;
min-height: 100%;


-webkit-transition: -webkit-transform .3s ease-in-out,width .3s ease-in-out;
-webkit-transition: width .3s ease-in-out,-webkit-transform .3s ease-in-out;
transition: width .3s ease-in-out,-webkit-transform .3s ease-in-out;
transition: transform .3s ease-in-out,width .3s ease-in-out;
transition: transform .3s ease-in-out,width .3s ease-in-out,-webkit-transform .3s ease-in-out;}
        .home{background: #ecf0f5; font-family: Source Sans Pro,Helvetica Neue,Helvetica,Arial,sans-serif; }


        </style>

@endif
@endsection
  <!-- Bootstrap Core CSS -->
    <link href={{URL::to("js/dashvendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
 <!-- Custom Fonts -->
    <link href={{URL::to("js/dashvendor/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">
   <!-- jQuery -->
    <script src={{URL::to("js/dashvendor/jquery/jquery.min.js")}}></script>

    <!-- Bootstrap Core JavaScript -->
    <script src={{URL::to("js/dashvendor/bootstrap/js/bootstrap.min.js")}}></script>
      <script type="text/javascript" src={{URL::to("js/main/main.js")}}></script>
      <script type="text/javascript" src={{URL::to("js/main/JIC.js")}}></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src={{URL::to("js/materialize.min.js")}}></script>

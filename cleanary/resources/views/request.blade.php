@extends('layouts.appadmin')
@section('content-title')


@endsection

@section('content-subtitle')

@endsection

@section('content')
   <div class="row ">
        <div class=" col-md-8 col-md-offset-2 ">
            <div class="card">
               

                <div class="card-body">
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

                                       @if(Auth::user()->favstarch  !="" && $s=explode(',',Auth::user()->favstarch))

                        		



            <option value="{{$klist['kname']}}|{{$klist['kprice']+ $s[1]}}">{{$klist['kname']}} - &#8358;{{$klist['kprice']+ $s[1]}}</option>
            
                                     
                      

                        		@endif

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
                        <div class="form-group row">
                           
                            <div class="col-md-12">
                        <dt class="list-group-item active">Favorite</dt>
                        <div class="table-responsive" >

                        <table class="table table-stripped table-hover">
                        	<tr>
                        		@if(Auth::user()->favperf !="" && $p=explode(',',Auth::user()->favperf))

                        		<td>Perfume</td><td>{{$p[0]}}</td><td>&#8358;{{$p[1]}}</td>

                        		@endif
                        	</tr>
                        	<tr>
                        		@if(Auth::user()->favstarch  !="" && $s=explode(',',Auth::user()->favstarch))

                        		<td>Starch</td><td>{{$s[0]}}</td><td>&#8358;{{$s[1]}}</td>
                        		

                        		@endif
                        	</tr>
                        </table>


						<input type="text" id="favperfume" onfocus="revertdone()" name="favperfume" value="{{ Auth::user()->favperf }}" hidden>
						<input type="text"  id="favstarch" onfocus="revertdone()" name="favstarch" value="{{ Auth::user()->favstarch }}" hidden>
			    
					</div>


				  <div class="input-group">
				                                 <span class="input-group-addon label-primary ">{{ __('Location') }}</span>
				<a class="btn btn-info" href="javascript:void(0)" id="lcbtn" onclick="ShowHide('clocation','lcbtn')">Change</a></div>
				</div>
				</div>
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
				    <div class="form-group row">
                           
                            <div class="col-md-12">
				    <dt class="list-group-item active">TODO</dt>
				    <div id="preview"></div>
				    <div id="mainst"><h4>Just Hang</h4><a class="btn btn-info" href="javascript:void(0)" id="stbtn" onclick="ShowHide('starch','stbtn')">Minimize</a><div id="starch"></div></div>
				    <div id="mainper"><h4>Perfume</h4><a class="btn btn-info" href="javascript:void(0)" id="pbtn" onclick="ShowHide('perfume','pbtn')">Minimize</a><div id="perfume"></div></div>
				    <div id="mainiron"><h4>Just Iron</h4><a class="btn btn-info" href="javascript:void(0)" id="stbtn" onclick="ShowHide('iron','ibtn')">Minimize</a><div id="iron"></div></div>
				    
				    
				    
				    
				    <div class="btn-group" >
				<a href="javascript:void(0)" id="starchbtn" class="btn btn-primary" onclick="preview('starch')">Just Hang</a>
				<a href="javascript:void(0)" id="perfumebtn" class="btn btn-primary" onclick="preview('perfume')">Add Perfume</a>
				<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="preview('iron')">Just Iron</a>
				<input type="text" hidden name="starchinput" id="starchinput">
				<input type="text" hidden name="perfumeinput" id="perfumeinput">
				<input type="text" hidden name="ironinput" id="ironinput">
				<input type="text" hidden name="kleanaryin" id="kleanaryinput">
				</div>



				<p>
        <input type="checkbox" name="tech" id="html">
        <label for="html">Express ( <label for="html"><span class="grey-text">Note that express service attract extra 40% charges!</span></label>)</label>
      </p>  

				<div id="reqdiv">
				          <div>
				              
				          </div>
				           
				           <div id="summary">
				               <p></p>
				           </div>
				              
				          </div>  

		 
</div>
</div>


</form>
  <a href="javascript:void(0)" class="btn btn-block btn-info" onclick="DoneBall()" id="doneball">Done</a>    

</div>
</div>
</div>
</div>


@endsection
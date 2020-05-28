@extends('layouts.appadmin')

@section('content-title')
{{ Auth::user()->name }} 
@endsection
@section('content-subtitle')
Account Setup
@endsection

@section('content')

	
    <div class="row ">
        <div class=" col-md-6 col-md-offset-3 ">
            <div class="card">
               

                <div class="card-body">
                    <form action="{{ route('acount.update') }}" method="post" >
                        @csrf

                        <div class="form-group row">
                           
                            <div class="col-md-12">
                            <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Name') }}</span>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>
                                </div>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group row">


                            <div class="col-md-12">
                            <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Phone Number') }}</span>
                                <input id="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ Auth::user()->phone  }}" required autofocus>
                                   </div>
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                           
                            <div class="col-md-12">
                            <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Gender') }}</span>
                                <select id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender"  required autofocus>
                                <option value="{{ Auth::user()->name }}">{{ Auth::user()->gender }}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                </select> 
                                </div>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                       
                        <div class="form-group  mb-0">
                            <div class="col-md-12 ">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="{{ __('Update') }}">
                                    
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

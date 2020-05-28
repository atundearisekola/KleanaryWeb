@extends('admin-lte::layouts.auth')

@section('content')
<div class="login-box-body">
  <p class="login-box-msg">Register a new membership</p>

  <form action="{{ route('add.branch') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full name" required autofocus>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      @if ($errors->has('name'))
      <span class="help-block">{{ $errors->first('name') }}</span>
      @endif
    </div>
    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('email'))
      <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="form-group ">
       <input id="phone" type="number" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}"  name="phone" placeholder="Phone Number" required >
         
         @if ($errors->has('phone'))
         <span class="invalid-feedback" >
         {{ $errors->first('phone') }}
         </span>
          @endif                       

       </div>

               <div class="form-group ">
                        
                       <input id="addr" type="text" class="form-control{{ $errors->has('addr') ? ' is-invalid' : '' }}" value="{{ old('addr') }}"  name="addr" placeholder="Enter Address" onchange="codeAddress()" required autofocus>
                   
                       @if ($errors->has('addr'))
                           <span class="invalid-feedback" >
                               {{ $errors->first('addr') }}
                           </span>
                       @endif
                            
               </div>

            <div class="form-group ">
                        
                    <div id="map" style="width: 250px; height: 100px;"></div>
                           
            </div>

          <div class="form-group ">
                         
                <input id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" value="{{ old('country') }}"  name="country" placeholder="User Country" required autofocus>
                    
                 @if ($errors->has('country'))
                     <span class="invalid-feedback" >
                        {{ $errors->first('country') }}
                    </span>
                 @endif
                            
         </div>

                          <div class="form-group ">
                          
                                <input id="state" type="text" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" value="{{ old('state') }}"  name="state" placeholder="User State" required autofocus>
                           
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" >
                                        {{ $errors->first('state') }}
                                    </span>
                                    @endif
                              
                        </div>

                          <div class="form-group ">
                          
                                <input id="localgov" type="text" class="form-control{{ $errors->has('localgov') ? ' is-invalid' : '' }}" value="{{ old('localgov') }}"  name="localgov" placeholder="Sub-Urban/Local Government" required autofocus>
                                   
                                @if ($errors->has('localgov'))
                                    <span class="invalid-feedback" >
                                        {{ $errors->first('localgov') }}
                                    </span>
                                @endif
                            
                        </div>
   

     

                       
                       
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
      </div>
      <!-- /.col -->
    </div>
  </form>

  {{-- <div class="social-auth-links text-center">
    <p>- OR -</p>
    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
    Facebook</a>
    <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
    Google+</a>
  </div> --}}

  <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
</div>

<!-- /.form-box -->
@endsection

@extends('layouts.appadmin')

@section('content-title')
{{ Auth::user()->name }} 

@endsection

@section('content-subtitle')
Add Favorite
@endsection

@section('content')
 

    <div class="col-md-6 col-md-offset-3 home">
<form action="{{route('add.favorite')}}" method="post">
@csrf


    <div class="form-group row center-block">
                           <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Favorite Perfume') }}</span>
                                <select name="favperf" class="form-control">
			<option value="{{ Auth::user()->favperf }}">{{ Auth::user()->favperf }}</option>
			@foreach($perflists as $perflist)
			<option value="{{$perflist['perfname']}},{{$perflist['perfprice']}}">{{$perflist['perfname']}} - &#8358;{{$perflist['perfprice']}}</option>
			
			@endforeach
			
		</select>
		</div>
                           
                        </div>

                        <div class="form-group row center-block" >
                           <div class="input-group">
                                 <span class="input-group-addon label-info ">{{ __('Favourite Starch') }}</span>

                           
                               <select name="favstarch" class="form-control">
			<option value="{{ Auth::user()->favstarch }}">{{ Auth::user()->favstarch }}</option>
			@foreach($starlists as $starlist)
			<option value="{{$starlist['starchname']}},{{$starlist['starchprice']}}">{{$starlist['starchname']}} - &#8358;{{$starlist['starchprice']}}</option>
			
			@endforeach
			
		</select>
                            </div>
                        </div>


 <div class="form-group row center-block">
     <div class="col-md-12 ">
	         <input type="submit" class="btn btn-info btn-lg btn-block" value="Update">
	   </div>
</div>

</form>
</div>



@endsection
@extends('default')

@section('content')
	<section>
		<div class="page-header" id="section-elector-info">
				<div class="row">

					<div class="col-lg-8">
						@if($errors->any())
						<div class="alert alert-success" role="alert"> The record of {{$elector->surname}}, {{$elector->given_name}} has been updated!</div>
						@endif
						{!! Form::model($elector, ['url'=>'elector/'.$elector->id, 'method'=> 'PATCH', 'class'=>'form-horizontal']) !!}
							<h3 class="bg-info">GNA/Hostile</h3>
							<div class="form-group">
								<div class="col-sm-4"><label>{!! Form::hidden('gna',0) !!}{!! Form::checkbox('gna', 1) !!} Gone No Address</label></div>
								<div class="col-sm-4"><label>{!! Form::hidden('hostile',0) !!}{!! Form::checkbox('hostile',1) !!} Hostile</label></div>
								<div class="col-sm-4">{!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}</div>
							</div>
							<h3 class="bg-info">Personal Details</h3>
    						<div class="form-group">							
      							<div class="col-sm-6"><label>Surname</label><input type="text" class="form-control" value="{{$elector->surname}}"></div>
     							<div class="col-sm-6"><label>First Name</label><input type="text" class="form-control" value="{{$elector->forenames}}"></div>
   	 						</div>
   	 						<div class="form-group">
      							<div class="col-sm-4"><label>Title</label><input type="text" class="form-control" value="{{$elector->title}}"></div>
     							<div class="col-sm-4"><label>Age Range</label><input type="text" class="form-control" value="{{ (date('Y') - $elector->age->age_to). "~" . (date('Y') - $elector->age->age_from)  }}"></div>
   	 							<div class="col-sm-4"><label>Maori Descent</label><input type="text" class="form-control" value="{{$elector->maori_descent}}"></div>
   	 						</div>
   	 						<h3 class="bg-info">Residential Address Details</h3>
    						<div class="form-group">
      							<label class="col-sm-12" > Street Address</label>
      							    <div class="col-sm-12"><input type="text" class="form-control" id="text" value="{{$elector->address->flat_no." ".$elector->address->house_no." ". $elector->address->house_alpha. " ". $elector->address->street}}"></div>

    						</div>
    						<div class="form-group">
      							<div class="col-sm-6"><label>Suburb, Town or Rd </label><input type="text" class="form-control" value="{{$elector->address->suburb_town}}"></div>
     							<div class="col-sm-6"><label>City, Postcode</label><input type="text" class="form-control" value="{{$elector->address->city}} , {{$elector->address->post_code}}"></div>
   	 						</div>
    						<h3 class="bg-info">Contact Details</h3>
    						<div class="form-group">
      							<div class="col-sm-6"><label>Phone</label><input type="text" class="form-control" value= "{{$elector -> telephone}} "></div>
     							<div class="col-sm-6"><label>Email</label><input type="email" class="form-control" id="inputEmail1" value="{{ $elector-> email}}"></div>
   							 </div>
   							 <h3 class="bg-info">Enrolment Details</h3>
    						<div class="form-group">
      							<div class="col-sm-6"><label>General/Maori</label><input type="text" class="form-control" value="{{$elector->maori_descent}}"></div>
     							<div class="col-sm-6"><label>Last Changed</label><input type="text" class="form-control" value="{{$elector->updated_at}}"></div>
    						</div>
    					{!! Form::close() !!}
					</div>
				</div>
		</div>
	</section>
@stop
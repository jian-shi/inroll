@extends('default')

@section('content')
	<section>
		<div class="page-header" id="section-elector-info">
				<div class="row">
					<div class="col-lg-6">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae nostrum, amet vel tempora, ex ut incidunt quo laudantium fugiat dolorem consequatur rem, nam provident eos nobis perferendis excepturi neque inventore.
						</p>
					</div>
					<div class="col-lg-6">
						{!! Form::model($elector, ['url'=>'electors/'.$elector->id, 'method'=> 'PATCH', 'class'=>'form-horizontal']) !!}
							<h3 class="bg-info">GNA/Hostile</h3>
							<div class="form-group">
								<div class="col-sm-4"><label>{!! Form::hidden('gna',0) !!}{!! Form::checkbox('gna', 1) !!} Gone No Address</label></div>
								<div class="col-sm-4"><label>{!! Form::hidden('hostile',0) !!}{!! Form::checkbox('hostile',1) !!} Hostile</label></div>
								<div class="col-sm-4">{!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}</div>
							</div>
							<h3 class="bg-info">Personal Details</h3>
    						<div class="form-group">							
      							<div class="col-sm-6"><label>Surname</label><input type="text" class="form-control" value="{{$elector->surname}}"></div>
     							<div class="col-sm-6"><label>First Name</label><input type="text" class="form-control" value="{{$elector->first_name}}"></div>
   	 						</div>
   	 						<div class="form-group">
      							<div class="col-sm-4"><label>Title</label><input type="text" class="form-control" value="{{$elector->title}}"></div>
     							<div class="col-sm-4"><label>Date of Birth</label><input type="text" class="form-control" value="{{$elector->date_of_birth}}"></div>
   	 							<div class="col-sm-4"><label>Maori Descent</label><input type="text" class="form-control" placeholder="{{$elector->maori_descent}}"></div>
   	 						</div>
   	 						<h3 class="bg-info">Residential Address Details</h3>
    						<div class="form-group">
      							<label class="col-sm-12" for="Street-Address"> Street Address</label>
      							<div class="col-sm-12"><input type="text" class="form-control" id="text" placeholder="{{$elector->address->street_address}}"></div>
    						</div>
    						<div class="form-group">
      							<div class="col-sm-6"><label>Suburb, Town or Rd </label><input type="text" class="form-control" placeholder="{{$elector->address->suburb}}"></div>
     							<div class="col-sm-6"><label>City, Postcode</label><input type="text" class="form-control" placeholder="{{$elector->address->city}} , {{$elector->address->postcode}}"></div>
   	 						</div>
    						<h3 class="bg-info">Contact Details</h3>
    						<div class="form-group">
      							<div class="col-sm-6"><label>Phone</label><input type="text" class="form-control" placeholder="1111"></div>
     							<div class="col-sm-6"><label>Email</label><input type="email" class="form-control" id="inputEmail1" placeholder="Email"></div>
   							 </div>
   							 <h3 class="bg-info">Enrolment Details</h3>
    						<div class="form-group">
      							<div class="col-sm-6"><label>General/Maori</label><input type="text" class="form-control" placeholder="General/Maori"></div>
     							<div class="col-sm-6"><label>Last Changed</label><input type="text" class="form-control" placeholder="01/10/2014"></div>
    						</div>
    					{!! Form::close() !!}
					</div>
				</div>
		</div>
	</section>
@stop
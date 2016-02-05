@extends('default')

@section('content')
	<section>
		<div class="page-header" id="section-elector-info">
				<div class="row">

					<div class="col-lg-8">
						@if($errors->any())
						<div class="alert alert-success" role="alert"> The record of {{$elector->surname}}, {{$elector->given_name}} has been updated!</div>
						@endif
						{!! Form::model($elector->relation,['action'=> ['RelationController@store', $elector->id],'class'=>'form-horizontal','id'=>'form']) !!}

							<h3 class="bg-info">GNA/Hostile</h3>
							<div class="form-group">

							    <div class="col-sm-3"><label>Relationship</label>{!! Form::select($elector->id.'[relation]',[null=>'?','friendly'=>'Friendly', 'persuadable'=>'Persuadable', 'hostile'=>'Hostile', 'candidate_vote'=>'Candidate Vote','home_unclear'=>'Home/ Unclear','not_home'=>'Visited Not Home'], isset($elector->relation->relation)?$elector->relation->relation:null, ['class' =>'form-control','id'=>'input-relation']) !!}</div>
                                <div class="col-sm-3"><label>Party Vote</label>{!! Form::select($elector->id.'[party_vote]',[null=>'N/A','act'=>'ACT', 'national'=>'National', 'Labour'=>'Labour', 'conservative'=>'Conservative','nzfirst'=>'NzFirst','green'=>'Green','other'=>'Other'], isset($elector->relation->party_vote)?$elector->relation->party_vote:null, ['class' =>'form-control','id'=>'input-party']) !!}</div>
                                <div class="col-sm-3"><label>GNA</label> {!! Form::hidden($elector->id.'[is_gna]', 0) !!}<input type="checkbox" name={{$elector->id.'[is_gna]'}} value="1" {{isset($elector->relation->is_gna) && $elector->relation->is_gna==1?'checked=checked': 'false'}}></div>

								<div class="col-sm-3">{!! Form::submit('Submit', ['class'=> 'btn btn-primary']) !!}</div>
							</div>

							<h3 class="bg-info">Personal Details</h3>
    						<div class="form-group">							
      							<div class="col-sm-6"><label>Surname</label><input type="text" class="form-control" value="{{$elector->surname}}"></div>
     							<div class="col-sm-6"><label>First Name</label><input type="text" class="form-control" value="{{$elector->forenames}}"></div>
   	 						</div>
   	 						<div class="form-group">
      							<div class="col-sm-3"><label>Title</label><input type="text" class="form-control" value="{{$elector->title}}"></div>
     							<div class="col-sm-3"><label>Age Range</label><input type="text" class="form-control" value="{{ (date('Y') - $elector->age->age_to). "~" . (date('Y') - $elector->age->age_from)  }}"></div>
   	 							<div class="col-sm-3"><label>Occupation</label><input type="text" class="form-control" value="{{$elector->occupation_code or "Unkown"}}"></div>
   	 							<div class="col-sm-3"><label>Maori Descent</label><input type="text" class="form-control" value="{{$elector->maori_descent}}"></div>
   	 						</div>
   	 						<h3 class="bg-info">Residential Address Details</h3>
    						<div class="form-group">
      							<label class="col-sm-12" > Street Address</label>
      							    <div class="col-sm-12"><input type="text" class="form-control" id="text" value="{{$elector->address->flat_no or ''}} {{$elector->address->house_no}}{{$elector->address->house_alpha}} {{ $elector->address->street}}"></div>

    						</div>
    						<div class="form-group">
      							<div class="col-sm-6"><label>Suburb, Town or Rd </label><input type="text" class="form-control" value="{{$elector->address->suburb_town}}"></div>
     							<div class="col-sm-6"><label>City, Postcode</label><input type="text" class="form-control" value="{{$elector->city or NULL}}  {{$elector->address->post_code}}"></div>
   	 						</div>
    						<h3 class="bg-info">Contact Details</h3>
    						<div class="form-group">
      							<div class="col-sm-4"><label>Phone</label>{!! isset($elector->phone->landline)?"<a href='skype:" .$elector->phone->landline. "?call'>":null !!} <input type="text" class="form-control" value= "{!! isset($elector->phone->landline)?$elector->phone->landline:null!!} "></a></div>
     							<div class="col-sm-4"><label>Mobile</label>{!! isset($elector->phone->mobile)?"<a href='skype:" .$elector->phone->mobile. "?call'>":null !!} <input type="text" class="form-control" value= "{!! isset($elector->phone->mobile)?$elector->phone->mobile:null!!} "></a></div>

     							<div class="col-sm-4"><label>Email</label><input type="email" class="form-control" id="inputEmail1" value="{{ $elector-> email}}"></div>
   							 </div>
   							 <h3 class="bg-info">Enrolment Details</h3>
    						<div class="form-group">
      							<div class="col-sm-6"><label>General/Maori</label><input type="text" class="form-control" value="{{$elector->maori_descent}}"></div>
     							<div class="col-sm-6"><label>Last Changed</label><input type="text" class="form-control" value="{{isset($elector->relation->updated_at)?$elector->relation->updated_at.' @ '. $elector->relation->user->name:$elector->updated_at. ' @ Original'}}"></div>
    						</div>
    					{!! Form::close() !!}
					</div>
				</div>
		</div>
	</section>
@stop
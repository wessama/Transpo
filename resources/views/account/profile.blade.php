@extends('layouts.page')

@section('subcontent')

<div class="row">
	<div class="col-lg-6">
		<div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
			<div class="au-card-title">
				<div class="bg-overlay bg-overlay--blue"></div>
				<h3>
					<i class="zmdi zmdi-account"></i>Profile</h3>
				</div>
				<div class="card">
					<form method="POST" id="profileForm" name="profileForm" action="{{ route('updateProfile') }}">
						@csrf
						<div class="card-body card-block">
							<div class="form-group">
								<label class=" form-control-label" for="phone">{{ __('Your phone number ') }}</label>
								<div class="input-group">
									<div class="input-group-addon">{{ __('+20') }}</div>
									<input class="form-control" name="phone" id="phone" type="text" value="{{ $info[0]['phone'] ?  $info[0]['phone']  : old('phone') }}" 
									placeholder="1xxxxxxxx">
								</div>
							</div>
							<div class="form-group">
								<label class=" form-control-label" for="emgc_contact">{{ __('Emergency contact ') }}</label>
								<div class="input-group">
									<div class="input-group-addon">{{ __('+20') }}</div>
									<input class="form-control" name="emgc_contact" id="phone" type="text" value="{{ $info[0]['emgc_contact'] ?  $info[0]['emgc_contact']  : old('emgc_contact') }}" 
									placeholder="1xxxxxxxx">
								</div>
							</div>
							<div class="form-group">
								<label class=" form-control-label" for="address1">{{ __('Address line 1 ') }}<small>(optional)</small></label>
								<div class="input-group">
									<input class="form-control" name="address1" id="address" type="text"
									value="{{ $info[0]['address'] ?  $info[0]['address']  : old('address') }}"
									placeholder="Your address" />
								</div>
							</div>
							<div class="form-group">
								<label class=" form-control-label" for="address2">{{ __('Address line 2 ') }}<small>(optional)</small></label>
								<div class="input-group">
									<input class="form-control" name="address2" id="address" type="text"
									placeholder="Your address" />
								</div>
							</div>
							<div class="form-group">
								<label class=" form-control-label" for="faculty">{{ __('Choose a location') }}</label>
								<select name="meeting_point" class="form-control" id="location">
									@if(!is_null($info[0]['meeting_point_id']))
									<option value="selected">{{ Auth::user()->UserDetails->MeetingPoint->Location->address }}</option>
									@else
									<option value="selected">Choose an option</option>
									@endif
									@foreach($locations as $location)
									<option value="{{ $location->id }}">{{ $location->address }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label class=" form-control-label" for="faculty">{{ __('Choose a meeting point ' ) }}<small> (pick a location first)</small></label>
								<select name="meeting_point" class="form-control" id="meeting_point">
									@if(!is_null($info[0]['meeting_point_id']))
									<option value="{{ Auth::user()->UserDetails->MeetingPoint->id }}">{{ Auth::user()->UserDetails->MeetingPoint->name }}</option>
									@else
									<option value="{{ $info[0]['meeting_point'] ?  $info[0]['meeting_point']  : '' }}">{{ $info[0]['meeting_point'] ?  $info[0]->MeetingPoint['name']  : 'Please select' }}</option>
									@endif
								</select>
							</div>
							<div class="form-group">
								<label class=" form-control-label" for="student_id">{{ __('Your student ID') }}</label>
								<small class="help-block form-text">2018/12345 would be 1812345</small>
								<div class="input-group">
									<div class="input-group-addon">{{ __('20') }}</div>
									<input class="form-control" name="student_id" id="student_id" type="text" value="{{ $info[0]['student_id'] ?  $info[0]['student_id']  : old('student_id') }}" placeholder="Faculty ID">
								</div>															
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary btn-sm" type="submit">
								<i class="fa fa-dot-circle-o"></i> {{ __('Submit') }}
							</button>
							<button class="btn btn-danger btn-sm" type="reset" onclick="this.form.reset()">
								<i class="fa fa-ban"></i> {{ __('Reset') }}
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
				<div class="au-card-title">
					<div class="bg-overlay bg-overlay--blue"></div>
					<h3>
						<i class="zmdi zmdi-image"></i>Avatar</h3>
					</div>
					<div class="card">
						<form method="POST" action="{{ route('updateAvatar') }}" enctype="multipart/form-data">
							@csrf
							<div class="card-body card-block">
								<div class="account2">
									<div class="image img-cir img-120">
										@include('account.avatar')
									</div>
									<h4 class="name">{{ Auth::user()->name }}</h4><small class="help-block form-text">You can change this in <mark><a href="{{ route('settings') }}">Settings</a><mark></small>
									</div>
									<div class="form-group">
										<label class="form-control-label" for="avatar">{{ __('Change your avatar') }}</label>
										<input name="avatar" class="form-control-file" id="file-input" type="file">
									</div>
								</div>
								<div class="card-footer">
									<button class="btn btn-primary btn-sm" type="submit">
										<i class="fa fa-dot-circle-o"></i> {{ __('Upload') }}
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


			@endsection


			@push('pagescript')
			<script>
				var url = "{{ url('/account/profile') }}";
			</script>
			<script src="{{ asset('js/profile.js') }}" type="text/javascript"></script>
			@endpush
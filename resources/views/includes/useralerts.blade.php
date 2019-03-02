@if(is_null(Auth::user()->UserDetails['meeting_point_id']))
<div class="form-group">
	<div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
		<span class="fas fa-info-circle"></span>
		<strong>{{ __('You did not add a meeting point. Visit the ') }}<a href="{{ route('profile') }}">{{ __('Profile') }}</a>{{ __(' tab to start setting up your profile.') }}</strong>
		<button class="close" aria-label="Close" type="button" data-dismiss="alert">
			<span aria-hidden="true">×</span>
		</button>
	</div>
</div>
@endif





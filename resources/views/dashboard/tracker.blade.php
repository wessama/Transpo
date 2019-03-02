@extends('layouts.page')

@section('subcontent')


<div class="row">
	<div class="col-lg-5">
		<div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
			<div class="au-card-title">
				<div class="bg-overlay bg-overlay--blue"></div>
				<h3>
					<i class="fas fa-map-marker-alt"></i>Location</h3>
				</div>
				<div class="card">
					<div id="map-canvas" style="width: 600px; height: 500px;"></div>
				</div>
			</div>
		</div>
	</div>


	@endsection

	@push('pagescript')
	<script>
		var user_location = "{{ auth()->user()->LocationPermission->first()->location_id }}";
		var url = "{{ url('dashboard/tracking') }}";
	</script>
	<script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.19.0.min.js"></script>
	<script src="{{ asset('js/tracker.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd_2PBiHuMVpQ3zAcY2wm0dOVM26OX-K0&callback=initialize"></script>
	@endpush
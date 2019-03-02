@if(count($errors) > 0)

@foreach($errors->all() as $error)
<div class="form-group">
	<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
		<span class="fa fa-warning"></span>
		<strong>{{ $error }}</strong>
		<button class="close" aria-label="Close" type="button" data-dismiss="alert">
			<span aria-hidden="true">×</span>
		</button>
	</div>
</div>
@endforeach

@endif

@if(session('error'))
<div class="form-group">
	<div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
		<span class="fa fa-warning"></span>
		<strong>{{ session('error') }}</strong>
		<button class="close" aria-label="Close" type="button" data-dismiss="alert">
			<span aria-hidden="true">×</span>
		</button>
	</div>
</div>
@endif

@if(session('warning'))
<div class="form-group">
	<div class="sufee-alert alert with-close alert-dark alert-dismissible fade show">
		<span class="fa fa-warning"></span>
		<strong>{{ session('warning') }}</strong>
		<button class="close" aria-label="Close" type="button" data-dismiss="alert">
			<span aria-hidden="true">×</span>
		</button>
	</div>
</div>
@endif

@if(session('success'))
<div class="form-group">
	<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
		<span class="fa fa-check"></span>
		<strong>{{ session('success') }}</strong>
		<button class="close" aria-label="Close" type="button" data-dismiss="alert">
			<span aria-hidden="true">×</span>
		</button>
	</div>
</div>
@endif


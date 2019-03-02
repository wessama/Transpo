@extends('layouts.app')

@section('content')

<div class="main-content">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col">
					<div class="col-lg-6" id="errorList">
						@include('includes.alerts')
						@include('includes.useralerts')
						@include('includes.modal')
					</div>
					@yield('subcontent')
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
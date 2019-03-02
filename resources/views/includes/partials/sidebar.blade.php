<div class="account2">
	<div class="image img-cir img-120">
		@include('account.avatar')
	</div>
	<h4 class="name">{{ Auth::user()->name }}</h4>
	<a href="{{ route('logout') }}"
	onclick="event.preventDefault();
	document.getElementById('logout-form').submit();">Sign out</a>
</div>
<nav class="navbar-sidebar2">
	<ul class="list-unstyled navbar__list">
			<li class="{{ Route::currentRouteNamed('home') ? 'active' : '' }}">
			<a href="{{ route('home') }}">
				<i class="fas fa-home"></i>Home</a>
			</li>
			<li class="{{ Route::currentRouteNamed('location') ? 'active' : '' }}">
			<a href="{{ route('location') }}">
				<i class="fas fa-map-marker-alt"></i>Track your bus</a>
			</li>
			@if(Voyager::can('browse_bus_stops'))
			<li class="has-sub">
				<a class="js-arrow" href="#">
					<i class="fas fa-sync-alt"></i>Stops
					<span class="arrow">
						<i class="fas fa-sync-alt"></i>
					</span>
				</a>
				<ul class="list-unstyled navbar__sub-list js-sub-list">
					<li class="{{ Route::currentRouteNamed('stops') ? 'active' : '' }}">
					<a href="{{ route('stops') }}">
					<i class="fas fa-arrow-right"></i>Arrival</a>
					</li>
					<li class="{{ Route::currentRouteNamed('leaving') ? 'active' : '' }}">
					<a href="{{ route('leaving') }}">
					<i class="fas fa-arrow-left"></i>Leaving</a>
					</li>
					<li class="{{ Route::currentRouteNamed('tracker') ? 'active' : '' }}">
					<a href="{{ route('tracker') }}">
					<i class="fas fa-bus"></i>Start Tracking</a>
					</li>
				</ul>
			</li>
			@endif
			<li class="has-sub">
				<a class="js-arrow" href="#">
					<i class="fa fa-user"></i>Account
					<span class="arrow">
						<i class="fas fa-angle-down"></i>
					</span>
				</a>
				<ul class="list-unstyled navbar__sub-list js-sub-list">
					<li class="{{ Route::currentRouteNamed('profile') ? 'active' : '' }}">
					<a href="{{ route('profile') }}"><i class="fas fa-user-circle"></i>Profile</a>
					</li>
					<li class="{{ Route::currentRouteNamed('settings') ? 'active' : '' }}">
					<a href="{{ route('settings') }}"><i class="fas fa-cog"></i>Settings</a>
					</li>
				</ul>
			</li>
		</ul>
</nav>


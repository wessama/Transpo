@extends('layouts.page')

@section('subcontent')

<div class="row">
    <div class="col">
        <!-- USER DATA-->
        <div class="user-data m-b-40">
            <div class="au-card-title" style="background-image:url('');">
                <div class="bg-overlay bg-overlay--blue"></div>
                <h2 class="title-3 m-b-30">
                    <i class="fas fa-calendar-check"></i>{{ __('Stops') }}</h2>
                </div>
                <div class="filters m-b-45">
                    <div class="rs-select2--light rs-select2--md">
                        <select class="js-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"
                        onchange="location = this.value;">
                        <option selected="selected">{{ request()->id ? request()->id : 'Round' }}</option>
                        @foreach($rounds as $round)
                        <option value="{{ route('leaving', ['id' => $round->id] + \Request::all()) }}">{{ $round->round }}</option>
                        @endforeach
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                @if(Voyager::can('read_locations'))
                <div class="rs-select2--light rs-select2--lg">
                        <select class="js-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"
                        onchange="location = this.value;">
                        <option selected="selected">{{ request()->location ? \App\Location::get_location(request()->location)[0]->address : 'Location' }} </option>
                        @foreach($locations as $location)
                        <option value="{{ route('leaving', ['location' => $location->id] + \Request::all()) }}">{{ $location->address }}</option>
                        @endforeach
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true"
                    onchange="location = this.value;">
                    <option selected="selected">{{ request()->day ? \App\Weekday::get_day(request()->day)[0]->day : 'Day' }}</option>
                    @foreach(\App\Weekday::all() as $day)
                    <option value="{{ route('leaving', ['day' => $day->id] + \Request::all()) }}">{{ $day->day }}</option>
                    @endforeach
                </select>
                <div class="dropDownSelect2"></div>
            </div>
            @endif
                <a href="{{ request()->url() }}" class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>Clear filters</a>
                </div>
                <div class="table-responsive table-data">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>meeting point</td>
                                    <td>number</td>
                                    <td>Names</td>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($points as $point)
                                <tr>
                                    <td>
                                    	{{ $point->name }}
                                    </td>
                                    <td>
                                    	{{ $point_count[$point->id] }}	
                                    </td>
                                    <td>
                                        @foreach($point_names[$point->id] as $names)
                                        @if (!empty($names))
                                           {{ $names." - " }}
                                        @endif
                                        @endforeach
                                     </td>
                            	</tr>
                            	@endforeach
                        </tbody>
                </table>
            </div>
        </div>
        <!-- END USER DATA-->
    </div>
</div>

@endsection
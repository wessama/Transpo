@extends('layouts.page')

@section('subcontent')


@if(\App\BusStop::getUserArrivalRound(Auth::user()->id, $Carbon::now()->dayOfWeek)->count() > 0)
<div class="form-group">
    <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
        <span class="fas fa-info-circle"></span>
        {{ __('Your bus is scheduled to arrive in ') }}
        <strong>{{ Auth::user()->UserDetails->MeetingPoint->name }}</strong>
        {{ __(' at ')}}
        <strong>{{ $Carbon::parse($BusDetails['arrival_time'])->format('h:i A')  }}</strong>
        <button class="close" aria-label="Close" type="button" data-dismiss="alert">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif

@if(\App\BusStop::getUserDepartureRound(Auth::user()->id, $Carbon::now()->dayOfWeek)->count() > 0)
<div class="form-group">
    <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
        <span class="fas fa-info-circle"></span>
        {{ __('Your bus is scheduled to leave to ') }}
        <strong>{{ Auth::user()->UserDetails->MeetingPoint->name }}</strong>
        {{ __(' at ')}}
        <strong>{{ $Carbon::parse($BusDetails['departure_time'])->format('h:i A') }}</strong>
        <button class="close" aria-label="Close" type="button" data-dismiss="alert">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif

<div class="row">
    <div class="col-lg-6">
        <!-- USER DATA-->
        <div class="user-data m-b-40">
            <div class="au-card-title" style="background-image:url('');">
                <div class="bg-overlay bg-overlay--blue"></div>
                <h2 class="title-3 m-b-30">
                    <i class="fas fa-calendar-check"></i>{{ __('schedule') }}</h2>
                </div>
                <div class="col-lg-6 m-t-30">
                    <div class="form-group">
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show" style="display: none;" id="handleThrowable">
                            <span class="fa fa-warning"></span>
                            <strong id="throwableText"></strong>
                            <button class="close" aria-label="Close" type="button" data-dismiss="alert">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-data">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>day</td>
                                    <td>arrival</td>
                                    <td>leaving</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$meeting_point_validator)
                                <tr>
                                    <td colspan="3" class="alert alert-info empty-row">
                                        <span class="far fa-check-circle"></span>
                                        {{ __(' You cannot set up your schedule before choosing a meeting point. Visit your ') }}
                                        <a href="{{ route('profile') }}">Profile</a>
                                        {{ __(' tab.') }}
                                    </td>
                                </tr>
                                @else
                                @foreach(\App\Weekday::all() as $day)
                                <tr>
                                    <td>
                                        <div class="table-data__info">
                                            <h6>{{ $day->day }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div id="action" class="rs-select2--trans rs-select2--sm">
                                            <select class="js-select2 select2-hidden-accessible roundAction" data-class="{{ $day->id }}" tabindex="-1" aria-hidden="true">
                                                @if(\App\BusStop::getUserArrivalRound(Auth::user()->id, $day->id)->count() > 0)
                                                <option value="selected">Round {{ \App\BusStop::getUserArrivalRound(Auth::user()->id, $day->id)->first()->round_id }}
                                                </option>    
                                                @else
                                                <option value="selected">Choose</option>
                                                @endif
                                                @foreach(App\Round::getArrivalTimes() as $round)
                                                <option value="{{ $round->id }}">Round 
                                                    {{ $round->id }}
                                                    {{__(' at ')}}
                                                    {{ $Carbon::parse($round->time)->format('h:i A') }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </td>
                                    <td>
                                      <div id="action" class="rs-select2--trans rs-select2--sm">
                                        <select  class="js-select2 select2-hidden-accessible roundAction" data-class="{{ $day->id }}" tabindex="-1" aria-hidden="true">
                                            @if(\App\BusStop::getUserDepartureRound(Auth::user()->id, $day->id)->count() > 0)
                                            <option value="selected">Round {{ \App\BusStop::getUserDepartureRound(Auth::user()->id, $day->id)->first()->round_id }}
                                            </option>    
                                            @else
                                            <option value="selected">Choose</option>
                                            @endif
                                            @foreach(App\Round::getDepartureTimes() as $round)
                                            <option value="{{ $round->id }}">Round 
                                                {{ $round->id }}
                                                {{__(' at ')}}
                                                {{ $Carbon::parse($round->time)->format('h:i A') }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </td>
                                <td class="table-data-feature">
                                    <form action="{{ route('deleteStop', ['id' => $day->id ]) }}" method="POST" data-message="Are you sure you want to remove this day from your schedule?">
                                        @csrf
                                        {{ method_field('delete') }}
                                        <button title="" class="item btn-delete-form" data-original-title="Delete" data-placement="top" data-toggle="tooltip">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END USER DATA-->
        </div>
        <div class="col-lg-6">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title" style="background-image:url('');">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h2 class="title-3 m-b-30">
                        <i class="fas fa-bus"></i>{{ __('bus info') }}</h2>
                    </div>
                    <div class="card">
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"><strong>Bus line</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{ $info['meeting_point'] ? Auth::user()->UserDetails->MeetingPoint->Location->address : 'Set your meeting point' }}</p>
                                    <a href="{{ route('profile') }}"><span class="fa fa-edit"></span></a>
                                </div>
                            </div>
                            @if($info['meeting_point'])
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"><strong>Current Meeting Point</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{ $info['meeting_point'] ? $info['meeting_point'] : 'No meeting point has been set' }}</p>
                                </div>
                            </div>
                            @endif
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"><strong>Round 1</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{ $info['meeting_point'] ? $Carbon::parse(Auth::user()->UserDetails->MeetingPoint->Schedule->first()->time)->format('h:i A') : 'Not available' }}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"><strong>Round 2</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{ $info['meeting_point'] ? $Carbon::parse(Auth::user()->UserDetails->MeetingPoint->Schedule->first()->time_alt)->format('h:i A') : 'Not available' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-lg-6">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                <div class="au-card-title" style="background-image:url('');">
                    <div class="bg-overlay bg-overlay--blue"></div>
                    <h2 class="title-3 m-b-30">
                        <i class="fas fa-user"></i>{{ __('user info') }}</h2>
                    </div>
                    <div class="card">
                        <div class="card-body card-block">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class="form-control-label"><strong>Name</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{ Auth::user()->name }}</p>
                                    <a href="{{ route('settings') }}"><span class="fa fa-edit"></span></a>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"><strong>Contact</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static"><strong>{{__('(+20) ')}}</strong>{{ $info['phone'] ? $info['phone'] : 'Set up your contact details' }}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label class=" form-control-label"><strong>Address</strong></label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <p class="form-control-static">{{ $info['address'] ? $info['address'] : 'Set your address' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endsection


        @push('meta')
        <meta name="csrf-token" content="{{csrf_token()}}">
        @endpush

        @push('pagescript')

        <script type="text/javascript">var url = "{{ url('/dashboard/home') }}";</script>
        <script src="{{ asset('js/dashboard.js') }}"></script>

        @endpush

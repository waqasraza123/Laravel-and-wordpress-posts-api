@extends('crudbooster::admin_template')

@section('content')


<div class="container">
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-12">
                <h3>Newsletter Statistics Details</h3>

                <h4 style="margin-top: 30px">Open Details</h4>
                <table class="table table-bordered table-striped">
                    <thead  style="background: #f5f5f5">
                    {{--<th>#</th>--}}
                    {{--<th>Sent Date</th>--}}
                    {{--<th>Frequency</th>--}}
                    <th width="50%">Open Date/Time</th>
                    <th>Subscriber</th>
                    {{--<th>Event Count</th>--}}
                    </thead>
                    <tbody>
                    @foreach($openedEvents as $eventTracking)
                        <tr>
                            {{--<td>{{$eventTracking['id']}}</td>--}}
                            {{--<td>{{$eventTracking['sent_date']}}</td>--}}
                            {{--<td>{{$eventTracking['action']}}</td>--}}
                            <td>{{$eventTracking['open_date']}}</td>
                            <td>{{$eventTracking['user']['email']}}</td>
                            {{--<td>{{count($eventTracking['items'])}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <h4 style="margin-top: 30px">Click Details</h4>
                <table class="table table-bordered table-striped">
                    <thead  style="background: #f5f5f5">
                    {{--<th>#</th>--}}
                    {{--<th>Sent Date</th>--}}
                    {{--<th>Frequency</th>--}}
                    <th width="50%">Click Date/Time</th>
                    <th>Subscriber</th>
                    {{--<th>Event Count</th>--}}
                    {{--<th>Open Date</th>--}}
                    </thead>
                    <tbody>
                    @foreach($clickedEvents as $eventTracking)
                        <tr>
                            {{--<td>{{$eventTracking['id']}}</td>--}}
                            {{--<td>{{$eventTracking['sent_date']}}</td>--}}
                            <td>{{$eventTracking['click_date']}}</td>
                            <td>{{$eventTracking['user']['email']}}</td>

                            {{--<td>{{$eventTracking['action']}}</td>--}}
                            {{--<td>{{count($eventTracking['items'])}}</td>--}}
                            {{--<td>{{$eventTracking['open_date']}}</td>--}}
                            {{--<td>{{$eventTracking['click_date']}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{--<table class="table table-bordered table-striped">
                    <thead>
                    <th>#</th>
                    <th>Sent Date</th>
                    <th>Frequency</th>
                    <th>User</th>
                    <th>Event Count</th>
                    <th>Open Date</th>
                    <th>Click Date</th>
                    </thead>
                    <tbody>
                    @foreach($eventTrackings as $eventTracking)
                        <tr>
                            <td>{{$eventTracking['id']}}</td>
                            <td>{{$eventTracking['sent_date']}}</td>
                            <td>{{$eventTracking['action']}}</td>
                            <td>{{$eventTracking['user']['email']}}</td>
                            <td>{{count($eventTracking['items'])}}</td>
                            <td>{{$eventTracking['open_date']}}</td>
                            <td>{{$eventTracking['click_date']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>--}}

            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection

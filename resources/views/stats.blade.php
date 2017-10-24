@extends('crudbooster::admin_template')

@section('content')
<div class="container">
    <div class="content-wrap">
        <div class="row">
            <div class="col-md-12">
                <h3>Newsletter Statistics</h3>

                <table class="table table-bordered table-striped">
                    <thead style="background: #f5f5f5">
                    <th>Sent Date</th>
                    <th>Emails Sent</th>
                    <th>Open Rate</th>
                    <th>CTR</th>
                    <th>Details</th>
                    </thead>
                    <tbody>
                    @foreach($eventTrackings as $eventTracking)
                        <tr>
                            <td>{{$eventTracking->sent_date}}</td>
                            <td>{{$eventTracking->mailing_count}}</td>
                            <td>{{number_format((($eventTracking['mailing_count']-$eventTracking['not_opened_count']) / $eventTracking['mailing_count']) * 100)}}%</td>
                            <td>{{number_format((($eventTracking['mailing_count']-$eventTracking['not_clicked_count']) / $eventTracking['mailing_count']) * 100)}}%</td>
                            <td>
                                <a href="{{route('stats.details',['eventId' => $event->id, 'sent_date' => $eventTracking['sent_date'], 'action'=>$eventTracking['action']])}}"
                                   style="color: #666"
                                >
                                    Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')


@endsection

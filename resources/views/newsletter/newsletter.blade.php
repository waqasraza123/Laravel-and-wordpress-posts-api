
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans|Raleway:600|Oswald" rel="stylesheet">

    <!--[if !mso]><!-- -->
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Open+Sans|Raleway:600|Oswald" rel="stylesheet" type='text/css'>
    <!--<![endif]-->

    <title>Document</title>
</head>
<body>




<img src="{{$pixelUrl}}" width="1" height="1">


@if(!empty($events['thismonth']))
    @if(count($events['thismonth']) >= 1)
        {{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">This month</h3>--}}
        {{--<hr>--}}
        @foreach($events['thismonth'] as $event)
            @include('newsletter.post_block', ['event' => $event])
        @endforeach
    @endif
@endif

{{--@if(!empty($events['nextmonth']))--}}
    {{--@if(count($events['nextmonth']) >= 1)--}}
        {{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">Next month</h3>--}}
        {{--<hr>--}}
        {{--@foreach($events['nextmonth'] as $event)--}}
            {{--@include('newsletter.post_block', ['event' => $event])--}}
        {{--@endforeach--}}
    {{--@endif--}}
{{--@endif--}}

{{--@if(!empty($events['national']))--}}
    {{--@if(count($events['national']) >= 1)--}}
        {{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">Some more upcoming events</h3>--}}
        {{--<hr>--}}
        {{--@foreach($events['national'] as $event)--}}
            {{--@include('email.newsletter_event_block', ['event' => $event])--}}
        {{--@endforeach--}}
    {{--@endif--}}
{{--@endif--}}





{{--@if(!empty($events['thisweek']))--}}
{{--@if(count($events['thisweek']) >= 1)--}}
{{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">This week</h3>--}}
{{--<hr>--}}
{{--@foreach($events['thisweek'] as $event)--}}
{{--@include('newsletter.post_block', ['event' => $event])--}}
{{--@endforeach--}}
{{--@endif--}}
{{--@endif--}}

{{--@if(!empty($events['nextweek']))--}}
{{--@if(count($events['nextweek']) >= 1)--}}
{{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center;  font-size: 22px; font-weight: 400;">Next week</h3>--}}
{{--<hr>--}}
{{--@foreach($events['nextweek'] as $event)--}}
{{--@include('newsletter.post_block', ['event' => $event])--}}
{{--@endforeach--}}
{{--@endif--}}
{{--@endif--}}

{{--@if(!empty($events['followingforthnight']))--}}
{{--@if(count($events['followingforthnight']) >= 1)--}}
{{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">Following fortnight</h3>--}}
{{--<hr>--}}
{{--@foreach($events['followingforthnight'] as $event)--}}
{{--@include('newsletter.post_block', ['event' => $event])--}}
{{--@endforeach--}}
{{--@endif--}}
{{--@endif--}}

{{--@if(!empty($events['thisforthnight']))--}}
{{--@if(count($events['thisforthnight']) >= 1)--}}
{{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">This fortnight</h3>--}}
{{--<hr>--}}
{{--@foreach($events['thisforthnight'] as $event)--}}
{{--@include('newsletter.post_block', ['event' => $event])--}}
{{--@endforeach--}}
{{--@endif--}}
{{--@endif--}}


{{--@if(!empty($events['nextforthnight']))--}}
{{--@if(count($events['nextforthnight']) >= 1)--}}
{{--<h3 style="font-family:'Arial', Helvetica, Open Sans, Verdana, sans-serif; text-align: center; font-size: 22px; font-weight: 400;">Next fortnight</h3>--}}
{{--<hr>--}}
{{--@foreach($events['nextforthnight'] as $event)--}}
{{--@include('newsletter.post_block', ['event' => $event])--}}
{{--@endforeach--}}
{{--@endif--}}
{{--@endif--}}


</body>
</html>



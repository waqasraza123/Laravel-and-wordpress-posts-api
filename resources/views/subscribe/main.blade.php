<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Subscribe</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        #mydiv {
            height:200px;
            width:400px;
            background: #323232;
            color:#222;
            text-shadow: 0px 1px 2px #555;
            display:none;
            text-align:center;
            line-height:4em;
            font-size:3em;
        }


        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>



</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <form method="POST" action="{{route('subscribe.store')}}" class="form-horizontal">
            {!! csrf_field() !!}

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <input name="first_name" type="text" class="form-control" id="input-text" placeholder="First Name">
                    </div>
                    <div class="col-sm-6">
                        <input name="last_name" type="text" class="form-control" id="input-text" placeholder="Surname">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <input name="email" type="text" class="form-control" id="input-text" placeholder="Email">
                    </div>
                </div>
            </div>

            <div class="form-check form-check-inline">
                <label class="col-sm-12 control-label m-t-ng-8">Select Topics</label>
            @foreach($topics as $topic)
                <label class="form-check-label">
                    <input type="checkbox" name="topics[]" id="c1" value="{{$topic->id}}"> {{$topic->name}}
                </label>
                @endforeach
            </div>

            <div class="form-group" style="margin-top:20px">
                <div class="row">
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-block" type="submit">Subscribe</button>
                    </div>
                </div>
            </div>

        </form>


    </div>
</div>



</body>
</html>

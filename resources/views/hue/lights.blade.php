<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME')}} :: Lights</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" media="all" async>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 50vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .title {
            font-size: 84px;
            text-align: center;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        code {
            color: #c7254e;
            background-color: #f9f2f4;
            border-radius: 4px;
            padding: 2px 4px;
        }

        #lights {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #lights td, #lights th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #lights tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #lights tr:hover {
            background-color: #ddd;
        }

        #lights th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #d00c23;
            color: white;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Philips Hue Lights
        </div>

        <table id="lights">
            <thead>
            <tr>
                <th>Name</th>
                <th>Product name</th>
                <th>State</th>
                <th>Model</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lights ?? '' as $light)
                <tr>
                    <td>{{ $light->name }}</td>
                    <td>{{ $light->productname }}</td>
                    <td>{{ $light->state->on ? 'On' : 'Off' }}</td>
                    <td>{{ $light->modelid }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

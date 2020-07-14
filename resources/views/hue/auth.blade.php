<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hue setup :: Sheep AI</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" media="all" async>

    <!-- Styles -->
    <style>
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
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            HUE Geschept!
        </div>

        <div class="links">
            <p>
                Je kunt dit venster sluiten, veel plezier met Hue ;)
            </p>
        </div>
    </div>
</div>
</body>
</html>

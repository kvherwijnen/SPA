<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>503 :: Onderhoud</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('assets/css/custom.css') }}" media="all" async>
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}" media="all" async>
    <style>
        body {
            background: #0a0b15 !important;
        }

        h1, h2 {
            color: #ffffff !important;
        }
    </style>
</head>

<body>
<div class="wrapper">
    <div class="d-block child-wrapper">
        <div class="d-flex justify-content-around align-content-around h-100">
            <div class="error">
                <div class="error-emoji error-503">
                    <h1>5<span></span>3</h1>
                </div>
                <h2 class="mt-5 pt-5">
                    Snuske? Oh Heerlijk!
                </h2>
                <p>Je ziet deze pagina omdat wij onderhoud plegen aan de website. Meestal duurt dit maar enkele minuten.</p>
                <a href="/">
                    <button class="btn btn-outline-white">Klik hier om te herladen</button>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

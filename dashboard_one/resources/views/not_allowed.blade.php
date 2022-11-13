<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>not allowed Page</title>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .allowed-wrapper {

        }

        .allowed-wrapper img {
            max-width: 50%;
        }

        .allowed-wrapper h3 {
            font-size: 35px;
            font-weight: bold;
            margin: 20px auto;
        }

        .allowed-wrapper .btn {
            background: #0f6848;
            color: #FFF;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 25px;

        }

    </style>
</head>
<body>

    <div class="allowed-wrapper">
        <div>
            <img src="{{ asset('images/not-allowed.svg') }}" alt="" class="img-fluid">
        </div>

        <h3>You Don't have access to this page</h3>

        <a href="{{ route('home') }}" class="btn btn-primary">
            Go To Home
        </a>

    </div>

</body>
</html>

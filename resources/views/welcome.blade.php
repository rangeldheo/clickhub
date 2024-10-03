<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ClickHub</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/vendor/adminlte/dist/css/adminlte.css" />
</head>

<body class="antialiased" style="background-color: #fd8e1d">
    <div class="content d-flex justify-content-center align-items-center vh-100">
        <div class="card col-md-4 p-4">
            <img class="m-auto" src="/vendor/adminlte/dist/img/logo.png" alt="Logo" width="50" />
            <div class="card-body">
                <h1 class="text-center mb-4">Bem vindo à Click Hub</h1>
                <div class="row">
                    <div class="col-md-10 offset-1">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-primary btn-block" href="/login" role="button">Login</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-outline-primary btn-block" href="/register"
                                    role="button">Cadastro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>

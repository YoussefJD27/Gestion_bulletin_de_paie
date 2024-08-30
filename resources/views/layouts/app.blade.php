<!-- layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional stylesheets or scripts -->
    <link rel="stylesheet" href="{{ asset('css/bulltin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
    .truncate-email {
        max-width: 130px; /* Ajustez la largeur maximale selon vos besoins */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">My App</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('R_salaries.index') }}">Liste des Salariés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('R_bulltines.All_bulletin') }}">Liste des Bulletins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('R_primes.index') }}">Liste des Primes</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Additional scripts -->
</body>
</html>

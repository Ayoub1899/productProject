<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products') }}">Liste de Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.create') }}">Créer un nouveau produit</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-link nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Se déconnecter
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
</body>
</html>

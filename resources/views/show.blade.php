@extends('app')
<head>
    <title>{{$product->name}}</title>
</head>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Détails du produit</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products') }}">Retour</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom</h5>
                        <p class="card-text">{{ $product->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prix</h5>
                        <p class="card-text">{{ $product->price }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <img src="/images/{{ $product->image1 }}" class="card-img-top img-fluid" alt="{{ $product->name }} - Image 1" style="height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Image 1</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <img src="/images/{{ $product->image2 }}" class="card-img-top img-fluid" alt="{{ $product->name }} - Image 2" style="height: 300px;">
                    <div class="card-body">
                        <h5 class="card-title">Image 2</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

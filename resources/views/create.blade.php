@extends('app')
<head>
    <title>Ajouter un produit</title>
</head>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Ajouter un nouveau produit</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products') }}">Retour</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Problème de saisie.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" name="name" class="form-control" placeholder="Nom">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Prix:</label>
                        <input type="number" name="price" class="form-control" placeholder="Prix">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image1">Image 1:</label>
                        <input type="file" name="image1" class="form-control" placeholder="Image 1">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image2">Image 2:</label>
                        <input type="file" name="image2" class="form-control" placeholder="Image 2">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

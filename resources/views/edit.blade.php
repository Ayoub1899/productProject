@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Product</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products') }}">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erreur.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nom:</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Prix:</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $product->description }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image1">Image 1:</label>
                        <input type="file" name="image1" class="form-control">
                        <img src="/images/{{ $product->image1 }}" width="300px">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image2">Image 2:</label>
                        <input type="file" name="image2" class="form-control">
                        <img src="/images/{{ $product->image2 }}" width="300px">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

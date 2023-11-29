@extends('app')
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Liste des produits</title>
</head>

@section('content')

    <div class="container">


        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 mb-4">
                    <div class="card d-flex flex-column h-100">
                        <img src="/images/{{ $product->image1 }}" class="card-img-top product-image" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->price }} DHS</p>
                            <p class="card-text">{{ $product->description }}</p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Détails</a>
                                <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Editer</a>
                                @if (Auth::user()->can('delete', $product))
                                    <form action="{{ route('delete', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger deleteBtn">Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $products->links() !!}
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer ce produit?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger confirmDelete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.deleteBtn').on('click', function () {
                // Afficher le modal de confirmation
                $('#deleteModal').modal('show');
            });

            // Configurer le bouton de confirmation dans le modal
            $('.confirmDelete').on('click', function () {
                // Soumettre le formulaire de suppression
                $('.deleteBtn').closest('form').submit();
            });
        });
    </script>
@endsection

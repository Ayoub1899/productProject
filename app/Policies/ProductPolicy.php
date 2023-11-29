<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    public function viewAny(): bool
    {
        return true; // Tous les utilisateurs peuvent voir la liste des produits
    }

    public function view(): bool
    {
        return true; // Tous les utilisateurs peuvent voir un produit spécifique
    }

    public function create(): bool
    {
        return true;
    }

    public function update(): bool
    {
        return true;

    }

    public function delete(User $user): bool
    {
        return $user->role === 'admin';
        // Les administrateurs peuvent supprimer n'importe quel produit,

    }

    public function show(User $user, Product $product): bool
    {
        return $this->view($user, $product);


    }


}

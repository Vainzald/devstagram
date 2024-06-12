<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
   
    /**
     * Determine whether the user can delete the model.
     */
    //El profesor dice que no es necesario pasarle el user porque sabe que es el que esta autenticado
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    
}

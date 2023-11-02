<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Despesa;

class DespesaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function verificaUsuario(User $user, Despesa $despesa){
        return $user->id === $despesa->usuario;
    }
}

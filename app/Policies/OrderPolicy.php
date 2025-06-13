<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // Alle ingelogde gebruikers kunnen hun eigen orders zien
    }

    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->isAdmin();
    }

    public function create(User $user)
    {
        return true; // Alle ingelogde gebruikers kunnen orders plaatsen
    }

    public function update(User $user, Order $order)
    {
        return $user->isAdmin(); // Alleen admins kunnen orders updaten
    }

    public function delete(User $user, Order $order)
    {
        return $user->isAdmin(); // Alleen admins kunnen orders verwijderen
    }
} 
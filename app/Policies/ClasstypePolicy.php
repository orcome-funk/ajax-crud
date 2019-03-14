<?php

namespace App\Policies;

use App\User;
use App\Classtype;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClasstypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the classtype.
     *
     * @param  \App\User  $user
     * @param  \App\Classtype  $classtype
     * @return mixed
     */
    public function view(User $user, Classtype $classtype)
    {
        // Update $user authorization to view $classtype here.
        return true;
    }

    /**
     * Determine whether the user can create classtype.
     *
     * @param  \App\User  $user
     * @param  \App\Classtype  $classtype
     * @return mixed
     */
    public function create(User $user, Classtype $classtype)
    {
        // Update $user authorization to create $classtype here.
        return true;
    }

    /**
     * Determine whether the user can update the classtype.
     *
     * @param  \App\User  $user
     * @param  \App\Classtype  $classtype
     * @return mixed
     */
    public function update(User $user, Classtype $classtype)
    {
        // Update $user authorization to update $classtype here.
        return true;
    }

    /**
     * Determine whether the user can delete the classtype.
     *
     * @param  \App\User  $user
     * @param  \App\Classtype  $classtype
     * @return mixed
     */
    public function delete(User $user, Classtype $classtype)
    {
        // Update $user authorization to delete $classtype here.
        return true;
    }
}

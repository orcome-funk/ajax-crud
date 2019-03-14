<?php

namespace App\Policies;

use App\User;
use App\StudentClass;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the student_class.
     *
     * @param  \App\User  $user
     * @param  \App\StudentClass  $studentClass
     * @return mixed
     */
    public function view(User $user, StudentClass $studentClass)
    {
        // Update $user authorization to view $studentClass here.
        return true;
    }

    /**
     * Determine whether the user can create student_class.
     *
     * @param  \App\User  $user
     * @param  \App\StudentClass  $studentClass
     * @return mixed
     */
    public function create(User $user, StudentClass $studentClass)
    {
        // Update $user authorization to create $studentClass here.
        return true;
    }

    /**
     * Determine whether the user can update the student_class.
     *
     * @param  \App\User  $user
     * @param  \App\StudentClass  $studentClass
     * @return mixed
     */
    public function update(User $user, StudentClass $studentClass)
    {
        // Update $user authorization to update $studentClass here.
        return true;
    }

    /**
     * Determine whether the user can delete the student_class.
     *
     * @param  \App\User  $user
     * @param  \App\StudentClass  $studentClass
     * @return mixed
     */
    public function delete(User $user, StudentClass $studentClass)
    {
        // Update $user authorization to delete $studentClass here.
        return true;
    }
}

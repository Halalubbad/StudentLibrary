<?php

namespace App\Policies;

use App\Models\University;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('Read-University')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\University  $university
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, University $university)
    {
        //
        return $admin->hasPermissionTo('Read-University')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('Create-University')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\University  $university
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, University $university)
    {
        //
        return $admin->id == $admin->id && $admin->hasPermissionTo('Update-University')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\University  $university
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, University $university)
    {
        //
        return $admin->hasRole('Super-Admin') && $admin->hasPermissionTo('Delete-University')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\University  $university
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, University $university)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\University  $university
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, University $university)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Faculity;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaculitityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('Read-Faculities')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Admin $admin, Faculity $faculitity)
    {
        //
        return $admin->hasPermissionTo('Read-Faculities')
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
        return $admin->hasPermissionTo('Create-Faculities')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Faculity $faculitity)
    {
        //
        return $admin->id == $admin->id && $admin->hasPermissionTo('Update-Faculities')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Faculity $faculitity)
    {
        //
        return $admin->hasRole('Super-Admin') && $admin->hasPermissionTo('Delete-Faculities')
            ? $this->allow()
            : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Faculity $faculitity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Faculity $faculitity)
    {
        //
    }
}

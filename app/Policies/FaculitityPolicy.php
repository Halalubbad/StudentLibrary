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
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        //
        return $user->hasPermissionTo('Read-Faculities')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( $user, Faculity $faculitity)
    {
        //
        return $user->hasPermissionTo('Read-Faculities')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Admin $admin)
    {
        //
        return $admin->hasPermissionTo('Create-Faculities')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Faculity $faculitity)
    {
        //
        return $admin->id == $admin->id && $admin->hasPermissionTo('Update-Faculities')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Faculity $faculitity)
    {
        //
        return $admin->hasRole('Super-Admin') && $admin->hasPermissionTo('Delete-Faculities')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin $admin
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
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Faculitity  $faculitity
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Faculity $faculitity)
    {
        //
    }
}

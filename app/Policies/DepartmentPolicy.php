<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
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
        return $user->hasPermissionTo('Read-Departments')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( $user, Department $department)
    {
        //
        return $user->hasPermissionTo('Read-Departments')
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
        return $admin->hasPermissionTo('Create-Departments')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Admin $admin, Department $department)
    {
        //
        return $admin->id == $admin->id && $admin->hasPermissionTo('Update-Departments')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Admin $admin, Department $department)
    {
        //
        return $admin->hasRole('Super-Admin') && $admin->hasPermissionTo('Delete-Departments')
            ? $this->allow()
            : $this->deny('YOU DONT HAVE ANY PERMISSIONS FOR THIS ACTION');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Admin $admin, Department $department)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin $admin
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Admin $admin, Department $department)
    {
        //
    }
}

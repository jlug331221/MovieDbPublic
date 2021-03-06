<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];

    /**
     * Role belongs to many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }


    /**
     * Give a permission to a role.
     *
     * @param Permission $permission
     *
     * @return Model
     */
    public function givePermissionTo(Permission $permission) {
        return $this->permissions()->save($permission);
    }
}

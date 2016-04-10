<?php

namespace App;

use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user may have multiple reviews.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    /**
     * A user may have multiple comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    /**
     * User belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    /**
     * User has an avatar.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar() {
        return $this->hasOne('App\Image', 'id', 'avatar');
    }

    /**
     * A User may have multiple lists.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterlist() {
        return $this->hasMany('App\Masterlist');
    }

    /**
     * Sets the avatar for a user, or sets the avatar to null.
     *
     * @param null $image
     * @return bool
     */
    public function setAvatar($image = null) {
        $this->avatar = ($image == null) ? null : $image->id;
        return $this->save();
    }

    /**
     * A user may have multiple comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masterlists()
    {
        return $this->hasMany('App\Masterlist');
    }

    /**
     * Assign a role to a user.
     *
     * @param string|Role|array $role
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function attachRole($role) {
        if(is_string($role)) {
            return $this->roles()->save(
                Role::whereName($role)->firstOrFail()
            );
        }
        if(is_object($role)) {
            $role = $role->getKey();
        }
        if(is_array($role)) {
            $role = $role['id'];
        }
        $this->roles()->attach($role);
    }

    /**
     * Remove user role.
     *
     * @param string|Role|array $role
     *
     * @return int
     */
    public function detachRole($role) {
        if(is_string($role)) {
            $roleObj = Role::whereName($role)->firstOrFail();
            return $this->roles()->detach($roleObj);
        }
        if(is_object($role)) {
            $role = $role->getKey();
        }

        if(is_array($role)) {
            $role = $role['id'];
        }

        return $this->roles()->detach($role);
    }

    /**
     * Attach multiple roles to a user.
     *
     * @param mixed $roles
     */
    public function attachRoles($roles) {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    /**
     * Detach multiple roles from a user. If $roles is left null, meaning
     * detachRoles() has no specified parameters, all user roles will be
     * removed.
     *
     * @param mixed $roles
     */
    public function detachRoles($roles = null) {
        if (!$roles) $roles = $this->roles()->get();

        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    /**
     * Verify if a user has a role.
     *
     * @param string|array $roles - Role string or array of roles.
     * @param $requireAll
     *
     * Example: 1. $user->hasRole('Administrator')
     *          2. $user->hasRole(['Comment Moderator', 'Review Moderator'])
     *          3. $user->hasRole(['Comment Moderator', 'Review Moderator'], true)
     *
     * Example 1 -> verify that a user has role of Administrator
     * Example 2 -> verify that user has role Comment Moderator OR Review Moderator
     * Example 3 -> verify that user has role Comment Moderator AND Review Moderator
     *
     * Order does not matter with verifying multiple roles.
     *
     * @return bool
     */
    public function hasRole($roles, $requireAll = false) {
        if(is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        if(is_array($roles)) {
            $i = 0;
            $requireAllCounter = 0;
            while($i < count($roles)) {
                $roleName = $roles[$i];
                if(!$requireAll && $this->hasRole($roleName)) {
                    return true;
                }
                if($requireAll && $this->hasRole($roleName)) {
                    $requireAllCounter++;
                }
                $i++;
            }
            return $requireAllCounter == count($roles);
        }
    }


    /**
     * Used by AuthServiceProvider to verify the role of a user.
     *
     * @param $role
     * @return bool
     */
    public function hasRoleAuthServiceProvider($role) {
        if(is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        foreach($role as $r) {
            if($this->hasRoleAuthServiceProvider($r->name)) {
                return true;
            }
        }
    }
}

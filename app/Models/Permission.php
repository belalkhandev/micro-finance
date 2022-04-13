<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    /**
     * Many to many relation between permissions and roles
     *
     * @return roles that belongs to this permission
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];
}

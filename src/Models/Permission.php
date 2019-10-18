<?php

namespace Yard8\LaravelPermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'group'
    ];

    /**
     * Get the roles who have this permission by default.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}

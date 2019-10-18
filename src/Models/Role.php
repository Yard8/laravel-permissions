<?php

namespace Yard8\LaravelPermissions\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
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
        'name'
    ];

    /**
     * Get the permissions this role has by default.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

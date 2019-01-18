<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RbacPermission extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'auth';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rbac_permissions';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The accounts that has this permission
     * 
     * @return HasMany
     */
    public function accountPermissions(): HasMany
    {
    	return $this->hasMany(GameAccountPermission::class, 'permissionId');
    }

    /**
     * The permissions that inherits from this
     * 
     * @return BelongsToMany
     */
    public function links(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'rbac_linked_permissions', 'id', 'linkedId')->using(RbacLinkedPermission::class);
    }

    /**
     * The permissions this inherits
     * 
     * @return BelongsToMany
     */
    public function linked(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'rbac_linked_permissions', 'linkedId', 'id')->using(RbacLinkedPermission::class);
    }
}

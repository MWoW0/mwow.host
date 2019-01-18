<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GameAccount extends Model
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
    protected $table = 'account';

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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'joindate' => 'datetime',
        'last_login' => 'datetime',
    ];

    /**
     * the RBAC permissons attached to this account
     * 
     * @return HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(GameAccountPermission::class, 'accountId');
    }

    /**
     * Characters pivot for this account
     * 
     * @return HasMany
     */
    public function characters(): HasMany
    {
        return $this->hasMany(RealmCharacter::class, 'acctid');
    }
}

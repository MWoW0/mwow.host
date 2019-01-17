<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GameAccountPermission extends Pivot
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
    protected $table = 'rbac_account_permissions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'accountId';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The account this grant is for
     * 
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
    	return $this->belongsTo(GameAccount::class, 'accountId');
    }

    /**
     * The granted permission
     * 
     * @return BelongsTo
     */
    public function permission(): BelongsTo
    {
    	return $this->belongsTo(RbacPermission::class, 'permissionId');
    }

    /**
     * The realm the permission is granted on
     * 
     * @return BelongsTo
     */
    public function realmlist(): BelongsTo
    {
    	return $this->belongsTo(Realmlist::class, 'realmId');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RbacLinkedPermission extends Pivot
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
    protected $table = 'rbac_linked_permissions';

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
     * The permission that "inherits" the linked permission
     * 
     * @return BelongsTo
     */
    public function permission(): BelongsTo
    {
    	return $this->belongsTo(RbacPermission::class, 'id');
    }

    /**
     * The linked permission
     * 	
     * @return BelongsTo
     */
    public function linked(): BelongsTo
    {
    	return $this->belongsTo(RbacPermission::class, 'linkedId');
    }
}

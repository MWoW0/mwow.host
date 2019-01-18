<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RealmCharacter extends Model
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
    protected $table = 'realmcharacters';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'acctid';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Account that made the characters
     * 
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
    	return $this->belongsTo(GameAccount::class, 'acctid');
    }

    /**
     * Realm the characters are on
     * 
     * @return BelongsTo
     */
    public function realm(): BelongsTo
    {
    	return $this->belongsTo(Realmlist::class, 'realmid');
    }
}

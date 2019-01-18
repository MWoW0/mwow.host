<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Realmlist extends Model
{
    /**
     * Map of game build version to expansion name
     * 
     * @var array
     */
    public static $expansions = [
        12340 => 'wotlk',
    ];

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
    protected $table = 'realmlist';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'realmbuild' => 'integer'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    	'expansion'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function getExpansionAttribute()
    {
        return self::$expansions[$this->realmbuild] ?? 'unknown';
    }

    /**
     * A sort of pivot for count of characters on a realm
     * 
     * @return HasMany
     */
    public function realmCharacters(): HasMany
    {
        return $this->hasMany(realmCharacter::class, 'realmid', 'id');
    }
}

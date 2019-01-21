<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTemplate extends Model
{
    public static $itemClass = [
        0 => 'Consumable',
        1 => 'Container',
        2 => 'Weapon',
        3 => 'Gem',
        4 => 'Armor',
        5 => 'Reagent',
        6 => 'Projectile',
        7 => 'Trade goods',
        8 => 'Generic',
        9 => 'Recipe',
        10 => 'Money',
        11 => 'Quiver',
        12 => 'Quest',
        13 => 'Key',
        14 => 'Permanent',
        15 => 'Misc',
        16 => 'Glyph'
    ];

    public static $itemSubclass = [
        'Consumable' => [
            0 => 'Consumable',
            1 => 'Potion',
            2 => 'Elixir',
            3 => 'Flask',
            4 => 'Scroll',
            5 => 'Food',
            6 => 'Item Enhancement',
            7 => 'Bandage',
            8 => 'Other'
        ],

        'Container' => [
            0 => 'Container',
            1 => 'Soul bag',
            2 => 'Herb bag',
            3 => 'Enchanting bag',
            4 => 'Engineering bag',
            5 => 'Gem bag',
            6 => 'Mining bag',
            7 => 'Leatherworking bag',
            8 => 'Inscription bag'
        ],

        'Weapon' => [
            0 => 'One-handed Axe',
            1 => 'Two-handed Axe',
            2 => 'Bow',
            3 => 'Gun',
            4 => 'One-handed Mace',
            5 => 'Two-handed Mace',
            6 => 'Polearm',
            7 => 'One-handed Sword',
            8 => 'Two-handed Sword',
            // 9 => 'Obsolete',
            10 => 'Staff',
            11 => 'One-handed Exotic',
            12 => 'Two-handed Exotic',
            13 => 'Fist',
            14 => 'Misc',
            15 => 'Dagger',
            16 => 'Thrown',
            17 => 'Spear',
            18 => 'Crossbow',
            19 => 'Wand',
            20 => 'Fishing pole'
        ],

        'Gem' => [
            0 => 'Red',
            1 => 'Blue',
            2 => 'Yellow',
            3 => 'Purple',
            4 => 'Green',
            5 => 'Orange',
            6 => 'Meta',
            7 => 'Simple',
            8 => 'Prismatic'
        ],

        'Armor' => [
            0 => 'Misc',
            1 => 'Cloth',
            2 => 'Leather',
            3 => 'Mail',
            4 => 'Plate',
            5 => 'Buckler',
            6 => 'Shield',
            7 => 'Libram',
            8 => 'Idol',
            9 => 'Totem',
            10 => 'Sigil'
        ],

        'Reagent' => [
            0 => 'Reagent'
        ],

        'Projectile' => [
            0 => 'Wand',
            1 => 'Bolt',
            2 => 'Arrow',
            3 => 'Bullet',
            4 => 'Thrown'
        ],

        'Trade goods' => [
            0 => 'Trade goods',
            1 => 'Parts',
            2 => 'Explosives',
            3 => 'Devices',
            4 => 'Jewelcrafting',
            5 => 'Cloth',
            6 => 'Leather',
            7 => 'Metal stone',
            8 => 'Meat',
            9 => 'Herb',
            10 => 'Elemental',
            11 => 'Other',
            12 => 'Enchanting',
            13 => 'Material',
            14 => 'Armor Enchantments',
            15 => 'Weapon Enchantments'
        ],

        'Generic' => [
            0 => 'Generic'
        ],

        'Recipe' => [
            0 => 'Book',
            1 => 'Leatherworking Pattern',
            2 => 'Tailoring Pattern',
            3 => 'Engineering Schematic',
            4 => 'Blacksithing Plan',
            5 => 'Cooking Recipe',
            6 => 'Alchemy Recipe',
            7 => 'First Aid Manual',
            8 => 'Enchanting Formula',
            9 => 'Fishing Manual',
            10 => 'Jewelcrafting Recipe'
        ],

        'Money' => [
            0 => 'Money'
        ],

        'Quiver' => [
            2 => 'Quiver',
            3 => 'Ammo pouch'
        ],

        'Quest' => [
            0 => 'Quest'
        ],

        'Key' => [
            0 => 'Key',
            1 => 'Locking pick'
        ],

        'Permanent' => [
            0 => 'Permanent'
        ],

        'Misc' => [
            0 => 'Junk',
            1 => 'Junk Reagent',
            2 => 'Pet',
            3 => 'Holiday',
            4 => 'Other',
            5 => 'Mount'
        ],

        'Glyph' => [
            1 => 'Warrior',
            2 => 'Paladin',
            3 => 'Hunter',
            4 => 'Rogue',
            5 => 'Priest',
            6 => 'Death knight',
            7 => 'Shaman',
            8 => 'Mage',
            9 => 'Warlock',
            11 => 'Druid'
        ]
    ];

    public static $itemQuality = [
        0 => [
            'color' => 'grey',
            'quality' => 'Poor'
        ],
        1 => [
            'color' => 'white',
            'quality' => 'Common'
        ],
        2 => [
            'color' => 'green',
            'quality' => 'Uncommon'
        ],
        3 => [
            'color' => 'plue',
            'quality' => 'Rare'
        ],
        4 => [
            'color' => 'purple',
            'quality' => 'Epic'
        ],
        5 => [
            'color' => 'orange',
            'quality' => 'Legendary'
        ],
        6 => [
            'color' => 'red',
            'quality' => 'Artifact'
        ],
        7 => [
            'color' => 'gold',
            'quality' => 'Bind on Account'
        ]
    ];

    public static $inventoryType = [
        0 => 'Non equipable',
        1 => 'Head',
        2 => 'Neck',
        3 => 'Shoulder',
        4 => 'Shirt',
        5 => 'Chest',
        6 => 'Waist',
        7 => 'Legs',
        8 => 'Feet',
        9 => 'Wrists',
        10 => 'Hands',
        11 => 'Finger',
        12 => 'Trinket',
        13 => 'One-Hand Weapon',
        14 => 'Shield',
        15 => 'Bow',
        16 => 'Back',
        17 => 'Two-Hand Weapon',
        18 => 'Bag',
        19 => 'Tabard',
        20 => 'Robe',
        21 => 'Main hand',
        22 => 'Off hand',
        23 => 'Holdable (Tome)',
        24 => 'Ammo',
        25 => 'Thrown',
        26 => 'Gun or Wand',
        27 => 'Quiver',
        28 => 'Relic'
    ];
    
    public static $statTypes = [
        0 => 'Mana',
        1 => 'Health',
        
        3 => 'Agility',
        4 => 'Strength',
        5 => 'Intellect',
        6 => 'Spirit',
        7 => 'Stamina',
        
        12 => 'Defense',
        13 => 'Dodge',
        14 => 'Parry',
        15 => 'Block',
        16 => 'Melee hit',
        17 => 'Ranged hit',
        18 => 'Spell hit',
        19 => 'Melee crit',
        20 => 'Ranged crit',
        21 => 'Spell crit',
        22 => 'Melee hit taken',
        23 => 'Ranged hit taken',
        24 => 'Spell hit taken',
        25 => 'Melee crit taken',
        26 => 'Ranged crit taken',
        27 => 'Spell crit taken',
        28 => 'Melee haste',
        29 => 'Ranged haste',
        30 => 'Spell haste',
        31 => 'Hit',
        32 => 'Crit',
        33 => 'Hit taken',
        34 => 'Crit taken',
        35 => 'Resiliance',
        36 => 'Haste',
        37 => 'Expertise',
        38 => 'Melee Attack Power',
        39 => 'Ranged Attack Power',

        // 40 => 'Feral Attack Power',
        // 41 => 'Healing',
        // 42 => 'Spell Damage',

        43 => 'Mana Regeneration',
        44 => 'Armor Penetration',
        45 => 'Spell Power',
        46 => 'Health Regeneration',
        47 => 'Spell Penetration',
        48 => 'Block'
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
    protected $connection = 'world';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_template';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'entry';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public static function itemSubclassForSelect(): array
    {
        return collect(self::$itemSubclass)
            ->flatMap(function ($options, $class) {
                return array_map(function ($option) use ($class) {
                    return "[{$class}] - {$option}";
                }, $options);
            })->toArray();
    }
}

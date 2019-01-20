<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sasin91\ItemClassSelect\ItemClassSelect;
use Sasin91\ItemDisplayId\ItemDisplayId;
use Sasin91\ItemQuality\ItemQuality;
use Sasin91\ItemSubclassSelect\ItemSubclassSelect;
use Sasin91\WowCurrency\WowCurrency;

class ItemTemplate extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'World';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\ItemTemplate';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'entry', 'name', 'description'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Number::make('Entry', 'entry')
                ->rules('required', 'numeric')
                ->sortable(),

            Number::make('ILvl', 'ItemLevel')->withMeta(['value' => 200]),

            Number::make('Required level', 'RequiredLevel')->rules('min:1', 'max:255')->withMeta(['value' => 90]),

            Select::make('class')
                ->creationRules('required')
                ->options(\App\ItemTemplate::$itemClass),

            Select::make('subclass')
                ->creationRules('required')
                ->options(\App\ItemTemplate::itemSubclassForSelect()),

            Text::make('Name')
                ->creationRules('required')
                ->rules('string', 'max:255', 'min:1'),

            ItemDisplayId::make('displayid')
                ->rules('required', 'numeric')
                ->hideFromIndex(),

            ItemQuality::make('Quality', 'Quality')
                ->rules('required', 'numeric')
                ->options(\App\ItemTemplate::$itemQuality),

            Number::make('Max count', 'maxcount')->hideFromIndex(),
            Number::make('Stacks', 'stackable')->hideFromIndex(),

            Number::make('Buy count', 'BuyCount')->rules('numeric', 'max:127', 'min:0')->hideFromIndex(),

            WowCurrency::make('Buying price', 'BuyPrice')->rules('numeric', 'min:0')->hideFromIndex(),
            WowCurrency::make('Selling price', 'SellPrice')->rules('numeric', 'min:0')->hideFromIndex(),

            Select::make('Inventory type', 'InventoryType')
                ->options(\App\ItemTemplate::$inventoryType)
                ->rules('numeric')
                ->hideFromIndex(),

            Text::make('Script', 'ScriptName')->help('References to a script in the core. eg. item_teleporter')->hideFromIndex()

            // Insert remaining stat_type{1..10}, stat_value{1..10}
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

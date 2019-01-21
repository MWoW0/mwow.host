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
        $fields = [
            Number::make('Entry', 'entry')
                ->rules('required', 'numeric')
                ->sortable()
                ->withMeta(['value' => $this->entry ?? \App\ItemTemplate::query()->max('entry')+1]),

            Number::make('ILvl', 'ItemLevel')->withMeta(['value' => $this->ItemLevel ?? 200]),

            Number::make('Required level', 'RequiredLevel')->rules('min:1', 'max:255')->withMeta(['value' => $this->RequiredLevel ?? 90]),

            Select::make('class')
                ->creationRules('required')
                ->options(\App\ItemTemplate::$itemClass)
                ->displayUsing(function ($value) {
                    return \App\ItemTemplate::$itemClass[$value] ?? $value;
                }),

            Select::make('subclass')
                ->creationRules('required')
                ->options(\App\ItemTemplate::itemSubclassForSelect())
                ->displayUsing(function ($value) {
                    return \App\ItemTemplate::itemSubclassForSelect()[$value] ?? $value;
                }),

            Text::make('Name')
                ->creationRules('required')
                ->rules('string', 'max:255', 'min:1'),

            ItemDisplayId::make('Display ID', 'displayid')
                ->rules('required', 'min:-8388607', 'max:8388607')
                ->withMeta(['value' => $this->displayid ?? 0])
                ->hideFromIndex(),

            ItemQuality::make('Quality', 'Quality')
                ->rules('required', 'numeric')
                ->options(\App\ItemTemplate::$itemQuality),

            Number::make('Max count', 'maxcount')
                ->rules('min:0', 'max:2147483648')
                ->hideFromIndex()
                ->withMeta(['value' => $this->maxcount ?? 0]),

            Number::make('Stacks', 'stackable')
                ->rules('min:0', 'max:2147483648')
                ->hideFromIndex()
                ->withMeta(['value' => $this->stackable ?? 0]),

            Number::make('Buy count', 'BuyCount')
                ->rules('numeric', 'max:127', 'min:0')
                ->withMeta(['value' => $this->BuyCount ?? 0])
                ->hideFromIndex(),

            WowCurrency::make('Buying price', 'BuyPrice')
                ->rules('numeric', 'min:0')
                ->withMeta(['value' => $this->BuyPrice ?? 0])
                ->hideFromIndex(),
            WowCurrency::make('Selling price', 'SellPrice')
                ->rules('numeric', 'min:0')
                ->hideFromIndex(),

            Select::make('Inventory type', 'InventoryType')
                ->options(\App\ItemTemplate::$inventoryType)
                ->rules('numeric')
                ->displayUsing(function ($value) {
                    return \App\ItemTemplate::$inventoryType[$value] ?? $value;
                })
                ->hideFromIndex(),

            Text::make('Script', 'ScriptName')
                ->rules('required', 'max:64')
                ->withMeta(['value' => $this->ScriptName ?? '""'])
                ->help('References to a script in the core. eg. item_teleporter')
                ->hideFromIndex(),
        ];

        for ($i = 1; $i < 11; $i++) {
            $fields[] = Select::make("Stat Type {$i}", "stat_type{$i}")
                ->options(\App\ItemTemplate::$statTypes)
                ->withMeta(['value' => $this->{"stat_type{$i}"} ?? 0])
                ->displayUsing(function ($value) {
                    return \App\ItemTemplate::$statTypes[$value] ?? $value;
                })
                ->hideFromIndex();

            $fields[] = Number::make("Stat value {$i}","stat_value{$i}")
                ->rules('min:0', 'max:4294967295')
                ->withMeta(['value' => $this->{"stat_value{$i}"} ?? 0])
                ->hideFromIndex();
        }

        return $fields;
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

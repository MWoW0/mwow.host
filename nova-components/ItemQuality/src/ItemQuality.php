<?php

namespace Sasin91\ItemQuality;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Select;

class ItemQuality extends Select
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'item-quality';
    /**
     * Set the options for the select menu.
     *
     * @param  array  $options
     * @return $this
     */
    public function options($options)
    {
        return $this->withMeta([
            'options' => collect($options ?? [])->map(function ($option, $value) {
                return [
                    'color' => $option['color'],
                    'label' => $option['quality'],
                    'value' => $value
                ];
            })->values()->all(),
        ]);
    }
}

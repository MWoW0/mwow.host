<?php

namespace Sasin91\WowCurrency;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Number;

class WowCurrency extends Number
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'wow-currency';

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  mixed|null  $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->step('0.01')->displayUsing(function ($value) {
            return $this->toWoWCurrencyString($value);
        });
    }

    public function toWoWCurrencyString($value):string
    {
        $copper = $value % 100;

        $value = ($value - $copper) / 100;

        $silver = $value % 100;

        $gold = ($value - $silver) / 100;

        return "{$gold}g {$silver}s {$copper}c";
    }
}

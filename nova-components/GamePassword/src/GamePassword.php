<?php

namespace Sasin91\GamePassword;

use App\Hashing\Sha1Hasher;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class GamePassword extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'game-password';

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttribute(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (! empty($request->{$requestAttribute})) {
            $model->{$attribute} = (new Sha1Hasher)->make($request[$requestAttribute], ['username' => $model->username]);
        }
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(
            parent::jsonSerialize(),
            ['value' => '']
        );
    }
}

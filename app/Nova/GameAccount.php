<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Sasin91\GamePassword\GamePassword;

class GameAccount extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Game';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\GameAccount';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'username';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'username', 'email', 'reg_mail'
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Account';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->onlyOnDetail()->sortable(),

            Boolean::make('Online')->sortable(),

            Boolean::make('Locked')->sortable(),

            Text::make('Username')
                ->sortable()
                ->creationRules('required', 'unique:auth.account,username')
                ->updateRules('unique:auth.account,username,{{resourceId}}')
                ->rules('string', 'min:1', 'max:32'),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            GamePassword::make('Password', 'sha_pass_hash')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            DateTime::make('Joined', 'joindate')->sortable(),

            Datetime::make('Last login', 'last_login')->sortable(),

            Text::make('IP', 'last_ip')->sortable(),

            Text::make('OS', 'os')->sortable()->onlyOnDetail(),

            HasMany::make('Permissions', 'permissions', GameAccountPermission::class),

            HasMany::make('Characters', 'characters', RealmCharacter::class)
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

<?php

namespace Sasin91\ItemDisplayId;

use App\Jobs\FetchIcon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Number;

class ItemDisplayId extends Number
{
    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = true;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'item-display-id';

    /**
     * The name of the disk the file uses by default.
     *
     * @var string
     */
    public $disk = 'public';

    /**
     * The icon for the display ID
     *
     * @var string|null
     */
    public $icon;

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  string|null  $disk
     * @param  callable|null  $storageCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $disk = 'public', $storageCallback = null)
    {
        parent::__construct($name, $attribute, $storageCallback);

        $this->disk = $disk;
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        $iconUrl = $this->resolveIconUrl();

        return array_merge([
            'thumbnailUrl' => $iconUrl,
            'previewUrl' => $iconUrl,
        ], $this->meta);
    }

    protected function resolveIconUrl():?string
    {
        if ($icon = $this->resolveIcon()) {
            return Storage::disk($this->disk)->url("icons/{$icon}.png");
        }

        return null;
    }

    protected function resolveIcon():?string
    {
        if ($this->icon) {
            return $this->icon;
        }

        $this->icon = DB::connection('itemDisplay')
            ->table('itemdisplay')
            ->where('ID', $this->value)
            ->value('icon');

        return tap($this->icon, function ($icon) {
            if (! Storage::disk($this->disk)->exists("icons/{$icon}.png")) {
                dispatch(new FetchIcon($icon));
            }

            $this->withMeta(['icon' => $icon]);
        });
    }
}

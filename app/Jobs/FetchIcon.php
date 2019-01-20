<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class FetchIcon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * name of the icon
     *
     * @var string
     */
    public $icon;

    /**
     * Disk the store the icon locally at
     *
     * @var string
     */
    public $disk = 'public';

    /**
     * FetchIcon constructor.
     * @param $icon
     * @param string $disk
     */
    public function __construct($icon, string $disk = null)
    {
        $this->icon = $icon;

        if ($disk) {
            $this->disk = $disk;
        }
    }

    /**
     * Attempt to fetch the icon from a remote host
     *
     * @return void
     */
    public function handle()
    {
        $iconForUrl = ucfirst($this->icon);

        Storage::disk($this->disk)->put("icons/{$this->icon}.png", file_get_contents("https://vignette.wikia.nocookie.net/wowwiki/images/f/fd/{$iconForUrl}.png"));
    }
}

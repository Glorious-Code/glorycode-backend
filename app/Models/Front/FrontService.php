<?php

namespace App\Models\Front;

use Spatie\LaravelData\Data;

class FrontService extends Data
{
    public ?string $icon;

    public string $title;

    public string $description;

    /**
     * @param  ?string  $icon
     */
    public function __construct(string $title, string $description, ?string $icon)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->description = $description;
    }
}

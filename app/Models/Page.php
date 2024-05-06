<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_tags',
        'meta_description',
        'is_published',
    ];

    // Model Scrope

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }


    // Media
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('contents');
    }

    public function contentsUrl()
    {
        $contents = [];

        foreach($this->getMedia('contents') as $media)
        {
            array_push($contents, [
                'url' => $media->getUrl(),
                'extension' => pathinfo($media->getUrl(), PATHINFO_EXTENSION)
            ]);
        }

        return $contents;
    }
}

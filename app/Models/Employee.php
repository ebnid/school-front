<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile')
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                
                $this->addMediaConversion('square')
                    ->width(300)
                    ->height(300)
                    ->format('webp')
                    ->quality(100);
                    
            });
    }


    public function profileUrl($size = 'square')
    {
        if($this->hasMedia('profile'))
        {
            return $this->getFirstMedia('profile')->getUrl($size);
        }
        
        return '';
    }


    // Model Scope
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

}

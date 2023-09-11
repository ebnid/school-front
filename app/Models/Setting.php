<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'value',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('banner')->singleFile();
        $this->addMediaCollection('logo')->singleFile();
    }


    public function bannerUrl()
    {
        if($this->hasMedia('banner'))
        {
            return $this->getFirstMedia('banner')->getUrl();
        }
        
        return '';
    }

    public function logoUrl()
    {
        if($this->hasMedia('banner'))
        {
            return $this->getFirstMedia('banner')->getUrl();
        }
        
        return '';
    }

}

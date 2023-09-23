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
        $this->addMediaCollection('principal')->singleFile();
        $this->addMediaCollection('principal_signature')->singleFile();
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
        if($this->hasMedia('logo'))
        {
            return $this->getFirstMedia('logo')->getUrl();
        }
        
        return '';
    }

    public function principalPhotoUrl()
    {
        if($this->hasMedia('principal'))
        {
            return $this->getFirstMedia('principal')->getUrl();
        }
        
        return '';
    }

    public function principalSignatureUrl()
    {
        if($this->hasMedia('principal_signature'))
        {
            return $this->getFirstMedia('principal_signature')->getUrl();
        }
        
        return '';
    }

}

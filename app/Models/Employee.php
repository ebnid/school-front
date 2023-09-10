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


    protected $casts = [
        'date_of_birth' => 'datetime',
        'join_date' => 'datetime',
        'current_organization_join_date' => 'datetime',
    ];

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

    // Compute Property
    public function getSafeNid()
    {

        // Get the first 4 digits of the input
        $firstFourDigits = substr($this->nid_no, 0, 4);

        // Calculate the number of asterisks needed to replace the rest of the input
        $asterisks = str_repeat('*', strlen($this->nid_no) - 4);

        // Concatenate the first 4 digits with asterisks
        $hidden = $firstFourDigits . $asterisks;

        return $hidden;
  
    }

}

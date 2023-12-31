<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Education;

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


    // Relationship
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    // Model Scope
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Compute Property
    public function getSafeNid()
    {

        $nid = $this->nid_no;
        $nid_length = strlen($nid);

        if($nid_length <= 4) return $nid;


        // Get the first 4 digits of the input
        $firstFourDigits = substr($nid, 0, 4);

        // Calculate the number of asterisks needed to replace the rest of the input
        $asterisks = str_repeat('*', strlen($nid) - 4);

        // Concatenate the first 4 digits with asterisks
        $hidden = $firstFourDigits . $asterisks;

        return $hidden;
  
    }

}

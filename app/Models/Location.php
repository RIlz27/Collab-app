<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->slug = Str::slug($location->name);
        });

        static::updating(function ($location) {
            $location->slug = Str::slug($location->name);
        });
    }
}
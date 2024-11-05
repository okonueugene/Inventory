<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Asset;
use Illuminate\Support\Str;
use App\Models\Notification;
class Employee extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'name',
        'department',
        'designation',
        'location',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\Asset;
class Asset extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'employee_id',
        'description',
        'code',
        'serial_number',
        'status',
        'purchase_date',
        'warranty_date',
        'decommission_date',
        'latitude',
        'longitude',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function audits()
    {
        return $this->hasMany(Audit::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('asset_images');
    }
}

<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Audit;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function addNotification()
    {
        $notifiable = User::all()->pluck('id')->toArray();
        foreach ($notifiable as $not) {
            if (auth()->user()->id != $not) {
                $uuid = Str::uuid();

                $data = array(
                    'type' => 'new_asset',
                    'title' => 'New Asset Added',
                    'notification_key' => $uuid,
                    'user_id' => $not,
                    'message' => auth()->user()->name . ' added a new asset',
                    'link' => url('admin/assets') . "?notification=" . $uuid,
                    'created_by' => auth()->user()->id,
                );

                Notification::create($data);
            }
        }
    }
}

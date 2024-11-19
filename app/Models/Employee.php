<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'department',
        'designation',
        'location',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function addNotification()
    {
        $notifiable = User::all()->pluck('id')->toArray();
        foreach ($notifiable as $not) {
            if (auth()->user()->id != $not) {
                $uuid = Str::uuid();

                $data = array(
                    'type' => 'new_employee',
                    'title' => 'New Employee',
                    'notification_key' => $uuid,
                    'user_id' => $not,
                    'message' => auth()->user()->name . ' has added a new employee',
                    'link' => url('/admin/employees') . "?notification=" . $uuid,
                    'created_by' => auth()->user()->id,
                );

                Notification::create($data);

            }
        }
    }

    
}

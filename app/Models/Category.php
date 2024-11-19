<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
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
                    'type' => 'new_category',
                    'title' => 'New Category',
                    'notification_key' => $uuid,
                    'user_id' => $not,
                    'message' => auth()->user()->name . ' has added a new category',
                    'link' => url('/admin/categories') . "?notification=" . $uuid,
                    'created_by' => auth()->user()->id,
                );

                Notification::create($data);

            }
        }
    }

}

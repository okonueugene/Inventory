<?php

namespace App\Models;

use App\Models\Asset;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'asset_id',
        'action',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function addNotification()
    {
        $notifiable = User::all()->pluck('id')->toArray();
        foreach ($notifiable as $not) {
            if (auth()->user()->id != $not) {
                $uuid = Str::uuid();

                $data = array(
                    'type' => 'new_audit',
                    'title' => 'New Audit',
                    'notification_key' => $uuid,
                    'user_id' => $not,
                    'message' => auth()->user()->name . ' has added a new audit',
                    'link' => url('/admin/audits') . "?notification=" . $uuid,
                    'created_by' => auth()->user()->id,
                );

                Notification::create($data);
            }
        }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
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
}

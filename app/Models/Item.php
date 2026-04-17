<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'description',
        'location',
        'type',
        'date_reported',
        'image_path',
        'status',
        'is_verified',
    ];

    protected function casts(): array
    {
        return [
            'date_reported' => 'date',
            'is_verified' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

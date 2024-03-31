<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    protected $casts = [
        'message_time' => 'string',
    ];

    public function getMessageTimeColumn()
    {
        return Carbon::parse($this->created_at)->format('H:i A');
    }
}

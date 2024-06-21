<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookData extends Model
{
    use HasFactory;

    protected $table = 'webhook_data';

    protected $fillable = [
        'email',
        'Name',
        'Phone',
        'Comments',
    ];

    protected $casts = [
        'email' => 'string',
        'Name' => 'string',
        'Phone' => 'string',
        'Comments' => 'string',
    ];

}

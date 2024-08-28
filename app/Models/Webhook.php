<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use HasFactory;

    protected $table = 'webhook_data';

    protected $fillable = [
        'Name',
        'Email',
        'Phone',
        'comments',
        'modme_company_id'
    ];

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

}

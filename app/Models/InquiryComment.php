<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryComment extends Model
{
    protected $fillable = ['inquiry_id', 'user_id', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }
}

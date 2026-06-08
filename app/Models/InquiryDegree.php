<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquiryDegree extends Model
{
    protected $fillable = [
        'inquiry_id',
        'degree_id',
        'obtained',
        'total',
        'part1_obtained',
        'part1_total',
        'part2_obtained',
        'part2_total',
    ];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }
}

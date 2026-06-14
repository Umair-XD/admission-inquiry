<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'name',
        'age',
        'phone',
        'cnic',
        'department_id',
        'course_id',
        'status',
        'entry_obtained',
        'entry_total',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function degrees()
    {
        return $this->hasMany(InquiryDegree::class);
    }

    public function comments()
    {
        return $this->hasMany(InquiryComment::class)->latest();
    }
}

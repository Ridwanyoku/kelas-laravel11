<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'month', 'year', 'check1', 'check2', 'check3', 'check4', 'total_cash',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

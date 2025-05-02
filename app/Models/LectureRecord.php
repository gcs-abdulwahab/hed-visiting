<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'monthly_billing_id',
        'lecture_type',
        'lecture_count',
        'amount'
    ];

    protected $casts = [
        'lecture_count' => 'integer',
        'amount' => 'decimal:2'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function monthlyBilling()
    {
        return $this->belongsTo(MonthlyBilling::class);
    }
} 
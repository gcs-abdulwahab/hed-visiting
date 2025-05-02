<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_code',
        'name',
        'father_name',
        'bank_account_number',
        'designation',
        'employee_type',
        'department_id',
        'inter_rate',
        'bs_rate',
        'is_active'
    ];

    protected $casts = [
        'inter_rate' => 'decimal:2',
        'bs_rate' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function monthlyBillings()
    {
        return $this->hasMany(MonthlyBilling::class);
    }

    public function lectureRecords()
    {
        return $this->hasMany(LectureRecord::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('is_active', false);
    }
}

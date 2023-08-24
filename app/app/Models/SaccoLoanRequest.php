<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaccoLoanRequest extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latestRequest = self::latest('LoanAppNumber')->first();
            $latestNumber = ($latestRequest) ? (int)substr($latestRequest->LoanAppNumber, 3) : 0;
            $newNumber = $latestNumber + 1;

            $model->LoanAppNumber = 'LAN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaccoIssue extends Model
{
    use HasFactory;

    //protected $fillable = ['MemberNumber', 'phoneNumber', 'DateofRequest', 'ReferenceNumber'];

     protected static function booted()
    {
        parent::booted();

        static::creating(function ($model) {
            $latestRequest = self::latest('ReferenceNumber')->first();
            $latestNumber = ($latestRequest) ? (int)substr($latestRequest->ReferenceNumber, 3) : 0;
            $newNumber = $latestNumber + 1;

            $model->ReferenceNumber = 'R' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });

       
    }
}


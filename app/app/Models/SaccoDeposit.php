<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaccoDeposit extends Model
{
    use HasFactory;
    protected $fillable = ['Username', 'amount', 'dateDeposited', 'receiptNumber'];
}

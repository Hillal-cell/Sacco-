<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaccoActiveLoan extends Model
{
    use HasFactory;
    // protected $primaryKey = 'Username'; // Specify the primary key
   // protected $foreignKey = 'MemberID'; // Specify the foreign key for relationships

    protected $primaryKey = 'UserId';


    protected $fillable = ['MemberID', 'Username', 'Amount_to_pay', 'Payment_Period', 'Cleared_Amount', 'Loan_Balance', 'status'];
    

    
}

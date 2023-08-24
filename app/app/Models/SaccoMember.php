<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//App\use\Models\SaccoActiveLoan;

class SaccoMember extends Model
{
    use HasFactory;
  //  protected $foreignKey = 'MemberNumber'; // Specify the primary key
   // protected $foreignKey = 'Username'; // Specify the foreign key for relationships\


   protected $primaryKey = 'UserId';
    
    protected $fillable = [ 'Username', 'email', 'password','phoneNumber','MemberNumber','accountBalance'];


    //relationship between sacco_members table and sacco_active_loans
   public function activeLoan()
    {
        return $this->hasOne(SaccoActiveLoan::class, 'MemberID', 'MemberNumber');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\User;
use App\Models\ExpenseParticipant;

class Expense extends Model
{
    public function group()
{
    return $this->belongsTo(Group::class);
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function participants()
{
    return $this->hasMany(ExpenseParticipant::class);
}

public function payer()
{
    // Simplified: assume the creator is the payer for now
    return $this->creator();
}
    protected $fillable = ['group_id', 'description', 'total_amount', 'receipt_path', 'created_by'];
    use HasFactory;

    

}



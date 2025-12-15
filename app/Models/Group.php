<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Group extends Model
{
    public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function users()
{
    return $this->belongsToMany(User::class);
}

public function expenses()
{
    return $this->hasMany(Expense::class);
}
    protected $fillable = ['name', 'created_by'];
    use HasFactory;
}

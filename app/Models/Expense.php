<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['title', 'description', 'amount', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'description',
        'amount',
        'expense_date',
        'payment_method',
        'image',
        'user_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_expense');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

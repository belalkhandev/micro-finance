<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $appends = ['category_name'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }

    public function getCategoryNameAttribute()
    {
        if ($this->category) {
            return $this->category->name;
        }

        return 'No category';
    }
}

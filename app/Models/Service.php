<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'title', 'country', 'description', 'image'];

    public function scopeFilter($query, $category)
    {
        $query->when($category ?? false, fn($query, $category) => $query->where('category_id', $category));
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

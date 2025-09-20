<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'review'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected static function booted()
    {
        static::updated(fn(Review $review) => Cache::forget('book:' . $review->book_id));
        static::deleted(fn(Review $review) => Cache::forget('book:' . $review->book_id));
    }
}

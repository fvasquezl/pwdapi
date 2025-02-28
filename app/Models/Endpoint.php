<?php

namespace App\Models;


use App\Models\Traits\HasSorts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Endpoint extends Model
{

    use HasFactory, HasSorts;

    public array $allowedSorts = ['title', 'content'];
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
    ];


    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}

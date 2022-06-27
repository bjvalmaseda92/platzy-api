<?php

namespace App\Models;

use App\Traits\CanBeRate;
use App\Traits\CanBeRated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory, CanBeRated;

    protected $guarded = [];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function create_by(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id")->withDefault([
            "name" => "Administrador",
        ]);
    }
}

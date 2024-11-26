<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', // ID do usuário que fez a avaliação
        'product_id', // ID do produto avaliado
        'rating', // Avaliação dada pelo usuário (de 1 a 5, por exemplo)
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'product_id' => 'integer',
        'rating' => 'integer',
    ];

    /**
     * Get the user that owns the rating.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that the rating belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate the average rating for the given product.
     *
     * @param  int  $productId
     * @return float|null
     */
    public static function totalRatingForProduct($productId)
{
    $totalRatings = Rating::where('product_id', $productId)->count();
    if ($totalRatings === 0) {
        return null; // Retorna null se não houver avaliações para o produto
    }

    $totalRatingValue = Rating::where('product_id', $productId)->sum('rating');

    return $totalRatingValue / $totalRatings;
}
}
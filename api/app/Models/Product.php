<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'net_price',
        'gross_price',
        'description',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->updated_at = null;
        });
    }

    public static function productList(Request $request): Collection
    {
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page - 1) * $limit;

        return self::productListBaseQuery($request)
                    ->orderBy($sortBy, $sortDirection)
                    ->limit($limit)
                    ->offset($offset)
                    ->get();
    }

    public static function productListCount(Request $request): int
    {
        return self::productListBaseQuery($request)
            ->count();
    }

    private static function productListBaseQuery(Request $request): Builder
    {
        $query = Product::query();
        $query->with('category');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('net_price_from')) {
            $query->where('net_price', '>=', $request->input('net_price_from'));
        }

        if ($request->has('net_price_to')) {
            $query->where('net_price', '<=', $request->input('net_price_to'));
        }

        if ($request->has('gross_price_from')) {
            $query->where('gross_price', '>=', $request->input('gross_price_from'));
        }

        if ($request->has('gross_price_to')) {
            $query->where('gross_price', '<=', $request->input('gross_price_to'));
        }

        return $query;
    }
}



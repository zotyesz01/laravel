<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->updated_at = null;
        });
    }

    public static function categoryList(Request $request): Collection
    {
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $offset = ($page - 1) * $limit;

        return self::categoryListBaseQuery($request)
            ->orderBy($sortBy, $sortDirection)
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    public static function categoryListCount(Request $request): int
    {
        return self::categoryListBaseQuery($request)
            ->count();
    }

    private static function categoryListBaseQuery(Request $request): Builder
    {
        $query = Category::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        return $query;
    }
}

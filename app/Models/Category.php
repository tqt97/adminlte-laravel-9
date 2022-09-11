<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'image', 'parent_id', 'order_at', 'feature', 'publish'];

    public function scopeRoot($query)
    {
        $query->whereNull('parent_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }

    public function categoriesTrashed()
    {
        return $this->belongsTo(Category::class)->onlyTrashed();
    }

    public function getPublish(): string
    {
        if ($this->attributes['publish'] == 1) {
            return 'fa-eye text-green';
        } else {
            return 'fa-eye-slash text-secondary';
        }
    }

    public function getFeature(): string
    {
        if ($this->attributes['feature'] == 1) {
            return 'fa-star-half-alt text-yellow';
        } else {
            return 'fa-star-half-alt text-secondary';
        }
    }
}

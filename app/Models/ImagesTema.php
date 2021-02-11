<?php

namespace App\Models;

use App\Models\MyLinktree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagesTema extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url_image',
    ];

    public function myLinktree()
    {
        return $this->hasMany(MyLinktree::class);
    }    
}

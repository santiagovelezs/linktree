<?php

namespace App\Models;

use App\Models\ImagesTema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MyLinktree extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imagesTema_id',
        'links_font',
        'links_color',        
    ];

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function imagesTema()
    {
        return $this->belongsTo(imagesTema::class, 'imagesTema_id');
    }

    /*public static function setupLinkTree($user)
    {
        $myLinkT = new MyLinktree();
        $myLinkT->user_id = $user->id;
        $myLinkT->imagesTema_id = ImagesTema::all()->first()->id;
        $myLinkT->save();
        return $myLinkT;
    }*/
}

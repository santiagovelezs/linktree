<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    use HasFactory;
    
    //$typesw = ['youtube', 'instagram', 'twitter', 'facebook'];    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'url',
    ];

    static $types = [
        'youtube',
        'instagram',
        'twitter', 
        'facebook'
    ];

    /*public static function getTypes()   
    {
        return self::$types;
    }*/

    public function getIcon()
    {
        switch($this->type)
        {
            case self::$types[0]:
                return "fab fa-youtube fa-3x";
            case self::$types[1]:
                return "fab fa-instagram-square fa-3x";
            case self::$types[2]:
                return "fab fa-twitter fa-3x";
            case self::$types[3]:
                return "fab fa-facebook-f fa-3x";                
        }  
    }
    

    public function scopeOwnedBy($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }   
}


<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'pv',
        'attack',
        'description',
        'defense',
        'user_id',
        'type_id',
        'rarety_id',
        'image_url',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function rarety()
    {
        return $this->belongsTo(Rarety::class);
    }
    public function notations()
    {
        return $this->hasMany(Notation::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function isInDeck($user)
    {
        return $user->deck->contains('id', $this->id);
    }
   
}

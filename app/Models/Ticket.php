<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function setTitleAttribute($value){
        $this->attributes["title"] = ucwords($value);
    }
    public function getCreatedAtAttribute($value){
        return date('d-m-Y', strtotime($value));
    }
}

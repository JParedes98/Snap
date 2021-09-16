<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'url',
        'open_in_new_tab',
        'is_private',
        'user_id'
    ];

    //    RELATIONSHIPS
    public function owner() {
        return $this->belongsTo('App\Models\User');
    }
}

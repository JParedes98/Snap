<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'html',
        'is_private',
        'user_id'
    ];

    //    RELATIONSHIPS

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

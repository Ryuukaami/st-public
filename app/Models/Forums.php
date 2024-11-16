<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forums extends Model
{

    use HasFactory;

    protected $table = 'forums';

    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

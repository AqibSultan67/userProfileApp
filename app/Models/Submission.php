<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    /**
     *
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'contact',
        'profile_image',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

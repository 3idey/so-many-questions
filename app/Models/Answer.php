<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Answer extends Model
{
    protected $fillable = ['user_id', 'question_id', 'body', 'is_best'];


    protected $casts = ['is_best' => 'boolean'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}

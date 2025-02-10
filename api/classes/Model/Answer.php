<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    // The name of the table associated with the model
    protected $table = 'answers';

    // The primary key associated with the table
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'text',
    ];

    /**
     * Get the question that owns the answer.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    // Define the relationship with RightAnswer
    public function rightAnswer()
    {
        return $this->hasOne(RightAnswer::class);
    }

    public function answerLogs()
    {
        return $this->hasMany(AnswerLog::class);
    }
}
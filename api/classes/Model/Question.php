<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    // The name of the table associated with the model
    protected $table = 'questions';

    // The primary key associated with the table
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'text',
        'test',
        'number',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'test' => 'integer',
        'number' => 'integer',
    ];

    /**
     * Get the test that owns the question.
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Get the answers for the question.
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get the right answers for the question.
     */
    public function rightAnswer()
    {
        return $this->hasOne(RightAnswer::class);
    }

    public function answerLogs()
    {
        return $this->hasMany(AnswerLog::class);
    }
}
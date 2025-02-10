<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerLog extends Model
{
    use HasFactory;

    // The name of the table associated with the model
    protected $table = 'answer_logs';

    // The primary key associated with the table
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'test_id',
        'question_id',
        'answer_id',
    ];

    /**
     * Get the user that owns the answer log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the test that the answer log belongs to.
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Get the question that the answer log belongs to.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the answer that the answer log belongs to.
     */
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}

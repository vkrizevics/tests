<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RightAnswer extends Model
{
    use HasFactory, SoftDeletes;

    // The name of the table associated with the model
    protected $table = 'right_answers';

    // The primary key associated with the table
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'question_id',
        'answer_id',
    ];

    /**
     * Get the question that owns the right answer.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the answer that is the right answer.
     */
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    // Ensure only one right answer per question
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Ensure only one right answer is allowed per question
            
            if (self::where('question_id', $model->question_id)->exists()) {
                throw new \Exception('This question already has a right answer.');
            }
        });
    }
}
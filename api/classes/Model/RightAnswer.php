<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Pareiza atbilde uz jautājumu no tabulas right_answers
 */
class RightAnswer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'right_answers';

    /**
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Ierakstu datumus automātiski apstrādā Eloquent
     * 
     * @var bool
     */
    public $timestamps = true;

    /**
     * Drīkst masveidā aizpildīt
     * 
     * @var string[]
     */
    protected $fillable = [
        'question_id',
        'answer_id',
    ];

    /**
     * Jautājums, uz kuru ir jādod atbilde
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Atbilde, kura ir pareiza
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    /**
     * Nodrošina, ka tikai viena atbilde ir pareiza
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (self::where('question_id', $model->question_id)->exists()) {
                throw new \Exception('Šim jautājumam jau ir pareiza atbilde.');
            }
        });
    }
}
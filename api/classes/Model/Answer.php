<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Atbilde to tabulas answers
 */
class Answer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'answers';

    /**
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
        'text',
    ];

    /**
     * Kuram jautājumam ir ši atbilde?
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Vai šī atbilde ir pareiza?
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rightAnswer()
    {
        return $this->hasOne(RightAnswer::class);
    }

    /**
     * Kuros logos šī atbilde ir minēta?
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answerLogs()
    {
        return $this->hasMany(AnswerLog::class);
    }
}
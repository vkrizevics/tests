<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Testa jautājums no tabulas questions
 */
class Question extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'questions';

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
        'test',
        'number',
    ];

    /**
     * Tests, kuram pieder jautājums
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Atbildes varianti jautājumam
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Pareiza atbilde
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rightAnswer()
    {
        return $this->hasOne(RightAnswer::class);
    }

    /**
     * Loga ieraksti, kuros ir minēts jautājums
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answerLogs()
    {
        return $this->hasMany(AnswerLog::class);
    }
}
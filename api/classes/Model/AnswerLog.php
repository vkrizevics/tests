<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Atbilžu logs tabulā answer_logs
 */
class AnswerLog extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'answer_logs';

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
        'user_id',
        'test_id',
        'question_id',
        'answer_id',
    ];

    /**
     * Lietotājs, kura atbilde ir nologota
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tests, kuru pildīja lietotājs
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    /**
     * Jautājums, uz kuru atbildēja lietotājs
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Atbildes variants, kuru izvēlējās lietotājs
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}

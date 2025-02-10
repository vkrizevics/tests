<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Gala rezultāts testam tabulā test_results
 */
class TestResult extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'test_results';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Drīkst masveidā aizpildīt
     * 
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'test_id',
        'right_answers',
    ];

    /**
     * Katrs rezultāts pieder kādam lietotājam
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Katrs rezultāts pieder konkrētajam testam
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}

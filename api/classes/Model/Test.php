<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Tests no tests tabulas
 */
class Test extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'tests';

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
        'name',
        'enabled',
    ];

    /**
     * Lauki, kuri būs jākonvertē uz PHP tipiem
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * Visi jautājumi šajā testā
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Visi logi, kuros ir minēts šis tēsts
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answerLogs()
    {
        return $this->hasMany(AnswerLog::class);
    }

    /**
     * Visi gala rezultāti, kuros ir minēts šis tests
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
}

<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use HasFactory, SoftDeletes;

    // The name of the table associated with the model
    protected $table = 'tests';

    // The primary key associated with the table
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'enabled',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * Get all the questions for the test.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answerLogs()
    {
        return $this->hasMany(AnswerLog::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);  // Lietotājs var būt saistīts ar vairākiem rezultātiem
    }
}

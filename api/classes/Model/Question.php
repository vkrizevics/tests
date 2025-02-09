<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the date format for the created_at and updated_at attributes
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Get the test that owns the question.
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test', 'id');
    }
}
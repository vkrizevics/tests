<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the date format for the created_at and updated_at attributes
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * Get all the questions for the test.
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'test', 'id');
    }
}

<?php
namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Lietotāju reģistrs bez autentifikācijas tabulā users
 */
class User extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'users';

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
    ];

    // Lietotājam var būt vairāki gala rezultāti
    public function testResults()
    {
        return $this->hasMany(TestResult::class);  
    }
}

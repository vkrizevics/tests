<?php
namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    // Piešķirtais tabulas nosaukums, ja tas ir nepieciešams
    protected $table = 'users';

    // Primārā atslēga
    protected $primaryKey = 'id';

    // Indicates if the model should be timestamped
    public $timestamps = true;

    // Aizsardzība pret masveida piešķiršanu
    protected $fillable = [
        'name',
    ];

    // Lietotājam var būt vairāki gala rezultāti
    public function testResults()
    {
        return $this->hasMany(TestResult::class);  
    }
}

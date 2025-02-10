<?php

namespace Api\Classes\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestResult extends Model
{
    use HasFactory, SoftDeletes; // Piešķir Soft Deletes un Factory atbalstu

    // Definējam tabulas nosaukumu, ja tas ir atšķirīgs no modeļa nosaukuma (neobligāti)
    protected $table = 'test_results';

    // Primārais atslēgas lauks
    protected $primaryKey = 'id';

    // Mass-assignment aizsardzība
    protected $fillable = [
        'user_id',
        'test_id',
        'right_answers',
    ];

    // Attiecības ar User modeli
    public function user()
    {
        return $this->belongsTo(User::class);  // Katrs rezultāts pieder lietotājam
    }

    // Attiecības ar Test modeli
    public function test()
    {
        return $this->belongsTo(Test::class);  // Katrs rezultāts pieder konkrētajam testam
    }
}

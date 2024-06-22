<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';

    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'date',
        'status',
        'catatan',
        'id_guru',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
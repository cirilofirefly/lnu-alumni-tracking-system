<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniIdRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'alumni_id_request_info_id',
        'student_id'
    ];

    public function alumniInfo()
    {
        return $this->belongsTo(AlumniIdRequestInfo::class, 'alumni_id_request_info_id', 'id');
    }
}

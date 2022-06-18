<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniIdRequestInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_number',
        'full_name',
        'course',
        'batch',
        'address',
        'date_of_birth',
        'email',
        'mobile_no',
        'telephone_no',
        'signature',
        'image'
    ];

    public function alumniRequest()
    {
        return $this->belongsTo(AlumniIdRequest::class, 'alumni_id_request_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $guarded = [];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student_account_infos() {
        return $this->hasMany(StudentAccountInfo::class, 'id');
    }
}

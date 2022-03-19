<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends  = ['allow_delete'];

    public function student_account_infos() {
        return $this->hasMany(StudentAccountInfo::class, 'batch_id', 'id');
    }

    public function getAllowDeleteAttribute() {
        return  !$this->student_account_infos()->exists();
    }
}

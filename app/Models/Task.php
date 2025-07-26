<?php

namespace App\Models;

use Dotenv\Repository\Adapter\GuardedWriter;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

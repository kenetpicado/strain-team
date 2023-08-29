<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'birth',
        'id_number',
        'username',
        'password',
        'phone',
        'tutor',
        'degree',
        'promoter_id',
        "branch_id"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeBranch($query, $branch)
    {
        if ($branch) {
            $query->where('branch_id', $branch);
        } else {
            $query->where('branch_id', 1);
        }
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}

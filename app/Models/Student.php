<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth',
        'id_number',
        'card_number',
        'pin',
        'phone',
        'tutor',
        'degree',
        'promoter_id',
        "branch_id"
    ];

    public function scopeBranch($query, $branch)
    {
        if ($branch) {
            $query->where('branch_id', $branch);
        } else {
            $query->where('branch_id', 1);
        }
    }
}

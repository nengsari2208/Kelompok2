<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimbursement extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'kategori',
        'bukti',
        'from',
        'to',
        'status'
    ];

    public function reimbursementDetail(){
        return $this->hasMany(reimbursementDetail::class, 'id_reimbursement', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}

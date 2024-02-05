<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReimbursementDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_reimbursement',
        'tanggal',
        'deskripsi',
        'pengeluaran'
    ];
    public function reimbursement(){
        return $this->belongsTo(Reimbursement::class, 'id_reimbursement');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Preke_sandelyje extends Model
{
    use HasFactory;
    protected $table = 'preke_sandelyje';

    /**
     * Get the comments for the blog post.
     */
    public function preke()
    {
        return $this->belongsTo(Preke::class, 'fk_prekeId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Category extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $fillable = ['name'];

    public function documents(){
        return $this->belongsTo(Document::class);
    }
    public function tags(){
        return $this->hasMany(Tags::class);
    }
}

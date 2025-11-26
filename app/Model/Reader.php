<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reader extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'firstName',
        'lastName',
        'patronymic',
        'address',
        'phone',
    ];
}
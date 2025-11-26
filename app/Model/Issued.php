<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Issued extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'issued';

    protected $fillable = [
        'readerID',
        'bookID',
        'issuedDate',
        'returnDate',
        'isReturned'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookID', 'id');
    }
}

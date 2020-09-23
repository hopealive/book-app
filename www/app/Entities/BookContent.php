<?php
namespace App\Entities;
use \Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $table = 'book_contents';
    protected $fillable = ['hash', 'content'];
}
?>
<?php
namespace App\Entities;
use \Illuminate\Database\Eloquent\Model;

class BookContent extends Model {
    protected $table = 'book_contents';
    protected $fillable = ['hash', 'content'];
}
?>
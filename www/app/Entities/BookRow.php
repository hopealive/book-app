<?php
namespace App\Entities;
use \Illuminate\Database\Eloquent\Model;

class BookRow extends Model {
    protected $table = 'book_rows';
    protected $fillable = ['book_id','row_id', 'order'];
}
?>
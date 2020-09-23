<?php
namespace App\Entities;
use \Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $table = 'books';
    protected $fillable = ['user_id','name'];
}
?>
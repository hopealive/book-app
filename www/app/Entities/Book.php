<?php
namespace App\Entities;
use \Illuminate\Database\Eloquent\Model;

class Book extends Model {
    protected $table = 'books';
    protected $fillable = ['user_id', 'name', 'filename', 'status'];

    const BOOK_STATUS_WAITING_START = 'waiting_start';
    const BOOK_STATUS_PROCESS = 'process';
    const BOOK_STATUS_SUCCESS = 'success';
    const BOOK_STATUS_FAIL = 'fail';

}

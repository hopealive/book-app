<?php
namespace App\Entities;
use \Illuminate\Database\Eloquent\Model;

class LogArchive extends Model {
    protected $table = 'log_archives';
    protected $fillable = ['created_at', 'text'];

}
?>
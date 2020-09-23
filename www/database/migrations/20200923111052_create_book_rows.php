<?php
declare(strict_types=1);

use \App\Migration;

final class CreateBookRows extends Migration
{
    public function up() {
        $this->schema->create('book_rows', function(Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id');
            $table->integer('book_id');
            $table->integer('row_id');
            $table->timestamps();
        });
    }

    public function down() {
        $this->schema->drop('book_rows');
    }
}

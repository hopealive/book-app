<?php
declare(strict_types=1);

use \App\Migration;

final class CreateBooks extends Migration
{
    public function up() {
        $this->schema->create('books', function(Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down() {
        $this->schema->drop('books');
    }

}

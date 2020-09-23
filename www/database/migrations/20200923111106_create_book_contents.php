<?php
declare(strict_types=1);

use \App\Migration;

final class CreateBookContents extends Migration
{
    public function up() {
        $this->schema->create('book_contents', function(Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id');
            $table->string('hash')->index();
            $table->mediumText('content');
            $table->timestamps();
        });
    }

    public function down() {
        $this->schema->drop('book_contents');
    }
}

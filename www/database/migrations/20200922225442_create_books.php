<?php
declare(strict_types=1);

use \App\Migration;
use App\Entities\Book;

final class CreateBooks extends Migration
{
    public function up() {
        $this->schema->create('books', function(Illuminate\Database\Schema\Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('name');
            $table->string('filename');
            $table->enum('status', [
                Book::BOOK_STATUS_WAITING_START,
                Book::BOOK_STATUS_PROCESS,
                Book::BOOK_STATUS_SUCCESS,
                Book::BOOK_STATUS_FAIL,
            ]);
            $table->timestamps();
        });
    }

    public function down() {
        $this->schema->drop('books');
    }

}

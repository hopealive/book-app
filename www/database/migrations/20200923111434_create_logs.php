<?php
declare(strict_types=1);

use \App\Migration;

final class CreateLogs extends Migration
{

    // CREATE TABLE `logs` (
    //     `created_at` DATETIME NOT NULL DEFAULT NOW(),
    //     `text` TEXT,
    //     INDEX logs_created_at (`created_at`)
    // )


    public function up() {
        $this->schema->create('logs', function(Illuminate\Database\Schema\Blueprint $table){
            $table->timestamp('created_at')->index();
            $table->text('text')->nullable();
        });
    }

    public function down() {
        $this->schema->drop('logs');
    }
}

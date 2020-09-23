<?php
declare(strict_types=1);

use \App\Migration;

final class CreateLogArchives extends Migration
{
    public function up() {
        $this->schema->create('log_archives', function(Illuminate\Database\Schema\Blueprint $table){
            $table->timestamp('created_at')->index();
            $table->text('text')->nullable();
        });
    }

    public function down() {
        $this->schema->drop('log_archives');
    }
}

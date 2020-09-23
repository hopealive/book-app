<?php

namespace App\Console;

use Carbon\Carbon;
use App\Entities\Log;

class ArchiveLogs
{
    const CHUNK_SIZE = 100;

    /**
     * Move old logs from logs to archive
     */
    public function handle()
    {
        $connection = (new Log())->getConnection();
        $connection->beginTransaction();

        $monthAgo = Carbon::now()->subMonth()->startOfDay();
        $countRaw = $connection->select('select count(*) as c from logs where created_at <= ?', [$monthAgo]);
        $count = !empty($countRaw) ? $countRaw[0]->c : 0;
        if(empty($count)) $connection->rollBack();

        for($i = 0; $i < $count; $i = $i + self::CHUNK_SIZE){
            $query = 'INSERT INTO log_archives SELECT * FROM logs WHERE created_at <= ? LIMIT ?, ?';
            $countRaw = $connection->insert($query, [$monthAgo, $i, self::CHUNK_SIZE]);
        }

        $connection->delete('DELETE FROM logs WHERE created_at <= ?', [$monthAgo]);
        $connection->commit();
    }



}

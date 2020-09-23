<?php

namespace App\Console;

use Carbon\Carbon;
use App\Entities\Log;

class SeedLogs
{

    public function handle()
    {
        $monthAgo = Carbon::now()->subMonth()->startOfDay();
        $result = Log::where('created_at', '<=', $monthAgo)->count();
        if(!empty($result)) return;

        Log::truncate();

        $logText = 'Some user make some action';

        $logs = [];
        for($i = 0; $i < 10000; ++$i){
            $logs[] = ['text'  => $logText . ' ok: '. $i, 'created_at' => $monthAgo];
        }
        Log::insert($logs);

        $logs = [];
        for($i = 0; $i < 10000; ++$i){
            $logs[] = ['text'  => $logText . ' old: '. $i, 'created_at' => Carbon::now()];
        }
        Log::insert($logs);
    }

}
<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Console\AddUser;
use App\Console\BookProcessor;
use App\Console\ArchiveLogs;
use App\Console\SeedLogs;
use App\Exceptions\UserException;

use App\Entities\Database;


new Database();
if (empty($argv[1])) die("No commands\n");

try {
    $command = null;
    switch ($argv[1]) {
        case 'add-user':
            $command = new AddUser($argv[2], $argv[3], $argv[4]);
            break;
        case 'process-book':
            $command = new BookProcessor();
            break;
        case 'archive-logs':
            $command = new ArchiveLogs();
            break;
        case 'seed-logs':
            $command = new SeedLogs();
            break;
        default:
            die("No command\n");
            break;
    }
    if(method_exists($command, 'handle')){
        $command->handle();
    }
} catch (TypeError $e) {
    echo "ERROR. Wrong arguments";
} catch (UserException $e) {
    echo "ERROR. " . $e->getMessage();
} catch (Exception $e) {
    echo "ERROR. Fatal Console Error";
}
echo "\n";

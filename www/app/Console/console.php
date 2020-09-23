<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Console\AddUser;
use App\Exceptions\UserException;


if (empty($argv[1])) die('No action');

try {
    switch ($argv[1]) {
        case 'add-user':
            $command = new AddUser($argv[2], $argv[3], $argv[4]);
            $command->register();
            break;
    }
} catch (TypeError $e) {
    echo "ERROR. Wrong arguments";
} catch (UserException $e) {
    echo "ERROR. " . $e->getMessage();
} catch (Exception $e) {
    echo "ERROR. Error while creating new user";
}
echo "\n";

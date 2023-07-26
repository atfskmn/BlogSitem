<?php
date_default_timezone_set('Europe/Istanbul');
session_start();
try {
    $createTableStatus=False;
    if(!is_file(__DIR__.'/database.sqlite')){
        $createTableStatus=True;
    }
    $db = new PDO('sqlite:'.__DIR__.'/database.sqlite');
    if($createTableStatus){
        include_once __DIR__.'/createTable.php';
    }

} catch (\PDOException $exception) {
    die('Code: ' . $exception->getCode() . ' Message:' . $exception->getMessage());
}
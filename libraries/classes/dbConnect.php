<?php
require __DIR__ . "/../vendor/autoload.php";
error_reporting(E_ALL ^ E_DEPRECATED);
if(!session_id())
{
    session_start();
}


$config=[
    'driver'    => 'mysql', // Db driver
    'host'      => 'localhost',
    'database'  => 'cpe_quotation',
    'username'  => 'root',
    'password'  => 'Q!w2e3r4',
    'charset'   => 'utf8', // Optional
    'collation' => 'utf8_unicode_ci', // Optional
    'prefix'    => 'cpe_', // Table prefix, optional
    'options'   => [ // PDO constructor options, optional
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
];

if(!class_exists("DB"))
{
    try {
        new Pixie\Connection("mysql",$config,'DB');
    }catch (Exception $exceptione){
        echo "Couldn't connect DB";
    }
}


//
//$dsn = "mysql:host=localhost;dbname=cpe_quotation;charset=UTF8";
//try {
//    return new PDO($dsn, "root", "Q!w2e3r4");
//
//
//}catch (PDOException $e) {
//    return $e->getMessage();
//}
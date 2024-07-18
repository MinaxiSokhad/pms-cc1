<?php
include __DIR__."/src/Framework/Database.php";
use Framework\Database;
$db = new Database('mysql',[
    'hostname' => 'localhost',
    'port'=>3306,
    'dbname'=>'phpiggy'
],'root','');//reflactor the code
$sqlFile = file_get_contents("./Database.sql");
 $db->query($sqlFile);
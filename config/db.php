<?php

try{
$db = new PDO("mysql:host=localhost;dbname=carpool2", "root", "");
} catch(Exception $e){
die($e->getMessage());
}
<?php

try{
$db = new PDO("mysql:host=localhost;dbname=carpool4", "root", "");
} catch(Exception $e){
die($e->getMessage());
}
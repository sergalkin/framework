<?php
require 'rb.php';
$db = require '../config/config_db.php';
R::setup($db['dsn'], $db['user'], $db['pass'], $options);
R::freeze(true);
R::fancyDebug(true);
//Create
/*$cat = R::dispense('category');
$cat->title = 'Категория 2';
$id = R::store($cat);
var_dump($id);*/

//read
/*$cat = R::load('category', 2);
echo $cat->title;*/

//Update
/*$cat = R::load('category', 3);
$cat->title = 'Kata3';
R::store($cat);*/
/*$cat = R::dispense('category');
$cat->title = "Kata3";
$cat->id = 3;
R::store($cat);*/

//Delete
/*$cat = R::load('category', 2);
R::trash($cat);
R::wipe('category');*/

/*$cats = R::findAll('category');*/
/*$cats = R::findAll('category', 'id > ?', [1]);
echo '<pre>';
print_r($cats);*/
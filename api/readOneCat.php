<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// initialize api 
include_once('../core/initialize.php');

// initialize post
$post = new Category($db);
$post->id = isset($_GET['id']) ? $_GET['id'] : die();
// blog post query
$post->readOne();
$post_arr = array(
    'id' => $post->id,
    'name' => $post->name,   
    'created_at' => $post->created_at

);

print_r(json_encode($post_arr));

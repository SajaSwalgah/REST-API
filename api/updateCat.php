<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initialize api 
include_once('../core/initialize.php');

// initialize post
$post = new Category($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->name = $data->name;

if ($post->update()) {
    echo json_encode(
        array('message' => 'Category Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Category NOT Updated')
    );
}

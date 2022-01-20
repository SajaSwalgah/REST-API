<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initialize api 
include_once('../core/initialize.php');

// initialize post
$post = new Category($db);

$data = json_decode(file_get_contents("php://input"));
$post->name = $data->name;
// blog post query
if ($post->create()) {
    echo json_encode(
        array('message' => 'Category created')
    );
} else {
    echo json_encode(
        array('message' => 'Category NOT created')
    );
}

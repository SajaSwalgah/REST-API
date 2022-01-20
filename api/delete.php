<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

// initialize api 
include_once('../core/initialize.php');

// initialize post
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;

// blog post query
if ($post->Delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post NOT Deleted')
    );
}

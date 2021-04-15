<?php
    /*
     * Headers
     */
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Content-Type-Allow-Methods: DELETE');
    header('Content-Type-Allow-Methods: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    /*
     * Api Initializing
     */
    include_once('../core/initialize.php');

    /*
     * Instantiate post
     */
    $post = new Post($db);

    /*
     * Get raw posted data
     */
    $data = json_decode(file_get_contents("php://input"));
    $post->id           = $data->id;

    if($post->delete()){
        echo json_encode(
            array('message' => 'Post deleted.')
        );
    }else{
        echo json_encode(
            array('message' => 'Post not deleted.')
        );
    }
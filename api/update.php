<?php
    /*
     * Headers
     */
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Content-Type-Allow-Methods: PUT');
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
    $post->title       = $data->title;
    $post->body        = $data->body;
    $post->author      = $data->author;
    $post->category_id = $data->category_id;

    if($post->update()){
        echo json_encode(
            array('message' => 'Post updated.')
        );
    }else{
        echo json_encode(
            array('message' => 'Post not updated.')
        );
    }
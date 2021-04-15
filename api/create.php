<?php
    /*
     * Headers
     */
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Content-Type-Allow-Methods: POST');
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
    $post->title        = $data->title;
    $post->body        = $data->body;
    $post->author      = $data->author;
    $post->category_id = $data->category_id;

    if($post->create()){
        echo json_encode(
            array('message' => 'Post created.')
        );
    }else{
        echo json_encode(
            array('message' => 'Post not created.')
        );
    }
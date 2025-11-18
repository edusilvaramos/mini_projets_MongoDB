<?php 

function createPost($postCollection) {
    $postCollection->insertOne([
        "title" => $_POST("title"),
        "content" => $_POST("content"),
        "title" => $_POST("title"),
        
    ]);
}
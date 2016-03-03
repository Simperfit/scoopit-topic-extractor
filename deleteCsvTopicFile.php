<?php

require_once('customErrorHandler.php');

header('Content-type: application/json');

try{
    $topic = filter_var($_GET['topic'], FILTER_SANITIZE_STRING);

    if(file_exists('scoopit_topic_'.$topic.'.csv')){
        unlink('scoopit_topic_'.$topic.'.csv');
    }

    echo json_encode(['error' => false], JSON_PRETTY_PRINT);
}catch(Exception $e){
    echo json_encode(['error' => true, 'message' => $e->getMessage()], JSON_PRETTY_PRINT);
}
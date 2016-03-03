<?php

require_once('vendor/autoload.php');
require_once('customErrorHandler.php');

use Sunra\PhpSimple\HtmlDomParser;

header('Content-type: application/json');

try{
    $topic = filter_var($_GET['topic'], FILTER_SANITIZE_STRING);
    $html = HtmlDomParser::file_get_html('http://www.scoop.it/t/'.$topic);

    $data = trim($html->find('nav[class=pagination] ul', 0)->last_child()->prev_sibling()->plaintext);
    echo json_encode(['error' => false, 'data' => $data], JSON_PRETTY_PRINT);
}catch(Exception $e){
    echo json_encode(['error' => true, 'message' => $e->getMessage()], JSON_PRETTY_PRINT);
}
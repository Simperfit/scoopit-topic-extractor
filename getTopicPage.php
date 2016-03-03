<?php

require_once('vendor/autoload.php');
require_once('customErrorHandler.php');

use Sunra\PhpSimple\HtmlDomParser;
use League\Csv\Writer;
use League\Csv\Reader;

echo header('Content-Type: application/json; charset=utf-8');

try{
    //Get parameters
    $topic = filter_var($_GET['topic'], FILTER_SANITIZE_STRING);
    $page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);

    //Scoopit
    $links= [];
    $scoopit_id = 0;

    $html = HtmlDomParser::file_get_html('http://www.scoop.it/t/'.$topic.'?page='.$page);
    $csv = Writer::createFromFileObject(new SplTempFileObject());

    if(file_exists('scoopit_topic_'.$topic.'.csv')){
        $existing_file = Reader::createFromPath('scoopit_topic_'.$topic.'.csv');
        $existing_lines = $existing_file->fetchAll();
        $csv->insertAll($existing_lines);
    }else{
        $csv->insertOne(['type', 'url', 'title', 'description', 'image_url', 'date']);
    }

    // Find all scoops
    foreach($html->find('h2[class=postTitleView]') as $element){
        $type = $element->first_child()->tag;
        $date = $element->parent()->parent()->find('div[class=post-content] span meta[itemprop=uploadDate]', 0)->content;

        if($type == "div"){
            $links[$scoopit_id]['type'] = 'POST';
            $links[$scoopit_id]['url'] = null;
        }else{
            $links[$scoopit_id]['type'] = 'LINK';
            $links[$scoopit_id]['url'] = trim($element->first_child()->href);
        }
        $links[$scoopit_id]['title'] = trim($element->first_child()->plaintext);
        $links[$scoopit_id]['description'] = trim($element->parent()->parent()->find('div[class=post-content] div[class=post-description] div[class=tCustomization_post_description]', 0)->innertext);
        $img = $element->parent()->parent()->find('div[class=post-image] div[class=thisistherealimage] img', 0);
        $links[$scoopit_id]['image_url'] = isset($img) ? $img->src : null;
        $links[$scoopit_id]['date'] = $date;

        $csv->insertOne($links[$scoopit_id]);

        $links[$scoopit_id]['date'] = new DateTime($date);
        $scoopit_id++;
    }

    file_put_contents('scoopit_topic_'.$topic.'.csv',$csv);

    //Return JSON encoded scoops
    echo json_encode(['error' => false, 'data' => $links], JSON_PRETTY_PRINT);
}catch(Exception $e){
    echo json_encode(['error' => true, 'message' => $e->getMessage()], JSON_PRETTY_PRINT);
}

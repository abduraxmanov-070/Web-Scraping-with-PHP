<?php
$url = 'https://kun.uz';
$url_authored = 'https://kun.uz/authored';

require 'vendor/autoload.php';
require 'db.php';
$httpClient = new \GuzzleHttp\Client();
$response = $httpClient->get($url_authored);
$htmlString = (string) $response->getBody();
//add this line to suppress any warnings
libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);

$news_xpath = $xpath->evaluate('//div//div[@class="container"]//div//div[@id="news-list"]//div[@class="news"]');

$news_list = [];
foreach($news_xpath as $news){
    $item = [
        'title'=>htmlspecialchars($news->childNodes[3]->textContent),
        'date'=>htmlspecialchars($news->childNodes[2]->childNodes[0]->textContent),
        'image'=>htmlspecialchars($news->childNodes[0]->childNodes[0]->attributes[0]->textContent),
        'link'=>htmlspecialchars($url.$news->childNodes[0]->attributes[1]->textContent),
        'short_content'=>'short content',
        'content'=>'news'
    ];
    $news_list[]=$item;
    insertData($item);
}
// print_r(json_encode($news_list));


?>
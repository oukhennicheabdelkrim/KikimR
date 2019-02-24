<?php

require 'vendor/autoload.php';

use oukhennicheabdelkrim\KikimR\KikimR as app;
use oukhennicheabdelkrim\KikimR\validator\RegExp;
use oukhennicheabdelkrim\KikimR\router\Router;

//EXAMPLE

function topicController($idTopic) {

    $topicsId = [18, 2, 3];

    if (in_array($idTopic, $topicsId)) {
        echo "Topic : $idTopic";
    } else {
        Router::setStatusCode(404);
    }
}

app::init();
Router::addMiddleware(function () {
    echo 'Started Middleware 1<br>';
});

Router::get('/', function () {
    echo 'Hello from KikimR !';
});

Router::get('page_[id]','topicController')
    ->with('id', RegExp::NUMBER);


// method to call when Status Code is 404
Router::whenStatusCode(404, function () {
    echo '404 .Not found';
});

app::run(); // Run App

?>

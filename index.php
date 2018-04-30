<?php

require'vendor/autoload.php';
use KikimR\KikimR as app;
use KikimR\validator\RegExp;
use KikimR\validator\Validator;
use KikimR\router\Router;
use KikimR\data\DataInput;

//EXAMPLE

app::init();
Router::addMiddleware(function (){});

Router::get('/',function(){ echo "Hello from KikimR";});

Router::get('/page_[id]',function($id){

    $topicsId=[18,2,3];
    if (in_array($id, $topicsId))
    {
        echo "Topic : $id <hr>";
    }
    else
    {
        Router::setStatusCode(404);
    }
})->with('id',RegExp::NUMBER);

// url: profil?id=theId&name=topicType)
Router::get('profil',function(){

      if (Validator::$get->is(array('id'=>RegExp::NUMBER,'name'=>'[a-zA-Z]+')))
      {
        echo 'id = '.DataInput::$get['id'].' | name = '.DataInput::$get['name'].' <hr> ';
      }
      else
      {
        Router::setStatusCode(404);
      }
}); 



Router::get('/error500',function(){Router::setStatusCode(500);});

// method to call when Status Code is 404
Router::whenStatusCode(404,function (){echo " 404 .Not found ";});

app::run();

?>
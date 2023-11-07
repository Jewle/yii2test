<?php

namespace app\controllers;

use ishop\App;

class CurrencyController extends AppController {

    public function changeAction(){
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if($currency){
//            $curr = \R::findOne('currency', 'code = ?', [$currency]);
            $curr=App::$app->getProperty('currency')['code'];
            if(!empty($curr)){
                setcookie('currency', $currency, time() + 3600*24*7, '/');
            }
        }
        redirect();
    }

}
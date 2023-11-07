<?php
/**
 * Created by PhpStorm.
 * User: Sergiuss
 * Date: 11.08.2019
 * Time: 14:46
 */

namespace app\models;


use ishop\App;

class BreadCrumbs extends AppModel{
    public static function getBreadcrumbs($catid,$name=''){
        $cats=App::$app->getProperty('cats');
        $bcumbs_array=self::getParts($cats,$catid);
        $bc_template="<li><a href='".PATH."'>Главная</a></li>";
        foreach ($bcumbs_array as $alias=>$title){
            $bc_template.="<li><a href='".PATH."/category/{$alias}'>{$title}</a></li>";
        }
        if($name){
            $bc_template.="<li>{$name}</li>";
        }
        return $bc_template;
    }
    public static function getParts($cats,$id){
        if(!$id) return false;
        $bcrumbs=[];
        foreach ($cats as $k=>$v) {
            if(isset($cats[$id])){
                $bcrumbs[$cats[$id]['alias']]=$cats[$id]['title'];
               $id=$cats[$id]['parent_id'];
            }
            else break;


        }
        return array_reverse($bcrumbs,true);

    }

}
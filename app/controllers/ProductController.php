<?php
/**
 * Created by PhpStorm.
 * User: Sergiuss
 * Date: 06.08.2019
 * Time: 13:06
 */

namespace app\controllers;


use app\models\BreadCrumbs;
use app\models\Product;
use RedBeanPHP\R;

class ProductController extends AppController{
    public function viewAction(){
        $alias=$this->route['alias'];
        $product=R::findOne('product',"alias=? AND status='1'",[$alias]);
        if(!$product){
            throw new \Exception('Страница не найдена',404);
        }
        $related=R::getAll('SELECT * FROM related_product JOIN product ON product.id=related_product.related_id WHERE related_product.product_id=?',[$product->id]);
        $gallery=R::findAll('gallery','product_id=?',[$product->id]);
        $p_model=new Product();
        $p_model->setRecentlyViewed($product->id);
        $bcumbs=BreadCrumbs::getBreadcrumbs($product->category_id,$product->title);
        $r_viewed=$p_model->getRecentlyViewed();
        $recentlyViewed=null;
        if($r_viewed){
            $recentlyViewed=R::find('product','id IN('.R::genSlots($r_viewed).') LIMIT 3',$r_viewed);

        }
        $mods=R::findAll('modification','product_id=?',[$product->id]);
        $this->setMeta($product->title);
        $this->set(compact('product','related','gallery','recentlyViewed','bcumbs','mods'));

    }
}
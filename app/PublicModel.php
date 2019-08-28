<?php
/**
 * Created by PhpStorm.
 * User: Arsi
 * Date: 8/28/2019
 * Time: 10:39 PM
 */

namespace App;


class PublicModel implements PublicInterface
{
 public function slug_format($str){
     return str_replace(' ','-',$str);
 }

 public function name_format($str){
        return str_replace('-',' ',$str);
 }


}
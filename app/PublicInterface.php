<?php
/**
 * Created by PhpStorm.
 * User: Arsi
 * Date: 8/28/2019
 * Time: 10:41 PM
 */

namespace App;
use Illuminate\Http\Request;

interface PublicInterface
{
public function slug_format($str);
public function name_format($str);
public function image(Request $request,$path,$name);
}
<?php
namespace App\Controllers;
use Src\Classes\ClassRender;
class View{
    public static function view($dir, $content= []){
        $render = new ClassRender();
        $render->setDir($dir);
        $render->setContent($content);
        $render->renderLayout();
    }
}
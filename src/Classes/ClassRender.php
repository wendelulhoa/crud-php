<?php
namespace src\Classes;
class ClassRender{
    public $dir;
    public $content;

    public function getDir(){
        return $this->dir;
    }

    public function setDir($dir){
        $this->dir = $dir;
    }

    public function getContent(){
        return $this->content;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public function renderLayout(){
        include(DIRREQ."app/Views/layout.php");
    }

    public function addHead(){

    }

    public function addMain(){
        if(file_exists(DIRREQ."app/Views/{$this->getDir()}.php")){
            include(DIRREQ."app/Views/{$this->getDir()}.php");
        }
        
    }

    public function addFooter(){

    }
}
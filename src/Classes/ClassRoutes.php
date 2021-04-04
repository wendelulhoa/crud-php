<?php
namespace src\Classes;
use Src\Traits\TraitUrlParser;
class ClassRoutes{
    use TraitUrlParser;
    private $route;

    public function getRoute(){
       $url= $this->parserUrl();
       $index = $url[0];
       $this->route=array(
           ""=>"HomeController",
           "user"=>"UserController",
           "republica"=>"RepublicaController"
       );

       if(array_key_exists($index, $this->route)){
        if(file_exists(DIRREQ."app/Controllers/{$this->route[$index]}.php")){
            return $this->route[$index];
        }
       }

    }
}
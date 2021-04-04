<?php
namespace App;
use Src\Classes\ClassRoutes;

class Dispath extends ClassRoutes{
    private $method;
    private $param = [];
    private $obj;
    
    public function __construct(){
        $this->addController();
    }

    protected function getMethod(){
        return $this->method;
    }

    public function setMethod($method){
        $this->method = $method;
    }
    
    protected function getParam(){
        return $this->param;
    }

    public function setParam($param){
        $this->param = $param;
    }

    private function addController(){
        $RouteController = $this->getRoute();
        $nameSpace = "App\\Controllers\\{$RouteController}";
        $this->obj = new $nameSpace;  
        if(isset($this->parserUrl()[1])){
            $this->addMethod();
        }
    }

    private function addMethod(){
        if(method_exists($this->obj, $this->parserUrl()[1])){
            $this->setMethod("{$this->parserUrl()[1]}");
            $this->addParam();
            call_user_func_array([$this->obj, $this->getMethod()], $this->getParam());
        }
    }

    private function addParam(){
        if(count($this->parserUrl()) > 2){
            foreach($this->parserUrl() as $key => $value){
                if($key > 1){
                    $this->setParam($this->param += [$key => $value]);
                }
            }
        }
    }


}
<?php 


class container 

{
    protected $binding = [];

    public function bind($name, callable $resolver){
       $dd = $this->binding[$name] = $resolver; 

    }

    public function make($name){
        $dd = $this->binding[$name]();
        var_dump($dd);
    }
}


$obj = new container;
$obj->bind("game", function(){
    return "footbale";
});

$obj->make('game')




?>
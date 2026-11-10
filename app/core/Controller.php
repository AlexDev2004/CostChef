<?php class Controller{
    protected array $models = [];
    protected array $views  =[];

    public function addModel(string $key , Model $model):void{
        $this->models[$key] = $model;
    }
    public function addView(string $key , View $view):void{
        $this->views[$key] = $view;
    }
}?>
<?php class ControllerHeader extends Controller{
    public function __construct(ModelRestaurant $model , Header $view){
        $this->addModel('restaurant' , $model);
        $this->addView('header' , $view);
    }

    public function render():void{
        $data = $this->models['restaurant']->getUser();

        $this->views['header']->setRestaurant($data);

        $this->views['header']->display();
        
    }
}?>
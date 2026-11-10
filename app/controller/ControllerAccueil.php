<?php class ControllerAccueil extends Controller{
    public function __construct(ViewAccueil $accueil , Footer $footer){
        $this->addView('accueil' , $accueil);
        $this->addView('footer' , $footer);
    }

    public function render():void{
        $this->views['footer']->setAriane(['accueil']);

        $this->views['accueil']->display();
        $this->views['footer']->display();
    }
}?>
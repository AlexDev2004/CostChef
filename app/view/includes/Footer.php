<?php class Footer extends View{
    private array $ariane = [];

    public function setAriane(array $ariane):self{
        $this->ariane = $ariane;
        return $this;
    }

    function display(){
        $pages = [];
        $pageActu = '';
        foreach($this->ariane as $i => $page){
            if($i == (count($this->ariane)-1)){
                $pageActu = $page;
            }else{
                $pages[] = $page;
            }
        }

        ?><footer>
            <button onclick="window.history.back()" class="secondaryButton">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="var(--cButton)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Retour
            </button>
            <div id="ariane">
                <?php foreach($pages as $case) echo("<div><a href='$_ENV[$case]'>$case</a></div> <div class='arianeSeparator'>></div>"); ?>
                <div><a class="buttonOff" href="#"><?php echo($page); ?></a></div>
            </div>
            <div id="cgu"><a href="#">Mention légales</a></div>
        </footer>
        </body>
        </html>
    <?php }
}?>
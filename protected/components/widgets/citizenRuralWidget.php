<?php


class CitizenRuralWidget extends CWidget
{
    public $models;
    public $form;
    public function run()
    {
        if ($this->models[0] instanceOf CitizenRural)
         $this->render('citizenRuralWidget',array('form'=>$this->form,'complainants'=>$this->models),FALSE);
    }
}
?>
<?php

class controllerMain extends Controller {
    protected $templateDir = 'template';
    public function actionPage() {
        echo $this->renderLayout(
            [
             'lo_content' => $this->renderTemplate('auth'),
            ]);
        $model = $this -> getModel('test');
        $model -> insertFakeData();
        }
}

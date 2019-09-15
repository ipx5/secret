<?php

class controllerMain extends Controller {
    public function actionPage() {
        echo $this->renderLayout(
            [
             'lo_auth' => $this->renderTemplate('auth'),
            ]);
        $model = $this -> getModel('test');
        $model -> insertFakeData();
        }
}

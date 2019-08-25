<?php

class controllerMain extends controller {
    public function actionPage() {
        echo $this->renderLayout('main',
            [
             'lo_auth' => $this->renderTemplate('auth'),
            ]);
        }

}
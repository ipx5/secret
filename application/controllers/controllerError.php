<?php
   
class controllerError extends Controller {
    public function actionNotfound() {
        print_r($_SESSION['error']);
    }
}
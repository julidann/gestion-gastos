<?php
require_once './app/models/GestionModel.php';
require_once './app/models/CotizacionesModel.php';
require_once './app/views/GestionView.php';

class HomeController {
    private $model;
    private $cotizacionesModel;
    private $view;

    public function __construct() {
        $this->model = new GestionModel();
        $this->cotizacionesModel = new CotizacionesModel();
        $this->view = new GestionView();
    }

    public function showHome() {
        $gestiones = $this->model->getAll();
        $cotizaciones = $this->cotizacionesModel->getAll();
        $this->view->showHome($gestiones, $cotizaciones);
       
    }

   

    

}






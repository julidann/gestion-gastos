<?php

require_once './app/models/GestionModel.php';
require_once './app/views/GestionView.php';

require_once './app/models/CotizacionesModel.php';
require_once './app/models/CuentasModel.php';
require_once './app/models/MesesModel.php';

class CotizacionController
{
    //private $model;
    private $view;
    private $cotizacionModel;
    private $cuentaModel;
    private $mesModel;


    function __construct()
    {
        //$this->model = new GestionModel();
        $this->view = new GestionView();
        $this->cotizacionModel = new CotizacionesModel();
        $this->cuentaModel = new CuentasModel();
        $this->mesModel = new MesesModel();
    }

    //------COTIZACION VIEW------//

    public function showCotizaciones()
    {
        $cotizacion = $this->cotizacionModel->getAll();
        $meses = $this->mesModel->getAll();
        $this->view->showCotizaciones($cotizacion, $meses);
    }

    public function showAddFormCotizacion()
    {
        $meses = $this->mesModel->getAll();
        $this->view->showAddFormCotizacion($meses);
    }

    public function showEditFormCotizacion($id)
    {

        $cotizacion = $this->cotizacionModel->get($id);

        if (!$cotizacion) {
            return $this->view->showError("No existe la cotización con el id=$id para editar.");
        }

        //esto es para poder llenar los select del formulario
        $meses = $this->mesModel->getAll();
        $cotizacion = $this->cotizacionModel->get($id);

        $this->view->showEditFormCotizacion($meses, $cotizacion);
    }



    //----- ADD EDIT DELETE COTIZACION--------- //
    public function insertCotizacion()
    {
        $anio = $_POST['anio'];
        $id_mes = $_POST['id_mes'];
        $cantidad_usd = $_POST['cantidad_usd'];
        $cotizacion_usd = $_POST['cotizacion_usd'];
        $pesos = $cantidad_usd * $cotizacion_usd;
        $descripcion = $_POST['descripcion'];

        $this->cotizacionModel->insert($anio, $id_mes, $cantidad_usd, $cotizacion_usd, $pesos, $descripcion);

        header("Location: " . BASE_URL . "tabla-cotizaciones");
    }

    public function editCotizacion($id)
    {
        $anio = $_POST['anio'];
        $id_mes = $_POST['id_mes'];
        $cotizacion_usd = $_POST['cotizacion_usd'];
        $pesos = $_POST['pesos'];
        $descripcion = $_POST['descripcion'];

        $this->cotizacionModel->update($id, $anio, $id_mes, $cotizacion_usd, $pesos, $descripcion);

        header("Location: " . BASE_URL . "tabla-cotizaciones");
    }

    public function deleteCotizacion($id)
    {
        $this->cotizacionModel->remove($id);
        header("Location: " . BASE_URL . "tabla-cotizaciones");
    }

    //----CALCULADORES---//
    public function calcularPesos()
    {
        //acá tengo que calcular los uds a fin de mes o primer dia de mes
        //y multiplicarlo por la cotización de ese momento
    }
}

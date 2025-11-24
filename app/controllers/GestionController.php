<?php

require_once './app/models/GestionModel.php';
require_once './app/views/GestionView.php';

require_once './app/models/CotizacionesModel.php';
require_once './app/models/CuentasModel.php';
require_once './app/models/MesesModel.php';

class GestionController
{
    private $model;
    private $view;
    private $cotizacionModel;
    private $cuentaModel;
    private $mesModel;
   

    function __construct()
    {
        $this->model = new GestionModel();
        $this->view = new GestionView();
        $this->cotizacionModel = new CotizacionesModel();
        $this->cuentaModel = new CuentasModel();
        $this->mesModel = new MesesModel();

    }

    //------GESTION VIEW------//
    public function showGestion()
    {
        $gestion = $this->model->getAll();

        $this->view->showGestion($gestion);
    }

    public function showAddFormGestion()
    {
        $cuentas = $this->cuentaModel->getAll();
        
        $this->view->showAddFormGestion(
            $cuentas,

        );
    }

    public function showEditFormGestion($id)
    {

        $gestion = $this->model->get($id);

        if (!$gestion) {
            return $this->view->showError("No existe el  con el id=$id para editar.");
        }

        //esto es para poder llenar los select del formulario
        $cuentas = $this->cuentaModel->getAll();
        $gestion = $this->model->get($id);
             


        $this->view->showEditFormGestion($cuentas, $gestion );
    }

    //------CRUD GESTION------//
    public function insertGestion()
    {

        if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showError('Error: falta completar la fecha');
        }
        if (!isset($_POST['id_cuenta']) || empty($_POST['id_cuenta'])) {
            return $this->view->showError('Error: falta completar la cuenta');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Error: falta completar la descripcion');
        }
     

        $fecha = $_POST['fecha'];
        $id_cuenta = $_POST['id_cuenta'];
        $descripcion = $_POST['descripcion'];
        $ingreso_efectivo = $_POST['ingreso_efectivo'] ?? null;
        $egreso_efectivo = $_POST['egreso_efectivo'] ?? null;
        $ingreso_banco = $_POST['ingreso_banco'] ?? null;
        $egreso_banco = $_POST['egreso_banco']?? null;
        $ingreso_usd = $_POST['ingreso_usd']?? null;
        $egreso_usd = $_POST['egreso_usd'] ?? null;
        $saldo_efectivo = $_POST['saldo_efectivo'] ?? null;
        $saldo_banco = $_POST['saldo_banco'] ?? null;
        $saldo_usd = $_POST['saldo_usd']?? null;


        $id = $this->model->insert($fecha, $id_cuenta, $descripcion, $ingreso_efectivo, $egreso_efectivo, $ingreso_banco, $egreso_banco, $ingreso_usd, $egreso_usd, $saldo_efectivo, $saldo_banco, $saldo_usd);

        if (!$id) {
            return $this->view->showError('Error al insertar nueva gestión)');
        }

        header('Location: ' . BASE_URL . 'tabla-gestion');
    }

    public function deleteGestion($id)
    {

        $gestion = $this->model->get($id);

        if (!$gestion) {
            return $this->view->showError("No existe el cliente con el id=$id");
        }
        $this->model->remove($id);

        header('Location: ' . BASE_URL . 'tabla-gestion');
    }

    public function editGestion($id)
    {

          if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
            return $this->view->showError('Error: falta completar la fecha');
        }
        if (!isset($_POST['id_cuenta']) || empty($_POST['id_cuenta'])) {
            return $this->view->showError('Error: falta completar la cuenta');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Error: falta completar la descripcion');
        }

          $fecha = $_POST['fecha'];
        $id_cuenta = $_POST['id_cuenta'];
        $descripcion = $_POST['descripcion'];
        $ingreso_efectivo = $_POST['ingreso_efectivo'] ?? null;
        $egreso_efectivo = $_POST['egreso_efectivo'] ?? null;
        $ingreso_banco = $_POST['ingreso_banco'] ?? null;
        $egreso_banco = $_POST['egreso_banco']?? null;
        $ingreso_usd = $_POST['ingreso_usd']?? null;
        $egreso_usd = $_POST['egreso_usd'] ?? null;
        //$saldo_efectivo = $_POST['saldo_efectivo'] ?? null;
        //$saldo_banco = $_POST['saldo_banco'] ?? null;
        //$saldo_usd = $_POST['saldo_usd']?? null;

        $gestion = $this->model->get($id);

        if (!$gestion) {
            return $this->view->showError("No existe el  con el id = $id");
        }



        $this->model->update($id, $fecha, $id_cuenta, $descripcion, $ingreso_efectivo, $egreso_efectivo, $ingreso_banco, $egreso_banco, $ingreso_usd, $egreso_usd);

        header('Location: ' . BASE_URL . 'tabla-gestion');
        exit;
    }

      public function showFormFiltro()
    {
        $gestiones = $this->model->getAll();
        $cuentas = $this->cuentaModel->getAll();
        $filtro_fecha = '';
        $filtro_cuenta_id = '';
    
        $this->view->showFormFiltros($gestiones,
            $cuentas,
            $filtro_fecha,
            $filtro_cuenta_id
        );
    }

    public function buscarGestiones()
    {

        $filtros = [
            'fecha' => $_GET['fecha'] ?? '',
            'id_cuenta' => $_GET['id_cuenta'] ?? '',
        ];


        $gestiones = $this->model->getGestionesFiltro($filtros);
        $cuentas = $this->cuentaModel->getAll();
        $filtro_fecha = $filtros['fecha'];
        $filtro_cuenta_id = $filtros['id_cuenta'];
        
    
        $this->view->showGestionesFiltradas(
            $gestiones,
            $cuentas,
            $filtro_fecha,
            $filtro_cuenta_id
        );

    }
    

}

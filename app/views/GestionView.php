<?php

class GestionView {
    public function showHome ($gestiones, $cotizaciones) {
       
        require_once './templates/layout/header.phtml';
        require_once './templates/home.phtml';
        require_once './templates/tabla_resumen.phtml';
        require_once './templates/grafico_cotizacion.phtml';
        require_once './templates/layout/footer.phtml';
    }
   
    public function showGestion ($gestiones) {
        require_once './templates/layout/header.phtml';
        require_once './templates/tabla_gestion.phtml';
        require_once './templates/layout/footer.phtml';
    }

    public function showCotizaciones ($cotizaciones){
        require_once './templates/layout/header.phtml';
        require_once './templates/tabla_cotizacion.phtml';
        require_once './templates/layout/footer.phtml';
    }
    public function showGestionesFiltradas(
            $gestiones,
            $cuentas,
            $filtro_fecha,
            $filtro_cuenta_id
        ){
        require_once './templates/layout/header.phtml';
        require_once './templates/form_filtrar_gestion.phtml';
        require_once './templates/tabla_gestion.phtml';
        require_once './templates/layout/footer.phtml';
        }

    public function showFormFiltros (
        $gestiones,
        $cuentas,
        $filtro_fecha,
        $filtro_cuenta_id
    ) {        
        require_once './templates/layout/header.phtml';
        require_once './templates/form_filtrar_gestion.phtml';
        require_once './templates/layout/footer.phtml';
    }
    
   
    public function showAddFormGestion ($cuentas){
        //$count = count($clientes);
         require_once './templates/layout/header.phtml';
        require_once './templates/form_add_gestion.phtml';
        require_once './templates/layout/footer.phtml';
    }
    

    public function showEditFormGestion ($cuentas, $gestion){
        require_once './templates/layout/header.phtml';
        require_once './templates/form_edit_gestion.phtml';
        require_once './templates/layout/footer.phtml';

    }

   
    public function showAddFormCotizacion ($meses){
         require_once './templates/layout/header.phtml';
        require_once './templates/form_add_cotizacion.phtml';
        require_once './templates/layout/footer.phtml';
    }

    public function showEditFormCotizacion ($meses, $cotizacion){
        require_once './templates/layout/header.phtml';
        require_once './templates/form_edit_cotizacion.phtml';
        require_once './templates/layout/footer.phtml';
    }


    public function showError($error) {
        echo "<h1>$error</h1>";
    }
}




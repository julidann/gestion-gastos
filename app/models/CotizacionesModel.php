<?php
require_once __DIR__ .'/../../config/config.php';
require_once __DIR__ .'/model.php';

class CotizacionesModel extends Model{
    
    public function get($id){
        $query = $this->db->prepare('SELECT * FROM cotizaciones WHERE id = ?');
        $query->execute([$id]);
        $localidades = $query->fetch(PDO::FETCH_OBJ);

        return $localidades;
    }

    public function getAll() {
     
        $query = $this->db->prepare( 'SELECT 
                c.*, 
                m.mes
            FROM cotizaciones c
            LEFT JOIN meses m ON c.id_mes = m.id
            ORDER BY c.anio DESC, c.id_mes DESC');
        $query->execute();

        $cotizaciones = $query->fetchAll(PDO::FETCH_OBJ);


        return $cotizaciones;
    }

    public function insert($anio, $id_mes, $cantidad_usd, $cotizacion_usd, $pesos, $descripcion) {

        $query = $this->db->prepare("INSERT INTO cotizaciones(anio, id_mes, cantidad_usd, cotizacion_usd, pesos, descripcion) VALUES(?,?,?,?,?,?)");
        $query->execute([$anio, $id_mes, $cantidad_usd, $cotizacion_usd, $pesos, $descripcion]);

        return $this->db->lastInsertId();
    }

    public function remove($id) {
        $query = $this->db->prepare('DELETE from cotizaciones where id = ?');
        $query->execute([$id]);

    }

    public function update($id, $anio, $id_mes, $cotizacion_usd, $pesos, $descripcion) {
        
        $query = $this->db->prepare("UPDATE cotizaciones SET anio = ?, id_mes = ?, cotizacion_usd = ?, pesos = ?, descripcion = ? , WHERE id = ?");
        $query->execute([$anio, $id_mes, $cotizacion_usd, $pesos, $descripcion, $id]);
    }

 
}
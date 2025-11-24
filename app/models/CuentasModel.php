<?php
require_once __DIR__ .'/../../config/config.php';
require_once __DIR__ .'/model.php';

class CuentasModel extends Model{
    
    public function get($id){
        $query = $this->db->prepare('SELECT * FROM cuentas WHERE id = ?');
        $query->execute([$id]);
        $rubros = $query->fetch(PDO::FETCH_OBJ);

        return $rubros;
    }

    public function getAll() {
     
        $query = $this->db->prepare( 'SELECT * FROM cuentas');
        $query->execute();

        $cuentas = $query->fetchAll(PDO::FETCH_OBJ);

        return $cuentas;
    }

    public function insert($cuenta) {

        $query = $this->db->prepare("INSERT INTO cuentas(cuenta) VALUES(?)");
        $query->execute([$cuenta]);

        return $this->db->lastInsertId();
    }

    public function remove($id) {
        $query = $this->db->prepare('DELETE from cuentas where id = ?');
        $query->execute([$id]);

    }

    public function update($id, $cuenta) {
        
        $query = $this->db->prepare("UPDATE cuentas SET cuenta = ? WHERE id = ?");
        $query->execute([$cuenta, $id]);
    }

}
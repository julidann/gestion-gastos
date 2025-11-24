<?php
require_once __DIR__ .'/../../config/config.php';
require_once __DIR__ .'/model.php';

class MesesModel extends Model{
    
    public function get($id){
        $query = $this->db->prepare('SELECT * FROM meses WHERE id = ?');
        $query->execute([$id]);
        $despachos = $query->fetch(PDO::FETCH_OBJ);

        return $despachos;
    }

    public function getAll() {
     
        $query = $this->db->prepare( 'SELECT * FROM meses');
        $query->execute();

        $despachos = $query->fetchAll(PDO::FETCH_OBJ);

        return $despachos;
    }

    public function insert($mes) {

        $query = $this->db->prepare("INSERT INTO meses(mes) VALUES(?)");
        $query->execute([$mes]);

        return $this->db->lastInsertId();
    }

    public function remove($id) {
        $query = $this->db->prepare('DELETE from meses where id = ?');
        $query->execute([$id]);

    }

    public function update($id, $mes) {
        
        $query = $this->db->prepare("UPDATE meses SET mes = ? WHERE id = ?");
        $query->execute([$mes, $id]);
    }

}
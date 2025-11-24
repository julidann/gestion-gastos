<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/model.php';


class GestionModel extends Model
{

    public function get($id)
    {
        $query = $this->db->prepare('SELECT * FROM gestion WHERE id = ?');
        $query->execute([$id]);
        $clientes = $query->fetch(PDO::FETCH_OBJ);

        return $clientes;
    }

    public function getAll()
    {
        $query = $this->db->prepare('SELECT 
    g.id,
    g.fecha,
    g.id_cuenta,
    g.descripcion,
    g.ingreso_efectivo,
    g.egreso_efectivo,
    g.ingreso_banco,
    g.egreso_banco,
    g.ingreso_usd,
    g.egreso_usd,
  
    c.cuenta AS nombre_cuenta
FROM gestion g
    LEFT JOIN cuentas c ON g.id_cuenta = c.id
    WHERE MONTH(g.fecha) = MONTH(CURDATE())
      AND YEAR(g.fecha) = YEAR(CURDATE())
    ORDER BY g.fecha ASC');
        $query->execute();

        $gestiones = $query->fetchAll(PDO::FETCH_OBJ);

    // Acumuladores de saldo
    $saldoEf   = 0;
    $saldoBco  = 0;
    $saldoUsd  = 0;

    foreach ($gestiones as $g) {

        // Cálculo saldo efectivo
        $saldoEf = $this->calcularSaldo($saldoEf, $g->ingreso_efectivo, $g->egreso_efectivo);
        $g->saldo_efectivo = $saldoEf;

       // Cálculo saldo banco
        $saldoBco = $this->calcularSaldo($saldoBco, $g->ingreso_banco, $g->egreso_banco);
        $g->saldo_banco = $saldoBco;

        // Cálculo saldo USD
        $saldoUsd = $this->calcularSaldo($saldoUsd, $g->ingreso_usd, $g->egreso_usd);
        $g->saldo_usd = $saldoUsd;
    }

    return $gestiones;
}

    public function insert($fecha, $id_cuenta, $descripcion, $ingreso_efectivo, $egreso_efectivo, $ingreso_banco, $egreso_banco, $ingreso_usd, $egreso_usd, $saldo_efectivo, $saldo_banco, $saldo_usd)
    {


        $query = $this->db->prepare("INSERT INTO gestion(fecha, id_cuenta, descripcion, ingreso_efectivo, egreso_efectivo, ingreso_banco, egreso_banco, ingreso_usd, egreso_usd, saldo_efectivo, saldo_banco, saldo_usd) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        $query->execute([$fecha, $id_cuenta, $descripcion, $ingreso_efectivo, $egreso_efectivo, $ingreso_banco, $egreso_banco, $ingreso_usd, $egreso_usd, $saldo_efectivo, $saldo_banco, $saldo_usd]);

        return $this->db->lastInsertId();
    }

    public function remove($id)
    {
        $query = $this->db->prepare('DELETE from gestion where id = ?');
        $query->execute([$id]);
    }

    public function update($id, $fecha, $id_cuenta, $descripcion, $ingreso_efectivo, $egreso_efectivo, $ingreso_banco, $egreso_banco, $ingreso_usd, $egreso_usd)
    {
        $query = $this->db->prepare("UPDATE gestion SET fecha = ?, id_cuenta = ?, descripcion = ?, ingreso_efectivo = ?, egreso_efectivo = ?, ingreso_banco = ?, egreso_banco = ?, ingreso_usd = ?, egreso_usd = ?  WHERE id = ?");

        $result = $query->execute([$fecha, $id_cuenta, $descripcion, $ingreso_efectivo, $egreso_efectivo, $ingreso_banco, $egreso_banco, $ingreso_usd, $egreso_usd, $id]);
        return $result;
    }

    public function getGestionesFiltro($filtros)     {
        $query = "SELECT    
    g.id,
    g.fecha,
    g.id_cuenta,
    g.descripcion,
    g.ingreso_efectivo,
    g.egreso_efectivo,
    g.ingreso_banco,
    g.egreso_banco,
    g.ingreso_usd,
    g.egreso_usd,
    g.saldo_efectivo,
    g.saldo_banco,
    g.saldo_usd,
    c.cuenta AS nombre_cuenta

    FROM gestion g
    LEFT JOIN cuentas c ON g.id_cuenta = c.id
    WHERE 1=1";
        $params = [];

        if (!empty($filtros['fecha'])) {
            $query .= " AND g.fecha = ?";
            $params[] = $filtros['fecha'];
        }
        if (!empty($filtros['id_cuenta'])) {
            $query .= " AND g.id_cuenta = ?";
            $params[] = $filtros['id_cuenta'];
        }

        $query .= " ORDER BY g.fecha ASC";
        $query = $this->db->prepare($query);
        $query->execute($params);

        $gestiones = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $gestiones;
    }



    // CALCULADORES

   public function calcularSaldo($saldoPrevio, $ingreso, $egreso)
{
    return $saldoPrevio + $ingreso - $egreso;
}
}

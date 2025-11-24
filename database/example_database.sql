-- -------------------------------------------------------------
--   Base de datos de ejemplo para el proyecto Gestión de Gastos
--   Base de datos: `julieta_gestion`
--   Versión limpia y segura para uso público
----------------------------------------------------------------

CREATE DATABASE gestion_gastos;
USE gestion_gastos;

-- -------------------------
-- Tabla: meses
-- -------------------------
CREATE TABLE meses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mes VARCHAR(250) NOT NULL
);

INSERT INTO meses (mes) VALUES
('ENERO'), ('FEBRERO'), ('MARZO'), ('ABRIL'), ('MAYO'), ('JUNIO'),
('JULIO'), ('AGOSTO'), ('SEPTIEMBRE'), ('OCTUBRE'), ('NOVIEMBRE'), ('DICIEMBRE');

-- -------------------------
-- Tabla: cuentas
-- -------------------------
CREATE TABLE cuentas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cuenta VARCHAR(250) NOT NULL
);

-- Datos de ejemplo totalmente ficticios (opcionales)
INSERT INTO cuentas (cuenta) VALUES
('EFECTIVO'),
('BANCO'),
('USD'),
('OTROS');

-- -------------------------
-- Tabla: cotizaciones
-- -------------------------
CREATE TABLE cotizaciones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  anio INT NOT NULL,
  id_mes INT NOT NULL,
  cantidad_usd INT NOT NULL,
  cotizacion_usd INT NOT NULL,
  pesos INT DEFAULT NULL,
  descripcion VARCHAR(250) DEFAULT NULL,
  FOREIGN KEY (id_mes) REFERENCES meses(id)
);

-- Datos de ejemplo inventados (opcionales)
INSERT INTO cotizaciones (anio, id_mes, cantidad_usd, cotizacion_usd, pesos, descripcion)
VALUES
  (2024, 1, 100, 800, 80000, 'Ejemplo inicial'),
  (2024, 2, 50, 900, 45000, 'Compra ficticia');

-- -------------------------
-- Tabla: gestion
-- -------------------------
CREATE TABLE gestion (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATE NOT NULL,
  id_cuenta INT NOT NULL,
  descripcion VARCHAR(250) NOT NULL,
  ingreso_efectivo INT DEFAULT NULL,
  egreso_efectivo INT DEFAULT NULL,
  ingreso_banco INT DEFAULT NULL,
  egreso_banco INT DEFAULT NULL,
  ingreso_usd INT DEFAULT NULL,
  egreso_usd INT DEFAULT NULL,
  saldo_efectivo INT DEFAULT NULL,
  saldo_banco INT DEFAULT NULL,
  saldo_usd INT DEFAULT NULL,
  FOREIGN KEY (id_cuenta) REFERENCES cuentas(id)
);

-- Movimiento ficticio de muestra
INSERT INTO gestion (fecha, id_cuenta, descripcion, ingreso_efectivo)
VALUES ('2024-01-01', 1, 'Ingreso de ejemplo', 10000);

-- -------------------------
-- Tabla: usuario
-- -------------------------
CREATE TABLE usuario (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user VARCHAR(250) NOT NULL,
  password VARCHAR(250) NOT NULL
);

-- NOTA: No incluir usuarios reales


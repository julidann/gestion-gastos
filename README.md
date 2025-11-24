#  Gestión de Gastos  
Aplicación web para registrar, consultar y analizar ingresos/egresos en diferentes cuentas (efectivo, banco, USD).  
Permite administrar movimientos, ver saldos, cargar cotizaciones y visualizar datos en tablas y gráficos.

Proyecto desarrollado en **PHP + MySQL**, siguiendo una estructura tipo **MVC**.

---

## Tecnologías usadas
- **PHP **
- **MySQL**
- **HTML5 / CSS3**
- **JavaScript**
- **Chart.js** (para gráficos)
- **Git / GitHub**

---

##  Funcionalidades principales
- Alta, baja y modificación de movimientos (CRUD)
- Gestión de cuentas (efectivo, banco, usd, etc.)
- Registro de cotizaciones mensuales del dolar blue
- Estadísticas y gráficos dinámicos
- Filtros por fecha, tipo de cuenta y descripción
- Login básico de usuario
- Código ordenado siguiendo patrón MVC  

---

##  Estructura del proyecto
gestion-gastos/
├── src/
│ ├── modelo/
│ ├── servicios/
│ └── Main.java
├── sql/
├── README.md
└── resources/

## Cómo usarlo
- Crear una base de datos en phpMyAdmin con el nombre **julieta-gestion**
- Importar el archivo **database_example.sql** incluido en el repositorio (esto crea todas las tablas vacías)
- En la tabla **usuario**, crear manualmente un registro con `user` y `password`
- Recomiendo hashear el password usando `password_hash()` en PHP
- Copiar el archivo **config_example.php** y renombrarlo como **config.php**
- Editar `config.php` con tus credenciales de MySQL
- Colocar el proyecto en tu servidor local (por ejemplo en `htdocs/Julieta`)
- Acceder desde el navegador a:  
  **http://localhost/Julieta/login**
- Y ahí si colocar nombre de usuario y contraseña creadas anteriormente
  
> Nota: el proyecto sigue un patrón tipo MVC.  
> No incluyo usuarios por defecto por razones de seguridad.

## Capturas de pantalla
A continuación algunas vistas del sistema:

- Panel de movimientos
- Formulario de carga
- Gráfico de cotizaciones
- Login

//poner capturas


## Arquitectura
El proyecto sigue un esquema MVC simple:

- **model/** → conexión a base de datos, consultas SQL y modelos.
- **views/** → archivos .phtml con HTML + PHP embebido.
- **controllers/** → reciben rutas, procesan entradas y envían datos a las vistas.
- **router.php** → define las rutas del sistema.





#  Gestión de Gastos  
Aplicación web para registrar, consultar y analizar ingresos/egresos en diferentes cuentas (efectivo, banco, USD).  
Permite administrar movimientos, ver saldos, cargar cotizaciones y visualizar datos en tablas y gráficos.

Proyecto desarrollado en **PHP + MySQL**, siguiendo una estructura tipo **MVC**.

---

## Tecnologías usadas
- **PHP**
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
```
Julieta/
├── app/
│ ├── controllers/
│ ├── middlewares/
│ ├── models/
│ ├── views/
├── config/
├── css/
│── database/
├── js/
├── templates/
│ ├── layouts/
├── .htaccess/
├── README.md
└── router.php/
```

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


## Arquitectura
El proyecto sigue un esquema MVC simple:

- **model/** → conexión a base de datos, consultas SQL y modelos.
- **views/** → archivos .phtml con HTML + PHP embebido.
- **controllers/** → reciben rutas, procesan entradas y envían datos a las vistas.
- **router.php** → define las rutas del sistema.

## Tabla de ruteo

| **Ruta (action)**              | **Método** | **Middleware**                      | **Controller**       | **Acción (método del controller)** |
| ------------------------------ | ---------- | ----------------------------------- | -------------------- | ---------------------------------- |
| `login`                        | GET        | SessionMiddleware                   | AuthController       | showLogin                          |
| `do_login`                     | POST       | SessionMiddleware                   | AuthController       | doLogin                            |
| `logout`                       | GET        | GuardMiddleware + SessionMiddleware | AuthController       | logout                             |
| `home`                         | GET        | GuardMiddleware + SessionMiddleware | HomeController       | showHome                           |
| `tabla-gestion`                | GET        | GuardMiddleware                     | GestionController    | showGestion                        |
| `agregar-gestion`              | GET        | GuardMiddleware                     | GestionController    | showAddFormGestion                 |
| `agregar-gestion`              | POST       | GuardMiddleware                     | GestionController    | insertGestion                      |
| `editar-gestion/{id}`          | GET        | GuardMiddleware                     | GestionController    | showEditFormGestion                |
| `editar-gestion/{id}`          | POST       | GuardMiddleware                     | GestionController    | editGestion                        |
| `eliminar-gestion/{id}`        | GET        | GuardMiddleware                     | GestionController    | deleteGestion                      |
| `buscar-gestiones`             | GET        | GuardMiddleware                     | GestionController    | showFormFiltro                     |
| `filtrar-gestion`              | GET        | GuardMiddleware                     | GestionController    | buscarGestiones                    |
| `tabla-cotizaciones`           | GET        | GuardMiddleware                     | CotizacionController | showCotizaciones                   |
| `agregar-cotizacion`           | GET        | GuardMiddleware                     | CotizacionController | showAddFormCotizacion              |
| `agregar-cotizacion`           | POST       | GuardMiddleware                     | CotizacionController | insertCotizacion                   |
| `editar-cotizacion/{id}`       | GET        | GuardMiddleware                     | CotizacionController | showEditFormCotizacion             |
| `editar-cotizacion/{id}`       | POST       | GuardMiddleware                     | CotizacionController | editCotizacion                     |
| `eliminar-cotizacion/{id}`     | GET        | GuardMiddleware                     | CotizacionController | deleteCotizacion                   |
| *(cualquier ruta no definida)* | -          | -                                   | -                    | 404 Page Not Found                 |








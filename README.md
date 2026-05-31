#  Estética Jazmín

## Sistema Inteligente de Citas para Salón de Belleza — desarrollado con Laravel 11, Breeze, Blade y Tailwind CSS.

**Repositorio:** [github.com/AresGodKiller/Estetica_Web](https://github.com/AresGodKiller/Estetica_Web)  
**Institución:** Instituto Tecnológico de Aguascalientes  
**Materia:** Programación Web  
**Docente:** Yomira del Carmen Rosales Martínez

---

##  Tabla de Contenidos

- [Descripción](#descripción)
- [Stack tecnológico](#stack-tecnológico)
- [Requisitos previos](#requisitos-previos)
- [Instalación](#instalación)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Rutas del sistema](#rutas-del-sistema)
- [Roles y autenticación](#roles-y-autenticación)
- [Funcionalidades](#funcionalidades)
- [Credenciales de prueba](#credenciales-de-prueba)
- [Equipo de desarrollo](#equipo-de-desarrollo)

---

## Descripción

**Estética Jazmín** es una plataforma web de gestión de citas para salones de belleza. Permite a los clientes reservar servicios en línea y a los administradores gestionar su agenda, empleadas, servicios y citas de forma eficiente.

El sistema cuenta con dos paneles diferenciados:

- **Panel del cliente** — reservar, modificar y cancelar citas, consultar el catálogo de servicios.
- **Panel del administrador** — gestión completa de citas, servicios y empleadas, con métricas del día en tiempo real.

---

## Extenciones


| PHP | 8.2+ | Lenguaje principal del backend |
| Laravel | 11.x | Framework MVC |
| Laravel Breeze | — | Autenticación (login, registro, sesiones) |
| Blade | — | Motor de plantillas para las vistas |
| Tailwind CSS | 3.x | Estilos y diseño responsivo |
| MySQL | 8.x | Base de datos relacional |
| Composer | — | Gestor de dependencias PHP |
| Node.js / npm | — | Compilación de assets frontend |
| Vite | — | Bundler de assets |

---

## Requisitos previos

Antes de instalar el proyecto asegúrate de tener lo siguiente:

- PHP 8.2 o superior
- Composer
- Node.js y npm
- MySQL (o MariaDB)
- Git

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/AresGodKiller/Estetica_Web.git
cd Estetica_Web
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

Edita el archivo `.env` con los datos de tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estetica_jazmin
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
```

### 4. Crear la base de datos

```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS estetica_jazmin;"
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

Esto crea todas las tablas y carga datos de prueba (usuarios, servicios, empleadas, horarios y citas).

### 6. Compilar assets y levantar el servidor

```bash
npm run dev
php artisan serve
```

La aplicación estará disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000).


## Rutas del sistema

Todas las rutas están definidas explícitamente en `routes/web.php` para mayor claridad y control.


## Roles y autenticación

El sistema utiliza **Laravel Breeze** para la autenticación y un middleware personalizado para el control de acceso por roles.

### Middleware `EsAdmin`

Ubicado en `app/Http/Middleware/EsAdmin.php`. Verifica que el usuario autenticado tenga el rol de administrador antes de acceder a cualquier ruta bajo `/admin`. Si no tiene permisos, retorna un error **403** con página personalizada.

Registrado en `bootstrap/app.php` bajo el alias `es.admin`.


## Funcionalidades

### Panel del cliente

- **Dashboard** — banner de bienvenida con catálogo de servicios destacados (precio y duración).
- **Catálogo de servicios** — vista completa de servicios activos en tarjetas.
- **Agendar cita** — selección de servicio, estilista disponible, fecha y hora.
- **Mis citas** — historial con estados: `pendiente`, `confirmada`, `completada`, `cancelada`.
- **Modificar cita** — edición de servicio, estilista, fecha y hora.
- **Cancelar cita** — cambio de estado con confirmación.

### Panel del administrador

- **Dashboard con métricas** — citas del día, pendientes, ingresos del día y estilistas activas.
- **Gestión de citas** — listado filtrable por estado; acciones de confirmar, completar y cancelar.
- **Crear cita** — para cliente existente (selección desde lista) o cliente nuevo (se crea automáticamente).
- **Gestión de servicios** — CRUD completo: nombre, descripción, precio, duración y estado activo/inactivo.
- **Gestión de empleadas** — CRUD completo con asignación de los servicios que ofrece cada estilista.

### Páginas de error personalizadas

- `403` — Acceso denegado (usuario sin permisos de admin).
- `404` — Página no encontrada.

---


---

## Equipo de desarrollo

| Nombre | Matrícula | Módulos desarrollados |

| Luis Arturo Cruz Coria     | 23151197 | Layout cliente, dashboard, CRUD servicios (admin) |
| Axel Johab Rodríguez Ortiz | 23151212 | Autenticación (login/registro), middleware `EsAdmin`, rutas |
| Eduardo Cadengo López      | 23151204 | Panel admin, layout admin, editar cita (cliente) |
| Itzel Citlalli Martell De La Cruz | 23151222 | Mis citas (cliente), CRUD empleadas (admin) |
| Damián Alexander Díaz Piña | 23141247 | Agendar cita (cliente), gestión de citas (admin) |


# Proyecto Seguimiento a Empleados (Laravel)

Bienvenido al Proyecto Backend Seguimiento a Empleados. Este proyecto utiliza el framework Laravel, a continuación encontrarás información importante sobre cómo clonar el repositorio, instalar las dependencias.

## 🚀 Clonar el Repositorio

Para clonar este repositorio en tu máquina local, sigue estos pasos:

1. **Clona el repositorio usando Git:**

    ```bash
    git clone https://github.com/jrgeorge89/SeguimientoEmpleados.git
    ```

2. **Navega a la carpeta del proyecto:**

    ```bash
    cd tu-repositorio
    ```

## 🔧 Instalación y Ejecución

Para instalar las dependencias y ejecutar el proyecto, sigue estos pasos:

1. **Instala las dependencias del proyecto:**

    Asegúrate de tener [Composer](https://getcomposer.org/) y [Node.js](https://nodejs.org/) instalados.

    ```bash
    composer install
    ```

2. **Configura el archivo de entorno:**

    Copia el archivo `.env.example` a `.env` y configura las variables de entorno según tu entorno local.

    ```bash
    cp .env.example .env
    ```

3. **Genera la clave de aplicación de Laravel:**

    ```bash
    php artisan key:generate
    ```

4. **Ejecuta las migraciones y los seeder si es necesario:**

    ```bash
    php artisan migrate
    php artisan db:seed
    php artisan db:seed --class=CategorySeeder
    ```

4.1 **Si deseamos refrezcar la BD y Seeder:**

    ```bash
    php artisan migrate:fresh --seed
    ```

5. **Instala las dependencias de frontend y compila los activos:**

    ```bash
    npm install
    npm run dev
    ```

6. **Inicia el servidor de desarrollo:**

    ```bash
    php artisan serve
    ```

   El proyecto estará disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000).

   ! Una vez inicializado el proyecto, puedes probar el proyecto por medio de Postman con los diferentes Endpoint o correr el proyecto del Front que contiene la interfaz para la gestión de Empleados y que consume las API del Backend (Laravel).

## ✅ Ejecución Pruebas TDD

Se implementó las pruebas unitarias automáticas por medio de PHPUnit, para los servicios Crear, Actualizar y Eliminar Empleados, en la carpeta tests\Feature\, sigue estos pasos:

1. **Test employee can be Created**

    ```bash
    php artisan test --without-tty tests\Feature\CreateEmployeeTest.php
    ```

2. **Test employee can be Read**

    ```bash
    php artisan test --without-tty tests\Feature\ReadEmployeeTest.php
    ```

3. **Test employee can be Update**

    ```bash
    php artisan test --without-tty tests\Feature\UpdateEmployeeTest.php
    ```

4. **Test employee can be Delete**

    ```bash
    php artisan test --without-tty tests\Feature\DeleteEmployeeTest.php
    ```    

## ✨ Funcionalidad Implementada

Este proyecto incluye la siguiente funcionalidad: **Pruebas TDD**


**¡Listo! Ahora estás listo para comenzar a revisar el Proyecto. ¡Gracias!** 😊

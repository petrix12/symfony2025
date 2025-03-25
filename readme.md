# Symfony
+ https://symfony.com

## Cursos online gratis
+ https://www.cursosdesarrolloweb.es/course/curso-symfony-6-principiantes
+ https://www.udemy.com/cart/subscribe/course/5852278
+ https://www.youtube.com/playlist?list=PLkVpKYNT_U9fdmk2QgRq0e_NNeommcu3m


## Instalar Symfony CLI
+ Para instalar Symfony CLI seguir los pasos indicados en:
    + https://symfony.com/download
+ En ubuntu:
    ```bash
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
    sudo apt install symfony-cli
    ```
+ Verificar si tenemos instalado los requerimientos de Symfony:
    ```bash
    symfony check:requirements
    ```
+ Ver los camandos de symfony disponibles:
    ```bash
    symfony
    symfony help
    ```

## Algunos aspectos y comandos de utilidad
### Crear proyectos
+ Crear un proyecto normal
    ```bash
    symfony new nombre_del_proyecto
    ```
+ Crear un proyecto con el flag para no instalar git
    ```bash
    symfony new nombre_del_proyecto --no-git
    ```

### Estructura de un proyecto
+ Ejecutar la consola de symfony (**movies/bin/console**):
    ```bash
    php bin/console
    ```
    o
    ```bash
    symfony console
    ```
+ Indicar de se leeran los controladores y se mapearan las rutas:
    ```yml title="movies/config/routes.yaml"
    controllers:
        resource:
            path: ../src/Controller/
            namespace: App\Controller
        type: attribute
    ```
    + Esta línea indica en donde se gestionarán los controladores:
        ```yml
        path: ../src/Controller/
        ```
    + Esta línea indica que las rutas se mapearan a traves de atributos:
        ```yml
        type: attribute
        ```
+ Punto de entrada a la aplicación:
    + movies/public/index.php
+ Rutas disponibles:
    ```bash
    symfony console debug:router
    ```
+ Versión de symfony:
    ```bash
    php bin/console about
    ```
    o 
    ```bash
    symfony console about
    ```

### Ejecución
+ Ejecutar proyecto:
    ```bash
    symfony serve -d
    ```
+ Para proyecto:
    ```bash
    symfony serve:stop
    ```

### Controladores
+ Dependencia MakerBundle:
    + https://symfony.com/bundles/SymfonyMakerBundle/current/index.html
+ Lista de comandos relacionados con make:
    ```bash
    symfony console list make
    ```
+ Crear un controlador
    ```bash
    symfony console make:controller
    ```

### Doctrine
+ Instalar el ORM Doctrine:
    ```bash
    composer require doctrine
    ```
    o
    ```bash
    composer require orm
    ```
+ Ver los comandos disponibles para trabajar con Doctrine:
    ```bash
    symfony console list doctrine
    ```


## Ejemplo de un proyecto con un CRUD
1. Creación:
    ```bash
    symfony new movies --no-git
    ```
2. Instalar dependencia maker:
    ```bash
    composer require --dev maker
    ```
3. Crear el controlador **MoviesController**
    ```bash
    symfony console make:controller
    ```
    + name: MoviesController
4. Instalar el ORM Doctrine
    ```bash
    composer require orm
    ```
    + Do you want to include Docker configuration from recipes?: No
    :::tip Modificaciones importantes en el proyecto
    + Creación de las carpetas 
        + **movies/migrations**.
        + **movies/src/Entity**.
        + **movies/src/Repository**.
    + Creación del packages **movies/config/packages/doctrine_migrations.yaml**.
    + Modificación del archivo **.env**:
        ```env
        # ...
        ###> doctrine/doctrine-bundle ###
        # Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
        # IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
        #
        # DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
        # DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
        # DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
        DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
        ###< doctrine/doctrine-bundle ###        
        ```
    :::
5. Configuración de la cadena de conexión a la base de datos en **.env**:
    ```env title="movies/.env"
    # ...
    DATABASE_URL="mysql://user:password@127.0.0.1:3306/base_de_datos?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
    # DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
    # ...
    ```
6. Crear base de datos:
    ```bash
    symfony console doctrine:database:create
    ```
    o
    ```bash
    symfony console d:d:c
    ```



## Primeros pasos en Symfony
+ ✔️ Proyecto final
+ ✔️ ¿Qué vamos a hacer?
+ ✔️ Instalar Symfony CLI y comprobar requerimientos
+ ✔️ Crear nuestro primer proyecto Symfony
+ ✔️ Conociendo la línea de comandos de Symfony
+ ✔️ Servidor de desarrollo local
## Preparando nuestro proyecto
+ ✔️ Instalar Symfony Maker Bundle
+ ✔️ Creando nuestro primer controlador 
+ ✔️ Instalar ORM Pack, añadiendo Doctrine a nuestro proyecto
+ ✔️ Crear nuestra base de datos con Symfony CLI
+ Crear nuestra entidad Movie con todos sus atributos
+ Crear y ejecutar las migraciones para generar nuestra base de datos
+ Añadiendo las entidades Genre y Country
+ Relacionar las entidades Genre y Country con la entidad Movie
+ Fixtures, generando datos ficticios para nuestro entorno de desarrollo
+ Instalar y configurar TailwindCSS
+ Instalar Twig, el motor de vistas de Symfony
## Listando las películas de la aplicación
+ Obtener las películas con Doctrine
+ Desarrollar el listado de películas con Twig
+ Refactorizar con parciales
+ Instalar paquete iconos FontAwesome
## Detalle película
+ Obtener una película con Doctrine
+ Detalle de una película con Twig
+ Añadir navegación superior a nuestro layout
## Alta y edición de películas
+ Formulario para la entidad Movie
+ Método create para representar el formulario de alta de películas
+ Estilizar formulario películas con TailwindCSS
+ Procesar el formulario de alta de películas
+ Formulario para editar películas y actualización de datos
+ Validar nuestro formulario en modo alta y edición
## Eliminar películas
+ La forma incorrecta de eliminar datos
+ La forma correcta de eliminar datos
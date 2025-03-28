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

### Maker Bundle
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
    + name: NombreControladorController
+ Crear una entidad:
    ```bash
    symfony console make:entity
    ```
    + name: NombreEntidad   (Siempre en singular y en camelcase)
    + Definir los nombres de los campos y sus tipos.
    + Esta acción crea los siguientes archivos:
        + movies/src/Entity/NombreEntidad.php
        + movies/src/Repository/NombreEntidadRepository.php
+ Ejecutar migraciones:
    ```bash
    symfony console make:migration
    ```
    + Este comando crea un archivo (VersionYYYYMMDDHHMMSS.php) de migración en **movies/migrations**.


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
+ Obtener versión de Doctrine:
    ```bash
    composer show doctrine/orm | grep versions
    ```
+ Obtener versión de MySQL del servico que esta corriendo:
    ```bash
    mysql -h 127.0.0.1 -P 5306 -u root -p -e "SELECT VERSION();"
    ```
    + **Nota**: si es necesario ajusta los valores de:
        + host: 127.0.0.1
        + puerto: 5306
        + usuario: root

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
    DATABASE_URL="mysql://user:password@127.0.0.1:3306/symfony_movies_app?serverVersion=8.0.41&charset=utf8mb4
    # DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
    # ...
    ```
    :::tip Nota
    Pendiente de configurar correctamente la cadena de conexión:
        + Usuario: user (en muchos casos root)
        + Password: password
        + Host: 127.0.0.1
        + Puerto: 3306
        + Base de datos: symfony_movies_app
        + Versión de la base de datos: 8.0.41   (muy importante)
        + Juego de caracteres: utf8mb4
    :::
6. Crear base de datos:
    ```bash
    symfony console doctrine:database:create
    ```
    o
    ```bash
    symfony console d:d:c
    ```
7. Crear entidad movie:
    ```bash
    symfony console make:entity
    ```
    + name: Movie
    + Definir los nombres de los campos y sus tipos:
        + nombre: title | tipo: string | longitud: 120 | nullable: no
        + nombre: description | tipo: string | longitud: 2000 | nullable: no
        + nombre: runtime | tipo: integer | nullable: no
        + nombre: budget | tipo: integer | nullable: no
        + nombre: poster | tipo: string | longitud: 250 | nullable: no
        + nombre: release_date | tipo: date | nullable: no
8. Ejecutar migraciones:
    ```bash
    symfony console make:migration
    ```
    + Archivo de migración creado: **movies/migrations/Version20250325123839.php**.
9. Modificar archivo de migración:
    ```php
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
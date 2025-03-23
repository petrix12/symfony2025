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

## Crear un proyecto
+ Crear un proyecto normal
    ```bash
    symfony new nombre_del_proyecto
    ```
+ Crear un proyecto con el flag para no instalar git
    ```bash
    symfony new nombre_del_proyecto --no-git
    ```

+ Ejecutar la consola de symfony (**movies/bin/console**):
    ```bash
    php bin/console
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
    symfony console about
    ```
+ Ejecutar proyecto:
    ```bash
    symfony serve -d
    ```
+ Para proyecto:
    ```bash
    symfony serve:stop
    ```


## Ejemplo de un proyecto con un CRUD
1. Creación:
    ```bash
    symfony new movies --no-git
    ```



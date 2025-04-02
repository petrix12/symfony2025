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
+ Ejecutar migraciones:
    ```bash
    symfony console doctrine:migrations:migrate
    ```
+ Ver estatus de las migraciones:
    ```bash
    symfony console doctrine:migrations:status
    ```
+ Deshacer la última migración:
    ```bash
    symfony console doctrine:migrations:migrate prev
    ```
+ Rehacer la última migración deshecha:
    ```bash
    symfony console doctrine:migrations:migrate next
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
8. Crear migraciones:
    ```bash
    symfony console make:migration
    ```
    + Archivo de migración creado: **movies/migrations/Version20250325123839.php**.
9. Modificar archivo de migración:
    ```php title="movies/migrations/Version20250325123839.php"
    // ...
    public function getDescription(): string
    {
        return 'Creates the movies table';
    }
    // ...
    ```
10. Ejecutar migraciones:
    ```bash
    symfony console doctrine:migrations:migrate
    ```
11. Crear entidad genero:
    ```bash
    symfony console make:entity Genre
    ```
    + Definir los nombres de los campos y sus tipos:
        + nombre: name | tipo: string | longitud: 120 | nullable: no
12. Crear entidad país:
    ```bash
    symfony console make:entity Country
    ```
    + Definir los nombres de los campos y sus tipos:
        + nombre: name | tipo: string | longitud: 100 | nullable: no
13. Crear migraciones:
    ```bash
    symfony console make:migration
    ```
    + Archivo de migración creado: **movies/migrations/Version20250402145639.php**.
14. Ejecutar migraciones:
    ```bash
    symfony console doctrine:migrations:migrate
    ```
15. Establecer relaciones:
    ```bash
    symfony console make:entity
    ```
    + Class name of the entity to create or update (e.g. TinyPuppy): Movie
    + **AQUÍ ESTABLECEMOS LA RELACIÓN CON GENERO**
    + New property name (press <return> to stop adding fields): genre
    + Field type (enter ? to see all types) [string]: relation
    + What class should this entity be related to?: Genre
    + Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]: ManyToOne
    + Is the Movie.genre property allowed to be null (nullable)? (yes/no) [yes]: no
    + Do you want to add a new property to Genre so that you can access/update Movie objects from it - e.g. $genre->getMovies()? (yes/no) [yes]: yes (Es para poder acceder a movies desde genero)
    + New field name inside Genre [movies]: ENTER (para que se llame movies)
    + Do you want to automatically delete orphaned App\Entity\Movie objects (orphanRemoval)? (yes/no) [no]: ENTER
    + **AQUÍ ESTABLECEMOS LA RELACIÓN CON PAÍS**
    + Add another property? Enter the property name (or press <return> to stop adding fields): country
    + Field type (enter ? to see all types) [string]: relation
    + What class should this entity be related to?: Country
    + Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]: ManyToOne
    + Is the Movie.country property allowed to be null (nullable)? (yes/no) [yes]: no
    + Do you want to add a new property to Country so that you can access/update Movie objects from it - e.g. $country->getMovies()? (yes/no) [yes]: ENTER
    + New field name inside Country [movies]: ENTER
    + Do you want to automatically delete orphaned App\Entity\Movie objects (orphanRemoval)? (yes/no) [no]: ENTER
    + Add another property? Enter the property name (or press <return> to stop adding fields): ENTER
16. Crear migraciones:
    ```bash
    symfony console make:migration
    ```
    + Archivo de migración creado: **movies/migrations/Version20250402152232.php**.
17. Ejecutar migraciones:
    ```bash
    symfony console doctrine:migrations:migrate
    ```
18. Instalar la dependencia ORM Fixtures
    ```bash
    composer require --dev ormfixtures
    ```
    + **Nota**: esto creara el fixture **movies/src/DataFixtures/AppFixtures.php**.
19. Crear fixture para los generos:
    ```bash
    symfony console make:fixtures
    ```
    + The class name of the fixtures to create (e.g. AppFixtures): GenreFixtures
20. Definir generos, editando **movies/src/DataFixtures/GenreFixtures.php**:
    ```php title="movies/src/DataFixtures/GenreFixtures.php"
    // ...
    use App\Entity\Genre;
    // ...

    class GenreFixtures extends Fixture
    {
        public function load(ObjectManager $manager): void
        {
            $genre1 = new Genre();
            $genre1->setName('Action');
            $manager->persist($genre1);

            $genre2 = new Genre();
            $genre2->setName('Adventure');
            $manager->persist($genre2);

            $genre3 = new Genre();
            $genre3->setName('Animation');
            $manager->persist($genre3);

            $genre4 = new Genre();
            $genre4->setName('Horror');
            $manager->persist($genre4);
            
            $genre5 = new Genre();
            $genre5->setName('Comedy');
            $manager->persist($genre5);

            $genre6 = new Genre();
            $genre6->setName('Crime');
            $manager->persist($genre6);

            $manager->flush();

            $this->addReference('genre1', $genre1);
            $this->addReference('genre2', $genre2);
            $this->addReference('genre3', $genre3);
            $this->addReference('genre4', $genre4);
            $this->addReference('genre5', $genre5);
            $this->addReference('genre6', $genre6);
        }
    }    
    ```
21. Crear fixture para los paises:
    ```bash
    symfony console make:fixtures
    ```
    + The class name of the fixtures to create (e.g. AppFixtures): CountryFixtures
22. Definir generos, editando **movies/src/DataFixtures/CountryFixtures.php**:
    ```php title="movies/src/DataFixtures/CountryFixtures.php"
    // ...
    use App\Entity\Country;
    // ...

    class CountryFixtures extends Fixture
    {
        public function load(ObjectManager $manager): void
        {
            $country1 = new Country();
            $country1->setName('USA');
            $manager->persist($country1);

            $country2 = new Country();
            $country2->setName('Canada');
            $manager->persist($country2);
            
            $country3 = new Country();
            $country3->setName('Mexico');
            $manager->persist($country3);
            
            $country4 = new Country();
            $country4->setName('France');
            $manager->persist($country4);
            
            $country5 = new Country();
            $country5->setName('Germany');
            $manager->persist($country5);
            
            $country6 = new Country();
            $country6->setName('Italy');
            $manager->persist($country6);
            
            $country7 = new Country();
            $country7->setName('Spain');
            $manager->persist($country7);

            $manager->flush();

            $this->addReference('country1', $country1);
            $this->addReference('country2', $country2);
            $this->addReference('country3', $country3);
            $this->addReference('country4', $country4);
            $this->addReference('country5', $country5);
            $this->addReference('country6', $country6);
            $this->addReference('country7', $country7);
        }
    }
    ```
23. Crear fixture para los películas:
    ```bash
    symfony console make:fixtures
    ```
    + The class name of the fixtures to create (e.g. AppFixtures): MovieFixtures
22. Definir generos, editando **movies/src/DataFixtures/MovieFixtures.php**:
    ```php title="movies/src/DataFixtures/MovieFixtures.php"
    //...
    use App\Entity\Country;
    use App\Entity\Genre;
    use App\Entity\Movie;
    //...

    class MovieFixtures extends Fixture
    {
        public function load(ObjectManager $manager): void
        {
            $movie1 = new Movie();
            $movie1->setTitle("El Señor de Los Anillos");
            $movie1->setCountry($this->getReference('country1', Country::class));
            $movie1->setGenre($this->getReference('genre1', Genre::class));
            $movie1->setBudget(93000000);
            $movie1->setReleaseDate(new \DateTime('2001-12-19'));
            $movie1->setDescription("Un hobbit, Frodo Bolsón, emprende un viaje épico con la Compañía del Anillo para destruir el Anillo Único y derrotar al Señor Oscuro Sauron en la Tierra Media.");
            $movie1->setRuntime(178);
            $movie1->setPoster('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/LotR21.png/250px-LotR21.png');
            $manager->persist($movie1);

            $movie2 = new Movie();
            $movie2->setTitle("La Guerra de las galaxias");
            $movie2->setCountry($this->getReference('country1', Country::class));
            $movie2->setGenre($this->getReference('genre1', Genre::class));
            $movie2->setBudget(93000000);
            $movie2->setReleaseDate(new \DateTime('2001-12-19'));
            $movie2->setDescription("Un hobbit, Frodo Bolsón, emprende un viaje épico con la Compañía del Anillo para destruir el Anillo Único y derrotar al Señor Oscuro Sauron en la Tierra Media.");
            $movie2->setRuntime(178);
            $movie2->setPoster('https://es.wikipedia.org/wiki/Archivo:Star_Wars_Logo.svg');
            $manager->persist($movie2);
            
            $movie3 = new Movie();
            $movie3->setTitle("La vida es bella");
            $movie3->setCountry($this->getReference('country1', Country::class));
            $movie3->setGenre($this->getReference('genre1', Genre::class));
            $movie3->setBudget(93000000);
            $movie3->setReleaseDate(new \DateTime('2001-12-19'));
            $movie3->setDescription("Un hobbit, Frodo Bolsón, emprende un viaje épico con la Compañía del Anillo para destruir el Anillo Único y derrotar al Señor Oscuro Sauron en la Tierra Media.");
            $movie3->setRuntime(178);
            $movie3->setPoster('https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Arezzo_01.JPG/960px-Arezzo_01.JPG');
            $manager->persist($movie3);
            
            $movie4 = new Movie();
            $movie4->setTitle("The Matrix");
            $movie4->setCountry($this->getReference('country1', Country::class));
            $movie4->setGenre($this->getReference('genre1', Genre::class));
            $movie4->setBudget(93000000);
            $movie4->setReleaseDate(new \DateTime('2001-12-19'));
            $movie4->setDescription("Un hobbit, Frodo Bolsón, emprende un viaje épico con la Compañía del Anillo para destruir el Anillo Único y derrotar al Señor Oscuro Sauron en la Tierra Media.");
            $movie4->setRuntime(178);
            $movie4->setPoster('https://upload.wikimedia.org/wikipedia/commons/9/9b/The.Matrix.glmatrix.2.png');
            $manager->persist($movie4);
            
            $movie5 = new Movie();
            $movie5->setTitle("Saving Private Ryan");
            $movie5->setCountry($this->getReference('country1', Country::class));
            $movie5->setGenre($this->getReference('genre1', Genre::class));
            $movie5->setBudget(93000000);
            $movie5->setReleaseDate(new \DateTime('2001-12-19'));
            $movie5->setDescription("Un hobbit, Frodo Bolsón, emprende un viaje épico con la Compañía del Anillo para destruir el Anillo Único y derrotar al Señor Oscuro Sauron en la Tierra Media.");
            $movie5->setRuntime(178);
            $movie5->setPoster('https://upload.wikimedia.org/wikipedia/en/thumb/a/ac/Saving_Private_Ryan_poster.jpg/220px-Saving_Private_Ryan_poster.jpg');
            $manager->persist($movie5);
            
            $movie6 = new Movie();
            $movie6->setTitle("Les Miserables");
            $movie6->setCountry($this->getReference('country1', Country::class));
            $movie6->setGenre($this->getReference('genre1', Genre::class));
            $movie6->setBudget(93000000);
            $movie6->setReleaseDate(new \DateTime('1935-12-19'));
            $movie6->setDescription("Un hobbit, Frodo Bolsón, emprende un viaje épico con la Compañía del Anillo para destruir el Anillo Único y derrotar al Señor Oscuro Sauron en la Tierra Media.");
            $movie6->setRuntime(178);
            $movie6->setPoster('https://es.wikipedia.org/wiki/Archivo:Les-Miserables-1935.jpg');
            $manager->persist($movie6);        

            $manager->flush();
        }
    }    
    ```
23. Purgar base de datos y cargar las fixtures:
    ```bash
    symfony console doctrine:fixtures:load
    ```
    + **Nota 1**: si queremos reestablecer los identificadores
        ```bash
        symfony console doctrine:fixtures:load --purge-with-truncate
        ```
    + **Nota 2**: si el comando anterior no funciona, podemos ejecutar:
        ```bash
        symfony console doctrine:schema:drop --force \
            && symfony console doctrine:schema:update --force \
            && symfony console doctrine:fixture:load -n
        ```
24. Instalar las dependencias de **Twig**:
    ```bash
    composer require twig
    ```        
25. Instalar Tailwind CSS:
    + URL: https://tailwindcss.com/docs/installation/framework-guides/symfony
    + Ejecutar:
        ```bash
        composer remove symfony/ux-turbo symfony/asset-mapper symfony/stimulus-bundle
        composer require symfony/webpack-encore-bundle symfony/ux-turbo symfony/stimulus-bundle
        ```
26. Instalar dependencias de Tailwind CSS:
    ```bash
    npm install tailwindcss @tailwindcss/postcss postcss postcss-loader
    ```
27. Modificar **webpack.config.js** para habilitar la compatibilidad con PostCSS:
    ```js title="movies/webpack.config.js"
    // ...
    Encore
        .enablePostCssLoader()
        // ...
    ;
    ```
28. Modificar **movies/assets/styles/app.css** para importar CSS de Tailwind:
    ```css title="movies/assets/styles/app.css"
    @import "tailwindcss";
    /* ... */
    ```
29. Crear **postcss.config.mjs** para configurar complementos PostCSS:
    ```mjs
    export default {
        plugins: {
            "@tailwindcss/postcss": {},
        },
    };
    ```
30. Incluir Tailwind CSS en la plantilla base:
    ```twig title="movies/templates/base.html.twig"
    <!-- ... -->
    {% block stylesheets %}
        {{ encore_entry_link_tags('app') }}
    {% endblock %}
    <!-- ... -->
    ```
31. Ejecutar:
    ```bash
    npm run watch
    ```
32. Crear vista **movies/templates/movies/index.html.twig**:
    ```twig
    ```
33. Modificar controlador **movies/src/Controller/MoviesController.php**:
    ```php
    // ...
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Attribute\Route;

    final class MoviesController extends AbstractController
    {
        #[Route('/movies', name: 'app_movies')]
        public function index(): Response
        {
            return $this->render('movies/index.html.twig');
        }
    }    
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
+ ✔️ Crear nuestra entidad Movie con todos sus atributos
+ ✔️ Crear y ejecutar las migraciones para generar nuestra base de datos
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
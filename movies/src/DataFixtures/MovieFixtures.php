<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

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

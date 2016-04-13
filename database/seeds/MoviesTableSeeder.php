<?php

use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie = App\Movie::create(['title' => 'Drive', 'country' => 'United States', 'release_date' => '1945-01-01', 'genre' => 'Action', 'parental_rating' => 'R', 'runtime' => 90, 'synopsis' => "A mysterious Hollywood stuntman and mechanic moonlights as a getaway driver and finds himself trouble when he helps out his neighbor."]);
        $this->addToAlbum('drive.jpg', $movie->album()->first(), true, 'Drive Poster');

        $movie = App\Movie::create(['title' => 'Twins', 'country' => 'United States', 'release_date' => '2009-01-01', 'genre' => 'Comedy', 'parental_rating' => 'G', 'runtime' => 121, 'synopsis' => "A physically perfect but innocent man goes in search of his long-lost twin brother, who is a short small-time crook."]);
        $this->addToAlbum('twins.jpg', $movie->album()->first(), true, 'Twins Poster');

        $movie = App\Movie::create(['title' => 'Rocky', 'country' => 'United States', 'release_date' => '1979-01-01', 'genre' => 'Crime', 'parental_rating' => 'PG', 'runtime' => 140, 'synopsis' => "Rocky Balboa, a small-time boxer, gets a supremely rare chance to fight the heavy-weight champion, Apollo Creed, in a bout in which he strives to go the distance for his self-respect."]);
        $this->addToAlbum('rocky.jpg', $movie->album()->first(), true, 'Rocky Poster');

        $movie = App\Movie::create(['title' => 'The Hunt for Red October', 'country' => 'Russia', 'release_date' => '1992-01-01', 'genre' => 'Western', 'parental_rating' => 'NC-17', 'runtime' => 113, 'synopsis' => "In November 1984, the Soviet Union's best submarine captain in their newest sub violates orders and heads for the USA. Is he trying to defect or to start a war?"]);
        $this->addToAlbum('the_hunt_for_red_october.jpg', $movie->album()->first(), true, 'The Hunt for Red October Poster');

        $movie = App\Movie::create(['title' => 'Antman', 'country' => 'Brazil', 'release_date' => '1988-01-01', 'genre' => 'Action', 'parental_rating' => 'PG-13', 'runtime' => 102, 'synopsis' => "Armed with a super-suit with the astonishing ability to shrink in scale but increase in strength, cat burglar Scott Lang must embrace his inner hero and help his mentor, Dr. Hank Pym, plan and pull off a heist that will save the world."]);
        $this->addToAlbum('antman.jpg', $movie->album()->first(), true, 'Antman Poster');

        $movie = App\Movie::create(['title' => 'The Terminator', 'country' => 'Uruguay', 'release_date' => '2013-01-01', 'genre' => 'Romance', 'parental_rating' => 'R', 'runtime' => 98, 'synopsis' => "A human-looking indestructible cyborg is sent from 2029 to 1984 to assassinate a waitress, whose unborn son will lead humanity in a war against the machines, while a soldier from that war is sent to protect her at all costs"]);
        $this->addToAlbum('the_terminator.jpg', $movie->album()->first(), true, 'The Terminator Poster');

        $movie = App\Movie::create(['title' => 'Terminator 2: Judgement Day', 'country' => 'Spain', 'release_date' => '2000-01-01', 'genre' => 'Sci-Fi', 'parental_rating' => 'G', 'runtime' => 80, 'synopsis' => "A cyborg, identical to the one who failed to kill Sarah Connor, must now protect her young son, John Connor, from a more advanced cyborg, made out of liquid metal."]);
        $album = $movie->album()->first();
        $this->addToAlbum('terminator_2_judgement_day.jpg', $album, true, 'T2 Poster');
        $this->addToAlbum('t2/1.jpg', $album, false, 'Arnold Schwarzenneger as The Terminator');
        $this->addToAlbum('t2/2.jpg', $album, false, 'Linda Carter as Sarah Connor and Edward Furlong as John Connor');
        $this->addToAlbum('t2/3.jpg', $album, false, 'Robert Patrick as T-1000');
        $this->addToAlbum('t2/4.jpg', $album, false, 'Still of Linda Hamilton in Terminator 2: Judgment Day (1991)');
        $this->addToAlbum('t2/5.jpg', $album, false, 'Still of Edward Furlong in Terminator 2: Judgment Day (1991)');
        $this->addToAlbum('t2/6.jpg', $album, false, 'Still of Linda Hamilton, Arnold Schwarzenegger and Joe Morton in Terminator 2: Judgment Day (1991)');
        $this->addToAlbum('t2/7.jpg', $album, false, 'Still of Linda Hamilton, Arnold Schwarzenegger and Edward Furlong in Terminator 2: Judgment Day (1991)');
        $this->addToAlbum('t2/8.jpg', $album, false, 'Still of Arnold Schwarzenegger in Terminator 2: Judgment Day (1991)');
        $this->addToAlbum('t2/9.jpg', $album, false, 'Still of Arnold Schwarzenegger and Edward Furlong in Terminator 2: Judgment Day (1991)');
        $this->addToAlbum('t2/10.jpg', $album, false, 'Robert Patrick in Terminator 2: Judgment Day (1991)');

        $movie = App\Movie::create(['title' => 'Star Wars Episode IV: A New Hope', 'country' => 'France', 'release_date' => '1993-01-01', 'genre' => 'Animation', 'parental_rating' => 'PG', 'runtime' => 120, 'synopsis' => "Luke Skywalker joins forces with a Jedi Knight, a cocky pilot, a wookiee and two droids to save the galaxy from the Empire's world-destroying battle-station, while also attempting to rescue Princess Leia from the evil Darth Vader."]);
        $this->addToAlbum('star_wars_episode_iv_a_new_hope.jpg', $movie->album()->first(), true, 'A New Hope Poster');

        $movie = App\Movie::create(['title' => 'Star Wars Episode V: The Empire Strikes Back', 'country' => 'Germany', 'release_date' => '1988-01-01', 'genre' => 'War', 'parental_rating' => 'R', 'runtime' => 108, 'synopsis' => "After the rebels have been brutally overpowered by the Empire on their newly established base, Luke Skywalker takes advanced Jedi training with Master Yoda, while his friends are pursued by Darth Vader as part of his plan to capture Luke."]);
        $this->addToAlbum('star_wars_episode_v_the_empire_strikes_back.jpg', $movie->album()->first(), true, 'The Empire Strikes Back Poster');

        $movie = App\Movie::create(['title' => 'Star Wars Episode VI: Return of the Jedi', 'country' => 'China', 'release_date' => '2004-01-01', 'genre' => 'Crime', 'parental_rating' => 'G', 'runtime' => 114, 'synopsis' => "After rescuing Han Solo from the palace of Jabba the Hutt, the rebels attempt to destroy the second Death Star, while Luke struggles to make Vader return from the dark side of the Force."]);
        $this->addToAlbum('star_wars_episode_vi_return_of_the_jedi.jpg', $movie->album()->first(), true, 'Return of the Jedi Poster');

        $movie = App\Movie::create(['title' => 'The Lord of the Rings: The Fellowship of the Ring', 'country' => 'Japan', 'release_date' => '1969-01-01', 'genre' => 'Action', 'parental_rating' => 'PG-13', 'runtime' => 116, 'synopsis' => "A meek Hobbit and eight companions set out on a journey to destroy the One Ring and the Dark Lord Sauron."]);
        $album = $movie->album()->first();
        $this->addToAlbum('the_lord_of_the_rings_the_fellowship_of_the_ring.jpg', $album, true, 'Fellowship of the Ring Poster');
        $this->addToAlbum('fellowship/1.jpg', $album, false, 'Still of Sean Bean, Viggo Mortensen, Orlando Bloom and Craig Parker in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/2.jpg', $album, false, 'Still of Sean Astin, Sean Bean, Elijah Wood, Viggo Mortensen, Ian McKellen, Orlando Bloom, Billy Boyd, Dominic Monaghan, John Rhys-Davies and Hugo Weaving in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/3.jpg', $album, false, 'Still of Viggo Mortensen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/4.jpg', $album, false, 'Still of Liv Tyler in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/5.jpg', $album, false, 'Still of Elijah Wood in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/6.jpg', $album, false, 'Still of Sean Astin in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/7.jpg', $album, false, 'Still of Ian Holm in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/8.jpg', $album, false, 'Still of Hugo Weaving in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/9.jpg', $album, false, 'Still of Cate Blanchett in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/10.jpg', $album, false, 'Still of Dominic Monaghan in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/11.jpg', $album, false, 'Still of Elijah Wood and Ian McKellen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/12.jpg', $album, false, 'Still of Billy Boyd in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/13.jpg', $album, false, 'Still of Liv Tyler in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/14.jpg', $album, false, 'Still of Orlando Bloom in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/15.jpg', $album, false, 'Still of Ian McKellen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/16.jpg', $album, false, 'Still of Hugo Weaving in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/17.jpg', $album, false, 'Still of Sean Astin and Elijah Wood in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/18.jpg', $album, false, 'Still of Christopher Lee in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/19.jpg', $album, false, 'Still of Viggo Mortensen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/20.jpg', $album, false, 'The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/21.jpg', $album, false, 'Still of Sean Bean in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/22.jpg', $album, false, 'Still of Liv Tyler in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/23.jpg', $album, false, 'Still of Elijah Wood and Cate Blanchett in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/24.jpg', $album, false, 'Still of Cate Blanchett in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/25.jpg', $album, false, 'Still of Lawrence Makoare in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/26.jpg', $album, false, 'Still of Orlando Bloom in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/27.jpg', $album, false, 'The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/28.jpg', $album, false, 'Still of Viggo Mortensen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/29.jpg', $album, false, 'Still of Peter Jackson in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/30.jpg', $album, false, 'Still of Liv Tyler and Viggo Mortensen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/31.jpg', $album, false, 'Still of Elijah Wood in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/32.jpg', $album, false, 'The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/33.jpg', $album, false, 'Still of John Rhys-Davies in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/34.jpg', $album, false, 'Still of Ian McKellen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/35.jpg', $album, false, 'Still of Christopher Lee in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/36.jpg', $album, false, 'Still of Elijah Wood in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/37.jpg', $album, false, 'Still of Sean Astin, Elijah Wood, Billy Boyd and Dominic Monaghan in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/38.jpg', $album, false, 'Still of Ian McKellen in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/39.jpg', $album, false, 'Still of Sean Bean in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/39.jpg', $album, false, 'Still of Sean Bean in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/40.jpg', $album, false, 'Sala Baker as Sauron in The Lord of the Rings: The Fellowship of the Ring');
        $this->addToAlbum('fellowship/41.jpg', $album, false, 'Peter Jackson and Howard Shore in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/42.jpg', $album, false, 'Peter Jackson in The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/43.jpg', $album, false, 'Billy Boyd at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/44.jpg', $album, false, 'Dominic Monaghan at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/45.jpg', $album, false, 'Elijah Wood at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/46.jpg', $album, false, 'John Rhys-Davies at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/47.jpg', $album, false, 'Liv Tyler at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/48.jpg', $album, false, 'Orlando Bloom at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/49.jpg', $album, false, 'Peter Jackson at event of The Lord of the Rings: The Fellowship of the Ring (2001)');
        $this->addToAlbum('fellowship/50.jpg', $album, false, 'Sean Astin at event of The Lord of the Rings: The Fellowship of the Ring (2001)');

        $movie = App\Movie::create(['title' => 'The Lord of the Rings: The Two Towers', 'country' => 'Australia', 'release_date' => '1972-01-01', 'genre' => 'Biography', 'parental_rating' => 'R', 'runtime' => 128, 'synopsis' => "While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron's new ally, Saruman, and his hordes of Isengard."]);
        $this->addToAlbum('the_lord_of_the_rings_the_two_towers.jpg', $movie->album()->first(), true, 'The Two Towers Poster');

        $movie = App\Movie::create(['title' => 'The Lord of the Rings: The Return of the King', 'country' => 'Argentina', 'release_date' => '1999-01-01', 'genre' => 'Adventure', 'parental_rating' => 'PG-13', 'runtime' => 96, 'synopsis' => "Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring."]);
        $this->addToAlbum('the_lord_of_the_rings_the_return_of_the_king.jpg', $movie->album()->first(), true, 'The Return of the King Poster');

        $movie = App\Movie::create(['title' => 'The Martian', 'country' => 'Iran', 'release_date' => '2014-01-01', 'genre' => 'Horror', 'parental_rating' => 'R', 'runtime' => 130, 'synopsis' => "During a manned mission to Mars, Astronaut Mark Watney is presumed dead after a fierce storm and left behind by his crew. But Watney has survived and finds himself stranded and alone on the hostile planet. With only meager supplies, he must draw upon his ingenuity, wit and spirit to subsist and find a way to signal to Earth that he is alive."]);
        $this->addToAlbum('the_martian.jpg', $movie->album()->first(), true, 'The Martian Poster');

        $movie = App\Movie::create(['title' => 'The Sword in the Stone', 'country' => 'Egypt', 'release_date' => '2011-01-01', 'genre' => 'Animation', 'parental_rating' => 'G', 'runtime' => 98, 'synopsis' => "The wizard Merlin teaches a young boy who is destined to be King Arthur."]);
        $this->addToAlbum('the_sword_in_the_stone.jpg', $movie->album()->first(), true, 'The Sword in the Stone Poster');

        $movie = App\Movie::create(['title' => 'The Lion King', 'country' => 'Kenya', 'release_date' => '1994-01-01', 'genre' => 'Animation', 'parental_rating' => 'G', 'runtime' => 104, 'synopsis' => "Lion cub and future king Simba searches for his identity. His eagerness to please others and penchant for testing his boundaries sometimes gets him into trouble."]);

        $movie = App\Movie::create(['title' => 'The Last King of Scotland', 'country' => 'United Kingdom', 'release_date' => '2006-09-13', 'genre' => 'Drama', 'parental_rating' => 'R', 'runtime' => 123, 'synopsis' => "Based on the events of the brutal Ugandan dictator Idi Amin's regime as seen by his personal physician during the 1970s."]);
    }

    private function addToAlbum($filename, $album, $default, $description)
    {
        $path = database_path() . '/seeds/images/' . $filename;
        $imgfile = new UploadedFile($path, 'placeholder.jpg', mime_content_type($path), filesize($path));
        $image = ImageSync::create($imgfile, $description);
        $album->addImage($image);
        if ($default)
            $album->changeDefault($image);
    }
}

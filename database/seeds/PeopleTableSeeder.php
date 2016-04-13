<?php

use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = App\Person::create(['first_name' => 'Arnold', 'middle_name' => 'Alois', 'last_name' => 'Schwarzenneger', 'first_alias' => null, 'middle_alias' => null, 'last_alias' => null, 'country_of_origin' => 'Austria', 'date_of_birth' => '1947-07-03', 'date_of_death' => null, 'biography' => 'Arnold Alois Schwarzenegger (born July 30, 1947) is an Austrian-American actor, filmmaker, businessman, investor, author, philanthropist, activist, former professional bodybuilder and politician. He served two terms as the 38th Governor of California from 2003 until 2011.']);
        $album = $person->album()->first();
        $this->addToAlbum('arnold_schwarzenneger.jpg', $album, true, 'Arnold Schwarzenneger');
        $this->addToAlbum('arnold_as_the_terminator.jpg', $album, false, 'Arnold as The Terminator');
        $this->addToAlbum('arnold_bodybuilding.png', $album, false, 'Arnold bodybuilding');

        $person = App\Person::create(['first_name' => 'Dwayne', 'middle_name' => 'Douglas', 'last_name' => 'Johnson', 'first_alias' => null, 'middle_alias' => null, 'last_alias' => null, 'country_of_origin' => 'United States', 'date_of_birth' => '1972-05-02', 'date_of_death' => null, 'biography' => 'Dwayne Douglas Johnson, also known as The Rock, was born on May 2, 1972 in Hayward, California, to Ata Johnson (née Maivia) and Canadian-born professional wrestler Rocky Johnson. His father is black (of Black Nova Scotian descent), and his mother is of Samoan background (her own father was Peter Fanene Maivia, also a professional wrestler). While growing up, Dwayne traveled around a lot with his parents and watched his father perform in the ring. During his high school years, Dwayne began playing football and he soon received a full scholarship from the University of Miami where he had tremendous success as a football player. In 1995, Dwayne suffered a back injury which cost him a place in the NFL. He then signed a 3 year deal with the Canadian League but left after a year to pursue a career in wrestling. He made his wrestling debut in the USWA under the name Flex Kavanah where he won the tag team championship with Brett Sawyer. In 1996, Dwayne joined the WWE and became Rocky Maivia where he joined a group known as "The Nation of Domination" and turned heel. Rocky eventually took over leadership of the "Nation" and began taking the persona of The Rock. After the "Nation" split, The Rock joined another elite group of wrestlers known as the "Corporation" and began a memorable feud with Steve Austin. Soon the Rock was kicked out of the "Corporation". He turned face and became known as "The Peoples Champion". In 2000, the Rock took time off from WWE to film his appearance in The Mummy Returns (2001). He returned in 2001 during the WCW/ECW invasion where he joined a team of WWE wrestlers at The Scorpion King (2002), a prequel to The Mummy Returns (2001).']);
        $this->addToAlbum('dwayne_johnson.jpg', $person->album()->first(), true, 'Dwayne Johnson');

        $person = App\Person::create(['first_name' => 'Alfredo', 'middle_name' => 'James', 'last_name' => 'Pacino', 'first_alias' => 'Al', 'middle_alias' => null, 'last_alias' => 'Pacino', 'country_of_origin' => 'United States', 'date_of_birth' => '1940-04-25', 'date_of_death' => null, 'biography' => 'Alfredo James "Al" Pacino (born April 25, 1940) is an American actor of stage and screen, filmmaker, and screenwriter. Pacino has had a career spanning more than fifty years, during which time he has received numerous accolades and honors both competitive and honorary, among them an Academy Award, two Tony Awards, two Primetime Emmy Awards, a British Academy Film Award, four Golden Globe Awards, the Lifetime Achievement Award from the American Film Institute, the Golden Globe Cecil B. DeMille Award, and the National Medal of Arts. He is also one of few performers to have won a competitive Oscar, an Emmy and a Tony Award for acting, dubbed the "Triple Crown of Acting".']);
        $this->addToAlbum('al_pacino.jpg', $person->album()->first(), true, 'Al Pacino');

        $person = App\Person::create(['first_name' => 'Marion', 'middle_name' => 'Mitchell', 'last_name' => 'Morrison', 'first_alias' => 'John', 'middle_alias' => null, 'last_alias' => 'Wayne', 'country_of_origin' => 'United States', 'date_of_birth' => '1907-05-26', 'date_of_death' => '1979-06-14', 'biography' => 'Marion Mitchell Morrison (born Marion Robert Morrison; May 26, 1907 – June 11, 1979), better known by his stage name John Wayne and by his nickname "Duke", was an American film actor, director, and producer. An Academy Award-winner for True Grit (1969), Wayne was among the top box office draws for three decades. An enduring American icon, for several generations of Americans he epitomized rugged masculinity and is famous for his demeanor, including his distinctive calm voice, walk, and height.']);
        $this->addToAlbum('john_wayne.jpg', $person->album()->first(), true, 'John Wayne');

        $person = App\Person::create(['first_name' => 'Louis', 'middle_name' => null, 'last_name' => 'Székely', 'first_alias' => 'Louis', 'middle_alias' => null, 'last_alias' => 'C.K.', 'country_of_origin' => 'United States', 'date_of_birth' => '1967-08-12', 'date_of_death' => null, 'biography' => 'Louis Székely (born September 12, 1967), known professionally as Louis C.K., is an American comedian, actor, writer, producer, director, and editor. He is the creator, star, writer, director, executive producer, and primary editor of the acclaimed FX comedy-drama series Louie. C.K. is known for his use of observational, self-deprecating, dark and vulgar humor in his stand-up career.']);
        $this->addToAlbum('louis_ck.jpg', $person->album()->first(), true, 'Louis C.K.');

        $person = App\Person::create(['first_name' => 'Mark', 'middle_name' => 'Richard', 'last_name' => 'Hamill', 'first_alias' => null, 'middle_alias' => null, 'last_alias' => null, 'country_of_origin' => 'United States', 'date_of_birth' => '1951-09-25', 'date_of_death' => null, 'biography' => 'Mark Richard Hamill (born September 25, 1951) is an American actor, voice actor, writer, producer, and director. He is best known for his portrayal of Luke Skywalker in the original Star Wars trilogy – Star Wars (1977), The Empire Strikes Back (1980), and Return of the Jedi (1983) – a role he reprised in Star Wars: The Force Awakens (2015). Hamill also starred and co-starred in the films Corvette Summer (1978), The Big Red One (1980), and Kingsman: The Secret Service (2015). Hamill\'s extensive voice acting work includes a long-standing role as the Joker, commencing with Batman: The Animated Series in 1992.']);
        $this->addToAlbum('mark_hamill.jpg', $person->album()->first(), true, 'Mark Hamill');

        $person = App\Person::create(['first_name' => 'John', 'middle_name' => 'Adam', 'last_name' => 'Belushi', 'first_alias' => null, 'middle_alias' => null, 'last_alias' => null, 'country_of_origin' => 'United States', 'date_of_birth' => '1949-01-24', 'date_of_death' => '1982-05-03', 'biography' => 'John Adam Belushi (January 24, 1949 – March 5, 1982) was an American comedian, actor, and musician. He is best known for his "intense energy and raucous attitude" which he displayed as one of the original cast members of the NBC sketch comedy show Saturday Night Live, in his role in the 1978 film Animal House and in his recordings and performances as one of The Blues Brothers.']);
        $this->addToAlbum('john_belushi.jpg', $person->album()->first(), true, 'John Belushi');

        $person = App\Person::create(['first_name' => 'John', 'middle_name' => 'Franklin', 'last_name' => 'Candy', 'first_alias' => null, 'middle_alias' => null, 'last_alias' => null, 'country_of_origin' => 'Canada', 'date_of_birth' => '1950-10-31', 'date_of_death' => '1994-03-04', 'biography' => 'John Franklin Candy (October 31, 1950 – March 4, 1994) was a Canadian actor and comedian, mainly in American films such as Planes, Trains and Automobiles (1987) and Uncle Buck (1989).']);
        $this->addToAlbum('john_candy.jpg', $person->album()->first(), true, 'John Candy');

        $person = App\Person::create(['first_name' => 'Tommy', 'middle_name' => 'Lee', 'last_name' => 'Jones', 'first_alias' => 'Tommy', 'middle_alias' => 'Lee', 'last_alias' => 'Jones', 'country_of_origin' => 'United States', 'date_of_birth' => '1946-09-15', 'date_of_death' => null, 'biography' => 'Tommy Lee Jones (born September 15, 1946) is an American actor and filmmaker. He has received four Academy Award nominations, winning one as Best Supporting Actor for his performance as U.S. Marshal Samuel Gerard in the 1993 thriller film The Fugitive.']);
        $this->addToAlbum('tommy_lee_jones.jpg', $person->album()->first(), true, 'Tommy Lee Jones');

        $person = App\Person::create(['first_name' => 'Michael', 'middle_name' => 'Andrew', 'last_name' => 'Fox', 'first_alias' => 'Michael', 'middle_alias' => 'J.', 'last_alias' => 'Fox', 'country_of_origin' => 'Canada', 'date_of_birth' => '1961-06-09', 'date_of_death' => null, 'biography' => 'Michael Andrew Fox, OC (born June 9, 1961), known as Michael J. Fox, is a Canadian-American actor, author, producer, and advocate. With a film and television career spanning from the 1970s, Fox\'s roles have included Marty McFly from the Back to the Future trilogy (1985–1990); Alex P. Keaton from NBC\'s Family Ties (1982–1989), for which he won three Emmy Awards and a Golden Globe Award; and Mike Flaherty in ABC\'s Spin City (1996–2001), for which he won an Emmy, three Golden Globes, and two Screen Actors Guild Awards.']);
        $this->addToAlbum('michael_j_fox.jpg', $person->album()->first(), true, 'Michael J. Fox');

        $person = App\Person::create(['first_name' => 'Thomas', 'middle_name' => 'Cruise', 'last_name' => 'Mapother', 'first_alias' => 'Tom', 'middle_alias' => null, 'last_alias' => 'Cruise', 'country_of_origin' => 'United States', 'date_of_birth' => '1962-07-03', 'date_of_death' => null, 'biography' => 'Tom Cruise (born Thomas Cruise Mapother IV; July 3, 1962) is an American actor and filmmaker. Cruise has been nominated for three Academy Awards and has won three Golden Globe Awards. He started his career at age 19 in the 1981 film Endless Love. After portraying supporting roles in Taps (1981) and The Outsiders (1983), his first leading role was in the romantic comedy Risky Business, released in August 1983.']);
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

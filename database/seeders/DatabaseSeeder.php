<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Artist;
use App\Models\Festival;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. LIMPIEZA DE TABLAS
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('artist_festival')->truncate();
        DB::table('ticket_types')->truncate();
        Festival::truncate();
        Artist::truncate();
        \App\Models\Location::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. ROLES Y ADMIN
        $this->call(RoleSeeder::class);

        User::firstOrCreate(
            ['email' => 'admin@venue.com'],
            [
                'name' => 'Jon Admin',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
            ]
        );

        // 3. CREACIÓN DE ARTISTAS
        $artistsData = [
            // Reggaeton / Urbano
            ['name' => 'Mora', 'genre' => 'Trap / Reggaeton', 'country' => 'Puerto Rico', 'spotify_url' => 'https://open.spotify.com/artist/0Q8NcsJwoCbZOHHW63su5S',
             'youtube_url' => 'https://www.youtube.com/embed/5aI7w5vTq1U',
             'bio' => 'Gabriel Armando Mora Quintero, nacido en 1996 en Bayamón, Puerto Rico. Inició su carrera como productor musical y compositor antes de debutar como cantante solista, destacando en la escena urbana por sus colaboraciones y su estilo que fusiona reggaetón, trap y R&B.'],

            ['name' => 'Jhay Cortez', 'genre' => 'Reggaeton', 'country' => 'Puerto Rico', 'spotify_url' => 'https://open.spotify.com/artist/00sOTPxgYE0K2E7F3v2F1Z',
             'youtube_url' => 'https://www.youtube.com/embed/L13sL7d4BTo',
             'bio' => 'Jesús Manuel Nieves Cortez, nacido en 1993 en Río Piedras, Puerto Rico. Es un cantante y compositor que comenzó escribiendo éxitos para otros artistas de renombre antes de consolidarse como una de las figuras principales del reggaetón contemporáneo.'],

            ['name' => 'Rauw Alejandro', 'genre' => 'Pop Urbano', 'country' => 'Puerto Rico', 'spotify_url' => 'https://open.spotify.com/artist/1mcTU81TzQhprhouKaTkpq',
             'youtube_url' => 'https://www.youtube.com/embed/9Bv_3C3b_vU',
             'bio' => 'Raúl Alejandro Ocasio Ruiz, nacido en 1993 en San Juan, Puerto Rico. Destaca por integrar influencias del R&B, dancehall y pop de los años 80 en el reggaetón, además de ser reconocido por sus complejas coreografías.'],

            ['name' => 'Feid', 'genre' => 'Reggaeton', 'country' => 'Colombia', 'spotify_url' => 'https://open.spotify.com/artist/2LRoIwlKmHjgvigdNGBHNo',
             'youtube_url' => 'https://www.youtube.com/embed/2vY_A9I89x4',
             'bio' => 'Salomón Villada Hoyos, nacido en 1992 en Medellín, Colombia. Comenzó su trayectoria componiendo para artistas como J Balvin y Nicky Jam, evolucionando hasta convertirse en un referente global del reggaetón bajo su alter ego \'Ferxxo\'.'],

            ['name' => 'Karol G', 'genre' => 'Reggaeton / Pop Urbano', 'country' => 'Colombia', 'spotify_url' => 'https://open.spotify.com/artist/790FomKkXshlbRYZFtwt5o',
             'youtube_url' => 'https://www.youtube.com/embed/hO2TXXF10V8',
             'bio' => 'Carolina Giraldo Navarro, nacida en 1991 en Medellín, Colombia. Es una cantante y compositora que ha logrado un éxito sin precedentes para una artista femenina en el género urbano, siendo galardonada con múltiples premios Grammy y Latin Grammy.'],

            ['name' => 'Bad Bunny', 'genre' => 'Reggaeton / Trap', 'country' => 'Puerto Rico', 'spotify_url' => 'https://open.spotify.com/artist/4q3ewBCX7sLwd24euOsy1D',
             'youtube_url' => 'https://www.youtube.com/embed/l8jKOfKzP4w',
             'bio' => 'Benito Antonio Martínez Ocasio, nacido en 1994 en Vega Baja, Puerto Rico. Rapero, cantante y productor que ha redefinido la música latina a nivel global, logrando récords históricos de reproducciones y giras mundiales.'],

            // EDM / Techno
            ['name' => 'Tiësto', 'genre' => 'Trance / EDM', 'country' => 'Países Bajos', 'spotify_url' => 'https://open.spotify.com/artist/2o5jDhtHVPhrJdv3cEQ99Z',
             'youtube_url' => 'https://www.youtube.com/embed/uA7mPZp6fH4',
             'bio' => 'Tijs Michiel Verwest, nacido en 1969 en Breda, Países Bajos. Considerado uno de los pioneros de la música electrónica de baile, fue el primer DJ en tocar en vivo en la ceremonia de apertura de unos Juegos Olímpicos (Atenas 2004).'],

            ['name' => 'Amelie Lens', 'genre' => 'Techno', 'country' => 'Bélgica', 'spotify_url' => 'https://open.spotify.com/artist/58XbwSjHjQkGZ1Iwa0U8P3',
             'youtube_url' => 'https://www.youtube.com/embed/N-0_Qo75d3c',
             'bio' => 'Nacida en 1990 en Vilvoorde, Bélgica. Dejó una exitosa carrera en la industria de la moda para dedicarse a la producción y mezcla de techno, convirtiéndose rápidamente en una de las fundadoras del sello Lenske y referente del techno europeo.'],

            ['name' => 'Calvin Harris', 'genre' => 'Dance / Pop', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/7CajNmpbOovJC86yjrqrFQ',
             'youtube_url' => 'https://www.youtube.com/embed/1v1-xJqEhyk',
             'bio' => 'Adam Richard Wiles, nacido en 1984 en Dumfries, Escocia. DJ, productor y cantante que revolucionó el pop electrónico en la década de 2010, acumulando múltiples récords mundiales por la cantidad de sencillos en el Top 10 británico.'],

            ['name' => 'David Guetta', 'genre' => 'EDM', 'country' => 'Francia', 'spotify_url' => 'https://open.spotify.com/artist/1Cs0zKBU1kc0i8ypK3B9ai',
             'youtube_url' => 'https://www.youtube.com/embed/uH1L54J0P6Y',
             'bio' => 'Pierre David Guetta, nacido en 1967 en París, Francia. Fue una figura clave para popularizar la música electrónica a nivel global al fusionar el house europeo con el pop y el hip-hop estadounidense a finales de los años 2000.'],

            ['name' => 'Charlotte de Witte', 'genre' => 'Techno', 'country' => 'Bélgica', 'spotify_url' => 'https://open.spotify.com/artist/1lRmeVQzTAl8KcvHk22T1B',
             'youtube_url' => 'https://www.youtube.com/embed/G1Nf11Wj_aM',
             'bio' => 'Nacida en 1992 en Gante, Bélgica. Productora y DJ de techno conocida por su sonido oscuro y minimalista. Es la fundadora del influyente sello discográfico KNTXT y una de las figuras más destacadas de la escena electrónica underground.'],

            ['name' => 'Martin Garrix', 'genre' => 'EDM', 'country' => 'Países Bajos', 'spotify_url' => 'https://open.spotify.com/artist/60d24wfXkVzDSfLS6pnUKD',
             'youtube_url' => 'https://www.youtube.com/embed/HqD2A-D9o8Q',
             'bio' => 'Martijn Gerard Garritsen, nacido en 1996 en Amstelveen, Países Bajos. Alcanzó la fama mundial a los 17 años con su sencillo \'Animals\' y ha sido nombrado repetidas veces como el DJ número 1 del mundo por DJ Mag.'],

            // Indie / Rock
            ['name' => 'Queens of the Stone Age', 'genre' => 'Stoner Rock', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/4pejUc4iciQfgdX6OKulQn',
             'youtube_url' => 'https://www.youtube.com/embed/F2zhe_rI0J4',
             'bio' => 'Banda de rock formada en 1996 en Palm Desert, California, por Josh Homme. Conocidos por su estilo de rock orientado a los riffs fuertes y la rítmica, son considerados pioneros en la popularización del stoner rock y hard rock alternativo.'],

            ['name' => 'The Strokes', 'genre' => 'Indie Rock', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/0epOFNiUPhn6ruCOPsg2R9',
             'youtube_url' => 'https://www.youtube.com/embed/6u_mGkG6K1k',
             'bio' => 'Banda de indie rock formada en 1998 en la ciudad de Nueva York. Su álbum debut en 2001, \'Is This It\', es ampliamente aclamado como uno de los discos más influyentes en la revitalización del garage rock y el post-punk en el siglo XXI.'],

            ['name' => 'The Killers', 'genre' => 'Alt Rock', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/0C0XlULifJtAqi6vPEb50m',
             'youtube_url' => 'https://www.youtube.com/embed/oK-sU0kO9hY',
             'bio' => 'Banda de rock formada en 2001 en Las Vegas, Nevada. Integran influencias de la música new wave de los años 80 y sintetizadores con rock alternativo, logrando un éxito masivo desde su álbum debut \'Hot Fuss\'.'],

            ['name' => 'Muse', 'genre' => 'Rock Electrónico', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/12Chz98pHFMPJEknJQMWvI',
             'youtube_url' => 'https://www.youtube.com/embed/bLzEq1Z41X0',
             'bio' => 'Trío de rock formado en 1994 en Teignmouth, Devon, Inglaterra. Son famosos por fusionar rock alternativo, música electrónica, heavy metal y música clásica, destacando por sus complejos y teatrales espectáculos en vivo.'],

            ['name' => 'Arctic Monkeys', 'genre' => 'Indie Rock', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/7Ln80lUS6He07XvHI8qqjP',
             'youtube_url' => 'https://www.youtube.com/embed/e1_vT1oK46w',
             'bio' => 'Banda formada en 2002 en Sheffield, Inglaterra. Se convirtieron en una de las primeras bandas en ganar atención pública a través de Internet, pasando del indie rock acelerado de sus inicios a un sonido mucho más cinematográfico y maduro.'],

            ['name' => 'Foo Fighters', 'genre' => 'Rock Alternativo', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/7jy3rLJdDQY21OgRLCZ9sD',
             'youtube_url' => 'https://www.youtube.com/embed/0KcwvH2Q10k',
             'bio' => 'Banda formada en 1994 en Seattle, Washington, como un proyecto en solitario del exbaterista de Nirvana, Dave Grohl. Hoy en día son una de las bandas de rock más exitosas y premiadas de la historia de los premios Grammy.'],

            // Heavy Metal
            ['name' => 'Judas Priest', 'genre' => 'Heavy Metal', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/2Tz1DTzX5g0elCSNA0MyaC',
             'youtube_url' => 'https://www.youtube.com/embed/mICbM9JmU0o',
             'bio' => 'Banda de heavy metal formada en 1969 en Birmingham, Inglaterra. Considerados fundamentales en la evolución de la música metal, fueron pioneros en introducir el uso de dos guitarras líderes y la estética de cuero y tachuelas.'],

            ['name' => 'Avenged Sevenfold', 'genre' => 'Heavy Metal', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/0nmQIMXWTXfhgOBweG0l0z',
             'youtube_url' => 'https://www.youtube.com/embed/1B1j3iI2Gz0',
             'bio' => 'Banda originaria de Huntington Beach, California, formada en 1999. Reconocidos por su destreza técnica, la versatilidad de su sonido (que abarca desde el metalcore hasta el heavy metal tradicional y progresivo) y sus complejas producciones en vivo.'],

            ['name' => 'Slipknot', 'genre' => 'Nu Metal', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/05fG473iIaoy82BF1aGhL8',
             'youtube_url' => 'https://www.youtube.com/embed/uH_lGvI7HqQ',
             'bio' => 'Banda formada en 1995 en Des Moines, Iowa. Se caracterizan por su enfoque agresivo en el sonido nu metal, su sección de percusión extendida y el uso constante de máscaras y uniformes durante sus enérgicos directos.'],

            ['name' => 'Rammstein', 'genre' => 'Metal Industrial', 'country' => 'Alemania', 'spotify_url' => 'https://open.spotify.com/artist/6wWVKhxIU2cEi0K81v7HvP',
             'youtube_url' => 'https://www.youtube.com/embed/StZcUAPRRac',
             'bio' => 'Banda de metal industrial formada en 1994 en Berlín, Alemania. Han ganado fama mundial tanto por su distintivo sonido, conocido como Neue Deutsche Härte, como por sus enormes espectáculos en directo repletos de efectos pirotécnicos.'],

            ['name' => 'Iron Maiden', 'genre' => 'Heavy Metal Clásico', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/6mdiAmBYSqRity02skH8EE',
             'youtube_url' => 'https://www.youtube.com/embed/H5H4zK9tW1o',
             'bio' => 'Formados en 1975 en el este de Londres por el bajista Steve Harris. Son pioneros del movimiento \'Nueva ola del heavy metal británico\' y cuentan con una discografía masiva, impulsada siempre por su icónica mascota gráfica, Eddie.'],

            ['name' => 'Metallica', 'genre' => 'Thrash Metal', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/2ye2Wgw4gimLv2eAKyk1PN',
             'youtube_url' => 'https://www.youtube.com/embed/F-l4P1_hQ74',
             'bio' => 'Banda formada en 1981 en Los Ángeles, California, por James Hetfield y Lars Ulrich. Son uno de los \'cuatro grandes\' del thrash metal y una de las bandas más exitosas comercialmente de todos los tiempos en la historia de la música pesada.'],

            // Pop / Hip-Hop
            ['name' => 'Doja Cat', 'genre' => 'Pop / Rap', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/5cj0lLjcoR7YOSnhnX0Po5',
             'youtube_url' => 'https://www.youtube.com/embed/5D3x5aHhNvw',
             'bio' => 'Amala Ratna Zandile Dlamini, nacida en 1995 en Los Ángeles, California. Cantante, rapera y productora que comenzó publicando música en SoundCloud cuando era adolescente, destacando por su aguda habilidad técnica para el rap combinada con sensibilidades pop.'],

            ['name' => 'Post Malone', 'genre' => 'Hip-Hop / Pop', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/246dkjvS1zLTtiykXe5h60',
             'youtube_url' => 'https://www.youtube.com/embed/Smd3FqF_13A',
             'bio' => 'Austin Richard Post, nacido en 1995 en Syracuse, Nueva York. Cantante y compositor conocido por mezclar géneros y subgéneros como hip hop, pop, R&B y rock, logrando diamantes de ventas y un masivo éxito multiplatino en su carrera.'],

            ['name' => 'Billie Eilish', 'genre' => 'Alt Pop', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/6qqNVTkY8uBg9cP3Jd7DAH',
             'youtube_url' => 'https://www.youtube.com/embed/W_qU1OaGqjA',
             'bio' => 'Billie Eilish Pirate Baird O\'Connell, nacida en 2001 en Los Ángeles, California. Comenzó a crear música con su hermano Finneas y alcanzó el reconocimiento global con un sonido de pop alternativo, sombrío y minimalista que desafía los estándares de la industria.'],

            ['name' => 'Kendrick Lamar', 'genre' => 'Hip-Hop', 'country' => 'Estados Unidos', 'spotify_url' => 'https://open.spotify.com/artist/2YZyLoL8N0Wb9xBt1NhZWg',
             'youtube_url' => 'https://www.youtube.com/embed/Z0XlA1HnQv8',
             'bio' => 'Kendrick Lamar Duckworth, nacido en 1987 en Compton, California. Considerado uno de los raperos más influyentes y líricamente complejos de su generación; es el primer músico de fuera del ámbito clásico o jazz en ganar el Premio Pulitzer de Música.'],

            ['name' => 'Dua Lipa', 'genre' => 'Pop', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/6M2wZ9GZgrQXHCFfjv46we',
             'youtube_url' => 'https://www.youtube.com/embed/o6E_f4h0R-w',
             'bio' => 'Nacida en 1995 en Londres, de ascendencia albano-kosovar. Su carrera musical despegó fusionando pop contemporáneo con estética disco y funk, lo que la ha llevado a ganar múltiples premios Grammy y Brit Awards en su meteórica trayectoria.'],

            ['name' => 'The Weeknd', 'genre' => 'R&B / Pop', 'country' => 'Canadá', 'spotify_url' => 'https://open.spotify.com/artist/1Xyo4u8uXC1ZmMpatF05PJ',
             'youtube_url' => 'https://www.youtube.com/embed/9zPlnr2r9p0',
             'bio' => 'Abel Makkonen Tesfaye, nacido en 1990 en Toronto, Canadá. Reconocido por su versatilidad sónica, que oscila entre el R&B alternativo oscuro de sus inicios y un synth-pop de gran éxito comercial inspirado en la música de los años 80.'],

            // Techno Underground
            ['name' => 'Richie Hawtin', 'genre' => 'Minimal Techno', 'country' => 'Canadá', 'spotify_url' => 'https://open.spotify.com/artist/1E2x63N66G01A51A6ZtG0x',
             'youtube_url' => 'https://www.youtube.com/embed/rP1O9Oubr0Y',
             'bio' => 'Nacido en 1970 en Banbury, Inglaterra, y criado en Windsor, Canadá. Es una figura de culto en el desarrollo de la música techno de Detroit durante los 90. Es pionero en el minimal techno y en el desarrollo de tecnologías y hardware para DJs.'],

            ['name' => 'Peggy Gou', 'genre' => 'House / Techno', 'country' => 'Corea del Sur', 'spotify_url' => 'https://open.spotify.com/artist/48WzEKeMAPuN15v1P8H8XN',
             'youtube_url' => 'https://www.youtube.com/embed/I01m3EGEyK4',
             'bio' => 'Kim Min-ji, nacida en 1991 en Incheon, Corea del Sur. Tras estudiar moda en Londres y aprender a producir en Berlín, se ha convertido en una productora y DJ aclamada mundialmente, integrando letras en coreano con música house optimista y bailable.'],

            ['name' => 'Tale Of Us', 'genre' => 'Melodic Techno', 'country' => 'Italia', 'spotify_url' => 'https://open.spotify.com/artist/5L1h0P29A2oUj0FkQjR5zH',
             'youtube_url' => 'https://www.youtube.com/embed/PjEHTp5G-z0',
             'bio' => 'Dúo italiano de DJs y productores formado en 2008 en Milán por Carmine Conte y Matteo Milleri. Fundadores de la discográfica y serie de eventos \'Afterlife\', son los principales referentes globales de la vertiente más emotiva y melancólica del techno.'],

            ['name' => 'Adam Beyer', 'genre' => 'Drumcode Techno', 'country' => 'Suecia', 'spotify_url' => 'https://open.spotify.com/artist/23oK8ts1yD9vj6RxyFjZk9',
             'youtube_url' => 'https://www.youtube.com/embed/ZqM1y1R11zM',
             'bio' => 'Nacido en 1976 en Estocolmo, Suecia. Es uno de los creadores del sonido techno sueco y fundador de \'Drumcode Records\', uno de los sellos más vendidos de la historia del techno, conocido por definir el sonido de grandes festivales.'],

            ['name' => 'Nina Kraviz', 'genre' => 'Acid Techno', 'country' => 'Rusia', 'spotify_url' => 'https://open.spotify.com/artist/3jK9MiCrA42lLAdMGUZpXv',
             'youtube_url' => 'https://www.youtube.com/embed/1B1sZ11F24s',
             'bio' => 'Nacida en 1987 en Irkutsk, Siberia, Rusia. Odontóloga de formación que se consolidó como productora y DJ, caracterizándose por mezclas crudas que incluyen acid house de Chicago, trance de los 90 y sus propias voces hipnóticas.'],

            ['name' => 'Carl Cox', 'genre' => 'Techno', 'country' => 'Reino Unido', 'spotify_url' => 'https://open.spotify.com/artist/1yqdfA1YfE3wX9I081mI82',
             'youtube_url' => 'https://www.youtube.com/embed/mPZJvK1nEQw',
             'bio' => 'Nacido en 1962 en Oldham, Inglaterra. Considerado un pionero de la escena rave británica de finales de los 80, es mundialmente famoso por su pericia técnica con tres platos y su icónica residencia de más de una década en el club Space de Ibiza.'],
        ];

        $artistModels = [];
        foreach ($artistsData as $data) {
            $data['image_url'] = 'default_artist.jpg';
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $id = DB::table('artists')->insertGetId($data);
            $artistModels[$data['name']] = $id;
        }

        // 4. CREACIÓN DE RECINTOS
        $locationBenidorm = \App\Models\Location::create([
            'name'        => 'Playa de Poniente',
            'address'     => 'Paseo de la Carretera Nacional, s/n',
            'city'        => 'Benidorm',
            'country'     => 'España',
            'capacity'    => 22000,
            'description' => 'Recinto al aire libre situado en la playa de Poniente de Benidorm, con vistas al Mediterráneo y escenario principal frente al mar.',
        ]);

        $locationBoom = \App\Models\Location::create([
            'name'        => 'Schorre Recreation Area',
            'address'     => 'Schorre 1',
            'city'        => 'Boom',
            'country'     => 'Bélgica',
            'capacity'    => 200000,
            'description' => 'Inmenso parque natural de 70 hectáreas a orillas del río Rupel, sede permanente de Tomorrowland desde 2005.',
        ]);

        $locationMadrid = \App\Models\Location::create([
            'name'        => 'IFEMA - Espacio Mad Cool',
            'address'     => 'Av. del Partenón, 5',
            'city'        => 'Madrid',
            'country'     => 'España',
            'capacity'    => 70000,
            'description' => 'Recinto ferial al norte de Madrid habilitado como gran espacio de festivales, con múltiples escenarios simultáneos.',
        ]);

        $locationClisson = \App\Models\Location::create([
            'name'        => 'Domaine de la Clisson',
            'address'     => 'Route de Clisson',
            'city'        => 'Clisson',
            'country'     => 'Francia',
            'capacity'    => 60000,
            'description' => 'Recinto permanente del Hellfest, situado en la campiña francesa junto al río Sèvre Nantaise, con 6 escenarios y ambiente medieval.',
        ]);

        $locationChicago = \App\Models\Location::create([
            'name'        => 'Grant Park',
            'address'     => '337 E Randolph St',
            'city'        => 'Chicago',
            'country'     => 'Estados Unidos',
            'capacity'    => 100000,
            'description' => 'Parque urbano en el corazón de Chicago, a orillas del lago Michigan. Sede histórica de Lollapalooza desde 2005.',
        ]);

        $locationHilvarenbeek = \App\Models\Location::create([
            'name'        => 'Beekse Bergen Safari Park',
            'address'     => 'Beekse Bergen 1',
            'city'        => 'Hilvarenbeek',
            'country'     => 'Países Bajos',
            'capacity'    => 80000,
            'description' => 'Parque natural de 250 hectáreas en Brabante del Norte, transformado cada verano en el recinto del Awakenings Summer Festival.',
        ]);

        // 5. CREACIÓN DE FESTIVALES Y RELACIONES
        $rbf = Festival::create([
            'name'        => 'Reggaeton Beach Festival',
            'location'    => 'Benidorm, España',
            'location_id' => $locationBenidorm->id,
            'style'       => 'Reggaeton / Urbano',
            'date'        => '2026-07-11',
            'image_url'   => 'default_festival.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $rbf->id, 'name' => 'General', 'price' => 85, 'quantity' => 20000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $rbf->id, 'name' => 'VIP Front Stage', 'price' => 150, 'quantity' => 2000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $rbf->artists()->attach([
            $artistModels['Mora']           => ['performance_start' => '17:00', 'performance_end' => '18:00'],
            $artistModels['Jhay Cortez']    => ['performance_start' => '18:15', 'performance_end' => '19:30'],
            $artistModels['Rauw Alejandro'] => ['performance_start' => '19:45', 'performance_end' => '21:00'],
            $artistModels['Feid']           => ['performance_start' => '21:15', 'performance_end' => '22:30'],
            $artistModels['Karol G']        => ['performance_start' => '22:45', 'performance_end' => '00:15'],
            $artistModels['Bad Bunny']      => ['performance_start' => '00:30', 'performance_end' => '02:30'],
        ]);

        $tomorrowland = Festival::create([
            'name'        => 'Tomorrowland',
            'location'    => 'Boom, Bélgica',
            'location_id' => $locationBoom->id,
            'style'       => 'EDM / Mainstream Techno',
            'date'        => '2026-07-18',
            'image_url'   => 'default_festival.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $tomorrowland->id, 'name' => 'Full Madness', 'price' => 355, 'quantity' => 180000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $tomorrowland->id, 'name' => 'Comfort VIP', 'price' => 600, 'quantity' => 15000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $tomorrowland->artists()->attach([
            $artistModels['Tiësto']            => ['performance_start' => '19:00', 'performance_end' => '20:15'],
            $artistModels['Amelie Lens']        => ['performance_start' => '20:30', 'performance_end' => '21:45'],
            $artistModels['Calvin Harris']      => ['performance_start' => '22:00', 'performance_end' => '23:15'],
            $artistModels['David Guetta']       => ['performance_start' => '23:30', 'performance_end' => '00:45'],
            $artistModels['Charlotte de Witte'] => ['performance_start' => '01:00', 'performance_end' => '02:15'],
            $artistModels['Martin Garrix']      => ['performance_start' => '02:30', 'performance_end' => '04:00'],
        ]);

        $madcool = Festival::create([
            'name'        => 'Mad Cool Festival',
            'location'    => 'Madrid, España',
            'location_id' => $locationMadrid->id,
            'style'       => 'Indie / Rock Alternativo',
            'date'        => '2026-07-09',
            'image_url'   => 'default_festival.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $madcool->id, 'name' => 'Abono 3 Días', 'price' => 195, 'quantity' => 70000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $madcool->id, 'name' => 'Abono VIP', 'price' => 450, 'quantity' => 5000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $madcool->artists()->attach([
            $artistModels['Queens of the Stone Age'] => ['performance_start' => '18:30', 'performance_end' => '19:45'],
            $artistModels['The Strokes']              => ['performance_start' => '20:00', 'performance_end' => '21:15'],
            $artistModels['The Killers']              => ['performance_start' => '21:30', 'performance_end' => '22:45'],
            $artistModels['Muse']                    => ['performance_start' => '23:00', 'performance_end' => '00:30'],
            $artistModels['Arctic Monkeys']           => ['performance_start' => '00:45', 'performance_end' => '02:15'],
            $artistModels['Foo Fighters']             => ['performance_start' => '02:30', 'performance_end' => '04:00'],
        ]);

        $hellfest = Festival::create([
            'name'        => 'Hellfest Open Air',
            'location'    => 'Clisson, Francia',
            'location_id' => $locationClisson->id,
            'style'       => 'Heavy Metal / Hard Rock',
            'date'        => '2026-06-26',
            'image_url'   => 'default_festival.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $hellfest->id, 'name' => 'Pass 4 Jours', 'price' => 329, 'quantity' => 60000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $hellfest->id, 'name' => 'VIP Hellcity', 'price' => 700, 'quantity' => 3000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $hellfest->artists()->attach([
            $artistModels['Judas Priest']      => ['performance_start' => '17:00', 'performance_end' => '18:30'],
            $artistModels['Avenged Sevenfold'] => ['performance_start' => '18:45', 'performance_end' => '20:15'],
            $artistModels['Slipknot']          => ['performance_start' => '20:30', 'performance_end' => '22:00'],
            $artistModels['Rammstein']         => ['performance_start' => '22:15', 'performance_end' => '23:45'],
            $artistModels['Iron Maiden']       => ['performance_start' => '00:00', 'performance_end' => '01:45'],
            $artistModels['Metallica']         => ['performance_start' => '02:00', 'performance_end' => '04:00'],
        ]);

        $lolla = Festival::create([
            'name'        => 'Lollapalooza',
            'location'    => 'Chicago, Estados Unidos',
            'location_id' => $locationChicago->id,
            'style'       => 'Pop / Hip-Hop / Global',
            'date'        => '2026-08-06',
            'image_url'   => 'default_festival.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $lolla->id, 'name' => 'General Admission 4-Day', 'price' => 385, 'quantity' => 100000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $lolla->id, 'name' => 'Platinum VIP', 'price' => 1500, 'quantity' => 4000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $lolla->artists()->attach([
            $artistModels['Doja Cat']       => ['performance_start' => '17:00', 'performance_end' => '18:15'],
            $artistModels['Post Malone']    => ['performance_start' => '18:30', 'performance_end' => '19:45'],
            $artistModels['Billie Eilish']  => ['performance_start' => '20:00', 'performance_end' => '21:15'],
            $artistModels['Kendrick Lamar'] => ['performance_start' => '21:30', 'performance_end' => '22:45'],
            $artistModels['Dua Lipa']       => ['performance_start' => '23:00', 'performance_end' => '00:15'],
            $artistModels['The Weeknd']     => ['performance_start' => '00:30', 'performance_end' => '02:30'],
        ]);

        $awakenings = Festival::create([
            'name'        => 'Awakenings Summer Festival',
            'location'    => 'Hilvarenbeek, Países Bajos',
            'location_id' => $locationHilvarenbeek->id,
            'style'       => 'Techno Underground / Tech House',
            'date'        => '2026-07-10',
            'image_url'   => 'default_festival.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $awakenings->id, 'name' => 'Weekend Pass', 'price' => 170, 'quantity' => 80000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $awakenings->id, 'name' => 'VIP Deck', 'price' => 300, 'quantity' => 5000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        $awakenings->artists()->attach([
            $artistModels['Richie Hawtin'] => ['performance_start' => '16:00', 'performance_end' => '17:45'],
            $artistModels['Peggy Gou']     => ['performance_start' => '18:00', 'performance_end' => '19:45'],
            $artistModels['Tale Of Us']    => ['performance_start' => '20:00', 'performance_end' => '21:45'],
            $artistModels['Adam Beyer']    => ['performance_start' => '22:00', 'performance_end' => '23:45'],
            $artistModels['Nina Kraviz']   => ['performance_start' => '00:00', 'performance_end' => '01:45'],
            $artistModels['Carl Cox']      => ['performance_start' => '02:00', 'performance_end' => '04:00'],
        ]);
    }
}
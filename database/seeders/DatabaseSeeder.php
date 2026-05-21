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
                'name'     => 'Jon Admin',
                'password' => Hash::make('12345678'),
                'role_id'  => 1,
            ]
        );

        // 3. CREACIÓN DE ARTISTAS
        $artistsData = [
            // Reggaeton / Urbano
            ['name' => 'Mora', 'genre' => 'Trap / Reggaeton', 'country' => 'Puerto Rico',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Mora_cantante_y_compositor.jpg/330px-Mora_cantante_y_compositor.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/0Q8NcsJwoCbZOHHW63su5S',
             'youtube_url' => 'https://www.youtube.com/embed/5aI7w5vTq1U',
             'bio'         => 'Gabriel Armando Mora Quintero, nacido en 1996 en Bayamón, Puerto Rico. Inició su carrera como productor musical y compositor antes de debutar como cantante solista, destacando en la escena urbana por sus colaboraciones y su estilo que fusiona reggaetón, trap y R&B.'],

            ['name' => 'Jhay Cortez', 'genre' => 'Reggaeton', 'country' => 'Puerto Rico',
             'image_url' => 'https://upload.wikimedia.org/wikipedia/en/b/b9/Jhay_Cortez_-_Famouz.png',
             'spotify_url' => 'https://open.spotify.com/artist/00sOTPxgYE0K2E7F3v2F1Z',
             'youtube_url' => 'https://www.youtube.com/embed/L13sL7d4BTo',
             'bio'         => 'Jesús Manuel Nieves Cortez, nacido en 1993 en Río Piedras, Puerto Rico. Es un cantante y compositor que comenzó escribiendo éxitos para otros artistas de renombre antes de consolidarse como una de las figuras principales del reggaetón contemporáneo.'],

            ['name' => 'Rauw Alejandro', 'genre' => 'Pop Urbano', 'country' => 'Puerto Rico',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/2023-11-16_Gala_de_los_Latin_Grammy%2C_13_%28cropped%29.jpg/500px-2023-11-16_Gala_de_los_Latin_Grammy%2C_13_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/1mcTU81TzQhprhouKaTkpq',
             'youtube_url' => 'https://www.youtube.com/embed/9Bv_3C3b_vU',
             'bio'         => 'Raúl Alejandro Ocasio Ruiz, nacido en 1993 en San Juan, Puerto Rico. Destaca por integrar influencias del R&B, dancehall y pop de los años 80 en el reggaetón, además de ser reconocido por sus complejas coreografías.'],

            ['name' => 'Feid', 'genre' => 'Reggaeton', 'country' => 'Colombia',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/4/45/Feid%2C_Castigo_music_video%3B_Mar_2022.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/2LRoIwlKmHjgvigdNGBHNo',
             'youtube_url' => 'https://www.youtube.com/embed/2vY_A9I89x4',
             'bio'         => 'Salomón Villada Hoyos, nacido en 1992 en Medellín, Colombia. Comenzó su trayectoria componiendo para artistas como J Balvin y Nicky Jam, evolucionando hasta convertirse en un referente global del reggaetón bajo su alter ego \'Ferxxo\'.'],

            ['name' => 'Karol G', 'genre' => 'Reggaeton / Pop Urbano', 'country' => 'Colombia',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/2023-11-16_Gala_de_los_Latin_Grammy%2C_15_%28cropped_2%29.jpg/500px-2023-11-16_Gala_de_los_Latin_Grammy%2C_15_%28cropped_2%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/790FomKkXshlbRYZFtwt5o',
             'youtube_url' => 'https://www.youtube.com/embed/hO2TXXF10V8',
             'bio'         => 'Carolina Giraldo Navarro, nacida en 1991 en Medellín, Colombia. Es una cantante y compositora que ha logrado un éxito sin precedentes para una artista femenina en el género urbano, siendo galardonada con múltiples premios Grammy y Latin Grammy.'],

            ['name' => 'Bad Bunny', 'genre' => 'Reggaeton / Trap', 'country' => 'Puerto Rico',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Bad_Bunny_2019_by_Glenn_Francis_%28cropped%29.jpg/500px-Bad_Bunny_2019_by_Glenn_Francis_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/4q3ewBCX7sLwd24euOsy1D',
             'youtube_url' => 'https://www.youtube.com/embed/l8jKOfKzP4w',
             'bio'         => 'Benito Antonio Martínez Ocasio, nacido en 1994 en Vega Baja, Puerto Rico. Rapero, cantante y productor que ha redefinido la música latina a nivel global, logrando récords históricos de reproducciones y giras mundiales.'],

            // EDM / Techno
            ['name' => 'Tiësto', 'genre' => 'Trance / EDM', 'country' => 'Países Bajos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/Ti%C3%ABsto_%40_Airbeat_One_2017.jpg/960px-Ti%C3%ABsto_%40_Airbeat_One_2017.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/2o5jDhtHVPhrJdv3cEQ99Z',
             'youtube_url' => 'https://www.youtube.com/embed/uA7mPZp6fH4',
             'bio'         => 'Tijs Michiel Verwest, nacido en 1969 en Breda, Países Bajos. Considerado uno de los pioneros de la música electrónica de baile, fue el primer DJ en tocar en vivo en la ceremonia de apertura de unos Juegos Olímpicos (Atenas 2004).'],

            ['name' => 'Amelie Lens', 'genre' => 'Techno', 'country' => 'Bélgica',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Amelie_Lens_06_2022.jpg/960px-Amelie_Lens_06_2022.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/58XbwSjHjQkGZ1Iwa0U8P3',
             'youtube_url' => 'https://www.youtube.com/embed/N-0_Qo75d3c',
             'bio'         => 'Nacida en 1990 en Vilvoorde, Bélgica. Dejó una exitosa carrera en la industria de la moda para dedicarse a la producción y mezcla de techno, convirtiéndose rápidamente en una de las fundadoras del sello Lenske y referente del techno europeo.'],

            ['name' => 'Calvin Harris', 'genre' => 'Dance / Pop', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Calvin_Harris_-_Rock_in_Rio_Madrid_2012_-_12_%28cropped%29.jpg/500px-Calvin_Harris_-_Rock_in_Rio_Madrid_2012_-_12_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/7CajNmpbOovJC86yjrqrFQ',
             'youtube_url' => 'https://www.youtube.com/embed/1v1-xJqEhyk',
             'bio'         => 'Adam Richard Wiles, nacido en 1984 en Dumfries, Escocia. DJ, productor y cantante que revolucionó el pop electrónico en la década de 2010, acumulando múltiples récords mundiales por la cantidad de sencillos en el Top 10 británico.'],

            ['name' => 'David Guetta', 'genre' => 'EDM', 'country' => 'Francia',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/2023-11-16_Gala_de_los_Latin_Grammy%2C_22_%28David_Guetta%29.jpg/500px-2023-11-16_Gala_de_los_Latin_Grammy%2C_22_%28David_Guetta%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/1Cs0zKBU1kc0i8ypK3B9ai',
             'youtube_url' => 'https://www.youtube.com/embed/uH1L54J0P6Y',
             'bio'         => 'Pierre David Guetta, nacido en 1967 en París, Francia. Fue una figura clave para popularizar la música electrónica a nivel global al fusionar el house europeo con el pop y el hip-hop estadounidense a finales de los años 2000.'],

            ['name' => 'Charlotte de Witte', 'genre' => 'Techno', 'country' => 'Bélgica',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Charlotte_de_witte-1513626416.jpg/500px-Charlotte_de_witte-1513626416.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/1lRmeVQzTAl8KcvHk22T1B',
             'youtube_url' => 'https://www.youtube.com/embed/G1Nf11Wj_aM',
             'bio'         => 'Nacida en 1992 en Gante, Bélgica. Productora y DJ de techno conocida por su sonido oscuro y minimalista. Es la fundadora del influyente sello discográfico KNTXT y una de las figuras más destacadas de la escena electrónica underground.'],

            ['name' => 'Martin Garrix', 'genre' => 'EDM', 'country' => 'Países Bajos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Martin_Garrix_%40_Web_Summit_2017.jpg/500px-Martin_Garrix_%40_Web_Summit_2017.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/60d24wfXkVzDSfLS6pnUKD',
             'youtube_url' => 'https://www.youtube.com/embed/HqD2A-D9o8Q',
             'bio'         => 'Martijn Gerard Garritsen, nacido en 1996 en Amstelveen, Países Bajos. Alcanzó la fama mundial a los 17 años con su sencillo \'Animals\' y ha sido nombrado repetidas veces como el DJ número 1 del mundo por DJ Mag.'],

            // Indie / Rock
            ['name' => 'Queens of the Stone Age', 'genre' => 'Stoner Rock', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c2/Queens_of_the_Stone_Age_-_SSE_Arena_Wembley_-_Saturday_18th_November_2017_QOTSAWembley181117-29_%2824730972488%29_%28cropped%29.jpg/1280px-Queens_of_the_Stone_Age_-_SSE_Arena_Wembley_-_Saturday_18th_November_2017_QOTSAWembley181117-29_%2824730972488%29_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/4pejUc4iciQfgdX6OKulQn',
             'youtube_url' => 'https://www.youtube.com/embed/F2zhe_rI0J4',
             'bio'         => 'Banda de rock formada en 1996 en Palm Desert, California, por Josh Homme. Conocidos por su estilo de rock orientado a los riffs fuertes y la rítmica, son considerados pioneros en la popularización del stoner rock y hard rock alternativo.'],

            ['name' => 'The Strokes', 'genre' => 'Indie Rock', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/The_Strokes_by_Roger_Woolman.jpg/960px-The_Strokes_by_Roger_Woolman.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/0epOFNiUPhn6ruCOPsg2R9',
             'youtube_url' => 'https://www.youtube.com/embed/6u_mGkG6K1k',
             'bio'         => 'Banda de indie rock formada en 1998 en la ciudad de Nueva York. Su álbum debut en 2001, \'Is This It\', es ampliamente aclamado como uno de los discos más influyentes en la revitalización del garage rock y el post-punk en el siglo XXI.'],

            ['name' => 'The Killers', 'genre' => 'Alt Rock', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/17/KillersBrixton120917-47.jpg/1280px-KillersBrixton120917-47.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/0C0XlULifJtAqi6vPEb50m',
             'youtube_url' => 'https://www.youtube.com/embed/oK-sU0kO9hY',
             'bio'         => 'Banda de rock formada en 2001 en Las Vegas, Nevada. Integran influencias de la música new wave de los años 80 y sintetizadores con rock alternativo, logrando un éxito masivo desde su álbum debut \'Hot Fuss\'.'],

            ['name' => 'Muse', 'genre' => 'Rock Electrónico', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/MuseBristol_050619-118_%2848035812973%29.jpg/1280px-MuseBristol_050619-118_%2848035812973%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/12Chz98pHFMPJEknJQMWvI',
             'youtube_url' => 'https://www.youtube.com/embed/bLzEq1Z41X0',
             'bio'         => 'Trío de rock formado en 1994 en Teignmouth, Devon, Inglaterra. Son famosos por fusionar rock alternativo, música electrónica, heavy metal y música clásica, destacando por sus complejos y teatrales espectáculos en vivo.'],

            ['name' => 'Arctic Monkeys', 'genre' => 'Indie Rock', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Arctic_Monkeys_-_Orange_Stage_-_Roskilde_Festival_2014.jpg/960px-Arctic_Monkeys_-_Orange_Stage_-_Roskilde_Festival_2014.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/7Ln80lUS6He07XvHI8qqjP',
             'youtube_url' => 'https://www.youtube.com/embed/e1_vT1oK46w',
             'bio'         => 'Banda formada en 2002 en Sheffield, Inglaterra. Se convirtieron en una de las primeras bandas en ganar atención pública a través de Internet, pasando del indie rock acelerado de sus inicios a un sonido mucho más cinematográfico y maduro.'],

            ['name' => 'Foo Fighters', 'genre' => 'Rock Alternativo', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/FoosLondonStad220618-124_%2842989552522%29.jpg/1280px-FoosLondonStad220618-124_%2842989552522%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/7jy3rLJdDQY21OgRLCZ9sD',
             'youtube_url' => 'https://www.youtube.com/embed/1VQ_3sBZEm0',
             'bio'         => 'Banda de rock alternativo formada en Seattle en 1994 por Dave Grohl, ex baterista de Nirvana. Con más de 100 millones de discos vendidos, son considerados una de las últimas grandes bandas de rock de estadio de la historia.'],

            // Metal
            ['name' => 'Metallica', 'genre' => 'Heavy Metal', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Metallica_March_2024.jpg/960px-Metallica_March_2024.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/2ye2Wgw4gimLv2eAKyk1NB',
             'youtube_url' => 'https://www.youtube.com/embed/2XbCWmY0eqY',
             'bio'         => 'Banda de heavy metal formada en Los Ángeles en 1981. Con más de 125 millones de discos vendidos son la banda de metal más exitosa de la historia, responsables de llevar el thrash metal al público masivo global.'],

            ['name' => 'Iron Maiden', 'genre' => 'Heavy Metal', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ed/IronMaidencollage2.jpg/500px-IronMaidencollage2.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/6mdiAmATAx73kdxrNbo6y2',
             'youtube_url' => 'https://www.youtube.com/embed/WM8bTdBs-cw',
             'bio'         => 'Banda de heavy metal formada en Londres en 1975. Pioneros del movimiento New Wave of British Heavy Metal, son considerados una de las bandas más influyentes e importantes de la historia del metal con más de 100 millones de discos vendidos.'],

            ['name' => 'Slipknot', 'genre' => 'Nu-Metal', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Slipknot_performing_live_in_the_O2_Arena_on_December_21%2C_2024_-_Pic_2.jpg/1280px-Slipknot_performing_live_in_the_O2_Arena_on_December_21%2C_2024_-_Pic_2.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/05fG473iIaoy82BF1aGhL8',
             'youtube_url' => 'https://www.youtube.com/embed/ZPUZwriZX0M',
             'bio'         => 'Banda de nu-metal formada en Des Moines, Iowa, en 1995. Conocidos por sus máscaras y monos de trabajo, su música combina metal pesado con elementos de rap, punk y música experimental, logrando millones de seguidores en todo el mundo.'],

            ['name' => 'Rammstein', 'genre' => 'Industrial Metal', 'country' => 'Alemania',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Escenario_con_llamas_de_fuego_en_la_canci%C3%B3n_Sonne.jpg/960px-Escenario_con_llamas_de_fuego_en_la_canci%C3%B3n_Sonne.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/6wWVKhxIU2cEi0K81v7HvP',
             'youtube_url' => 'https://www.youtube.com/embed/NeQM1c-XCDc',
             'bio'         => 'Banda de metal industrial formada en Berlín en 1994. Conocidos por sus impresionantes espectáculos pirotécnicos en vivo y sus letras provocadoras mayoritariamente en alemán, son la banda alemana con mayor proyección internacional de todos los tiempos.'],

            ['name' => 'Judas Priest', 'genre' => 'Heavy Metal', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d2/Judas_Priest_-_Wacken_Open_Air_2018_01.jpg/960px-Judas_Priest_-_Wacken_Open_Air_2018_01.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/2tRsMl4eGxwoNabM08Dm4I',
             'youtube_url' => 'https://www.youtube.com/embed/r4ogVpSPacc',
             'bio'         => 'Banda de heavy metal formada en Birmingham en 1969. Considerados los "dioses del metal", definieron el sonido clásico del heavy metal con guitarras gemelas, cuero y tachuelas, siendo una influencia directa para prácticamente todas las bandas del género.'],

            ['name' => 'Avenged Sevenfold', 'genre' => 'Heavy Metal', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Avenged_Sevenfold_2.jpg/960px-Avenged_Sevenfold_2.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/0nmQIMXWTXfhgOBdNzhGOs',
             'youtube_url' => 'https://www.youtube.com/embed/OQGByFCARi4',
             'bio'         => 'Banda de heavy metal formada en Huntington Beach, California, en 1999. Han vendido más de 8 millones de álbumes en todo el mundo combinando metal melódico, hard rock y metalcore con elaboradas producciones en vivo.'],

            // Pop / Hip-Hop
            ['name' => 'Billie Eilish', 'genre' => 'Pop / Alternativo', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/c/c7/BillieEilishO2140725-39_-_54665577407_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/6qqNVTkY8uBg9cP3Jd7DAH',
             'youtube_url' => 'https://www.youtube.com/embed/DyDfgMOUjCI',
             'bio'         => 'Billie Eilish Pirate Baird O\'Connell, nacida en 2001 en Los Ángeles. Se convirtió en la artista más joven en ganar los cuatro premios Grammy principales en una sola noche, revolucionando el pop con un sonido íntimo y oscuro.'],

            ['name' => 'Kendrick Lamar', 'genre' => 'Hip-Hop / Rap', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/3/32/Pulitzer2018-portraits-kendrick-lamar.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/2YZyLoL8N0Wb9xBt1NhZWg',
             'youtube_url' => 'https://www.youtube.com/embed/TVSn_qHnF54',
             'bio'         => 'Nacido en 1987 en Compton, California. Considerado uno de los mejores raperos de todos los tiempos, ganó el Premio Pulitzer de Música en 2018, convirtiéndose en el primer artista no clásico ni de jazz en recibir este galardón.'],

            ['name' => 'The Weeknd', 'genre' => 'R&B / Pop', 'country' => 'Canadá',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/9/95/The_Weeknd_Cannes_2023.png',
             'spotify_url' => 'https://open.spotify.com/artist/1Xyo4u8uXC1ZmMpatF05PJ',
             'youtube_url' => 'https://www.youtube.com/embed/XXYlFuWEuKI',
             'bio'         => 'Abel Makkonen Tesfaye, nacido en 1990 en Toronto, Canadá. Creador de un sonido oscuro y cinematográfico que fusiona R&B, synth-pop y pop alternativo. Es uno de los artistas más escuchados de la historia en Spotify.'],

            ['name' => 'Dua Lipa', 'genre' => 'Pop / Dance', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/4/43/Dua_Lipa-69819.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/6M2wZ9GZgrQXHCFfjv46we',
             'youtube_url' => 'https://www.youtube.com/embed/oygrmJFKYZY',
             'bio'         => 'Nacida en 1995 en Londres de padres albanokosovares. Con su álbum \'Future Nostalgia\' reinventó el disco pop de los años 80 para el siglo XXI, ganando tres Grammy y convirtiéndose en una de las artistas femeninas más exitosas de su generación.'],

            ['name' => 'Post Malone', 'genre' => 'Hip-Hop / Pop', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Post_Malone_July_2021_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/246dkjvS1zLTtiykXe5h60',
             'youtube_url' => 'https://www.youtube.com/embed/UceaB4D0jpo',
             'bio'         => 'Austin Richard Post, nacido en 1995 en Syracuse, Nueva York. Ha conseguido múltiples récords en el Billboard Hot 100 con un estilo que mezcla hip-hop, R&B, pop y rock, siendo uno de los artistas más versátiles de su generación.'],

            ['name' => 'Doja Cat', 'genre' => 'Pop / Hip-Hop', 'country' => 'Estados Unidos',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/DojaCatO2140624_%2818_of_105%29_%2853792877753%29_%28cropped%29.jpg/500px-DojaCatO2140624_%2818_of_105%29_%2853792877753%29_%28cropped%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/5cj0lLjcoR7YOSnhnX0Po5',
             'youtube_url' => 'https://www.youtube.com/embed/pok81uHbAXk',
             'bio'         => 'Amala Ratna Zandile Dlamini, nacida en 1995 en Los Ángeles. Artista multifacética que combina rap, canto y producción propia. Ganó tres Grammy en 2023 y es conocida por su creatividad visual y su habilidad para moverse entre géneros.'],

            // Techno Underground
            ['name' => 'Richie Hawtin', 'genre' => 'Techno / Minimal', 'country' => 'Canadá',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Richie_Hawtin-SMS-2018-2.jpg/960px-Richie_Hawtin-SMS-2018-2.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/1EuAnCHHEsqFHDpfQRynrP',
             'youtube_url' => 'https://www.youtube.com/embed/giGDgz-1cBY',
             'bio'         => 'Nacido en 1970 en Banbury, Inglaterra, criado en Windsor, Canadá. Pionero del techno minimal bajo el alias Plastikman, es uno de los DJs más influyentes del mundo y cofundador del sello discográfico Minus.'],

            ['name' => 'Peggy Gou', 'genre' => 'House / Techno', 'country' => 'Corea del Sur',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Peggy_Gou_2019.jpg/500px-Peggy_Gou_2019.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/7G5KB6aCkAFPLJEpWwWFDR',
             'youtube_url' => 'https://www.youtube.com/embed/9ogBBn4KHQk',
             'bio'         => 'Ji-hye Gou, nacida en 1991 en Incheon, Corea del Sur. Productora y DJ afincada en Berlín que se ha convertido en una de las figuras más reconocibles del house y el techno global, destacando también por su influencia en la moda.'],

            ['name' => 'Tale Of Us', 'genre' => 'Melodic Techno', 'country' => 'Italia',
             'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/Cali_y_El_Dandee_en_una_entrevista.jpg/960px-Cali_y_El_Dandee_en_una_entrevista.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/6uoQLFSqVPJSRnzNcwfUSq',
             'youtube_url' => 'https://www.youtube.com/embed/0yjyHiyNhA4',
             'bio'         => 'Dúo italiano formado por Carmine Conte y Matteo Milleri. Son los creadores del sello Afterlife y máximos exponentes del techno melódico, un subgénero que fusiona techno de cuatro por cuatro con texturas cinematográficas y emotivas.'],

            ['name' => 'Adam Beyer', 'genre' => 'Techno', 'country' => 'Suecia',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Adam_Beyer_%283559941164%29.jpg/500px-Adam_Beyer_%283559941164%29.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/0LyfQWJT6nXafLPZqxe9Of',
             'youtube_url' => 'https://www.youtube.com/embed/b4EWVTNNt1Y',
             'bio'         => 'Nacido en 1974 en Estocolmo, Suecia. Fundador del influyente sello Drumcode Records y uno de los DJs de techno más respetados del mundo, conocido por su sonido potente y funcional que domina las pistas de baile desde los años 90.'],

            ['name' => 'Nina Kraviz', 'genre' => 'Techno / House', 'country' => 'Rusia',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Nina_Kraviz%2C_2012.jpg/500px-Nina_Kraviz%2C_2012.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/6tVg8TP9mPWABxCMhpFHQb',
             'youtube_url' => 'https://www.youtube.com/embed/hEOZpmV-f0E',
             'bio'         => 'Nacida en 1980 en Irkutsk, Siberia. Cantante, productora y DJ que fundó el sello трип (Trip), es una de las figuras más carismáticas e influyentes de la escena electrónica mundial, conocida por sets salvajes y una personalidad arrolladora.'],

            ['name' => 'Carl Cox', 'genre' => 'Techno / House', 'country' => 'Reino Unido',
             'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/CarlCox.jpg/500px-CarlCox.jpg',
             'spotify_url' => 'https://open.spotify.com/artist/7Es1KGf4Ls2L6HmOCzTnNM',
             'youtube_url' => 'https://www.youtube.com/embed/X9Kufk4U4Tc',
             'bio'         => 'Nacido en 1962 en Barbados, criado en Clapham, Londres. Considerado uno de los DJs más grandes de la historia de la música electrónica, es mundialmente famoso por su pericia técnica con tres platos y su icónica residencia de más de una década en el club Space de Ibiza.'],
        ];

        $artistModels = [];
        foreach ($artistsData as $data) {
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
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/Baja_Beach_Fest_2019.jpg/960px-Baja_Beach_Fest_2019.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $rbf->id, 'name' => 'General',        'price' => 85,  'quantity' => 20000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $rbf->id, 'name' => 'VIP Front Stage', 'price' => 150, 'quantity' => 2000,  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5b/Tomorrowland_Mainstage_Nacht.jpg/1280px-Tomorrowland_Mainstage_Nacht.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $tomorrowland->id, 'name' => 'Full Madness', 'price' => 355, 'quantity' => 180000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $tomorrowland->id, 'name' => 'Comfort VIP', 'price' => 600, 'quantity' => 15000,  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/Noria_del_Mad_Cool_2016.jpg/1280px-Noria_del_Mad_Cool_2016.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $madcool->id, 'name' => 'Abono 3 Días', 'price' => 195, 'quantity' => 70000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $madcool->id, 'name' => 'Abono VIP',    'price' => 450, 'quantity' => 5000,  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/0/08/Hellfest2017_10.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $hellfest->id, 'name' => 'Pass 4 Jours', 'price' => 329, 'quantity' => 60000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $hellfest->id, 'name' => 'VIP Hellcity', 'price' => 700, 'quantity' => 3000,  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7e/Lollapalooza_Argentina%21_%2833655638331%29.jpg/960px-Lollapalooza_Argentina%21_%2833655638331%29.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $lolla->id, 'name' => 'General Admission 4-Day', 'price' => 385,  'quantity' => 100000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $lolla->id, 'name' => 'Platinum VIP',            'price' => 1500, 'quantity' => 4000,   'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
            'image_url'   => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/Awakenings_%281457330255%29.jpg/960px-Awakenings_%281457330255%29.jpg',
        ]);

        DB::table('ticket_types')->insert([
            ['festival_id' => $awakenings->id, 'name' => 'Weekend Pass', 'price' => 170, 'quantity' => 80000, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['festival_id' => $awakenings->id, 'name' => 'VIP Deck',     'price' => 300, 'quantity' => 5000,  'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
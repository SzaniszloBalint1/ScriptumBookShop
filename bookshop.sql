-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Ápr 20. 17:33
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bookshop`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `publish_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 1,
  `cover_image` varchar(255) DEFAULT NULL,
  `describe` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `publish_date`, `price`, `rating`, `cover_image`, `describe`, `views`, `created_at`, `updated_at`) VALUES
(1, 'Zabhegyező', 'J.D. Salinger', '9780316769488', '1951-07-16', 4500, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/504/50504.jpg', '\'Hát ha tényleg kíváncsi vagy rá, először biztos azt szeretnéd tudni, hogy hol születtem, meg hogy milyen volt az én egész tetű gyerekkorom, meg hogy mik voltak a szüleim, mielőtt beszereztek engem, meg minden, szóval hogy egy ilyen Copperfield Dávid-féle marhaságot adjak le, de ehhez nincs kedvem. Először is unom ezt a témát, másodszor a szüleimet sorba megütné a gutman, ha nagyon mélyre találnék túrni a dologban. Az ilyesmire rém érzékiek, főleg az apám. Rendesek is, meg minden, nem mondom, de rém érzékiek. Ebből úgyse lesz itten életírás, vagy mit tudom én, csak azt akarom elmondani, hogyan zsongtam be tavaly karácsony táján, amiből aztán olyan nagy lerobbanás lett, hogy ideküldtek összeszedni magamat. Vagyis azt, amit már D. B.-nek is elmondtam, a drága bátyámnak, tudod, aki Hollywoodban van. Nincs túl messze ettől a nyomor helytől, majdnem minden hétvégen meglátogat. Jövő hónapban kocsin visz haza a diliházból, persze csak ha elengednek. Most vett egy Jaguárt. Egy olyan kis angol tragacs, tudod, kétszázzal fut óránként. Majdnem négyezerbe van neki. Most vágott zsebre egy csomó dohányt. Azelőtt nem szokott, mikor még otthon lakott, és rendes író volt. Ő írta azt a bombajó novellás kötetet, a Titokzatos aranyhal-at, ha még nem hallottad volna. A legjobb benne a Titokzatos aranyhal. Egy kis krapekről szól, aki senkinek se engedi az aranyhalát megnézni, mert a saját pénzén vette. Halálos volt. Most Hollywoodban van D. B. Tisztára elkurvult. Ha van valami a világon, amit utálok, az a mozi. Ne is mondd.\' - így kezdődik a generációs regény. Salinger letehetetlen könyve most a diákok számára is elérhető áron kerül a Bookline oldalára. ', 0, NULL, NULL),
(2, 'Normális emberek', 'Sally Rooney', '6533810760821', '2018-08-30', 4500, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/258/3156258.jpg', 'Egy érzelmileg mély és intim történet két fiatal kapcsolatáról, akik éveken át keresztezik egymás útját.', 0, NULL, NULL),
(3, 'Norvég erdő', 'Haruki Murakami', '9697049686910', '1987-09-04', 5200, 1, 'https://marvin.bline.hu/product_images/1034/ID22-76380.JPG', ' Melankolikus és nosztalgikus regény a szerelemről, veszteségről és a felnőtté válásról a ’60-as évek Japánjában.', 0, NULL, NULL),
(4, 'Briliáns barátnőm', 'Elena Ferrante', '5941174460654', '2011-10-19', 4800, 1, 'https://marvin.bline.hu/product_images/444/ID22-323291.JPG', 'Egy évtizedeket felölelő történet két nápolyi lány barátságáról, társadalmi különbségekről és női sorsokról.', 0, NULL, NULL),
(5, 'Fehér fogak', 'Zadie Smith', '3093136342322', '2000-01-27', 5000, 1, 'https://s01.static.libri.hu/cover/c2/8/8476200_4.jpg', 'Szellemes és éleslátó regény a multikulturális Londonról, generációs és kulturális különbségekről.', 0, NULL, NULL),
(6, 'Ne bántsátok a feketerigót!', 'Harper Lee', '9780061120084', '1960-07-11', 5000, 1, 'https://cdn.britannica.com/21/182021-050-666DB6B1/book-cover-To-Kill-a-Mockingbird-many-1961.jpg', 'Az alabamai Maycomb városában utolsó gondtalan nyarát tölti egy testvérpár, Jem és négy évvel fiatalabb húga, Scout. Az őket anya nélkül nevelő Finch ügyvéd megpróbál tökéletes apaként viselkedni, ám neki sem könnyű. Izzik körülötte a levegő: egy színes bőrű férfit véd a bíróságon. Ráadásul váratlan események, misztikus jelenések, nyugtalanító hírek zavarják meg a család nyugalmát. A gyerekek élete is gyökeresen megváltozik: a felnőtté válás varázslatos és fájdalmas útja immár elkerülhetetlen számukra...', 0, NULL, NULL),
(7, '1984', 'George Orwell', '9780451524935', '1949-06-08', 4000, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/577/3300577.jpg', 'George Orwell (szül. Eric Arthur Blair, 1903-1950) a 20. század egyik legnagyobb hatású írója. Az Indiában született, majd Angliában nevelkedett szerző egyetemi ösztöndíj híján utazott vissza szülőföldjére, hogy a burmai rendőrségnél dolgozzon, ám 1927-re végleg megundorodva az angol gyarmati politikától, kilépett a szervezetből. Az itt szerzett tapasztalatai a hatalom működéséről és az elnyomottak helyzetéről, majd a szegénynegyedekben töltött keserű hónapok, és végül a második világháború tragédiája vezetett Orwell és a 20. század egyik legismertebb műve, az 1984 megírásához, amelyet megérdemelten emlegetnek a világirodalom klasszikusai között.\'Üdvözlet az egyformaság korából, a magányosság korából, a Nagy Testvér korából, a duplagondol korából\' - írja a naplójába Winston Smith, a lázadó, a gondolatbűnöző, aki nem hajlandó elismerni, hogy a 2 x 2 a Párt akarata szerint lehet három vagy öt. Az 1984 örök emlékeztető a 20. század totalitárius hatalmainak működéséről, ugyanakkor kegyetlen szatíra és figyelmeztetés is a jövőre vagy éppenséggel a jelenre nézve, hiszen ma is zsigereinkben érezhetjük a diktatúrák örökségét. A mai napig közszájon forgó kifejezések mellett ugyanakkor a regény által jobban érthető a 21. század különböző technológiákkal átszőtt terekben létező társadalmának működése is, a köztéri kameráktól kezdve a közösségi médián át az álhírekig', 0, NULL, NULL),
(8, 'Szép új világ', 'Aldous Huxley', '5739201846275', '1932-01-01', 4000, 1, 'https://cdn.antikvarium.hu/foto/nagy/46126015.jpg', ' Egy látszólag tökéletes, de lélektelen és elnyomó jövő társadalmát bemutató regény, ahol az emberek mesterséges boldogságban élnek.', 0, NULL, NULL),
(9, 'A szolgálólány meséje', 'Margaret Atwood', '1092837465927', '1985-09-17', 4600, 1, 'https://moly.hu/system/covers/big/covers_864540.jpg', ' Sötét jövőkép egy világban, ahol a nők jogait elnyomták, és a termékeny nőket szolgaságba kényszerítették.', 0, NULL, NULL),
(10, '451 Fahrenheit', 'Ray Bradbury', '7584930264711', '1953-10-19', 4300, 1, 'https://marvin.bline.hu/product_images/1227/B288680.JPG', 'Egy olyan világban játszódó történet, ahol a könyveket elégetik, és a társadalom a tudatlanságban tartásra épül.', 0, NULL, NULL),
(11, 'Büszkeség és balítélet', 'Jane Austen', '9780141439518', '1813-01-28', 3800, 1, 'https://s01.static.libri.hu/cover/6f/7/6585783_4.jpg', 'Csodálatos lények lehettek a régi angol papkisasszonyok - egy kis faluban elásva, vénlányságra és tüdőbajra kárhoztatva hervadhatatlan regényeket tudtak írni az emberi természetről és szenvedélyekről. Jane Austen is vidéki papleány volt, mint a Bronté nővérek. Hat teljes regény maradt utána és néhány töredék. Ennek a viszonylag kis életműnek legismertebb és sok kritikus szerint a legjelentősebb darabja a Büszkeség és balítélet. Mint Austen többi regényét, ezt is feszes szerkezete, klasszikus stílusa, szellemes dialógusai, mély pszichológiája és nem utolsósorban írónőjének csillogó okossága teszik ma is élvezetes olvasmánnyá. A regény szűk társadalmi körben mozog, de pompásan jellemzett alakok széles skáláját vonultatja fel. A jómódú Mr. Bennetnek falusi földbirtoka, buta és fecsegő felesége, valamint öt lánya van. Jane, a legidősebb szép és kedves, bele is szeret Mr. Bingley, a szomszéd birtok bérlője. De barátja, Mr. Darcy, aki gőgös, kellemetlen alak, nemcsak hogy kemény vitákba keveredik Elizabeth-tel, Jane briliáns eszű és éles nyelvű húgával, de barátját is lebeszéli a hozzá nem illő házasságról. Eliza rosszul ítéli meg Darcyt, s amikor az váratlanul megkéri a kezét, fejére olvassa gőgösségét és kikosarazza. A regény végére mindkét főszereplő leküzdi hibáját: egyik a büszkeségét, másik az előítéleteket, s boldogan egymáséi lesznek, mire természetesen a másik pár boldogságának sincs többé akadálya.', 0, NULL, NULL),
(12, 'Anna Karenina', 'Lev Tolsztoj', '1029384756102', '1878-01-01', 5500, 1, 'https://books.google.hu/books/publisher/content?id=7wdlEAAAQBAJ&hl=hu&pg=PA1&img=1&zoom=3&bul=1&sig=ACfU3U3gXy1m4rY1qAqAKb5vWPtJhUEnxw&w=1280', 'Sorsfordító szerelmi tragédia és társadalomkritika az orosz arisztokrácia világából.', 0, NULL, NULL),
(13, 'Nyomorultak', 'Victor Hugo', '9483726150937', '1862-01-01', 5800, 1, 'https://s01.static.libri.hu/cover/81/c/3320760_4.jpg', 'Epikus történet a 19. századi Franciaországról, amely az igazságosság, a megváltás és az emberi szenvedés kérdéseit vizsgálja.', 0, NULL, NULL),
(14, 'Szerelmünk lapjai', 'Nicholas Sparks', '6457382910453', '1996-10-01', 4100, 1, 'https://s01.static.libri.hu/cover/9d/9/2769190_4.jpg', 'Megható szerelmi történet egy életen át tartó kapcsolatról és a múlt fájdalmas emlékeiről.', 0, NULL, NULL),
(15, 'Üvöltő szelek', 'Emily Brontë', '392847561203', '1847-12-12', 4700, 1, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFUcqsJGAi3MUQbtm1_AHaGPBlWdfkBQ77fQ&s', 'Sötét és szenvedélyes szerelmi történet, amely a bosszú és az érzelmi szenvedés témáit járja körül.', 0, NULL, NULL),
(16, 'Mielőtt megismertelek', 'Jojo Moyes', '7658392014566', '2012-01-05', 4900, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/480/3839480.jpg', ' Egy nő és egy mozgáskorlátozott férfi különleges kapcsolatának szívszorító története.', 0, NULL, NULL),
(17, 'Tomorrow, and Tomorrow, and Tomorrow', 'Gabrielle Zevin', '3829104756285', '2022-07-05', 5300, 1, 'https://encrypted-tbn1.gstatic.com/shopping?q=tbn:ANd9GcQfQlyyycYNEJXF-unPIfGLmRaIltBJhkDFOd4KVlolWdcaKc8n3Ev6krp2VwIk5aupWOUmtk5JPh954N1pHZRXkmX7-pb9tlhVdWvi0qd7&usqp=CAc', 'Egyedi szerelmi és barátság történet két videojáték-fejlesztőről, akik együtt próbálnak érvényesülni.', 0, NULL, NULL),
(18, 'A Nagy Gatsby', 'F. Scott Fitzgerald', '9780743273565', '1925-04-10', 4200, 1, 'https://m.media-amazon.com/images/I/819wCzUTZWL._AC_UF1000,1000_QL80_.jpg', 'Jay Gatsby, a titokzatos milliomos felemelkedésének, tündöklésének és bukásának története sosem volt még ennyire aktuális. A 20. század egyik kiemelkedő világirodalmi alkotása művészi tökéllyel jeleníti meg az amerikai álom olyan örök témáit, mint a pénz és a hatalom bűvölete, az ambíció, a lehetetlen megkísértése és az újrakezdés lehetősége, miközben érzékletes képet fest a húszas évek túlhabzó dzsesszkorszakáról is. A szegény sorból származó Gatsby beleszeret egy gazdag lányba, Daisybe, de a háború elsodorja őket egymástól, s míg a fiatalember a tengerentúlon harcol, a lány férjhez megy egy faragatlan, ám dúsgazdag emberhez, Tom Buchananhez. Hazatérése után Gatsby fanatikus akarással, az eszközökben sem válogatva vagyont szerez, hogy \'méltó\' legyen Daisyhez, és hogy a világítótorony reményt adó zöld fényét követve újrateremthesse a múltat és visszahódíthassa a fiatal asszonyt. A gazdasági összeomlás előszobájában zajló szerelmi háromszög, a fényűző partik, a politikusok és filmsztárok, a luxusautók és hidroplánok ma is ismerős színfalai mögött azonban végül a boldogtalan házasságok és beteljesületlen szerelmek, a szegénység és az elnyomás, a reménytelenség, a kiábrándultság és a magány világát találjuk.', 0, NULL, NULL),
(19, 'Akiért a harang szól', 'Ernest Hemingway', '9780684803357', '1940-10-21', 4300, 1, 'https://s01.static.libri.hu/cover/e5/9/6958394_4.jpg', '1937-ben Ernest Hemingway Spanyolországba utazott, hogy a polgárháborúról tudósítson. Az eredmény: minden idők legjobb háborús regénye, amellyel Hemingway a legnagyobb közönségsikerét aratta. Egy fiatal amerikai, Robert Jordan önkéntesként csatlakozik egy antifasiszta gerillacsapathoz, amelynek fel kell robbantania egy hidat. Az akció végrehajtása közben beleszeret a gyönyörű Mariába. Hemingway kiforrott hangon ötvözi a hegyek között töltött percek apró rezdüléseit az az élet végességének tragikumával. ,,Gigantikus\'\' - The New York Times ,,Három dolog egy fergeteges műben: szerelmi történet, feszült kalandregény, és az életükért harcoló spanyol gazdák vészterhes tragédiája.', 0, NULL, NULL),
(20, 'Egerek és emberek', 'John Steinbeck', '9780142000670', '1937-03-09', 2370, 1, 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Of_Mice_and_Men_%281937_1st_ed_dust_jacket%29.jpg/250px-Of_Mice_and_Men_%281937_1st_ed_dust_jacket%29.jpg', 'A kaliforniai Soledad közelében furcsa párt tesz le az autóbusz: George alacsony és fürge észjárású, társa, Lennie lomha, nehézfejű óriás. Egy közeli tanyára tartanak, munkát keresnek. Bár a tanya lakói és munkásai korántsem barátságosak, nincs más választásuk: itt kell maradniuk, ha meg akarják valósítani közös álmukat, hogy vegyenek egy saját tanyát, ahol majd önállóan gazdálkodhatnak. Lennie-t ártatlan együgyűsége folyton bajba sodorja, és George-nak igencsak észnél kell lennie, ha mindkettőjüket meg akarja óvni a következményektől. Barátságuk ritka kincs az őket körülvevő sivár, brutális világban, amely könyörtelenül megsemmisülésre ítél mindent, ami emberi. A szikár, minden sallangtól mentes, sodró erejű kisregény a nagy gazdasági világválság idején két vándormunkás tragikusan felemelő történetén keresztül mutatja be a modern társadalom elidegenedésének, az emberi kapcsolatok kiüresedésének pusztító hatását. Mondanivalója a mai napig sem veszítette el érvényét.', 0, NULL, NULL),
(21, 'Moby-Dick', 'Herman Melville', '9780142437247', '1851-10-18', 4600, 1, 'https://m.media-amazon.com/images/I/61PBBKyZ1rL._AC_UF1000,1000_QL80_.jpg', 'Ishamel tengerész és kalandor. Szerencsét akar próbálni a bálnavadászok között, így hát csatlakozik a Pequod legénységéhez, melyet a sokat szenvedett, féllábú kapitány, Ahab vezet. Miután útra kelnek, Ahab kapitány egyre megszállottabban keresi Moby Dicket, a hatalmas bálnát, amely nyomorékká tette. A legénység borzongva hallgatja a veszélyes fehér óriásról szóló történeteket, és a kapitány gazdagságot, valamint hírnevet ígér nekik, ha sikerül kézre keríteniük a szörnyeteget. Ez az eseménydús történet azt meséli el, mi történik, ha valaki mindenáron bosszút akar állni ellenfelén.', 0, NULL, NULL),
(22, '80 nap alatt a Föld körül', 'Jules Verne', '9789632535267', '1872-12-22', 6640, 1, 'https://s01.static.libri.hu/cover/3e/c/7784923_4.jpg', 'Mi történik akkor, ha az ember fogadásból a lehető legrövidebb idő alatt körbe akarja utazni a világot? Pillanatok alatt összecsomagol és elindul. És ha indulása után felügyelő ered a nyomába, aki azzal gyanúsítja, hogy kirabolta az Angol Bankot? Akkor megindul egy hihetetlen utazás három földrészen keresztül, kalandokkal, bonyodalmakkal, az érzelmek valóságos hullámvasútján. ', 0, NULL, NULL),
(23, 'A vadon szava', 'Jack London', '9789632535321', '1903-01-01', 663, 1, 'https://s01.static.libri.hu/cover/6a/b/712651_4.jpg', 'Jack London számos kiadást megért regényének hőse, Buck, a bernáthegyi-skót juhászkutya keverék békés otthonából a zord Északra kerül. Sok hányattatás után igazi barátra talál egy jószívű aranybányászban. Miután gazdáját az indiánok megölik, engedve a vadon szavának, egy farkasfalka vezére lesz. ', 0, NULL, NULL),
(24, 'A kincses sziget', 'Robert Louis Stevenson', '2093847562939', '1883-01-01', 4400, 1, 'https://upload.wikimedia.org/wikipedia/commons/8/83/Treasure_Island-Scribner\'s-1911.jpg', 'Klasszikus kalandregény, amelyben egy fiú kalózok és rejtélyes térképek között keresi az elásott kincset.', 0, NULL, NULL),
(25, 'A három testőr', 'Alexandre Dumas', '3048571928464', '1844-01-01', 4600, 1, 'https://europakiado.hu/content/2019/6/Product/300/706426F.gif', 'Hősiességgel és intrikákkal teli történet három testőr és egy fiatal kardforgató kalandjairól a francia udvarban.', 0, NULL, NULL),
(26, 'A Hobbit', 'J.R.R. Tolkien', '9780547928227', '1937-09-21', 5500, 1, 'https://m.media-amazon.com/images/I/712cDO7d73L.jpg', 'Amikor kellemes, minden becsvágy nélküli életéből, meghitt föld alatti otthonából Gandalf, a mágus és egy csapat törp elragadja, Bilbó, a hobbit igazi kaland kellős közepébe csöppen: \'betörési szakértőként\' kell segédkeznie a kincs visszaszerzésében, amitől Smaug, a nagy és veszedelmes sárkány fosztotta meg egykor a Hegymély Királyát. Noha egy porcikája sem kívánja a kellemetlen megbízatást, Bilbó maga is lépten-nyomon meglepődik tulajdon ügyességén és leleményességén! A kalandok során már itt felbukkan a titokzatos varázserővel rendelkező gyűrű, amely Tolkien világában később is kiemelt szerepet fog játszani...', 0, NULL, NULL),
(27, 'Harry Potter- A bölcsek köve', 'J.K. Rowling', '9831232143461', '1997-06-26', 4740, 1, 'https://s01.static.libri.hu/cover/b6/f/716048_4.jpg', 'A Harry Potterről szóló, hétkötetesre tervezett regényfolyam első része. A könyvben megismerkedhetünk többek között a Roxfort varázslóiskolával, Harryvel, a varázslópalántával, és tanúi lehetünk csodálatosan izgalmas kalandjainak. Harry Potter kisfiú, történetünk kezdetén 11 éves, valamint varázsló is, talán a leghatalmasabb varázsló, a kiválasztott, aki meg tud küzdeni a gonosz erőivel, erről azonban fogalma sincs. (..) Harry aztán egy napon levelet kap, pontosabban néhány tízezer levelet, a biztonság kedvéért, mivel a nagybácsi elkobzós kedve magasra hág, amelyből megtudja, hogy a következő szemesztert Roxfortban kezdheti, a világ legnevesebb bentlakásos varázslóiskolájában, amely nem kis mértékben hasonlít a brit iskolarendszer hírhedett public schooljaira, talán attól eltekintve, hogy koedukált. Harry, a kifosztott árva ekkor belép abba a világba, amelyhez szülei is tartoztak, hogy megküzdjön azzal a Ki-Ne-Mondd-A-Nevét sötét erővel, amely árvává tette. Harry kiválasztott, homlokán a jegy, de egyben közönséges nebuló is, akinek minden kiválasztottsága ellenére fel kell mutatnia valamit, esetünkben kiemelkedő sportteljesítményt és kellő csapatszellemet, hogy elnyerje az egyszerű diáktársat megillető tiszteletet, és megússza valahogy a vizsgáit. A Gonosz Erőt nem könnyű legyőzni, de egy elitiskola hierarchiájában kiküzdeni valami helyet, főként, ha az alsóbbrendű muglik között nevelkedett az ember, és mit sem tud a magasabb bűbájról, az még nehezebb', 0, NULL, NULL),
(28, 'Harry Potter és a titkok kamrája - 2. könyv', 'J.K. Rowling', '9831232143763', '1998-07-02', 4930, 1, 'https://s01.static.libri.hu/cover/33/2/716047_4.jpg', 'Könyvünk címszereplőjével, a varázslónak tanuló kiskamasszal már megismerkedhettünk a \'Harry Potter és a bölcsek köve\' című meseregényben. A mű és szerzője gyorsan világhírnévre tett szert. Harry varázslónak született. Második tanéve a Roxfort Boszorkány - és Varázslóképző Szakiskolában éppen olyan eseménydúsnak bizonyult, mint amilyen az első volt. Lekési a különvonatot, így barátai repülő autóján érkezik tanulmányai színhelyére. S a java csak ezután következik..', 0, NULL, NULL),
(29, 'Harry Potter és az azkabani fogoly - 3. könyv', 'J.K. Rowling', '9831232143862', '1999-07-08', 5000, 1, 'https://s01.static.libri.hu/cover/c0/6/684283_4.jpg', 'Azkabanból, a gonosz varázslókat őrző rettegett és szuperbiztos börtönből megszökik egy fogoly. A Mágiaügyi Minisztériumban tudják, hogy a veszélyes szökevény Roxfortba tart, a Boszorkány-és Varázslóképző Szakiskolába.A varázslónövendék Harry Potter és barátai számára a harmadik tanév sem csak a vizsgák izgalmait tartogatja... ', 0, NULL, NULL),
(30, 'Harry Potter és a Tűz Serlege - 4. könyv', 'J.K. Rowling', '9831232143961', '2000-07-08', 5200, 1, 'https://s01.static.libri.hu/cover/a6/9/716046_4.jpg', 'Melyik nemzeti válogatott nyeri a Kviddics Világkupát? Ki lesz a Trimágus Tusa győztese? Utóbbiért a világ három boszorkány- és varázslóképző tanintézetének legrátermettebb diákjai küzdenek. A világraszóló versengés házigazdája Roxfort, az az iskola, ahová Harry Potter immár negyedévesként érkezik. S ahogy az a felsőbb osztályosoknál már egyáltalán nem különös, Harry és barátai a másik nemet is felfedezik... Ám nem csupán e kellemes izgalmakat ígérő események várnak Harryre és barátaira. Voldemort, a fekete mágusok vezére újból készülődik...Tele van a történet váratlanokkal, véletlenekkel, s miért tagadnánk: rémekkel, szörnyekkel, kísértetekkel. Valahogy annyira tele, mint az életünk. ', 0, NULL, NULL),
(31, 'Harry Potter és a Főnix Rendje - 5. könyv', 'J.K. Rowling', '9831232144061', '2003-07-21', 5400, 1, 'https://s01.static.libri.hu/cover/ff/5/716045_4.jpg', 'Dumbledore végül leeresztette kezét, és félhold szemüvegén át, fürkészve nézett Harry szemébe. - Eljött az ideje - szólt -, hogy elmondjam neked, amit már öt éve el kellett volna mondanom. Ülj le, kérlek! Ha megajándékozol egy kis türelemmel, mindent hallani fogsz, amit tudnod kell. Ha befejeztem, szidhatsz, dühönghetsz. Nem fogok védekezni. Harry Potter ötödik évére készül a Roxfort Boszorkány-Varázslóképző Szakiskolában. Harry - társaival ellentétben sosem örül a nyári szünetnek, ám ez a mostani még rosszabb, mint rendesen. Nem csak rokonai, Dursleyék keserítik meg az életét, de - ami a legfájdalmasabb - mintha barátai is elfeledkeztek volna róla. Harry azon töri a fejét, hogyan törhetne ki lehetetlen helyzetéből, ám nyári szünidejének egy hirtelen, drámai fordulat vet véget. Hamarosan azt is megtudja, hogy Roxfortban sem számíthat békés tanulásra és kviddicsezésre...', 0, NULL, NULL),
(32, 'Harry Potter és a Félvér Herceg - 6. könyv', 'J.K. Rowling', '9831232144161', '2005-06-16', 6165, 1, 'https://s01.static.libri.hu/cover/d8/e/716068_4.jpg', 'A Harry Potter sorozat hatodik kötete 2006. február 10-én jelenik meg magyar nyelven az Animus Kiadó gondozásában. A szerző nem árulja el előre, hogy ki a címben szereplő félvér herceg, csak annyit közölt, hogy nem az immár hatodéves varázslótanonc, de nem is Lord Voldemort, a gonosz varázsló. A regény egyik szereplője meghal - egyelőre titok, hogy ki. ', 0, NULL, NULL),
(33, 'Harry Potter és a Halál ereklyéi - 7. könyv', 'J.K. Rowling', '9831232144261', '2007-07-21', 6165, 1, 'https://s01.static.libri.hu/cover/0c/e/682623_4.jpg', 'Ujjait öntudatlanul a karjába fúrta, mintha fizikai fájdalommal viaskodna. Össze sem tudta számolni, hányszor hullott már a vére. Egyszer elvesztette a jobb karja összes csontját, s ennek az útnak a során a homlokán és a kezén viselt sebhely mellé máris szerzett még egyet a mellkasára és párat az alkarjára, se mindeddig soha, egyetlenegyszer sem érezte azt, amit most: hogy végzetesen meggyengült, hogy pőre és kiszolgáltatott lett, hogy varázsereje legjavától fosztották meg. Hermione, ha ezt elpanaszolná neki, azt mondaná, a pálca annyit ér csak, amennyit a varázsló, aki használja. De Hermione nem tudhatja ezt, ő nem élte át, hogy a pálcája magától meglódul, akár az iránytű, és aranyló lángolkat lő az ellenségre. Harry most érezte csak át igazán, hogy mennyire bízott őrangyalában, a pálcájában lévő ikermagban, most, mikor már elveszítette azt.', 0, NULL, NULL),
(34, 'A szél neve', 'Patrick Rothfuss', '9789632936423', '2007-03-27', 3990, 1, 'https://s01.static.libri.hu/cover/44/8/1941063_4.jpg', 'A kortárs epikus fantasy egyik mesterművében a Krónikás egy útszéli fogadóban belefog, hogy lejegyezze Kvothe történetét, aki hétköznapi fiúból a világ leghírhedtebb varázslójává és rettegett királygyilkossá vált. Kvothe vándorkomédiások között nevelkedik, amíg apja és anyja, valamint a társulat többi tagja áldozatául nem esik a földöntúli gonosz erőnek, mert olyan titkokat kutatott, amelyeket nem kellett volna. A fiú az egyetlen, aki életben maradt.Sok viszontagság után jelentkezik a mágia legendás egyetemére, hogy helyet harcoljon ki magának a világban, feltárja szülei halálának titkát és megtanulja, hogyan szólítsa magához a szelet. Patrick Rothfuss lebilincselő regénye egy legendákkal teli, veszedelmes világ és egy rendkívüli ifjú történetét meséli el. ', 0, NULL, NULL),
(35, 'Háború és béke', 'Leo Tolstoy', '9781400079988', '1869-01-01', 14240, 1, 'https://m.media-amazon.com/images/I/81W6BFaJJWL._AC_UF1000,1000_QL80_.jpg', '1805, csillogó moszkvai és szentpétervári bálok, ifjonti szerelmek, boldogtalan házasságok. 1812, Napóleon hadserege betör Oroszországba. Tolsztoj regénye a világirodalom három legismertebb alakjának sorsát követi: Pjotr Bezuhov egy gróf törvénytelen gyermeke, akinek meg kell küzdenie az örökségéért, miközben a spirituális teljességre áhítozik. Andrej Bolkonszkij herceg hátrahagyja a családját, hogy harcoljon Napóleon ellen. Natasa Rosztova egy orosz arisztokrata szép, fiatal lánya, aki mindkét férfinak felkelti az érdeklődését.', 0, NULL, NULL),
(36, 'A katedrális', 'Ken Follett', '3948572613843', '1989-10-03', 5500, 1, 'https://s01.static.libri.hu/cover/3d/f/6018735_4.jpg', 'Monumentális történelmi regény, amely a középkori Angliában egy hatalmas katedrális építésének hátterét és emberi drámáit mutatja be.', 0, NULL, NULL),
(37, 'Farkasbőrben', 'Hilary Mantel', '2039487563841', '2009-04-30', 4800, 1, 'https://moly.hu/system/covers/big/covers_504609.jpg?1534276104', 'Az Angliában zajló Tudor-kor politikai játszmáit és Thomas Cromwell felemelkedését bemutató történelmi regény.', 0, NULL, NULL),
(38, 'A rózsa neve', 'Umberto Eco', '3048571927385', '1980-10-10', 5100, 1, 'https://moly.hu/system/covers/big/covers_798486.jpg', 'Középkori krimi és filozófiai mestermű, amely egy bencés kolostorban történt rejtélyes gyilkosságokat göngyölít fel.', 0, NULL, NULL),
(39, 'Pompeji', 'Robert Harris', '2938475628372', '2003-11-03', 4700, 1, 'https://images2.penguinrandomhouse.com/cover/9780812974614', 'A Vezúv kitörésének előestéjén játszódó történelmi thriller, amely egy vízmérnök szemszögéből mutatja be az ókori világ végzetes napját.', 0, NULL, NULL),
(40, 'Bűn és bűnhődés', 'Fyodor Dostoevsky', '9780486415871', '1866-01-01', 4700, 1, 'https://s01.static.libri.hu/cover/b4/2/9691658_4.jpg', '- Bűn? Miféle bűn? - kiáltott az fel egyszerre tombolva. - Az, hogy megöltem azt az ocsmány, kártékony tetvet, azt az uzsorás vénasszonyt, akinek az elpusztításáért negyven vétkét megbocsátják az embernek, aki a szegények életnedvét szívta, ez lenne bűn? Dehogy törődöm vele, eszem ágában sincs elmosni. Mit böködnek felém mindenfelől: \'bűn, bűn!\' Csak most látom igazán, micsoda ostobán gyenge jellem vagyok, most, miután rászántam magam, hogy vállalom ezt a felesleges szégyent! Egyszerűen gyengeségből, tehetségtelenségből szántam el magam, meg talán az előny reményében, ahogy ez a... Porfirij tanácsolta! - Bátyám, bátyám, miket beszélsz! Hiszen vért ontottál! - kiáltott fel kétségbeesetten Dunya. - Mindenki ontja - kapott a szón szinte önkívületben Raszkolnyikov -, a vér folyton ömlik, mindig is ömlött a világban, mint a vízesés, mint a pezsgő, és aki elköveti, megkoronázzák érte a Capitoliumon, és utóbb az emberiség jótevőjének nevezik. Nézz körül alaposan, és vedd észre! Én jót akartam az embereknek, és száz és ezer jó dolgot tettem volna e helyett az egy ostobaság helyett, még csak nem is ostobaság, csak ügyetlenség, mert a gondolat maga egyáltalán nem volt olyan ostoba, amilyennek most látszik, a kudarc után. (A kudarc után minden ostobaságnak látszik!) Ezzel az ostobasággal csak azt akartam elérni, hogy független legyek, hogy megtegyem az első lépést, megszerezzem az eszközöket, akkor aztán mindent elsimított volna a mérhetetlenül nagyobb haszon. De én, én... az első lépést sem bírtam ki, mert hitvány vagyok! Ez itt a lényeg! De azért sem fogom a ti szemetekkel nézni magamat: ha sikerült volna, koronát tesznek a fejemre, így meg csapdában vergődöm!', 0, NULL, NULL),
(41, 'Az üvegbura', 'Sylvia Plath', '3948572612933', '1963-01-14', 4500, 1, 'https://s01.static.libri.hu/cover/4e/3/6608420_4.jpg', 'Egy fiatal nő mentális leépülésének és identitáskeresésének megrázó története önéletrajzi ihletéssel.', 0, NULL, NULL),
(42, 'A félkegyelmű', 'Fjodor Dosztojevszkij', '2039487564834', '1869-01-01', 5200, 1, 'https://s01.static.libri.hu/cover/86/d/736216_4.jpg', 'Egy tiszta szívű, naiv férfi története, aki egy erkölcsileg romlott társadalomban próbál boldogulni.', 0, NULL, NULL),
(43, 'Trainspotting', 'Irvine Welsh', '3948572619387', '1993-01-01', 4900, 1, 'https://marvin.bline.hu/product_images/964/E31793.JPG', 'Nyers és provokatív regény, amely egy skóciai heroinfüggő fiatalok életébe enged bepillantást.', 0, NULL, NULL),
(44, 'Beszélnünk kell Kevinről', 'Lionel Shriver', '2039487562912', '2003-01-01', 4700, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/857/1191857.jpg', 'Megrázó és elgondolkodtató történet egy anya szemszögéből, aki próbálja megérteni, miért lett a fia tömeggyilkos.', 0, NULL, NULL),
(45, 'A Gyűrűk Ura I-III.', 'J.R.R. Tolkien', '9780261103252', '1954-07-29', 7500, 1, 'https://s01.static.libri.hu/cover/50/e/4173195_4.jpg', ' A Gyűrűk Ura tündérmese. Mégpedig -- legalábbis terjedelmét tekintve -- alighanem minden idők legnagyobb tündérmeséje. Tolkien képzelete szabadon, ráérősen kalandozik a könyv három vaskos kötetében -- vagyis abban a képzelt időben, mikor a világ sorát még nem az ember szabta meg, hanem a jót és szépet, a gonoszat és álnokot egyaránt ember előtti lények, ősi erők képviselték. Abban az időben, mikor a mi időszámításunk előtt ki tudja, hány ezer, tízezer esztendővel a Jó kisebbségbe szorult erői szövetségre léptek, hogy a Rossz erőit legyőzzék: tündérek, féltündék, az ősi Nyugat-földe erényeit őrző emberek, törpök és félszerzetek, erdő öregjei fogtak össze, hogy a jó varázslat eszközével, s a nagy mágus, Gandalf vezetésével végül győzelmet arassanak, de épp e győzelem következtében elenyésszen az ő idejük, s az árnyak birodalmába áthajózva átadják a földet új urának, az emberfajnak.', 0, NULL, NULL),
(46, 'Trónok harca', 'George R.R. Martin', '9789632936423', '1996-08-06', 3990, 1, 'https://upload.wikimedia.org/wikipedia/hu/9/98/T%C5%B1z_%C3%A9s_j%C3%A9g_dala_1_-_Tr%C3%B3nok_harca.gif', 'Westeros hét királyságát egykor a sárkánykirályok uralták. Vérrel és tűzzel teli uralmuknak Robert Baratheon vetett véget, aki letaszította a Vastrónról az utolsó, őrült Targaryen királyt. Azonban Robertet külső és belső ellenségek fenyegetik, és amikor jobbkeze, a hűséges Jon Arryn váratlanul meghal, legrégebbi barátjához és fegyvertársához, a hideg Északot kormányzó Eddard Starkhoz fordul segítségért. Deres végletekig hűséges, egyenes és merev ura egyedül találja magát a királyi udvarban, ahol senki és semmi sem az, aminek látszik, és egyre erősödik benne a gyanú, hogy Jon Arryn halála nem volt véletlen. Egy kontinenssel arrébb az utolsó sárkányherceg húgát bocsájtja áruba, hogy visszaszerezze a trónt, ám Robert legveszélyesebb ellenségei sokkal közelebb rejtőznek. Miközben az ambiciózus nagyurak és mindenre elszánt trónkövetelők dögkeselyűként köröznek a Vastrón körül, az emberek világát védő Falon túl feltámadnak a hideg szelek, és egy ősi fenyegetés kel újra életre. Westeros hosszú nyara véget érőben van; közeleg a tél.', 0, NULL, NULL),
(47, 'Az Idő Kereke-sorozat', 'Robert Jordan', '9789632936123', '1990-01-15', 3990, 1, 'https://i.cdn29.hu/apix_collect_c/2107/the-wheel-of-time-sorozat/the_wheel_of_time_sorozat_screenshot_20211229203212_3_original_560x313_cover.jpg', 'Az Idő Kereke (The Wheel of Time, közkeletű rövidítéssel WoT) egy epikus fantasyregény-sorozat, melyet az amerikai James Oliver Rigney Jr., írói nevén Robert Jordan indított útjára. Eredetileg hatkötetesre tervezett sorozat lett volna, de a hossza egyre csak növekedett, és végül 14 könyv került kiadásra. Egy előzménytörténetet is kiadtak. Jordan az első könyvet 1984-ben kezdte el írni, és 1990-ben került kiadásra. ', 0, NULL, NULL),
(48, 'A ragyogás', 'Stephen King', '9789632548117', '1977-01-28', 4500, 1, 'https://s01.static.libri.hu/cover/5c/9/4832423_4.jpg', '- Minden nagy szállodának vannak botrányai - mondta. - Ahogy kísértet is van minden nagy szállodában. Hogy miért? A fenébe is, az emberek jönnek-mennek. Megesik, hogy valamelyik a szobájában dobja fel a talpát, a szíve, vagy gutaütés, vagy valami ilyesmi. A szálloda babonás hely. Nincs tizenharmadik emelet, nincs tizenhármas szoba, nincs tükör az ajtón, amin az ember bemegy, meg hasonlók.', 0, NULL, NULL),
(49, 'Kedvencek temetője', 'Stephen King', '9789632643274', '1993-01-01', 3200, 1, 'https://s01.static.libri.hu/cover/8a/e/5133250_4.jpg', 'Dr. Louis Creed, a fiatal orvos kitűnő állást kapott: a Maine-i Egyetem rendelőjének lett a vezetője, ezért Chicagóból az idilli New England-i tájban álló, magányos házba költözik családjával - feleségével, Rachellel, ötéves lányukkal, Ellie-vel és másfél éves kisfiukkal, Gage-dzsel. Boldogan, a szép jövő reményében veszik birtokukba új otthonukat... Az első gondra az út túloldalán, velük átellenben élő öregember, Jud hívja föl a figyelmüket: a tájat kettészelő országúton éjjel-nappal olajszállító tartálykocsik dübörögnek, halálos veszélynek téve ki a háziállatokat és az apróságokat. Nem véletlenül van a közelben egy nyomasztó légkörű, ódon temető az elgázolt háziállatok számára... Az első trauma akkor éri Louist, amikor egy baleset áldozatául esett, haldokló fiú a rendelőben dadogó szavakkal óva inti az állattemetőn túli veszedelemtől. Nem sokra rá egy tartálykocsi elgázolja Ellie imádott macskáját, és az öreg Jud - jó- vagy rosszakaratból? - az állattemetőn túli, hátborzongató vidékre, a micmac indiánok egykori temetkezőhelyére viszi Louist, s ott földelteti el vele az állatot. Másnap a macska visszatér - de ocsmány jószág lett belőle: lomha, ijesztően bűzlő és gonosz. Aztán néhány békés hónap után a kis Gage elszabadul a szüleitől, és szaladni kezd pici lábain az országút felé...King borzalmakkal teli regénye magyarul 1993-ban jelent meg először, Állattemető címen.', 0, NULL, NULL),
(50, 'Hill House szelleme', 'Shirley Jackson', '9789634791672', '1959-10-16', 3490, 1, 'https://www.mafab.hu/static/2018/262/11/307290_1537437491.9701.jpg', 'Egy klasszikus horrorregény, amely egy kísértetjárta házban játszódik, és az emberi psziché mélységeit tárja fel.', 0, NULL, NULL),
(51, 'Carrie', 'Stephen King', '9780450031069', '1974-04-05', 2990, 1, 'https://s01.static.libri.hu/cover/11/5/7307518_4.jpg', 'Stephen King első regénye egy tinédzser lányról, aki felfedezi telekinetikus képességeit, és bosszút áll az őt bántalmazókon.', 0, NULL, NULL),
(52, 'Holly', 'Stephen King', '9781982177697', '2023-09-05', 5990, 1, 'https://europakiado.hu/content/2024/1/Product/preview/king_holly_borito_300dpi.jpg', 'Stephen King legújabb regénye Holly Gibney nyomozóról, aki egy rejtélyes ügyet próbál megoldani.', 0, NULL, NULL),
(53, 'Hunting Adeline', 'H. D. Carlton', '7347532773465', '2021-08-17', 4800, 1, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcRU_EXlA9bYUvQ_ot71LIrhP99hKd8audHB2Wa-6Aim1JtZG92ty0f4rPBInRL_uwUVSX2CTuuGAXisp7jAW6gANyfOkVdPGMX4Z7Qui9JMNCZljp-RdkfFZ9aDxxqYDrCKmWms3g&usqp=CAc', 'Egy sötét romantikus thriller H.D. Carlton tollából, amelyben egy nő macska-egér játékba keveredik egy veszélyes üldözővel.', 0, NULL, NULL),
(54, 'Icebreaker', 'Hannah Grace', '2836555385244', '2022-02-01', 4200, 1, 'https://moly.hu/system/covers/big/covers_763852.jpg?1663615032', ' Hannah Grace jégkorongos románca, ahol egy műkorcsolyázó és egy hokijátékos között váratlanul fellángol a szenvedély', 0, NULL, NULL),
(55, 'Red, White & Royal Blue', 'Casey McQuiston', '7204033193022', '2019-05-14', 4100, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/881/2498881.jpg', 'Casey McQuiston LGBTQ+ romantikus regénye, amely egy amerikai elnök fia és egy brit herceg titkos szerelméről szól.', 0, NULL, NULL),
(56, 'Bride', 'Ali Hazelwood', '1638262424943', '2023-06-06', 4600, 1, 'https://s01.static.libri.hu/cover/a7/c/10675258_4.jpg', 'Ali Hazelwood sci-fi romantikája, amely egy paranormális világban játszódik, ahol egy nő egy veszélyes házasságba kényszerül.', 0, NULL, NULL),
(57, 'Twisted Hate', 'Ana Huang', '2623229610032', '2022-01-27', 4500, 1, 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQwo6dWS_dyGk1A5J7GE0Z6IZ7Xd7jq-5XYK-oYYcEzgtVH9kF0yBffwMUEYYCf4xt4ak6nQAAGoE5NlBiTqK7Yke891yMloAV4yK2wOnt-OIFKERpvJdVr9w&usqp=CAc', 'Ana Huang szenvedélyes ellenségekből szeretőkké váló románca, tele feszültséggel és sötét titkokkal.', 0, NULL, NULL),
(58, 'Wildfire', 'Hannah Grace', '7890076306114', '2023-07-18', 4400, 1, 'https://lira.erbacdn.net/upload/M_28/rek1/38/3981038.jpg', ' Hannah Grace jégkorongos sorozatának második kötete, amelyben a nyári táborban fellángoló érzelmek kerülnek középpontba.', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `book_category`
--

CREATE TABLE `book_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `book_category`
--

INSERT INTO `book_category` (`id`, `book_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 2, NULL, NULL),
(7, 7, 3, NULL, NULL),
(8, 8, 3, NULL, NULL),
(9, 9, 3, NULL, NULL),
(10, 10, 3, NULL, NULL),
(11, 11, 2, NULL, NULL),
(12, 12, 2, NULL, NULL),
(13, 13, 2, NULL, NULL),
(14, 14, 4, NULL, NULL),
(15, 15, 4, NULL, NULL),
(16, 16, 4, NULL, NULL),
(17, 17, 4, NULL, NULL),
(18, 18, 5, NULL, NULL),
(19, 19, 5, NULL, NULL),
(20, 20, 5, NULL, NULL),
(21, 21, 6, NULL, NULL),
(22, 22, 6, NULL, NULL),
(23, 23, 6, NULL, NULL),
(24, 24, 6, NULL, NULL),
(25, 25, 6, NULL, NULL),
(26, 26, 7, NULL, NULL),
(27, 27, 7, NULL, NULL),
(28, 28, 7, NULL, NULL),
(29, 29, 7, NULL, NULL),
(30, 30, 7, NULL, NULL),
(31, 31, 7, NULL, NULL),
(32, 32, 7, NULL, NULL),
(33, 33, 7, NULL, NULL),
(34, 34, 7, NULL, NULL),
(35, 35, 8, NULL, NULL),
(36, 36, 8, NULL, NULL),
(37, 37, 8, NULL, NULL),
(38, 38, 8, NULL, NULL),
(39, 39, 8, NULL, NULL),
(40, 40, 9, NULL, NULL),
(41, 41, 9, NULL, NULL),
(42, 42, 9, NULL, NULL),
(43, 43, 9, NULL, NULL),
(44, 44, 9, NULL, NULL),
(45, 45, 10, NULL, NULL),
(46, 46, 10, NULL, NULL),
(47, 47, 10, NULL, NULL),
(48, 48, 11, NULL, NULL),
(49, 49, 11, NULL, NULL),
(50, 50, 11, NULL, NULL),
(51, 51, 11, NULL, NULL),
(52, 52, 11, NULL, NULL),
(53, 53, 12, NULL, NULL),
(54, 54, 12, NULL, NULL),
(55, 55, 12, NULL, NULL),
(56, 56, 12, NULL, NULL),
(57, 57, 12, NULL, NULL),
(58, 58, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`id`, `CategoryName`, `created_at`, `updated_at`) VALUES
(1, 'Modern irodalom', NULL, NULL),
(2, 'Klasszikus irodalom', NULL, NULL),
(3, 'Disztópia', NULL, NULL),
(4, 'Romantikus regény', NULL, NULL),
(5, 'Amerikai irodalom', NULL, NULL),
(6, 'Kalandregény', NULL, NULL),
(7, 'Fantasy', NULL, NULL),
(8, 'Történelmi regény', NULL, NULL),
(9, 'Pszichológiai regény', NULL, NULL),
(10, 'Epikus fantasy', NULL, NULL),
(11, 'Horror', NULL, NULL),
(12, 'Erotikus', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_27_000003_create_categories_table', 1),
(5, '2025_01_27_000004_create_books_table', 1),
(6, '2025_01_27_000006_create_payment_methods_table', 1),
(7, '2025_01_27_000007_create_orders_table', 1),
(8, '2025_01_27_000008_create_orderitems_table', 1),
(9, '2025_01_27_000009_create_payments_table', 1),
(10, '2025_01_27_00003_create_personal_access_tokens_table', 1),
(11, '2025_01_28_103123_create_book_category_table', 1),
(12, '2025_02_27_112634_create_rating_table', 1),
(13, '2025_03_03_110612_create_comments_table', 1),
(14, '2025_03_11_082616_create_shipping_table', 1),
(15, '2025_03_13_110643_add_total_price_to_orderitems_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orderitems`
--

CREATE TABLE `orderitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `BooksTotalPrice` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `OrderDate` date NOT NULL,
  `Status` varchar(255) NOT NULL,
  `TotalAmount` int(11) NOT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `paymentmethod_id` bigint(20) UNSIGNED NOT NULL,
  `PaymentDate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MethodName` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `MethodName`, `created_at`, `updated_at`) VALUES
(1, 'Utánvét', '2025-04-19 14:04:43', '2025-04-19 14:04:43'),
(2, 'Banki átutalás', '2025-04-19 14:04:43', '2025-04-19 14:04:43');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rating`
--

CREATE TABLE `rating` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shipping`
--

CREATE TABLE `shipping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `fee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `Username`, `email`, `email_verified_at`, `password`, `FullName`, `PhoneNumber`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Zsozso', 'gortler.zsolt@gmail.com', '2025-02-27 23:00:00', '$2y$12$XdyYpitR79Ipyho2mMuqCOhSNnLLEUFCg/SROO0NDRk4qWg7eKN.i', 'Gortler Zsolt', '+36205490150', 'admin', NULL, NULL, NULL),
(2, 'Gandalfiki', 'k955658@gmail.com', '2025-02-27 23:00:00', '$2y$12$npQRsHsFMZzi1nRssbNYoeQz3lBnvE1uOMebI8x45DP8xyT9zMbHC', 'Szaniszlo Balint', '+36205029699', 'admin', NULL, NULL, NULL),
(3, 'Tesztelő', 'vizsgaremek@outlook.com', '2025-02-27 23:00:00', '$2y$12$ArFx24zdIewAn8XCPkMOo.TOmdcvb0SbBjoozvjeUbx.AZtOe26my', 'Teszt Elek', '+36205490434', 'admin', NULL, NULL, NULL);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_category_book_id_foreign` (`book_id`),
  ADD KEY `book_category_category_id_foreign` (`category_id`);

--
-- A tábla indexei `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- A tábla indexei `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_book_id_foreign` (`book_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- A tábla indexei `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderitems_order_id_foreign` (`order_id`),
  ADD KEY `orderitems_book_id_foreign` (`book_id`);

--
-- A tábla indexei `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_paymentmethod_id_foreign` (`paymentmethod_id`);

--
-- A tábla indexei `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rating_user_id_book_id_unique` (`user_id`,`book_id`),
  ADD KEY `rating_book_id_foreign` (`book_id`);

--
-- A tábla indexei `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- A tábla indexei `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_order_id_foreign` (`order_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`Username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_fullname_unique` (`FullName`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`PhoneNumber`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT a táblához `book_category`
--
ALTER TABLE `book_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT a táblához `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT a táblához `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `orderitems_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_paymentmethod_id_foreign` FOREIGN KEY (`paymentmethod_id`) REFERENCES `payment_methods` (`id`);

--
-- Megkötések a táblához `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Megkötések a táblához `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

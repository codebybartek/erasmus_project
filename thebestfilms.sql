-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 28 Maj 2019, 19:59
-- Wersja serwera: 5.7.24-0ubuntu0.18.04.1
-- Wersja PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `thebestfilms`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `title_article` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description_article` text COLLATE utf8_slovenian_ci NOT NULL,
  `date_article` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img_art` text COLLATE utf8_slovenian_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `url_address` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Zrzut danych tabeli `article`
--

INSERT INTO `article` (`id_article`, `title_article`, `description_article`, `date_article`, `img_art`, `id_user`, `url_address`) VALUES
(18, 'Disney\'s \'Aladdin\' Soars Over Memorial Day Weekend at the Box Office', 'Disney\'s Aladdin topped the weekend with an impressive debut, delivering over $85 million for the three-day and is expected to top $100 million for the four-day, Memorial Day holiday weekend.', '2019-05-27 17:59:21', '../assets/images/aladdin.jpg', 1, 'https://www.boxofficemojo.com/news/?id=4515'),
(25, 'â€˜The Last Watchâ€™: â€˜Game of Thronesâ€™ Castâ€™s Honest Reactions and More Takeaways From Heartfelt Doc', 'â€œGame of Thronesâ€ finally delivers the beautiful, epic, and heartfelt farewell that fans want â€” not with the finale episode but through the behind-the-scenes documentary â€œThe Last Watch.â€ Helmed by â€œSeahorseâ€ director Jeanie Finlay, itâ€™s a remarkable snapshot of the people whoâ€™ve given their lives to the sprawling production.', '2019-05-27 18:13:33', '../assets/images/Game-of-Thrones-ending-GOT-book-800x400.jpg', 1, 'https://www.indiewire.com/2019/05/game-of-thrones-documentary-kit-harington-last-watch-jeanie-finlay-hbo-1202145050/'),
(26, 'Cannes: Bong Joon-ho\'s \'Parasite\' Wins Palme d\'Or', 'A star-studded Cannes Film Festival came to a close Saturday night with a bang as Bong Joon-ho\'s Parasite took home the Palme d\'Or, while Mati Diop\'s Atlantics landed the runner-up Grand Prix award.\r\n\r\nThe Parasite win denied Once Upon a Time in Hollywood director Quentin Tarantino his second top Cannes prize of his career (the helmer won the Palme dâ€™Or 25 years ago for his groundbreaking Pulp Fiction) as his widely praised new pic came up empty-handed at the ceremony.', '2019-05-28 09:55:43', '../assets/images/bong_joon-ho.jpg', 1, 'https://www.hollywoodreporter.com/news/cannes-bong-joon-hos-parasite-wins-palme-dor-1213729');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` text COLLATE utf32_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id_category`, `name_category`) VALUES
(1, 'drama'),
(2, 'horror'),
(3, 'romantic'),
(4, 'comedy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `body_comment` text COLLATE utf32_polish_ci NOT NULL,
  `id_film` int(11) DEFAULT NULL,
  `id_series` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `date_comment` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id_comment`, `body_comment`, `id_film`, `id_series`, `id_user`, `date_comment`) VALUES
(59, 'sdfsdfsd', NULL, NULL, 1, '2019-05-21 15:44:41'),
(60, 'hggf', NULL, NULL, 1, '2019-05-21 15:45:34'),
(68, 'Great series!', NULL, 1, 1, '2019-05-27 17:39:07');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `countries`
--

CREATE TABLE `countries` (
  `id_country` int(11) NOT NULL,
  `country` text COLLATE utf32_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `countries`
--

INSERT INTO `countries` (`id_country`, `country`) VALUES
(1, 'USA'),
(2, 'France'),
(3, 'UK'),
(4, 'Spain');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `episode`
--

CREATE TABLE `episode` (
  `id_episode` int(11) NOT NULL,
  `episode_aired` date NOT NULL,
  `episode_name` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `episode_description` text COLLATE utf8_slovenian_ci NOT NULL,
  `id_season` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Zrzut danych tabeli `episode`
--

INSERT INTO `episode` (`id_episode`, `episode_aired`, `episode_name`, `episode_description`, `id_season`) VALUES
(1, '2011-04-18', 'Winter Is Coming', 'Eddard Stark is torn between his family and an old friend when asked to serve at the side of King Robert Baratheon; Viserys plans to wed his sister to a nomadic warlord in exchange for an army.', 1),
(9, '2011-04-25', 'The Kingsroad ', 'While Bran recovers from his fall, Ned takes only his daughters to King\'s Landing. Jon Snow goes with his uncle Benjen to the Wall. Tyrion joins them.', 1),
(10, '2011-05-23', 'Lord Snow', 'Jon begins his training with the Night\'s Watch; Ned confronts his past and future at King\'s Landing; Daenerys finds herself at odds with Viserys.', 1),
(11, '2011-05-30', 'Cripples, Bastards, and Broken Things', 'Eddard investigates Jon Arryn\'s murder. Jon befriends Samwell Tarly, a coward who has come to join the Night\'s Watch.', 1),
(12, '2011-06-06', 'The Wolf and the Lion', 'Catelyn has captured Tyrion and plans to bring him to her sister, Lysa Arryn, at the Vale, to be tried for his, supposed, crimes against Bran. Robert plans to have Daenerys killed, but Eddard refuses to be a part of it and quits.', 1),
(13, '2011-06-13', 'A Golden Crown', 'While recovering from his battle with Jaime, Eddard is forced to run the kingdom while Robert goes hunting. Tyrion demands a trial by combat for his freedom. Viserys is losing his patience with Drogo.', 1),
(14, '2011-06-20', 'You Win or You Die', 'Robert has been injured while hunting and is dying. Jon and the others finally take their vows to the Night\'s Watch. A man, sent by Robert, is captured for trying to poison Daenerys. Furious, Drogo vows to attack the Seven Kingdoms.', 1),
(15, '2011-06-27', 'The Pointy End', 'The Lannisters press their advantage over the Starks; Robb rallies his father\'s northern allies and heads south to war; The White Walkers attack the Wall; Tyrion returns to his father with some new friends.', 1),
(16, '2011-07-04', 'Baelor', 'Robb goes to war against the Lannisters. Jon finds himself struggling on deciding if his place is with Robb or the Night\'s Watch. Drogo has fallen ill from a fresh battle wound. Daenerys is desperate to save him.', 1),
(17, '2011-07-11', 'Fire and Blood', 'Robb vows to get revenge on the Lannisters. Jon must officially decide if his place is with Robb or the Night\'s Watch. Daenerys says her final goodbye to Drogo.', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `films`
--

CREATE TABLE `films` (
  `Id_film` int(11) NOT NULL,
  `title_film` text COLLATE utf32_polish_ci NOT NULL,
  `description_film` text COLLATE utf32_polish_ci NOT NULL,
  `img_film` text COLLATE utf32_polish_ci NOT NULL,
  `date_film` int(11) NOT NULL,
  `director_film` text COLLATE utf32_polish_ci NOT NULL,
  `id_country` int(11) NOT NULL,
  `trailer_film` text COLLATE utf32_polish_ci NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `films`
--

INSERT INTO `films` (`Id_film`, `title_film`, `description_film`, `img_film`, `date_film`, `director_film`, `id_country`, `trailer_film`, `id_category`) VALUES
(27, 'Forgetting Sarah Marshall2', 'Peter Bretter is a professional composer. After parting with actress Sarah Marshall is experiencing a nervous breakdown. He goes to Hawaii with the advice of a friend. It turns out that she is also there with a new boyfriend. To make matters worse, all rooms are booked except for a very expensive apartment ...', '../assets/images/forgetting_sarah_marshall.jpg', 2007, 'Nicholas Stoller', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/Z-TOWpIKDP8&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 4),
(28, 'The Shawshank2 Redemption', 'The film was based on the story of Stephen King Rita Hayworth and Shawshank Redemption . He tells the story of Andy Dufresne, a banker who is unjustly sentenced to a double life sentence for murdering his wife and her lover. He goes to Shawshank prison, in which sadistic guards and an overbearing governor rule. However, despite everything, it does not break down.\r\n\r\nInterestingly, the film did not accumulate large audiences during cinema screenings, and only recently distributed on cassettes and discs began to bring great successes. Currently, he is often mentioned in the rankings of the best films of all time.', '../assets/images/shawshank.jpg', 1996, 'Nick Cassavetes', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/6hB3S9bIaco&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(29, 'Gran Torino', 'Walt Kowalski, an American of Polish descent, a veteran of the Korean war, is a burly and harsh conservative for his relatives and neighbors. He does not like strangers and openly expresses himself with contempt for &quot;blacks&quot;, &quot;yolk&quot; and other nationalities; there is also no good relationship with your family. Under the mask of the tetrka, however, there is an honest and decent man, guided by his own conscience and principles seemingly not suited to the contemporary mentality of the Americans. The main theme of the film begins when Walt catches a young immigrant trying to steal his car, commissioned by a local gang. The theft of the classic car model of Walt Kowalski - Ford Gran Torino from 1972 - was supposed to be a criminal initiation of Thao, coming from an immigrantthe boy\'s family, Walt\'s neighbor. Despite the difficult circumstances and the great cultural diversity, the consistent operation of the traditional Thao family and Walt\'s (American) traditionalism find common ground. For Thao, brought up in a house full of women, Walt becomes a male model of behavior. The boy learns the universal principles of operation, both in everyday and extraordinary situations that take place during the return of the movie and in the solution.', '../assets/images/torino.jpg', 2009, '', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/Z-TOWpIKDP8&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(30, '21', '21 - drama from 2008 produced by Columbia Pictures . Directed by Australian Robert Luketica ( Legal blonde ). It is played by Jim Sturgess , Kevin Spacey , Kate Bosworth and Laurence Fishburne . The film was inspired by the real story of a group of MIT students . It is the screening of the best-seller Ben Mezrich Bringing Down The House', '../assets/images/21.jpg', 2009, '', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/7uYESECSFYY&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(31, 'The Notebook', 'Allie suffers from Alzheimer \'s disease living in a social care home. He does not remember events from the past, he does not even recognize family members. Her husband Noah, however, does not give up fighting for his wife and tries to help her regain her lost memories, unfortunately in vain.\r\n\r\nIn the end, he decides to read aloud every day the love story of two young hearts that moves Allie to the depths. She does not realize, however, that this is their own story. Young Allie, a rich girl from the city, meets during holidays spent in Seabrook ( North Carolina)) a poor and rough boy from the Noah province. Teenagers fall in love and, despite their differences, they quickly recognize that their love is unique and enjoys a carefree and exciting summer in the countryside. However, Allie\'s parents are anxiously watching their relationship. When they notice that for Allie, this feeling is more than just a summer romance, they immediately take her back to the city. Every day, throughout the year, Noah writes romantic letters to her beloved, but Allie does not receive any of them, because her mother stops them. After one year, Noah enlists for the army and fights on America in the Second World War. When he returns, he renovates the house, where during the memorable summer they experienced their first time. Noah still loves her and despite relationships with other women he can not forget about her.', '../assets/images/notebook.jpg', 2004, '', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/FC6biTjEyZw&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 3),
(33, 'Avengers: Endgame', 'After the devastating events of Avengers: Infinity war (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to undo Thanos\' actions and restore order to the universe.', '../assets/images/avengers.jpg', 2019, 'Anthony Russo, Joe Russo', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/TcMBFSGVi1c&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(34, 'John Wick: Chapter 3 - Parabellum', 'Super-assassin John Wick is on the run after killing a member of the international assassin\'s guild, and with a $14 million price tag on his head - he is the target of hit men and women everywhere.', '../assets/images/johnwick3.jpg', 2019, 'Chad Stahelski', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/pU8-7BX9uxs&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rates`
--

CREATE TABLE `rates` (
  `id_rate` int(11) NOT NULL,
  `id_film` int(11) DEFAULT NULL,
  `id_series` int(11) DEFAULT NULL,
  `id_season` int(11) DEFAULT NULL,
  `id_episode` int(11) DEFAULT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `rates`
--

INSERT INTO `rates` (`id_rate`, `id_film`, `id_series`, `id_season`, `id_episode`, `rate`) VALUES
(2, NULL, NULL, 1, NULL, 1),
(3, NULL, NULL, 1, NULL, 1),
(5, NULL, NULL, 1, NULL, 5),
(6, NULL, 1, NULL, NULL, 4),
(7, 27, NULL, NULL, NULL, 3),
(8, 27, NULL, NULL, NULL, 5),
(9, 28, NULL, NULL, NULL, 5),
(10, 28, NULL, NULL, NULL, 5),
(11, 27, NULL, NULL, NULL, 5),
(12, NULL, 1, NULL, NULL, 4),
(13, NULL, NULL, 1, NULL, 4),
(14, NULL, NULL, NULL, 1, 3),
(15, 29, NULL, NULL, NULL, 4),
(16, 31, NULL, NULL, NULL, 4),
(17, 27, NULL, NULL, NULL, 3),
(18, 28, NULL, NULL, NULL, 5),
(19, 29, NULL, NULL, NULL, 5),
(20, 34, NULL, NULL, NULL, 5),
(21, 33, NULL, NULL, NULL, 5),
(22, NULL, 1, NULL, NULL, 4),
(23, NULL, 2, NULL, NULL, 5),
(24, NULL, 3, NULL, NULL, 5),
(25, NULL, 4, NULL, NULL, 3),
(26, 30, NULL, NULL, NULL, 3),
(27, 27, NULL, NULL, NULL, 2),
(28, 31, NULL, NULL, NULL, 3),
(29, NULL, NULL, 9, NULL, 2),
(30, NULL, NULL, 8, NULL, 3),
(31, NULL, NULL, 7, NULL, 4),
(32, NULL, NULL, 1, NULL, 5),
(33, NULL, NULL, 2, NULL, 5),
(34, NULL, NULL, 3, NULL, 4),
(35, NULL, NULL, 4, NULL, 4),
(36, NULL, NULL, 6, NULL, 4),
(37, NULL, NULL, NULL, 9, 4),
(38, NULL, NULL, NULL, 10, 4),
(39, NULL, NULL, NULL, 11, 5),
(40, NULL, NULL, NULL, 12, 3),
(41, NULL, NULL, NULL, 13, 2),
(42, NULL, NULL, NULL, 14, 5),
(43, NULL, NULL, NULL, 15, 2),
(44, NULL, NULL, NULL, 16, 4),
(45, NULL, NULL, NULL, 17, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_role` text COLLATE utf32_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id_role`, `name_role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'moderator');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `season`
--

CREATE TABLE `season` (
  `id_season` int(11) NOT NULL,
  `season_name` int(11) NOT NULL,
  `season_year` year(4) NOT NULL,
  `id_series` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Zrzut danych tabeli `season`
--

INSERT INTO `season` (`id_season`, `season_name`, `season_year`, `id_series`) VALUES
(1, 1, 2011, 1),
(2, 2, 2012, 1),
(3, 3, 2013, 1),
(4, 4, 2014, 1),
(6, 5, 2015, 1),
(7, 6, 2016, 1),
(8, 7, 2017, 1),
(9, 8, 2019, 1),
(10, 1, 2005, 2),
(11, 1, 2008, 3),
(12, 1, 2006, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `series`
--

CREATE TABLE `series` (
  `id_series` int(11) NOT NULL,
  `title_series` text COLLATE utf32_polish_ci NOT NULL,
  `description_series` text COLLATE utf32_polish_ci NOT NULL,
  `img_series` text COLLATE utf32_polish_ci NOT NULL,
  `date_series` int(11) NOT NULL,
  `director_series` text COLLATE utf32_polish_ci NOT NULL,
  `id_country` int(11) NOT NULL,
  `trailer_series` text COLLATE utf32_polish_ci NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `series`
--

INSERT INTO `series` (`id_series`, `title_series`, `description_series`, `img_series`, `date_series`, `director_series`, `id_country`, `trailer_series`, `id_category`) VALUES
(1, 'Game of Thrones', 'Nine noble families fight for control over the mythical lands of Westeros, while an ancient enemy returns after being dormant for thousands of years.', '../assets/images/got.jpg', 2011, 'David Benioff, D.B. Weiss', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/522l0YE9hRQ&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(2, 'Supernatural', 'Two brothers follow their father\'s footsteps as hunters, fighting evil supernatural beings of many kinds, including monsters, demons, and gods that roam the earth.', '../assets/images/supernatural.jpg', 2005, 'Eric Kripke', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/t-775JyzDTk&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(3, 'Breaking bad', 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family\'s future.', '../assets/images/bb.jpg', 2008, 'Vince Gilligan', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/HhesaQXLuRY&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1),
(4, 'Dexter', 'By day, mild-mannered Dexter is a blood-spatter analyst for the Miami police. But at night, he is a serial killer who only targets other murderers.', '../assets/images/dexter.jpg', 2006, 'James Manos Jr.', 1, '&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/YQeUmSD1c3g&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(255) COLLATE utf32_polish_ci NOT NULL,
  `password_user` varchar(255) COLLATE utf32_polish_ci NOT NULL,
  `email_user` text COLLATE utf32_polish_ci NOT NULL,
  `id_role` int(11) NOT NULL DEFAULT '2',
  `created_data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `name_user`, `password_user`, `email_user`, `id_role`, `created_data`) VALUES
(1, 'admin', 'c84258e9c39059a89ab77d846ddab909', 'admin@admin.pl', 1, '2019-03-03 23:20:52'),
(17, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.com', 2, '2019-02-28 01:01:09'),
(33, 'moderator', '0408f3c997f309c03b08bf3a4bc7b730', 'bakoziel@ucm.es', 3, '2019-05-22 16:24:26');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_series` (`id_series`);

--
-- Indeksy dla tabeli `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id_country`);

--
-- Indeksy dla tabeli `episode`
--
ALTER TABLE `episode`
  ADD PRIMARY KEY (`id_episode`),
  ADD KEY `id_season` (`id_season`);

--
-- Indeksy dla tabeli `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`Id_film`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_country` (`id_country`);

--
-- Indeksy dla tabeli `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id_rate`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_series` (`id_series`),
  ADD KEY `id_season` (`id_season`),
  ADD KEY `id_episode` (`id_episode`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeksy dla tabeli `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`id_season`),
  ADD KEY `id_series` (`id_series`);

--
-- Indeksy dla tabeli `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id_series`),
  ADD KEY `id_country` (`id_country`),
  ADD KEY `id_category` (`id_category`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT dla tabeli `countries`
--
ALTER TABLE `countries`
  MODIFY `id_country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `episode`
--
ALTER TABLE `episode`
  MODIFY `id_episode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `films`
--
ALTER TABLE `films`
  MODIFY `Id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `rates`
--
ALTER TABLE `rates`
  MODIFY `id_rate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `season`
--
ALTER TABLE `season`
  MODIFY `id_season` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `series`
--
ALTER TABLE `series`
  MODIFY `id_series` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`id_film`) REFERENCES `films` (`Id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`id_series`) REFERENCES `series` (`id_series`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `episode`
--
ALTER TABLE `episode`
  ADD CONSTRAINT `episode_ibfk_1` FOREIGN KEY (`id_season`) REFERENCES `season` (`id_season`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `films_ibfk_2` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `films` (`Id_film`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id_series`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rates_ibfk_3` FOREIGN KEY (`id_season`) REFERENCES `season` (`id_season`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rates_ibfk_4` FOREIGN KEY (`id_episode`) REFERENCES `episode` (`id_episode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `season`
--
ALTER TABLE `season`
  ADD CONSTRAINT `season_ibfk_1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id_series`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `series_ibfk_2` FOREIGN KEY (`id_country`) REFERENCES `countries` (`id_country`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

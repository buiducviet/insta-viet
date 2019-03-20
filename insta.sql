-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2018 at 06:22 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insta`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `data` longtext COLLATE utf8mb4_unicode_ci,
  `client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT NULL,
  `viewed` int(11) DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `type` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `seo`, `status`, `viewed`, `thumb`, `cover`, `slug`, `content`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Phim và hoạt ảnh', '{"title":"Xu h\\u01b0\\u1edbng n\\u1ed9i th\\u1ea5t 2019","description":"Di\\u00ean Hy C\\u00f4ng L\\u01b0\\u1ee3c full"}', NULL, NULL, '/storage/articles/xu-huong-noi-that-2019-thumb-1.png', NULL, 'xu-huong-noi-that-2019', '<p>Bootstrap is the most popular HTML, CSS, and JavaScript framework for developing responsive, mobile-first websites.</p>\r\n\r\n<p>Bootstrap is completely free to download and use!</p>\r\n\r\n<p><a href="https://www.w3schools.com/bootstrap/bootstrap_get_started.asp">Start learning Bootstrap now &raquo;</a></p>\r\n\r\n<hr />\r\n<h2>Try it Yourself Examples</h2>\r\n\r\n<p>This Bootstrap tutorial contains hundreds of Bootstrap examples.</p>\r\n\r\n<p>With our online editor, you can edit the code, and click on a button to view the result.</p>\r\n\r\n<p><img alt="Responsive Bootstrap Page" src="https://www.w3schools.com/bootstrap/imgdefault.jpg" /></p>', NULL, '2018-10-11 17:15:08', '2018-10-17 11:21:47'),
(2, 'Test no', '{"title":"Test no","description":null}', NULL, NULL, '/storage/articles/test-no-thumb-2.png', NULL, 'test-no', '<p>sdsd</p>', NULL, '2018-10-12 12:05:34', '2018-10-17 11:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `article_groups`
--

CREATE TABLE `article_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_groups`
--

INSERT INTO `article_groups` (`id`, `article_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

CREATE TABLE `article_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_tags`
--

INSERT INTO `article_tags` (`id`, `article_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) UNSIGNED NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `host`, `setting`) VALUES
(2, 'insta-frontend.host', '{"title":"Instagram online","keywords":null,"description":"Instagram hashtags, users, location discovery","fb_app_id":null,"fb_admin":null,"google_analytic":null,"desc_spam":null,"footer":null,"tags":null,"blocks":[{"name":"Country","tags":"united,japan"}],"menu":{"popular_users":{"name":"Users","title":"Users","description":"Users"},"popular_tags":{"name":"Hashtags","title":"Tags","description":"Tags"},"trending_photo":{"name":"Photos","title":"Discovery","description":"Discovery"},"locations":{"name":"Locations","title":"Locations","description":"Locations"}},"seo":{"user":{"title":"User","description":null},"tag":{"title":"Tag","description":null},"location":{"title":"Location","description":null},"post":{"title":"Feed","description":null},"search":{"title":"Search","description":null}},"popular_tags":"celeb,sport","popular_locations":"Tokyo,Newyork,London,Paris","logo":"\\/webs\\/insta-frontendhost\\/logo.png","banner":"\\/webs\\/insta-frontendhost\\/banner.jpg"}'),
(3, 'piknow.host', '{"popular_tags":"hollywood","popular_locations":"london,paris","blocks":[{"name":"Country","tags":"us,vietnam"}],"title":null,"keywords":null,"description":null,"fb_app_id":null,"fb_admin":null,"google_analytic":null,"footer":null,"menu":{"popular_users":{"name":"Users","title":null,"description":null},"popular_tags":{"name":"Hashtags","title":null,"description":null},"trending_photo":{"name":"Discovery","title":null,"description":null},"locations":{"name":"Locations","title":null,"description":null}},"seo":{"user":{"title":null,"description":null},"tag":{"title":null,"description":null},"location":{"title":null,"description":null},"post":{"title":null,"description":null},"search":{"title":null,"description":null}},"banner":"\\/webs\\/piknowhost\\/banner.png"}');

-- --------------------------------------------------------

--
-- Table structure for table `client_blocks`
--

CREATE TABLE `client_blocks` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_blocks`
--

INSERT INTO `client_blocks` (`id`, `client_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `client_groups`
--

CREATE TABLE `client_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_groups`
--

INSERT INTO `client_groups` (`id`, `client_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 3),
(4, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `client_menus`
--

CREATE TABLE `client_menus` (
  `id` int(11) UNSIGNED NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_menus`
--

INSERT INTO `client_menus` (`id`, `client_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `name`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Quang Nguyen', 'admin@abc.vn', 'hi admin', 1, '2018-11-18 02:53:13', '2018-11-18 03:22:38');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Test'),
(3, 'Ok');

-- --------------------------------------------------------

--
-- Table structure for table `group_tags`
--

CREATE TABLE `group_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `tag_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_tags`
--

INSERT INTO `group_tags` (`id`, `tag_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `key`, `sort`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AIzaSyBaHCNXu_bk3AMwXq3JVhmHWJNygTO5IVo', 1540654422, 1, '2018-10-09 12:44:07', '2018-10-27 15:33:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_25_012849_create_jobs_table', 2),
(4, '2017_11_25_014517_create_failed_jobs_table', 2),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(8, '2016_06_01_000004_create_oauth_clients_table', 3),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `slug`, `type`, `content`, `client_id`) VALUES
(10, 'Quảng cáo', NULL, 'ads', '{"side_ads":null,"video_bottom":"<script>console.log(''video bottom'')<\\/script>","body_ads":null,"popup_all":null,"popup_detail":null}', 1),
(16, 'Home setting', NULL, 'home', NULL, NULL),
(17, 'Label setting', NULL, 'label', NULL, NULL),
(18, NULL, 'lien-he', 'article', '{"content":null}', 1),
(19, 'Danh mục youtube', NULL, 'categories', '{"phim":{"name":"Phim v\\u00e0 Ho\\u1ea1t \\u1ea3nh","slug":"phim","id":"1","icon":"fa fa-film"},"oto-va-xe":{"name":"\\u00d4 t\\u00f4 v\\u00e0 Xe c\\u1ed9","slug":"oto-va-xe","id":"2","icon":null},"am-nhac":{"name":"\\u00c2m nh\\u1ea1c","slug":"am-nhac","id":"10","icon":null},"thu-cung-va-dong-vat":{"name":"V\\u1eadt c\\u01b0ng v\\u00e0 \\u0110\\u1ed9ng v\\u1eadt","slug":"thu-cung-va-dong-vat","id":"15","icon":null},"the-thao":{"name":"Th\\u1ec3 thao","slug":"the-thao","id":"17","icon":null},"phim-ngan":{"name":"Phim Ng\\u1eafn","slug":"phim-ngan","id":"18","icon":null},"du-lich-su-kien":{"name":"Du l\\u1ecbch v\\u00e0 S\\u1ef1 ki\\u1ec7n","slug":"du-lich-su-kien","id":"19","icon":null},"tro-choi":{"name":"Tr\\u00f2 ch\\u01a1i","slug":"tro-choi","id":"20","icon":null},"video-blog":{"name":"Video Blog","slug":"video-blog","id":"21","icon":null},"hai":{"name":"H\\u00e0i","slug":"hai","id":"23","icon":null},"giai-tri":{"name":"Gi\\u1ea3i tr\\u00ed","slug":"giai-tri","id":"24","icon":null},"video-tin-tuc":{"name":"Tin t\\u1ee9c","slug":"video-tin-tuc","id":"25","icon":null},"huong-dan-phong-cach":{"name":"H\\u01b0\\u1edbng d\\u1eabn v\\u00e0 Phong c\\u00e1ch","slug":"huong-dan-phong-cach","id":"26","icon":null},"giao-duc":{"name":"Gi\\u00e1o d\\u1ee5c","slug":"giao-duc","id":"27","icon":null},"khoa-hoc-cong-nghe":{"name":"Khoa h\\u1ecdc v\\u00e0 C\\u00f4ng ngh\\u1ec7","slug":"khoa-hoc-cong-nghe","id":"28","icon":null}}', NULL),
(20, NULL, 'ban-quyen', 'article', '{"content":null}', 1),
(21, NULL, NULL, 'general_setting', '{"key_limit":"200"}', NULL),
(22, 'Quảng cáo', NULL, 'ads', '{"sidebar":null,"container":null,"head":null,"footer":null,"pop_all":null,"pop_detail":"<script>\\r\\nconsole.log(''detail)\\r\\n<\\/script>"}', 2),
(23, NULL, 'term', 'article', '{"content":null}', 2),
(24, NULL, 'contact', 'article', '{"content":null}', 2),
(25, 'Quảng cáo', NULL, 'ads', '{"sidebar":null,"container":null,"head":null,"footer":null,"pop_all":"<!-- Go to www.addthis.com\\/dashboard to customize your tools -->\\r\\n<script type=\\"text\\/javascript\\" src=\\"\\/\\/s7.addthis.com\\/js\\/300\\/addthis_widget.js#pubid=ra-5bf150beb69e2833\\"><\\/script>","pop_detail":null}', 3),
(26, NULL, 'term', 'article', '{"content":null}', 3),
(27, NULL, 'contact', 'article', '{"content":null}', 3);

-- --------------------------------------------------------

--
-- Table structure for table `s_feeds`
--

CREATE TABLE `s_feeds` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s_locations`
--

CREATE TABLE `s_locations` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `s_tags`
--

CREATE TABLE `s_tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s_tags`
--

INSERT INTO `s_tags` (`id`, `key`, `status`) VALUES
(2, 'dance', NULL),
(3, 'cute', NULL),
(4, 'ahsapocalypse', NULL),
(5, 'fbf', NULL),
(6, 'flashbackfriday', NULL),
(7, 'beheard', NULL),
(8, 'myfavoritemurder', NULL),
(9, 'murderino', NULL),
(10, 'ssdgm', NULL),
(11, 'beavernuggets', NULL),
(12, 'hardstarking', NULL),
(13, 'supernatural', NULL),
(14, 'supernaturalfamily', NULL),
(15, 'supernaturallove', NULL),
(16, 'supernaturalfamilylove', NULL),
(17, 'deanwinchester', NULL),
(18, 'samwinchester', NULL),
(19, 'winchesterbrothers', NULL),
(20, 'winchesterbros', NULL),
(21, 'bobby', NULL),
(22, 'johnwinchester', NULL),
(23, 'marywinchester', NULL),
(24, 'castielwinchester', NULL),
(25, 'jack', NULL),
(26, 'lucifer', NULL),
(27, 'crowely', NULL),
(28, 'rowerna', NULL),
(29, 'jensenackles', NULL),
(30, 'jaredpada', NULL),
(31, 'mishacollins', NULL),
(32, 'markasheppered', NULL),
(33, 'jensenjaredmisha', NULL),
(34, 'j2m', NULL),
(35, 'supernaturalforever', NULL),
(36, 'supernaturalfanforever', NULL),
(37, 'supernaturalfanpage', NULL),
(38, 'ackles', NULL),
(39, 'destiel', NULL),
(40, 'destielforever', NULL),
(41, 'jensenacklesrock', NULL),
(42, 'deanwinchestergirl79', NULL),
(43, 'parentingteam', NULL),
(44, 'todayparents', NULL),
(45, 'pregnancy', NULL),
(46, 'repost', NULL),
(47, 'mainwitches', NULL),
(48, 'splittinguptogether', NULL),
(49, 'thanksgivingclapback', NULL),
(50, 'wildwest', NULL),
(51, 'melodyranch', NULL),
(52, 'brooklyn99', NULL),
(53, 'b99', NULL),
(54, 'brooklyn99post', NULL),
(55, 'b99scenes', NULL),
(56, 'peraltiago', NULL),
(57, 'jakeperalta', NULL),
(58, 'amysantiago', NULL),
(59, 'captainholt', NULL),
(60, 'b99cast', NULL),
(61, 'brooklynninenine', NULL),
(62, 'rosadiaz', NULL),
(63, 'andysamberg', NULL),
(64, 'melissafumero', NULL),
(65, 'terrycrews', NULL),
(66, 'charlesboyle', NULL),
(67, 'ginalinetti', NULL),
(68, 'chelseaperetti', NULL),
(69, 'terryjeffords', NULL),
(70, 'brooklyn99humor', NULL),
(71, 'brooklyn99edits', NULL),
(72, 'funko', NULL),
(73, 'funkopop', NULL),
(74, 'funkompany', NULL),
(75, 'funkomania', NULL),
(76, 'funkomafia', NULL),
(77, 'funkocollector', NULL),
(78, 'funkocollection', NULL),
(79, 'funkohq', NULL),
(80, 'funkoexclusive', NULL),
(81, 'funkofam', NULL),
(82, 'funkofamily', NULL),
(83, 'funkofanatic', NULL),
(84, 'funkofunatic', NULL),
(85, 'funkoaddict', NULL),
(86, 'funkoshop', NULL),
(87, 'funkophotography', NULL),
(88, 'harrypotter', NULL),
(89, 'dobby', NULL),
(90, 'brooklyn99edit', NULL),
(91, 'rayholt', NULL),
(92, 'thepopshack', NULL),
(93, 'funkopops', NULL),
(94, 'rocky', NULL),
(95, 'bullwinkle', NULL),
(96, 'strangerthings', NULL),
(97, 'eleven', NULL),
(98, 'mike', NULL),
(99, 'nfl', NULL),
(100, 'dallas', NULL),
(101, 'cowboys', NULL),
(102, 'troyaikman', NULL),
(103, 'pops', NULL),
(104, 'popvinyls', NULL),
(105, 'vinyls', NULL),
(106, 'funkos', NULL),
(107, 'ripkimporter', NULL),
(108, 'bettywhite', NULL),
(109, 'rosenylund', NULL),
(110, 'thegoldengirls', NULL),
(111, 'tbt', NULL),
(112, 'goldengirls', NULL),
(113, 'turtleneck', NULL),
(114, 'spn', NULL),
(115, 'spnfamily', NULL),
(116, 'jensen', NULL),
(117, 'dean', NULL),
(118, 'winchester', NULL),
(119, 'actor', NULL),
(120, 'actors', NULL),
(121, 'movies', NULL),
(122, 'movie', NULL),
(123, 'cw', NULL),
(124, 'tvshow', NULL),
(125, 'fandom', NULL),
(126, 'comiccon', NULL),
(127, 'creeationsentertainment', NULL),
(128, 'winchesters', NULL),
(129, 'wayward', NULL),
(130, 'waywardson', NULL),
(131, 'daysofourlives', NULL),
(132, 'mcm', NULL),
(133, 'mce', NULL),
(134, 'greeneyes', NULL),
(135, 'spnfandom', NULL),
(136, 'supernaturalmemes', NULL),
(137, 'hunters', NULL),
(138, 'dumbo', NULL),
(139, 'timburton', NULL),
(140, 'disneyland', NULL),
(141, 'popvinyl', NULL),
(142, 'vinyl', NULL),
(143, 'collection', NULL),
(144, 'popvinylatic', NULL),
(145, 'charles70', NULL),
(146, 'bughead', NULL),
(147, 'riverdale', NULL),
(148, 'star', NULL),
(149, 'kimporter', NULL),
(150, 'pdiddy', NULL),
(151, 'albsure', NULL),
(152, 'emmastone', NULL),
(153, 'arianagrande', NULL),
(154, 'donjulio', NULL),
(155, 'donjuliopartner', NULL),
(156, 'ipackedashoebox', NULL),
(157, 'everystepmatters', NULL),
(158, 'synnkarlsen', NULL),
(159, 'clariceorsini', NULL),
(160, 'clique', NULL),
(161, 'bbc', NULL),
(162, 'bccthree', NULL),
(163, 'mediciseason3', NULL),
(164, 'medici', NULL),
(165, 'themagnificent', NULL),
(166, 'mediciilmagnifico', NULL),
(167, 'medicilorenzoilmagnifico', NULL),
(168, 'medicithemagnificent', NULL),
(169, 'lorenzoilmagnifico', NULL),
(170, 'lorenzodemedici', NULL),
(171, 'imedici', NULL),
(172, 'imedici3', NULL),
(173, 'sarahparish', NULL),
(174, 'auroraruffino', NULL),
(175, 'leprechaun', NULL),
(176, 'horror', NULL),
(177, 'horrormovies', NULL),
(178, 'horrorfilms', NULL),
(179, 'horrorfans', NULL),
(180, 'horrorpage', NULL),
(181, 'horrorfamily', NULL),
(182, 'awesome', NULL),
(183, 'regrann', NULL),
(184, 'fallontonight', NULL),
(185, 'gettyentertainment', NULL),
(186, 'mcu', NULL),
(187, 'excelsior', NULL),
(188, 'legend', NULL),
(189, 'rip', NULL),
(190, 'stanlee', NULL),
(191, 'teamstark', NULL),
(192, 'tgp', NULL),
(193, 'tgpscenes', NULL),
(194, 'tgpseason3', NULL),
(195, 'nbcthegoodplace', NULL),
(196, 'thegoodplacenbc', NULL),
(197, 'eleanorshellstrop', NULL),
(198, 'jasonmendoza', NULL),
(199, 'tahanialjamil', NULL),
(200, 'chidianogonye', NULL),
(201, 'thebadplace', NULL),
(202, 'nbc', NULL),
(203, 'kristenbell', NULL),
(204, 'teddanson', NULL),
(205, 'janet', NULL),
(206, 'michael', NULL),
(207, 'darcycarden', NULL),
(208, 'williamjacksonharper', NULL),
(209, 'mannyjacinto', NULL),
(210, 'jameelajamil', NULL),
(211, 'thestuff', NULL),
(212, 'monstervision', NULL),
(213, 'monster', NULL),
(214, 'monsters', NULL),
(215, 'horrorfan', NULL),
(216, 'horrorfanatic', NULL),
(217, 'horrorclub', NULL),
(218, 'horrormakeup', NULL),
(219, 'horrorlover', NULL),
(220, 'horrornerd', NULL),
(221, 'horrorgram', NULL),
(222, 'halloween', NULL),
(223, 'monstersquad', NULL),
(224, 'universalmonsters', NULL),
(225, 'halloweentime', NULL),
(226, 'happyhalloween', NULL),
(227, 'forthethrone', NULL),
(228, 'marypoppinsreturns', NULL),
(229, 'bradstoys', NULL),
(230, 'funkogram', NULL),
(231, 'funkoverse', NULL),
(232, 'funkotime', NULL),
(233, 'talespin', NULL),
(234, 'pop', NULL),
(235, 'dorbz', NULL),
(236, 'mysteryminis', NULL),
(237, 'wobblers', NULL),
(238, 'pintsizeheroes', NULL),
(239, 'originalfunko', NULL),
(240, 'collectibles', NULL),
(241, 'funkofinderz', NULL),
(242, 'popnbeards', NULL),
(243, 'jersey-general', NULL),
(244, 'yeehaw', NULL),
(245, 'generallee', NULL),
(246, 'dirtroad', NULL),
(247, 'offroad', NULL),
(248, 'moonshine', NULL),
(249, 'dukesofhazzard', NULL),
(250, 'athome', NULL),
(251, 'pushbar', NULL),
(252, 'hiddenheadlights', NULL),
(253, 'claireholt', NULL),
(254, 'latingrammys', NULL),
(255, 'toystory4', NULL),
(256, 'thirdgenerationcamaroandfirebird', NULL),
(257, 'tgcamaroandfirebird', NULL),
(258, 'tgcandf', NULL),
(259, 'membercars', NULL),
(260, 'z28', NULL),
(261, 'camaroz28', NULL),
(262, 'chevrolet', NULL),
(263, 'camarosofinstagram', NULL),
(264, 'funkopopnews', NULL),
(265, 'funkonews', NULL),
(266, 'funkopopvinyl', NULL),
(267, 'popculture', NULL),
(268, 'vinylfigure', NULL),
(269, 'funatic', NULL),
(270, 'news', NULL),
(271, 'funkoupdates', NULL),
(272, 'collector', NULL),
(273, 'funkoig', NULL),
(274, 'funkoinstagram', NULL),
(275, 'projectbluebook', NULL),
(276, 'batkid', NULL),
(277, 'poptwinstuesday', NULL),
(278, 'funkophotoaday', NULL),
(279, 'popcollector', NULL),
(280, 'popfunko', NULL),
(281, 'funkolove', NULL),
(282, 'topfunkophotos', NULL),
(283, 'funkofan', NULL),
(284, 'funkopopcollector', NULL),
(285, 'funkocommunity', NULL),
(286, 'disneyfunko', NULL),
(287, 'disneyfunkopop', NULL),
(288, 'disney', NULL),
(289, 'hongkong', NULL),
(290, 'theprincessswitch', NULL),
(291, 'miloventimiglia', NULL),
(292, 'mopar', NULL),
(293, 'mopars', NULL),
(294, 'moparfans', NULL),
(295, 'moparnation', NULL),
(296, 'moparfam', NULL),
(297, 'moparfamily', NULL),
(298, 'moparnocar', NULL),
(299, 'moparornocar', NULL),
(300, 'moparofficial', NULL),
(301, 'moparian', NULL),
(302, 'moparlove', NULL),
(303, 'moparlife', NULL),
(304, 'moparmuscle', NULL),
(305, 'moparmafia', NULL),
(306, 'moparworld', NULL),
(307, 'moparperformance', NULL),
(308, 'dodge', NULL),
(309, 'dodgebrothers', NULL),
(310, 'dodgeofficial', NULL),
(311, 'dodgefam', NULL),
(312, 'dodgecoronet', NULL),
(313, 'coronet', NULL),
(314, 'rt', NULL),
(315, 'socal', NULL),
(316, 'mopardaily', NULL),
(317, '440magnum', NULL),
(318, 'musclecars', NULL),
(319, 'americanmuscle', NULL),
(320, 'americanmusclecar', NULL),
(321, 'musclecarzone', NULL),
(322, 'happyworldkindnessday', NULL),
(323, 'whatisrememberedlives', NULL),
(324, 'theaidsmemorial', NULL),
(325, 'aidsmemorial', NULL),
(326, 'neverforget', NULL),
(327, 'endaids', NULL),
(328, 'dreemlyne', NULL),
(329, 'pashmina', NULL),
(330, 'cashmere', NULL),
(331, 'scarfs', NULL),
(332, 'staywarm', NULL),
(333, 'style', NULL),
(334, 'accessory', NULL),
(335, 'lightweight', NULL),
(336, 'forwomen', NULL),
(337, 'formen', NULL),
(338, 'newproject', NULL),
(339, 'enjoy', NULL),
(340, 'support', NULL),
(341, 'model', NULL),
(342, 'fashion', NULL),
(343, 'chicago', NULL),
(344, 'warm', NULL),
(345, 'durable', NULL),
(346, 'classy', NULL),
(347, 'timesup', NULL),
(348, 'sisterhood', NULL),
(349, 'alexanderskarsg', NULL),
(350, 'alexanderskarsgard', NULL),
(351, 'travellife', NULL),
(352, 'paollaoliveira', NULL),
(353, 'dirtyjohn', NULL),
(354, 'motherhood', NULL),
(355, 'parentproblems', NULL),
(356, 'parentinghumor', NULL),
(357, 'motherhoodunplugged', NULL),
(358, 'familylife', NULL),
(359, 'family', NULL),
(360, 'honestmotherhood', NULL),
(361, 'lifewithkids', NULL),
(362, 'mommemes', NULL),
(363, 'momhumor', NULL),
(364, 'momlife', NULL),
(365, 'toddler', NULL),
(366, 'toddlerlife', NULL),
(367, 'toddlermom', NULL),
(368, 'baby', NULL),
(369, 'babies', NULL),
(370, 'babylife', NULL),
(371, 'kids', NULL),
(372, 'kidslife', NULL),
(373, 'funnymom', NULL),
(374, 'momprobs', NULL),
(375, 'boymom', NULL),
(376, 'girlmom', NULL),
(377, 'momquotes', NULL),
(378, 'parentingquotes', NULL),
(379, 'sahm', NULL),
(380, 'sahmlife', NULL),
(381, 'stayathomemom', NULL),
(382, 'workingmom', NULL),
(383, 'vanderpumprules', NULL),
(384, 'alwayschoosedare', NULL),
(385, 'tarajiphenson', NULL),
(386, 'terrencehoward', NULL),
(387, 'cookielyon', NULL),
(388, 'luciouslyon', NULL),
(389, 'empire', NULL),
(390, 'omarihardwick', NULL),
(391, 'activist', NULL),
(392, 'poet', NULL),
(393, 'artist', NULL),
(394, 'motivator', NULL),
(395, 'leader', NULL),
(396, 'teacher', NULL),
(397, 'goalchaser', NULL),
(398, 'blackexcellence', NULL),
(399, 'humanexcellence', NULL),
(400, 'intellectuallywoke', NULL),
(401, 'intellectuallylit', NULL),
(402, 'humblesoul', NULL),
(403, 'kissedbygod', NULL),
(404, 'alphamale', NULL),
(405, 'proud', NULL),
(406, 'creed', NULL),
(407, 'joebobbriggs', NULL),
(408, 'spongebobsquarepants', NULL),
(409, 'comix', NULL),
(410, 'cartoon', NULL),
(411, 'mashup', NULL),
(412, 'lowbrow', NULL),
(413, 'lowbrowart', NULL),
(414, 'penandink', NULL),
(415, 'crosshatch', NULL),
(416, 'illustration', NULL),
(417, '90df', NULL),
(418, '90dayfiancemarathon', NULL),
(419, '90dayfiance', NULL),
(420, '90dayfiance-tlc', NULL),
(421, '90dayfiancee', NULL),
(422, '90dayfiancerecap', NULL),
(423, '90dayfiance-etc', NULL),
(424, '90daymorons', NULL),
(425, 'kalaniandasuelu', NULL),
(426, 'amypoehler', NULL),
(427, 'leslieknope', NULL),
(428, 'adamscott', NULL),
(429, 'benwyatt', NULL),
(430, 'parksandrecreation', NULL),
(431, 'pawneeindiana', NULL),
(432, 'got', NULL),
(433, 'jaredpadalecki', NULL),
(434, 'marksheppard', NULL),
(435, 'jared', NULL),
(436, 'padalecki', NULL),
(437, 'misha', NULL),
(438, 'collins', NULL),
(439, 'mark', NULL),
(440, 'sheppard', NULL),
(441, 'castiel', NULL),
(442, 'crowley', NULL),
(443, 'demon', NULL),
(444, 'angel', NULL),
(445, 'gagreel', NULL),
(446, 'supernaturalgagreel', NULL),
(447, 'clairenovak', NULL),
(448, 'kaianeves', NULL),
(449, 'gabriel', NULL),
(450, 'sabriel', NULL),
(451, 'archangel', NULL),
(452, 'thisisus', NULL),
(453, 'laugh', NULL),
(454, 'funfacts', NULL),
(455, 'gorillas', NULL),
(456, 'briellemilla', NULL),
(457, 'superstore', NULL),
(458, 'claudiakim', NULL),
(459, 'fantasticbeasts', NULL),
(460, 'nagini', NULL),
(461, 'teenvoguesummit', NULL),
(462, 'fallleaves', NULL),
(463, 'thepotterpigs', NULL),
(464, 'guineapigs', NULL),
(465, 'autumnfashion', NULL),
(466, 'guineapig', NULL),
(467, 'petsarefamily', NULL),
(468, 'guineapigsofinstagram', NULL),
(469, 'rescues', NULL),
(470, 'moods', NULL),
(471, 'adoptdontshop', NULL),
(472, 'cavy', NULL),
(473, 'guineapiglove', NULL),
(474, 'plaid', NULL),
(475, 'smallpet', NULL),
(476, 'petphotography', NULL),
(477, 'dailyfluff', NULL),
(478, 'seasonal', NULL),
(479, 'furbabies', NULL),
(480, 'thedodo', NULL),
(481, 'instapets', NULL),
(482, 'vibez', NULL),
(483, 'japan', NULL),
(484, 'kawaii', NULL),
(485, 'westernscreechowl', NULL),
(486, 'megascopskennicottii', NULL),
(487, 'owl', NULL),
(488, 'owlstagram', NULL),
(489, 'japanowlclub', NULL),
(490, 'eule', NULL),
(491, 'hibou', NULL),
(492, 'gufo', NULL),
(493, 'ulula', NULL),
(494, 'uggla', NULL),
(495, 'beagle', NULL),
(496, 'beaglecommunity', NULL),
(497, 'beaglesofinstagram', NULL),
(498, 'beaglepuppy', NULL),
(499, 'beaglelove', NULL),
(500, 'grumpybeaglesunited', NULL),
(501, 'beagleworld', NULL),
(502, 'beaglemania', NULL),
(503, 'beaglegram', NULL),
(504, 'beaglesrule', NULL),
(505, 'beaglegang', NULL),
(506, 'beagleboy', NULL),
(507, 'tomhiddleston', NULL),
(508, 'haroldpinter', NULL),
(509, 'betrayal', NULL),
(510, 'jamielloyd', NULL),
(511, 'pinteratthepinterseason', NULL),
(512, 'shadowandact', NULL),
(513, 'trans', NULL),
(514, 'girlslikeus', NULL),
(515, 'amiyahscott', NULL),
(516, 'mjrodriquez', NULL),
(517, 'lavernecox', NULL),
(518, 'kingstonfarady', NULL),
(519, 'indyamoore', NULL),
(520, 'posefx', NULL),
(521, 'sohappy', NULL),
(522, 'sotranquil', NULL),
(523, 'sochill', NULL),
(524, 'weupherewithonepilotyall', NULL),
(525, 'iyi', NULL),
(526, 'geceler', NULL),
(527, 'sally4ever', NULL),
(528, 'godownundermycomforter', NULL),
(529, 'hotdudesreading', NULL),
(530, 'engagement', NULL),
(531, 'instagram', NULL),
(532, 'sandwich', NULL),
(533, 'faoschwarz', NULL),
(534, 'returntowonder', NULL),
(535, 'ahsfx', NULL),
(536, 'comedy', NULL),
(537, 'standup', NULL),
(538, 'instastandup', NULL),
(539, 'instacomedy', NULL),
(540, 'hbo', NULL),
(541, 'hbolatino', NULL),
(542, 'funny', NULL),
(543, 'relationshipsbelike', NULL),
(544, 'arguments', NULL),
(545, 'car', NULL),
(546, 'nickguerra', NULL),
(547, 'latino', NULL),
(548, 'jokes', NULL),
(549, 'aladdin', NULL),
(550, 'anerdydad', NULL),
(551, 'sebastianstan', NULL),
(552, 'sebastianporn', NULL),
(553, '384', NULL),
(554, 'sexyseabass', NULL),
(555, 'vanillaice', NULL),
(556, 'winterboobear', NULL),
(557, 'buckybarnes', NULL),
(558, 'lancetucker', NULL),
(559, 'jeffgillooly', NULL),
(560, 'jackbenjamin', NULL),
(561, 'tjhammond', NULL),
(562, 'papichulo', NULL),
(563, 'chubbydumpling', NULL),
(564, 'partner', NULL),
(565, 'bioclarity', NULL),
(566, 'powerofgreen', NULL),
(567, 'gameofthrones', NULL),
(568, 'gameofthronesmemes', NULL),
(569, 'jonsnow', NULL),
(570, 'aegontargaryen', NULL),
(571, 'gameofthronesintro', NULL),
(572, 'starks', NULL),
(573, 'thestarks', NULL),
(574, 'gameofthronesindia', NULL),
(575, 'housedemocrats', NULL),
(576, 'first', NULL),
(577, 'bill', NULL),
(578, 'basics', NULL),
(579, 'democracy', NULL),
(580, 'automatic', NULL),
(581, 'voterregistration', NULL),
(582, 'restoration', NULL),
(583, 'votingrightsact', NULL),
(584, 'public', NULL),
(585, 'financing', NULL),
(586, 'elections', NULL),
(587, 'gerrymandering', NULL),
(588, 'constitutionalamendment', NULL),
(589, 'citizensunited', NULL),
(590, 'goodstart', NULL),
(591, 'democrats', NULL),
(592, 'civicdirect', NULL),
(593, 'espaciofunkopop', NULL),
(594, 'juguetes', NULL),
(595, 'coleccion', NULL),
(596, 'toys', NULL),
(597, 'hockey', NULL),
(598, 'nhl', NULL),
(599, 'dogs', NULL),
(600, 'hollylodge', NULL),
(601, 'hellboy', NULL),
(602, 'mandymoore', NULL),
(603, 'eddiebauer', NULL),
(604, 'holidayadventurecampaign', NULL),
(605, 'hillsongwcc', NULL),
(606, 'forclarity', NULL),
(607, 'jedhapatrol', NULL),
(608, 'nkotb', NULL),
(609, 'majorlyhugefan', NULL),
(610, 'beyondshockedandhappy', NULL),
(611, 'popcurated', NULL),
(612, 'popgram', NULL),
(613, 'stantheman', NULL),
(614, 'novababe', NULL),
(615, 'ootd', NULL),
(616, 'godzilla', NULL),
(617, 'kingkong', NULL),
(618, 'godzillavskong', NULL),
(619, 'godzillavskingkong', NULL),
(620, 'milliebobbybrown', NULL),
(621, 'danaigurira', NULL),
(622, 'briantyreehenry', NULL),
(623, 'eizagonzalez', NULL),
(624, 'ziyizhang', NULL),
(625, 'scifi', NULL),
(626, 'monstermovies', NULL),
(627, 'actionmovies', NULL),
(628, 'adventure', NULL),
(629, 'movienews', NULL),
(630, 'movieupdates', NULL),
(631, 'film', NULL),
(632, 'cinema', NULL),
(633, 'tgif', NULL),
(634, 'friday', NULL),
(635, 'nascar', NULL),
(636, 'indycar', NULL),
(637, 'f1', NULL),
(638, 'formula1', NULL),
(639, 'racing', NULL),
(640, 'motorsports', NULL),
(641, 'race', NULL),
(642, 'racecar', NULL),
(643, 'motorsport', NULL),
(644, 'speed', NULL),
(645, 'chevy', NULL),
(646, 'ford', NULL),
(647, 'toyota', NULL),
(648, 'homesteadmiami', NULL),
(649, 'miami', NULL),
(650, 'homesteadmiamispeedway', NULL),
(651, 'brettmoffitt', NULL),
(652, 'thefavourite', NULL),
(653, 'symphonyoftheseas', NULL),
(654, 'funkostickers', NULL),
(655, 'admincar', NULL),
(656, 'camarosofmichigan', NULL),
(657, 'thirdgencamaro', NULL),
(658, 'tomhardy', NULL),
(659, 'princeofwales', NULL),
(660, 'buckinghampalace', NULL),
(661, 'iaindecaestecker', NULL),
(662, 'agentsofshield', NULL),
(663, 's7', NULL),
(664, 'chloebennet', NULL),
(665, 'elizabethhenstridge', NULL),
(666, 'jeffward', NULL),
(667, 'nataliacordovabuckley', NULL),
(668, 'henrysimmons', NULL),
(669, 'mingnawen', NULL),
(670, 'abc', NULL),
(671, 'marvel', NULL),
(672, 'leopoldfitz', NULL),
(673, 'fitzsimmons', NULL),
(674, 'johnnygalecki', NULL),
(675, 'dannynash', NULL),
(676, 'americandreamer', NULL),
(677, 'leonardhofstadter', NULL),
(678, 'thebigbangtheory', NULL),
(679, 'tbbt', NULL),
(680, 'rehearsal', NULL),
(681, 'rihanna', NULL),
(682, 'ashanti', NULL),
(683, 'navy', NULL),
(684, 'badgalriri', NULL),
(685, 'thegoodplace', NULL),
(686, 'thehollywoodreporter', NULL),
(687, 'snow', NULL),
(688, 'nyc', NULL),
(689, 'conversationswithozzy', NULL),
(690, 'new', NULL),
(691, 'magazine', NULL),
(692, 'hollywood', NULL),
(693, 'hollywoodstudios', NULL),
(694, 'blackandwhite', NULL),
(695, 'black', NULL),
(696, 'white', NULL),
(697, 'caution', NULL),
(698, 'mariahcarey', NULL),
(699, 'mimi', NULL),
(700, 'lambily', NULL),
(701, 'frasesmarvel10a', NULL),
(702, 'marvelstud10s', NULL),
(703, 'yashicamat124g', NULL),
(704, 'mediumformat', NULL),
(705, 'trix400', NULL),
(706, 'shootfilm', NULL),
(707, 'chrisevans', NULL),
(708, 'avengers', NULL),
(709, 'infinitywar', NULL),
(710, 'steverogers', NULL),
(711, 'captainamerica', NULL),
(712, 'irocz', NULL),
(713, 'camaroirocz', NULL),
(714, '3rdgencamaro', NULL),
(715, 'internationalraceofchampions', NULL),
(716, 'fastfurious', NULL),
(717, 'beccacosmetics', NULL),
(718, 'campfloggnaw2018', NULL),
(719, 'sorrytobotheryou', NULL),
(720, 'laurakightlinger', NULL),
(721, 'hollywoodimprov', NULL),
(722, 'theovon', NULL),
(723, 'thispastweekend', NULL),
(724, 'qupidshoesambassador', NULL),
(725, 'spiritawards', NULL),
(726, 'blackkklansman', NULL),
(727, 'adamdriver', NULL),
(728, '001', NULL),
(729, '002', NULL),
(730, 'generallee01', NULL),
(731, 'hazzardcounty', NULL),
(732, 'confederateflag', NULL),
(733, 'vegan', NULL),
(734, 'vegans', NULL),
(735, 'veganism', NULL),
(736, 'veganlife', NULL),
(737, 'veganstrong', NULL),
(738, 'veganfood', NULL),
(739, 'animallover', NULL),
(740, 'loveanimals', NULL),
(741, 'veganmemes', NULL),
(742, 'veganmeme', NULL),
(743, 'meme', NULL),
(744, 'food', NULL),
(745, 'fishing', NULL),
(746, 'earthlings', NULL),
(747, 'animalrights', NULL),
(748, 'animalsarenotyours', NULL),
(749, 'donteatmeat', NULL),
(750, 'friendsnotfood', NULL),
(751, 'diet', NULL),
(752, 'govegan', NULL),
(753, 'igvideo', NULL),
(754, 'igoftheday', NULL),
(755, 'instavideos', NULL),
(756, 'comedyclub', NULL),
(757, 'comedyshow', NULL),
(758, 'comedians', NULL),
(759, 'comedyvideo', NULL),
(760, 'hahahahaha', NULL),
(761, 'laughoutloud', NULL),
(762, 'comedyvideos', NULL),
(763, 'funnystuff', NULL),
(764, 'insta-chicago', NULL),
(765, 'chicity', NULL),
(766, 'linkinprofile', NULL),
(767, 'strongertogether', NULL),
(768, 'topofthemountain', NULL),
(769, 'dontlookdown', NULL),
(770, 'safewithme', NULL),
(771, 'lifesanadventure', NULL),
(772, 'enjoyit', NULL),
(773, 'igotyou', NULL),
(774, 'sidekick', NULL),
(775, 'pic', NULL),
(776, 'strongerthanhate', NULL),
(777, 'nojailforyou', NULL),
(778, 'littleblackjean', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `s_users`
--

CREATE TABLE `s_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `s_users`
--

INSERT INTO `s_users` (`id`, `key`, `status`, `follower`) VALUES
(1, 'ahsfxoficial', NULL, NULL),
(2, 'vanderjames', NULL, NULL),
(3, 'melissajoanhart', NULL, NULL),
(4, 'erinfoster', NULL, NULL),
(5, 'hardstark', NULL, NULL),
(6, 'jordynwoods', NULL, NULL),
(7, 'deanwinchestergirl79', NULL, NULL),
(8, 'todayparents', NULL, NULL),
(9, 'ahsfx', NULL, NULL),
(10, 'splittinguptogether', NULL, NULL),
(11, 'dlopezdemedrano', NULL, NULL),
(12, 'victoriajustice', NULL, NULL),
(13, 'georgehtakei', NULL, NULL),
(14, 'buzzfeed', NULL, NULL),
(15, 'codybwalker', NULL, NULL),
(16, 'dani_thorne', NULL, NULL),
(17, 'wellsadams', NULL, NULL),
(18, 'peraltiagoduh', NULL, NULL),
(19, 'mindykaling', NULL, NULL),
(20, 'funkompany', NULL, NULL),
(21, 'boylecousins', NULL, NULL),
(22, 'agentsofshield', NULL, NULL),
(23, 'thepopshack', NULL, NULL),
(24, 'vanessajsimmons', NULL, NULL),
(25, 'bettywhitenoise', NULL, NULL),
(26, 'the.supernatural.trickster', NULL, NULL),
(27, 'thefosterstv', NULL, NULL),
(28, 'welove_jensenackles', NULL, NULL),
(29, 'popvinyl', NULL, NULL),
(30, 'yaelgrobglas', NULL, NULL),
(31, 'cindymccain', NULL, NULL),
(32, 'giulianarancic', NULL, NULL),
(33, 'dorindamedley', NULL, NULL),
(34, 'thereallukeevans', NULL, NULL),
(35, 'writerras', NULL, NULL),
(36, 'opheliachanel', NULL, NULL),
(37, 'judedemorest', NULL, NULL),
(38, 'empressivetv', NULL, NULL),
(39, 'emgarfydaily', NULL, NULL),
(40, 'toulouuuuse', NULL, NULL),
(41, 'chordoverstreet', NULL, NULL),
(42, 'bethanyhamilton', NULL, NULL),
(43, 'dc_marvel_fans', NULL, NULL),
(44, 'synnkarlsenbr', NULL, NULL),
(45, 'jennyagyeman_wu', NULL, NULL),
(46, 'horror_family20', NULL, NULL),
(47, 'kingyazzfanpage', NULL, NULL),
(48, 'ryyandestinyy', NULL, NULL),
(49, 'mohnish_bahl', NULL, NULL),
(50, 'entertainmenttonight', NULL, NULL),
(51, 'yoongismainhoe', NULL, NULL),
(52, 'gabby3shabby', NULL, NULL),
(53, 'emeraldcitycomiccon', NULL, NULL),
(54, 'fallontonight', NULL, NULL),
(55, 'omgthatsariana', NULL, NULL),
(56, 'praisedthelourd', NULL, NULL),
(57, 'gettyentertainment', NULL, NULL),
(58, 'robertdowneyjr', NULL, NULL),
(59, 'tgpfeed', NULL, NULL),
(60, 'mingey', NULL, NULL),
(61, 'monstervision2017', NULL, NULL),
(62, 'kitharingtonrelated', NULL, NULL),
(63, 'disneymovies', NULL, NULL),
(64, 'bradstoys', NULL, NULL),
(65, 'funkofinderz', NULL, NULL),
(66, 'popnbeards', NULL, NULL),
(67, 'jersey_general', NULL, NULL),
(68, 'clairehdaily', NULL, NULL),
(69, 'jezebel', NULL, NULL),
(70, 'georgebeard7089', NULL, NULL),
(71, 'tgcamaroandfirebird', NULL, NULL),
(72, 'frankiejgrande', NULL, NULL),
(73, 'funkopop.news', NULL, NULL),
(74, 'theshiggyshow', NULL, NULL),
(75, 'skylineracing93', NULL, NULL),
(76, 'mkmalarkey', NULL, NULL),
(77, 'comicbook', NULL, NULL),
(78, 'poppeddisney', NULL, NULL),
(80, 'vanessahudgens', NULL, NULL),
(81, 'redbutterfly50', NULL, NULL),
(82, 'lightscameracar', NULL, NULL),
(83, 'juleshough', NULL, NULL),
(84, 'annehathaway', NULL, NULL),
(85, 'theaidsmemorial', NULL, NULL),
(86, 'jonathan_myrealtor', NULL, NULL),
(87, 'summernatscarfestival', NULL, NULL),
(88, 'americaferrera', NULL, NULL),
(89, 'delishskarsgard', NULL, NULL),
(90, 'carpool_karaoke', NULL, NULL),
(91, 'jenatkinhair', NULL, NULL),
(92, 'fcpaollaoliveiraamor', NULL, NULL),
(93, 'conniebritton', NULL, NULL),
(94, 'stayathomiesblog', NULL, NULL),
(95, 'chrishellhartley', NULL, NULL),
(96, 'letoyaluckett', NULL, NULL),
(97, 'devhynes', NULL, NULL),
(98, 'taraji_cookie_carter', NULL, NULL),
(99, 'ratedomari', NULL, NULL),
(100, 'lianaliberato', NULL, NULL),
(101, 'omarihardwickofficial', NULL, NULL),
(102, 'brielle', NULL, NULL),
(103, 'miss_emmastone', NULL, NULL),
(104, '90dayfiance_etc', NULL, NULL),
(105, 'itsmshkekesam', NULL, NULL),
(106, 'steve.lacy', NULL, NULL),
(107, 'strip_marvel', NULL, NULL),
(108, 'reesewitherspoon', NULL, NULL),
(109, 'poehlerfey', NULL, NULL),
(110, 'supernatural.dscw', NULL, NULL),
(111, 'mandymooremm', NULL, NULL),
(112, 'marlonwayans', NULL, NULL),
(113, 'msjennafischer', NULL, NULL),
(114, 'slaymesarahp', NULL, NULL),
(115, 'thewhiteredfox', NULL, NULL),
(116, 'thechristopherstreetreader', NULL, NULL),
(117, 'markjannini', NULL, NULL),
(118, 'nbcsuperstore', NULL, NULL),
(119, 'fandango', NULL, NULL),
(120, 'nicotortorella', NULL, NULL),
(121, 'the.potter.pigs', NULL, NULL),
(122, 'fukujin_owl', NULL, NULL),
(123, 'mrcheyennejackson', NULL, NULL),
(124, 'thetailsofgibson', NULL, NULL),
(125, 'markwahlberg', NULL, NULL),
(126, 'pixar', NULL, NULL),
(127, 'cupofthomas', NULL, NULL),
(128, 'shadow_act', NULL, NULL),
(129, 'masoud13075', NULL, NULL),
(130, 'jhonimarchinko', NULL, NULL),
(131, 'unqualified', NULL, NULL),
(132, 'gwenblakeinfo', NULL, NULL),
(133, 'lil_henstridge', NULL, NULL),
(134, 'drewraytanner', NULL, NULL),
(135, 'danielssean', NULL, NULL),
(136, 'analuoficiall', NULL, NULL),
(137, 'stran______', NULL, NULL),
(138, 'hbo', NULL, NULL),
(139, 'hotdudesreading', NULL, NULL),
(140, 'bigandmilky', NULL, NULL),
(141, 'nph', NULL, NULL),
(142, 'aclu_nationwide', NULL, NULL),
(143, 'olivamarquez', NULL, NULL),
(144, 'therealstanlee', NULL, NULL),
(145, 'ahs8fx', NULL, NULL),
(146, 'nickcomic', NULL, NULL),
(147, 'gameofthronespost', NULL, NULL),
(148, 'thefullbullpen', NULL, NULL),
(149, 'anerdydad', NULL, NULL),
(150, 'dirkblocker', NULL, NULL),
(151, 'sebastiansteeth', NULL, NULL),
(152, 'gameofthrones.gram', NULL, NULL),
(153, 'civicdirect', NULL, NULL),
(154, 'funkopopesp', NULL, NULL),
(155, 'realsebroche', NULL, NULL),
(156, 'youcantmakethisup', NULL, NULL),
(157, 'selmablair', NULL, NULL),
(158, 'thisismandymoore', NULL, NULL),
(159, 'hillsongwcc', NULL, NULL),
(160, 'squidsy', NULL, NULL),
(161, 'jedhapatrol', NULL, NULL),
(162, 'popcurated', NULL, NULL),
(163, 'avengers_cast', NULL, NULL),
(164, 'problack.princess', NULL, NULL),
(165, 'drew__dorsey', NULL, NULL),
(166, 'cinematicsource', NULL, NULL),
(167, 'trexco_on_track', NULL, NULL),
(168, 'lastlapinsider', NULL, NULL),
(169, 'theacademy', NULL, NULL),
(170, 'thefavouritemovie', NULL, NULL),
(171, 'vegaalexa', NULL, NULL),
(172, 'funkohq_shopper', NULL, NULL),
(173, 'sofiavergara', NULL, NULL),
(174, 'tomsohardy', NULL, NULL),
(175, 'bridgetmoynahan', NULL, NULL),
(176, 'iaindecaesteckerbr', NULL, NULL),
(177, 'disney', NULL, NULL),
(178, 'lightninggalecki', NULL, NULL),
(179, 'bluebreeys', NULL, NULL),
(180, 'laur_akins', NULL, NULL),
(181, 'barbrastreisand', NULL, NULL),
(182, 'sabrinanetflix', NULL, NULL),
(183, 'lauraclery', NULL, NULL),
(184, 'chelseahandler', NULL, NULL),
(185, 'juliotheshiba', NULL, NULL),
(186, 'hayesgrier', NULL, NULL),
(187, 'nbcthegoodplace', NULL, NULL),
(188, 'emilysxtone', NULL, NULL),
(189, 'chloebridges', NULL, NULL),
(190, 'fantasticbeastsmovie', NULL, NULL),
(191, 'scooterbraun', NULL, NULL),
(192, 'marvellatam', NULL, NULL),
(193, 'staronfox', NULL, NULL),
(194, 'sophiatali', NULL, NULL),
(195, 'amine', NULL, NULL),
(196, 'michielhuisman', NULL, NULL),
(197, 'caradelevingne', NULL, NULL),
(198, 'fastandfuriousmovie', NULL, NULL),
(199, 'johnandchrissy', NULL, NULL),
(200, 'andybovine', NULL, NULL),
(201, 'kingpush', NULL, NULL),
(202, 'r29unbothered', NULL, NULL),
(203, 'bootsriley', NULL, NULL),
(204, 'naomiwgrossman', NULL, NULL),
(205, 'hollywoodimprov', NULL, NULL),
(206, 'blumhouse', NULL, NULL),
(207, 'samsmithgrams', NULL, NULL),
(208, 'taylorbennett', NULL, NULL),
(209, 'dukesofhazzard1979', NULL, NULL),
(210, 'antoni', NULL, NULL),
(211, 'plantbasednews', NULL, NULL),
(212, 'msevylynch', NULL, NULL),
(213, 'vml_uk', NULL, NULL),
(214, 'laughfactory_ch', NULL, NULL),
(215, 'thomassanders', NULL, NULL),
(216, 'steph_shep', NULL, NULL),
(217, 'itscrystalsmith', NULL, NULL),
(218, 'therealhannahsimone', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seo` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `seo`, `status`, `parent_id`, `keyword`, `icon`) VALUES
(1, 'Test', 'me-va-be', '{"title":"Di\\u00ean Hy C\\u00f4ng L\\u01b0\\u1ee3c","description":"Di\\u00ean Hy C\\u00f4ng L\\u01b0\\u1ee3c full"}', NULL, NULL, 'Diên Hy Công Lược', NULL),
(2, 'child tags', 'child-tag', '{"title":"kid video","description":"kid videos"}', NULL, 1, 'child', NULL),
(3, 'Ô tô và xe cộ', 'o-to', '{"title":"\\u00d4 t\\u00f4 v\\u00e0 xe c\\u1ed9","description":"\\u00d4 t\\u00f4 v\\u00e0 xe c\\u1ed9"}', 1, NULL, 'Car', 'fa fa-car');

-- --------------------------------------------------------

--
-- Table structure for table `tops`
--

CREATE TABLE `tops` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `following` int(11) DEFAULT NULL,
  `media` int(11) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tops`
--

INSERT INTO `tops` (`id`, `username`, `name`, `follower`, `following`, `media`, `key`, `avatar`, `city`, `sort`) VALUES
(1, 'instagram', 'Instagram', 271210511, 0, 0, '25025320', 'https://instagram.fcpt7-1.fna.fbcdn.net/vp/de7f1892d7bd16faada39f2b5385701e/5CB33E5B/t51.2885-19/s150x150/14719833_310540259320655_1605122788543168512_a.jpg?_nc_ht=instagram.fcpt7-1.fna.fbcdn.net', NULL, 1542964370),
(2, 'cristiano', 'Cristiano Ronaldo', 149038262, 0, 0, '173560420', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/5b38ba9619fa1be600a5aa65ef7089fb/5CD60C88/t51.2885-19/s150x150/27580324_1961241000859897_4541351977585475584_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, 1542964485),
(3, 'selenagomez', 'Selena Gomez', 144500457, 0, 0, '460563723', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/2382eb361a8bbc71a7dd1555d6fe5d96/5CD5BA90/t51.2885-19/s150x150/39140818_445602959281673_7253789249969848320_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, 1542964645),
(4, 'arianagrande', 'Ariana Grande', 139928112, 0, 0, '7719696', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/0cf7a42185a99ee4440f8c1627d95603/5C9DA9F9/t51.2885-19/s150x150/46202793_1797285160382597_428877640129052672_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, 1542965496),
(5, 'kimkardashian', 'Kim Kardashian West', 122903449, 0, 0, '18428658', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/bbfa5e7265a78c74f287877830194a09/5C9B3E2C/t51.2885-19/s150x150/41326196_329788961105496_8866535953355767808_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, 1542965696),
(6, 'therock', 'therock', 125600444, 0, 0, '232192182', 'https://instagram.fpnh10-1.fna.fbcdn.net/vp/83867a2852250179b5fa07806b2cc233/5CD749FC/t51.2885-19/11850309_1674349799447611_206178162_a.jpg?_nc_ht=instagram.fpnh10-1.fna.fbcdn.net', NULL, 1542965809),
(7, 'beyonce', 'Beyoncé', 121962944, 0, 0, '247944034', 'https://scontent-sea1-1.cdninstagram.com/vp/301a039f1eada09caea0d1cad4989f2e/5C9D3B58/t51.2885-19/s150x150/35294447_2180528571961271_4347619716693491712_n.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, 1542966012),
(8, 'kyliejenner', 'Kylie', 122140111, 0, 0, '12281817', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/2649da330751f1b2745db9221bb64ed4/5CA34D44/t51.2885-19/s150x150/44912764_513368699149193_6384901908401750016_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, 1542966137),
(9, 'taylorswift', 'Taylor Swift', 114032189, 0, 0, '11830955', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/661b1fdfc994dcfd1152c7c02b5c6014/5CD318BF/t51.2885-19/s150x150/20969376_112654676087652_1378856425261891584_a.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, 1542966200),
(10, 'neymarjr', 'EneJota 🇧🇷 👻 neymarjr', 108226722, 0, 0, '26669533', 'https://scontent-frt3-2.cdninstagram.com/vp/f64e5b706fa2d8ad4f3a9e614f3fd520/5CD5942C/t51.2885-19/s150x150/44761039_749978215363405_3752692271464579072_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, 1542967733),
(11, 'justinbieber', 'Justin Bieber', 103735739, 0, 0, '6860189', 'https://scontent-sea1-1.cdninstagram.com/vp/ae68b9317f9dea1e50bd41ac9608523e/5CB66238/t51.2885-19/s150x150/20633803_159905257904822_3024096755265306624_a.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, 1542968239),
(12, 'leomessi', 'Leo Messi', 104501244, 0, 0, '427553890', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/4a8872266b1bf998e8cda10db6558e64/5CA30AF6/t51.2885-19/s150x150/43818140_2116018831763532_3803033961098117120_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(13, 'kendalljenner', 'Kendall', 100695427, 0, 0, '6380930', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/d48ee9549419bff3a732423a8ec96f0d/5C9F06CD/t51.2885-19/s150x150/44490232_2195370810706389_6721780709100355584_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(14, 'nickiminaj', 'Barbie®', 96707685, 0, 0, '451573056', 'https://scontent-frt3-2.cdninstagram.com/vp/d4451d75ec5d486739b460d36cbf8309/5CA0BEB9/t51.2885-19/s150x150/38428857_2268617196485173_7479580993595113472_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(15, 'natgeo', 'National Geographic', 94335955, 0, 0, '787132', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/f68d978c22b02fe231133053610a0fb8/5CAD4CE8/t51.2885-19/s150x150/13597791_261499887553333_1855531912_a.jpg', NULL, NULL),
(16, 'nike', 'nike', 83285308, 0, 0, '13460080', 'https://scontent-frt3-2.cdninstagram.com/vp/ef92b8df26899ffb9416076a4bea516d/5C9FFF32/t51.2885-19/s150x150/26155970_1584552474997482_4541081815552622592_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(17, 'khloekardashian', 'Khloé', 84003692, 0, 0, '208560325', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/3e61b6ad79630a81af3a936d60369c0d/5CD7A18F/t51.2885-19/s150x150/46065157_368951283879517_6906870817187954688_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(18, 'jlo', 'Jennifer Lopez', 83662961, 0, 0, '305701719', 'https://scontent-sof1-1.cdninstagram.com/vp/c38321177dd2ebd04ddb1477a2e9f9de/5CA4ABA2/t51.2885-19/s150x150/31775721_991090314389280_8797532849864441856_n.jpg?_nc_ht=scontent-sof1-1.cdninstagram.com', NULL, NULL),
(19, 'mileycyrus', 'Miley Cyrus', 75679106, 639, 0, '325734299', '/popular-users/mileycyrus.jpg?1542088488', NULL, NULL),
(20, 'katyperry', 'KATY PERRY', 74311358, 0, 0, '407964088', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/69db1402b5e7f471d48d620d8241a5da/5CD9FE4E/t51.2885-19/s150x150/44731199_947005522162053_4429453171693191168_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(21, 'ddlovato', 'Demi Lovato', 70574060, 383, 2113, '189393625', '/popular-users/ddlovato.jpg?1542088496', NULL, NULL),
(22, 'kourtneykardash', 'Kourtney Kardashian', 69446227, 84, 3602, '145821237', '/popular-users/kourtneykardash.jpg?1542088501', NULL, NULL),
(23, 'badgalriri', 'badgalriri', 66549693, 0, 0, '25945306', 'https://scontent-sea1-1.cdninstagram.com/vp/08ecf7c4e103e236b96d14f188b783d4/5CB58986/t51.2885-19/11032926_1049846535031474_260957621_a.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, NULL),
(24, 'realmadrid', 'Real Madrid C.F.', 65398614, 32, 2459, '290023231', '/popular-users/realmadrid.jpg?1542088509', NULL, NULL),
(25, 'kevinhart4real', 'Kevin Hart', 64985051, 489, 5878, '6590609', '/popular-users/kevinhart4real.jpg?1542088513', NULL, NULL),
(26, 'victoriassecret', 'Victoria''s Secret', 62494079, 540, 6864, '3416684', '/popular-users/victoriassecret.jpg?1542088516', NULL, NULL),
(27, 'fcbarcelona', 'FC Barcelona', 61974718, 48, 11269, '260375673', '/popular-users/fcbarcelona.jpg?1542088520', NULL, NULL),
(28, 'theellenshow', 'Ellen', 62530910, 0, 0, '18918467', 'https://instagram.fpnh10-1.fna.fbcdn.net/vp/83ad01f21dccb975e58cb5c0135a776e/5CA77C9D/t51.2885-19/s150x150/26871912_152242622146201_1712258780646866944_n.jpg?_nc_ht=instagram.fpnh10-1.fna.fbcdn.net', NULL, NULL),
(29, 'shakira', 'Shakira', 55596375, 0, 0, '217867189', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/ffc7af50df95114e71d8e55b70e04ff0/5CA33868/t51.2885-19/s150x150/41826615_255061411817730_4448410745020874752_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(30, 'zendaya', 'Zendaya', 53754676, 0, 0, '9777455', 'https://scontent-arn2-1.cdninstagram.com/vp/0679fad8d6877bbcf49a6a370e9f948a/5CB748BB/t51.2885-19/s150x150/43146007_338219383412225_7074956904937553920_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(31, 'justintimberlake', 'Justin Timberlake', 53222311, 0, 0, '303054725', 'https://scontent-sof1-1.cdninstagram.com/vp/62110dbb6720295bb9f5484fef5361d9/5CD95E24/t51.2885-19/s150x150/41885947_179833979582415_978760172732153856_n.jpg?_nc_ht=scontent-sof1-1.cdninstagram.com', NULL, NULL),
(32, 'davidbeckham', 'David Beckham', 52788924, 0, 0, '186904952', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/dfd58f45120e08cdedad34f0a4e26821/5CD8D1A3/t51.2885-19/s150x150/11848873_416913721845060_1906915195_a.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(33, 'vindiesel', 'Vin Diesel', 51057787, 37, 1357, '1287006597', '/popular-users/vindiesel.jpg?1542088545', NULL, NULL),
(34, 'champagnepapi', 'champagnepapi', 52225558, 0, 0, '14455831', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/21729e37c0c647dc1a46f82eff987b04/5CA19B51/t51.2885-19/s150x150/34011981_618191521876445_2442613970717114368_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(35, 'emmawatson', 'Emma Watson', 49395804, 0, 0, '1418652011', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/5337e0437a6646e699479553b4c46066/5CB3B0F6/t51.2885-19/s150x150/40359013_685684271788603_8690748963474636800_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(36, '9gag', '9GAG: Go Fun The World', 48965899, 0, 0, '259220806', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/3ebe37c815f10abde74856a379971835/5C970AFE/t51.2885-19/s150x150/18645376_238828349933616_4925847981183205376_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(37, 'chrisbrownofficial', 'CHRIS BROWN', 48886641, 0, 0, '29394004', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/04c996d09bf9488503725b42f0f5fb4a/5CB8B720/t51.2885-19/s150x150/46601370_2245101502479528_8351563657963896832_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(38, 'kingjames', 'LeBron James', 45912448, 0, 0, '19410587', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/edb2e77e53ce7ea876d282eb65e60d18/5C98AEA6/t51.2885-19/s150x150/38081739_444309582641396_1152956199352664064_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(39, 'gigihadid', 'Gigi Hadid', 44422075, 900, 2796, '12995776', '/popular-users/gigihadid.jpg?1542088571', NULL, NULL),
(40, 'caradelevingne', 'Cara Delevingne', 41419754, 1688, 3827, '3255807', '/popular-users/caradelevingne.jpg?1542088575', NULL, NULL),
(41, 'jamesrodriguez10', 'James Rodríguez', 40659873, 0, 0, '188222091', 'https://scontent-sof1-1.cdninstagram.com/vp/7575560d04c833ffd322bf2de8791b07/5CD624E2/t51.2885-19/s150x150/36482334_284440725629778_637647474877530112_n.jpg?_nc_ht=scontent-sof1-1.cdninstagram.com', NULL, NULL),
(42, 'ronaldinho', 'Ronaldo de Assis Moreira', 38719918, 237, 2187, '979177642', '/popular-users/ronaldinho.jpg?1542088584', NULL, NULL),
(43, 'shawnmendes', 'Shawn Mendes', 38849143, 0, 0, '212742998', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/6e36a981d54af689b1a4d16824f7e9d6/5CB8A20F/t51.2885-19/s150x150/30855248_1218485234953362_7447011419070922752_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(44, 'garethbale11', 'Gareth Bale', 37449983, 0, 0, '246194371', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/40f086d7825434b40d44c87afb255c15/5C7B58DD/t51.2885-19/s150x150/40337931_323958211688301_6400680879512879104_n.jpg', NULL, NULL),
(45, 'nikefootball', 'Nike Football (Soccer)', 36746815, 242, 1645, '23678829', '/popular-users/nikefootball.jpg?1542088597', NULL, NULL),
(46, 'nasa', 'NASA', 37815183, 0, 0, '528817151', 'https://scontent-frt3-2.cdninstagram.com/vp/fd18d559498a3a0fa2a05483f9df7f30/5CD46BED/t51.2885-19/s150x150/29090066_159271188110124_1152068159029641216_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(47, 'zacefron', 'Zac Efron', 36971089, 0, 0, '29421778', 'https://scontent-arn2-1.cdninstagram.com/vp/b1aa05d1365107692d4e2906f9104244/5C95B64C/t51.2885-19/11259380_355578351305074_1494114058_a.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(48, 'maluma', 'MALUMA', 36540394, 253, 6977, '44059601', '/popular-users/maluma.jpg?1542088610', NULL, NULL),
(49, 'iamzlatanibrahimovic', 'Zlatan Ibrahimović', 35942931, 0, 0, '637874562', 'https://scontent-arn2-1.cdninstagram.com/vp/cdf5ff6cea12cd3beb3c2b43b9c4966b/5C9FAB87/t51.2885-19/s150x150/43816493_474655406360884_468213059454763008_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(50, 'marcelotwelve', 'Marcelo Vieira Jr.', 33232126, 1103, 1887, '176702683', '/popular-users/marcelotwelve.jpg?1542088618', NULL, NULL),
(51, 'brumarquezine', 'Bruna Marquezine ♡', 33607528, 0, 0, '5383478', 'https://scontent-sea1-1.cdninstagram.com/vp/df916f5875bc0ea83387143205ca4f09/5CBADC75/t51.2885-19/s150x150/14583243_181784588934150_6820282541333807104_n.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, NULL),
(52, 'adele', 'Adele', 32333463, 0, 344, '2242640123', '/popular-users/adele.jpg?1542088626', NULL, NULL),
(53, 'nba', 'NBA', 32128316, 798, 26687, '20824486', '/popular-users/nba.jpg?1542088631', NULL, NULL),
(54, 'anitta', 'anitta 🎤', 32728618, 0, 0, '26633036', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/239d47ac01beee31833897fe8c5fbc16/5CA766F9/t51.2885-19/s150x150/43985734_323877458406904_8938590785729724416_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(55, 'ladygaga', 'Lady Gaga', 31264499, 37, 2965, '184692323', '/popular-users/ladygaga.jpg?1542088639', NULL, NULL),
(56, 'chanelofficial', 'CHANEL', 31085499, 1, 1391, '695995017', '/popular-users/chanelofficial.jpg?1542088644', NULL, NULL),
(57, 'luissuarez9', 'Luis Suarez', 30645350, 99, 486, '1470414259', '/popular-users/luissuarez9.jpg?1541387188', NULL, NULL),
(58, 'vanessahudgens', 'Vanessa Hudgens', 30363691, 709, 2880, '270099873', '/popular-users/vanessahudgens.jpg?1541387192', NULL, NULL),
(59, 'lelepons', 'Lele Pons', 31697199, 0, 0, '177402262', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/43a10a9857b2b3b4154ee91ef5c6bb90/5CB44F22/t51.2885-19/s150x150/46780168_1985441128208993_3080378921540124672_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(60, 'zayn', 'Zayn Malik', 30186270, 0, 0, '2033147472', 'https://scontent-arn2-1.cdninstagram.com/vp/0e87889db7a51c05b901ded7508aaa7d/5CA5C674/t51.2885-19/s150x150/30593049_1829779367053687_3825211093450489856_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(61, 'paulpogba', 'Paul Labile Pogba', 31070289, 0, 0, '2482066817', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/51ac09bc02ebf2bd642a4f41878afc4e/5CD70134/t51.2885-19/s150x150/36613396_1061181154048288_5045151585571700736_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(62, 'adidasoriginals', 'adidas Originals', 29631896, 211, 3765, '9187952', '/popular-users/adidasoriginals.jpg?1541387210', NULL, NULL),
(63, 'thenotoriousmma', 'Conor McGregor Official', 29799052, 0, 0, '421468021', 'https://instagram.fpnh10-1.fna.fbcdn.net/vp/8ccdfc0c78bfada66a0efbaafb478bf0/5CD2FA75/t51.2885-19/s150x150/26343200_2031055817138272_1453838565610881024_n.jpg?_nc_ht=instagram.fpnh10-1.fna.fbcdn.net', NULL, NULL),
(64, 'priyankachopra', 'Priyanka Chopra Jonas', 33466894, 0, 0, '178537482', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/03c0ac61134729bffdc6b1005f6fd7f8/5CA4D05F/t51.2885-19/s150x150/36160514_413404345843157_6996416856630231040_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(65, 'gucci', 'Gucci', 29373593, 154, 5174, '2421050', '/popular-users/gucci.jpg?1541387224', NULL, NULL),
(66, 'zara', 'ZARA Official', 30039262, 0, 0, '602725764', 'https://scontent-arn2-1.cdninstagram.com/vp/7ab16b776843faf583201fa3ee222c1f/5C9374A7/t51.2885-19/s150x150/30604092_253590611849905_3001466864640458752_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(67, 'hudabeauty', 'Huda Kattan', 29770000, 0, 0, '44222792', 'https://scontent-lax3-2.cdninstagram.com/vp/0a3a322070e63e79dcdd5ef5069c5125/5CA7A18A/t51.2885-19/s150x150/34874678_238549473603169_3851434999823728640_n.jpg', NULL, NULL),
(68, 'snoopdogg', 'snoopdogg', 28480611, 3086, 38607, '1574083', '/popular-users/snoopdogg.jpg?1541387237', NULL, NULL),
(69, 'marinaruybarbosa', 'Marina Ruy Barbosa', 28103916, 1647, 1634, '18846950', '/popular-users/marinaruybarbosa.jpg?1541387243', NULL, NULL),
(70, 'louisvuitton', 'Louis Vuitton Official', 28908043, 0, 0, '187619120', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/2a8c319cf51d6b6cac1630b24b8bfbbd/5CD0253A/t51.2885-19/914335_653223868059486_1434031198_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(71, 'hm', 'H&M', 28097976, 0, 0, '23410080', 'https://scontent-lax3-2.cdninstagram.com/vp/e03c2a8d238f841c8623e0694e079852/5C98A2CE/t51.2885-19/s150x150/22710452_231392117393541_5263937473033011200_n.jpg', NULL, NULL),
(72, 'deepikapadukone', 'Deepika Padukone', 29809345, 0, 0, '572299277', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/46aae1fcea24b3c0190ba4851b407b36/5CD3699C/t51.2885-19/s150x150/46375991_278946266097875_3650008944971087872_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(73, 'ayutingting92', 'Ayu Tingting', 28532649, 0, 0, '522969993', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/e6ebdda797e42870bb774be11a23cd94/5C951BC6/t51.2885-19/s150x150/41557330_241611743199937_4201592649695625216_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(74, 'adidasfootball', 'adidas Football (Soccer)', 26986896, 256, 1681, '640806256', '/popular-users/adidasfootball.jpg?1541387264', NULL, NULL),
(75, 'teddysphotos', 'Ed Sheeran', 27226732, 0, 0, '185546187', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/b9e60b7d34e0c94a9fc2ca206fd74fe2/5C9D478C/t51.2885-19/s150x150/15802365_1228177640596658_8518886379701141504_a.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(76, 'leonardodicaprio', 'Leonardo DiCaprio', 27952830, 0, 0, '1506607755', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/c6d9d399bbea2dee7b74ca1596faffa1/5CB86355/t51.2885-19/s150x150/12558345_1659293120975484_1074689227_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(77, 'natgeotravel', 'National Geographic Travel', 26373976, 76, 9333, '23947096', '/popular-users/natgeotravel.jpg?1541387277', NULL, NULL),
(78, 'andresiniesta8', 'Andres Iniesta', 25962289, 115, 842, '496865116', '/popular-users/andresiniesta8.jpg?1541387281', NULL, NULL),
(79, 'robertdowneyjr', 'Robert Downey Jr.', 25859148, 36, 279, '1518284433', '/popular-users/robertdowneyjr.jpg?1541387286', NULL, NULL),
(80, 'nickyjampr', 'NICKY JAM', 25704219, 5319, 9865, '55795588', '/popular-users/nickyjampr.jpg?1541387290', NULL, NULL),
(81, 'whinderssonnunes', 'Whindersson Nunes', 26764966, 0, 0, '284920884', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/cdc570abb05fa09509093d53b13e75d6/5CA7B146/t51.2885-19/s150x150/43674393_2156386061271607_4913254784884015104_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(82, 'tatawerneck', 'Tata Werneck', 26802307, 0, 0, '26029182', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/c3d7873a234d89832390f3a309023ecf/5CA1D985/t51.2885-19/s150x150/12677624_525015697673067_466669943_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(83, 'raffinagita1717', 'Raffiahmad Nagitaslavina1717', 25277711, 1956, 9504, '1918078581', '/popular-users/raffinagita1717.jpg?1541387305', NULL, NULL),
(84, 'virat', 'Virat Adirek', 775, 104, 1, '110567', '/popular-users/virat.jpg?1541387313', NULL, NULL),
(85, 'karimbenzema', 'Karim Benzema', 24986064, 147, 1210, '1234301500', '/popular-users/karimbenzema.jpg?1541387319', NULL, NULL),
(86, 'danbilzerian', 'Dan Bilzerian', 25411166, 0, 0, '50417061', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/8aae219747b652b13625e557be65ab4d/5C9FB9FF/t51.2885-19/s150x150/41677722_309612136484816_4022476815346958336_n.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(87, 'aliaabhatt', 'Alia ✨⭐️', 26293729, 0, 0, '259925762', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/2be07762d8bbb9322e086f0e36639e92/5CA333EF/t51.2885-19/s150x150/47583511_433007800568270_342863227740225536_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(88, 'jbalvin', 'J Balvin', 25259649, 0, 0, '10482862', 'https://scontent-sof1-1.cdninstagram.com/vp/47ae96b197c8fab5d8b0c10c0f271c35/5C9AED39/t51.2885-19/s150x150/31973693_2050439175218769_3414687463484948480_n.jpg?_nc_ht=scontent-sof1-1.cdninstagram.com', NULL, NULL),
(89, 'shraddhakapoor', 'Shraddha', 26132718, 0, 0, '296102572', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/9dfc11e433ac52868e1f64db1d9f44d1/5CA184B0/t51.2885-19/s150x150/37077287_572658719796014_6584344568831934464_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(90, 'harrystyles', '', 24319792, 229, 481, '144605776', '/popular-users/harrystyles.jpg?1541387341', NULL, NULL),
(91, 'manchesterunited', 'Manchester United', 24983104, 0, 0, '491527077', 'https://instagram.fhan3-3.fna.fbcdn.net/vp/d98df87d76aba78cd6ec7677eda46014/5CD4D52B/t51.2885-19/s150x150/47178374_2245797802409176_7321101248743079936_n.jpg?_nc_ht=instagram.fhan3-3.fna.fbcdn.net', NULL, NULL),
(92, 'eminem', 'Marshall Mathers', 24174165, 0, 396, '192417402', '/popular-users/eminem.jpg?1541387351', NULL, NULL),
(93, 'ivetesangalo', 'Veveta', 24692826, 0, 0, '13577008', 'https://instagram.fcpt7-1.fna.fbcdn.net/vp/3887dd9476b81882ac0779e267bf5ab1/5CB2F24F/t51.2885-19/s150x150/47510983_347309082729872_586616773705465856_n.jpg?_nc_ht=instagram.fcpt7-1.fna.fbcdn.net', NULL, NULL),
(94, 'blakelively', 'Blake Lively', 23841092, 28, 309, '1437529575', '/popular-users/blakelively.jpg?1541387360', NULL, NULL),
(95, 'wizkhalifa', 'Wiz Khalifa', 24388343, 0, 0, '5486909', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/fb5a71d3eacffd65d6dd187afdcd4f49/5CAA00D3/t51.2885-19/s150x150/43778507_359648234600983_3773423954048319488_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(96, 'prillylatuconsina96', 'Prilly Latuconsina', 25038504, 0, 0, '225064794', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/334d4561af5ad7e13c4e7081efc9f105/5CB7B600/t51.2885-19/s150x150/47183740_207535420176179_742212984889147392_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(97, 'princessyahrini', 'Syahrini', 23862658, 0, 0, '24239929', 'https://instagram.fprg2-1.fna.fbcdn.net/vp/432de699af740195585ec72b87447da8/5C99E610/t51.2885-19/s150x150/33127268_1661703787283507_3266744140993396736_n.jpg', NULL, NULL),
(98, 'victoriabeckham', 'Victoria Beckham', 23324252, 252, 2629, '186901415', '/popular-users/victoriabeckham.jpg?1541387377', NULL, NULL),
(99, 'laudyacynthiabella', 'Laudya Cynthia Bella', 23311061, 2590, 3145, '2993265', '/popular-users/laudyacynthiabella.jpg?1541387381', NULL, NULL),
(100, 'amandacerny', 'Amanda Cerny', 23778082, 0, 0, '10245870', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/7bce3efd190765944c048dfb8682ac0a/5CA3DC16/t51.2885-19/s150x150/46045233_123255181907589_8365126168252252160_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(101, 'daddyyankee', 'Daddy Yankee', 23871521, 0, 0, '40992858', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/b0b05c2941080c030c0dc97307267fa6/5CA44BF1/t51.2885-19/s150x150/42875322_262136827830128_7331386157818707968_n.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(102, 'stephencurry30', 'Wardell Curry', 23198697, 0, 0, '324599988', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/beb792e1369f04e66cfd18b4f7864c19/5C98519A/t51.2885-19/s150x150/22277378_1720913538216240_2580026733478543360_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(103, 'krisjenner', 'Kris Jenner', 23670520, 0, 0, '144646783', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/dfd0d578ea0fb1d1da9951033869bc8d/5CA707FE/t51.2885-19/10723790_1558166717804655_760366473_a.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(104, 'adidas', 'adidas', 22316513, 137, 726, '20269764', '/popular-users/adidas.jpg?1541387542', NULL, NULL),
(105, 'lucyhale', 'Lucy Hale', 22170175, 506, 1620, '6849281', '/popular-users/lucyhale.jpg?1541387546', NULL, NULL),
(106, 'floydmayweather', 'Floyd Mayweather', 22104367, 194, 789, '16264572', '/popular-users/floydmayweather.jpg?1541387549', NULL, NULL),
(107, 'dior', 'Dior Official', 22839815, 0, 0, '550072490', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/280d53953ed39d790fd9b0b1f5920cfb/5C99EF10/t51.2885-19/s150x150/42633985_1927008894059358_8334422696888631296_n.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(108, 'niallhoran', 'Niall Horan', 21665376, 0, 0, '46983271', 'https://scontent-frt3-2.cdninstagram.com/vp/dff3827af9289aff0151241f13914010/5CCE3743/t51.2885-19/s150x150/38754818_2216697521704999_2250673750569648128_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(109, 'britneyspears', 'Britney Spears', 21415137, 98, 2129, '12246775', '/popular-users/britneyspears.jpg?1541387564', NULL, NULL),
(110, 'camerondallas', 'Cameron Dallas', 21180270, 0, 0, '218943210', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/9e880d750a4faffcdffa212af264a961/5CB47530/t51.2885-19/s150x150/43315608_579062975890667_2158398723267231744_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(111, 'shaymitchell', 'Shay Mitchell', 21179647, 898, 5395, '2364270', '/popular-users/shaymitchell.jpg?1541387572', NULL, NULL),
(112, 'zachking', 'Zach King', 21129771, 22, 819, '14805456', '/popular-users/zachking.jpg?1541387579', NULL, NULL),
(113, '50cent', '50 Cent', 21097904, 87, 2095, '21193118', '/popular-users/50cent.jpg?1541387583', NULL, NULL),
(114, 'danialves', 'DanialvesD2 My Twitter', 20951666, 540, 2489, '248633614', '/popular-users/danialves.jpg?1541387587', NULL, NULL),
(115, 'letthelordbewithyou', 'Scott Disick', 20738656, 42, 1031, '325848806', '/popular-users/letthelordbewithyou.jpg?1541387591', NULL, NULL),
(116, 'voguemagazine', 'Vogue', 20507981, 404, 5291, '198154074', '/popular-users/voguemagazine.jpg?1541387596', NULL, NULL),
(117, 'ciara', 'Ciara', 20200055, 96, 3583, '27914637', '/popular-users/ciara.jpg?1541387601', NULL, NULL),
(118, 'maccosmetics', 'M·A·C Cosmetics', 19941206, 993, 6730, '319897212', '/popular-users/maccosmetics.jpg?1541387605', NULL, NULL),
(119, 'theweeknd', 'The Weeknd', 19606733, 3, 53, '266319242', '/popular-users/theweeknd.jpg?1541387609', NULL, NULL),
(120, 'raisa6690', '', 19329892, 1210, 3429, '8115577', '/popular-users/raisa6690.jpg?1541387613', NULL, NULL),
(121, 'sommerray', 'Sommer Ray', 19258614, 292, 661, '522601519', '/popular-users/sommerray.jpg?1541387617', NULL, NULL),
(122, 'ashleybenson', 'Ashley Benson', 19163260, 0, 0, '2720271', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/9b88f70870ad2b2de58aab30f99d6e61/5CD9D562/t51.2885-19/s150x150/20767004_110776579604525_5587135613187915776_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(123, 'barackobama', 'Barack Obama', 19607824, 0, 0, '10206720', 'https://scontent-sea1-1.cdninstagram.com/vp/5425af64db27c740682ef7c3a60b6d93/5CB4DBA8/t51.2885-19/s150x150/16123627_1826526524262048_8535256149333639168_n.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, NULL),
(124, 'amberrose', 'Amber Rose', 18576011, 282, 453, '278071194', '/popular-users/amberrose.jpg?1541387630', NULL, NULL),
(125, 'bellathorne', 'BELLA', 18430240, 2212, 4811, '9721868', '/popular-users/bellathorne.jpg?1541387633', NULL, NULL),
(126, 'davidluiz_4', 'David Luiz', 18473555, 0, 0, '175975796', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/83df9cb33d403c03834b01d2691918d0/5CD6135C/t51.2885-19/s150x150/43325515_179739376264070_2484603095716200448_n.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(127, 'instagrambrasil', 'Instagram Brasil', 17476150, 206, 1567, '1193780966', '/popular-users/instagrambrasil.jpg?1541387643', NULL, NULL),
(128, 'channingtatum', 'Channing Tatum', 17201662, 410, 806, '20315007', '/popular-users/channingtatum.jpg?1541387647', NULL, NULL),
(129, 'onedirection', 'One Direction', 17119422, 85, 726, '202329761', '/popular-users/onedirection.jpg?1541387652', NULL, NULL),
(130, 'starbucks', 'Starbucks Coffee ☕', 17118591, 3466, 1700, '1034466', '/popular-users/starbucks.jpg?1541387657', NULL, NULL),
(131, 'youtube', 'YouTube', 16653322, 0, 0, '1337343', 'https://scontent-dfw5-2.cdninstagram.com/vp/ac75e7d1f94781953f9c16aa5350259a/5CC0F085/t51.2885-19/s150x150/35999106_2215959818433171_3743893695951273984_n.jpg?_nc_ht=scontent-dfw5-2.cdninstagram.com', NULL, NULL),
(132, 'gisel_la', 'Gisella Anastasia', 18428865, 0, 0, '3261799', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/d72380fda58a598a4cb5205319031d38/5C99BB71/t51.2885-19/s150x150/13642896_1792598734354059_1343937683_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(133, 'gio_ewbank', 'Giovanna Ewbank', 16299881, 0, 0, '13384265', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/0288d3fdbcd5f96fb4e520e534267c56/5CAFB368/t51.2885-19/s150x150/18299067_1394630890617453_2090208210408439808_a.jpg', NULL, NULL),
(134, 'inijedar', 'Jessica Iskandar', 15136853, 0, 0, '54305422', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/8b5be602fbebcbd187946a9ab5c1f726/5C90943A/t51.2885-19/s150x150/20837264_665148070344834_7029309614558543872_a.jpg', NULL, NULL),
(135, 'jasonstatham', 'Jason Statham', 18083764, 0, 0, '1777543238', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/5d93dded969ca5f4e55c1a8338e037dd/5C7C352D/t51.2885-19/s150x150/13402224_561313060714843_108117413_a.jpg', NULL, NULL),
(136, 'thegoodquote', 'Positive & Motivational Quotes', 15234008, 0, 0, '192151340', 'https://instagram.fpnh10-1.fna.fbcdn.net/vp/2f02849a058db2ea4146580f99bfbfbb/5CD908B6/t51.2885-19/10724741_640671322720624_1731364349_a.jpg?_nc_ht=instagram.fpnh10-1.fna.fbcdn.net', NULL, NULL),
(137, 'prada', 'Prada', 17772754, 0, 0, '304662892', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/a4398e74f91b155431b7d5f8948c2288/5CA36E61/t51.2885-19/s150x150/14359996_1495091150508318_322898428_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(138, 'haileybieber', 'Hailey Rhode Bieber', 16266813, 0, 0, '7141291', 'https://scontent-lax3-2.cdninstagram.com/vp/7e8e73b6b27c01ee15bdadcb9c7c4b28/5CA323F9/t51.2885-19/s150x150/40964307_2140990659500917_8794923128951144448_n.jpg', NULL, NULL),
(139, 'k.mbappe', 'Kylian Mbappé', 24328075, 0, 0, '4213518589', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/4f88a3cabb8a3b8a94db4be481233051/5CD618F7/t51.2885-19/s150x150/46337154_530293077486600_561987068998189056_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(140, 'kyliecosmetics', 'Kylie Cosmetics', 18819729, 0, 0, '2223304785', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/f3b061417afd0b36a1ec92efd5378bb2/5CD14FC0/t51.2885-19/s150x150/32035642_1236048826530462_6748121949685153792_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(141, 'kritisanon', 'Kriti', 15813474, 0, 0, '448810631', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/b9c2a41319d9799ed0e2d3c0ddcb2f2c/5CD9C511/t51.2885-19/s150x150/43779008_335432000589391_6232535671538450432_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(142, 'katrinakaif', 'Katrina Kaif', 16794279, 0, 0, '3562982855', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/475af2aa63389a7965c9898328e5a748/5CD33CF7/t51.2885-19/s150x150/35574284_1425937077550443_3257439085756678144_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(143, 'virat.kohli', 'Virat Kohli', 27553068, 0, 0, '2094200507', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/99929acb6427bd39f67dcfa22c2c774f/5C9DDA10/t51.2885-19/s150x150/23421447_154371338501730_9043234412606521344_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(144, 'iamcardib', 'CARDIVENOM', 37781799, 0, 0, '1436859892', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/5ecc51c510410ee1168e45fe3e0ecf9b/5C99A588/t51.2885-19/s150x150/42680589_539814339816821_1579579209284583424_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(145, 'iamsrk', 'Shah Rukh Khan', 15670960, 0, 0, '628480450', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/3ca399e3b753f430ccc43bf7042f81a7/5C9C1060/t51.2885-19/11821175_1046879962002756_496959586_a.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(146, 'championsleague', 'UEFA Champions League', 32291113, 0, 0, '1269788896', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/d6a306f59137759bd70ff8f464d754dd/5C9D3DA7/t51.2885-19/s150x150/45920061_308240136454437_4096753430008168448_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(147, 'dualipa', 'Dua Lipa', 23299640, 0, 0, '12331195', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/dc6a5c5b20de2bdebe511e9627ebd52d/5CB84B3A/t51.2885-19/s150x150/47055064_522143431632706_2073175641422823424_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(148, 'dishapatani', 'disha patani (paatni)', 16223008, 0, 0, '510093911', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/ef77765a45d06af774add9f24d24438c/5CB2F7A9/t51.2885-19/s150x150/36877370_1818026014950669_7397988542095294464_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(149, 'dolcegabbana', 'Dolce & Gabbana', 19091996, 0, 0, '5123245', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/bcc5622e4e1a44c8a066d8e743d01e68/5CB46323/t51.2885-19/s150x150/12531072_1560969467535937_984363712_a.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(150, 'varundvn', 'Varun Dhawan', 16762058, 0, 0, '266928623', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/0265e5c5eb50ce1825c626331de0af7b/5C9723B4/t51.2885-19/s150x150/36086110_2017784938537468_812211361151975424_n.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(151, 'dovecameron', '♡DOVE♡', 22925336, 0, 0, '145312309', 'https://instagram.fhan3-2.fna.fbcdn.net/vp/2fc0eca392048bf2f365942d94a159b5/5CA82724/t51.2885-19/s150x150/47263016_1068455116661152_5232035065843679232_n.jpg?_nc_ht=instagram.fhan3-2.fna.fbcdn.net', NULL, NULL),
(152, 'real__pcy', 'EXO_CY', 16100162, 0, 0, '1292592968', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/2ad179bea22a3ea3293efa52665c580b/5CD93133/t51.2885-19/s150x150/1516181_950410035039603_2032940806_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(153, 'colesprouse', 'Cole Sprouse', 21493822, 0, 0, '1363484236', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/930545cc9addd98386c5ecfeee8590d0/5CB3E7B7/t51.2885-19/s150x150/41537550_255300631844329_5876369087541542912_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(154, 'camila_cabello', 'camila', 28483027, 0, 0, '19596899', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/c28593ea28893f928e8cc123d1f053a2/5CA73279/t51.2885-19/s150x150/43175536_494081787741900_5007697860137844736_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(155, 'ncentineo', 'Noah Centineo', 16158531, 0, 0, '33283012', 'https://scontent-frt3-2.cdninstagram.com/vp/86a0ef5a6d9acf6081120d498dc1ee02/5CB4A7E5/t51.2885-19/s150x150/38431277_222724578419016_8122382661156077568_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(156, 'chiaraferragni', 'Chiara Ferragni', 15721183, 0, 0, '19769622', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/f5acbdd5915cc4c5489163dd877554f2/5CA877B6/t51.2885-19/s150x150/43536318_1986586334734653_2070701877699280896_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(157, 'chloegmoretz', 'Chloe Grace Moretz', 15389046, 0, 0, '11305924', 'https://instagram.fpnh6-1.fna.fbcdn.net/vp/865876dd453861b4de1e616fb0fa4a5d/5C99CD57/t51.2885-19/s150x150/42365148_2154365594826399_4069488436447281152_n.jpg?_nc_ht=instagram.fpnh6-1.fna.fbcdn.net', NULL, NULL),
(158, 'worldstar', 'WorldStar Hip Hop // WSHH', 22051282, 0, 0, '980505357', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/4883b39f2fd14f00899f4e4d8bfa276c/5CD5D97B/t51.2885-19/s150x150/12394007_501183550043840_2101337459_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(159, 'wwe', 'WWE', 16248802, 0, 0, '45145019', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/e8cfb45517d325f2eae4468e5ed12ceb/5CD45EC4/t51.2885-19/10598202_685252491555134_101121370_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(160, 'willsmith', 'Will Smith', 26366440, 0, 0, '3132929984', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/751519ce5ff475b148dce7e10e13a10d/5CA64E26/t51.2885-19/s150x150/25010491_745588952304475_5100777880275648512_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(161, 'wesleysafadao', 'Wesley Safadão', 19973320, 0, 0, '23577429', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/1bdcb920bd2a2824e311015059ede497/5CB4B737/t51.2885-19/s150x150/41415150_487804325030236_6196393942649405440_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(162, 'thehughjackman', 'Hugh Jackman', 22273634, 0, 0, '489110643', 'https://instagram.fpnh10-1.fna.fbcdn.net/vp/aae4072a2c7b8e0293e6882ef23afb76/5CD90F6C/t51.2885-19/s150x150/17268058_359910467741624_7289852282173128704_a.jpg?_nc_ht=instagram.fpnh10-1.fna.fbcdn.net', NULL, NULL),
(163, 'jacquelinef143', 'Jacqueline Fernandez', 23804922, 0, 0, '227407214', 'https://scontent-sof1-1.cdninstagram.com/vp/e39f446b97ba82a03a3b8c79b10f8b43/5CA8A382/t51.2885-19/s150x150/21107407_1216696288434242_2499074506983735296_a.jpg?_nc_ht=scontent-sof1-1.cdninstagram.com', NULL, NULL),
(164, 'juventus', 'Juventus Football Club', 20063040, 0, 0, '194317179', 'https://scontent-sof1-1.cdninstagram.com/vp/c0a8171ef2889e83f5efec2d5223f539/5C99B2C2/t51.2885-19/s150x150/46398195_311254102820754_6566244112062742528_n.jpg?_nc_ht=scontent-sof1-1.cdninstagram.com', NULL, NULL),
(165, 'eljuanpazurita', 'Juanpa Zurita', 19798751, 0, 0, '191110424', 'https://scontent-arn2-1.cdninstagram.com/vp/fbf10bdf1966d523303371741a37dd0c/5CD5FAEE/t51.2885-19/s150x150/43739413_183044989288518_4559135796480704512_n.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(166, 'zidane', 'zidane', 21100934, 0, 0, '1412007771', 'https://scontent-arn2-1.cdninstagram.com/vp/a5af364ef5f59ce572a1fe4d17baac9f/5CA67CF0/t51.2885-19/928834_1612422195638747_774990253_a.jpg?_nc_ht=scontent-arn2-1.cdninstagram.com', NULL, NULL),
(167, 'beingsalmankhan', 'Salman Khan', 20023011, 0, 0, '1547627005', 'https://scontent-sea1-1.cdninstagram.com/vp/d3cf7aa3dae449bd434bf4e16faa82e9/5CBFE104/t51.2885-19/10810066_708040225931789_33645907_a.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, NULL),
(168, 'sunnyleone', 'Sunny Leone', 17261180, 0, 0, '24931858', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/2ed9516fa0b21ce4b88c61b72cd697a6/5CA49CD4/t51.2885-19/s150x150/42003780_255884161738694_1217295286188113920_n.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(169, 'simoneses', 'simoneses', 15491765, 0, 0, '176509437', 'https://instagram.fhan5-2.fna.fbcdn.net/vp/acf386056670676dffdff7e0ca43660a/5CA755B6/t51.2885-19/s150x150/17663712_1093232820789031_8945097549514014720_a.jpg?_nc_ht=instagram.fhan5-2.fna.fbcdn.net', NULL, NULL),
(170, 'maisa', '+A', 18521101, 0, 0, '741697042', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/929a4f8e490a42b607e56ab00e8a3535/5CD8F3BB/t51.2885-19/s150x150/46377176_1132985880197051_2571174273305542656_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(171, 'anushkasharma', 'AnushkaSharma1588', 22105553, 0, 0, '196434978', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/f1cbce7945733195a45c1a39439f0845/5CB4D896/t51.2885-19/s150x150/41704361_534210723671072_8036831692918358016_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(172, 'akshaykumar', 'Akshay Kumar', 23371819, 0, 0, '907025384', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/746a0e15684534ee2d87062df434d947/5CA3CF89/t51.2885-19/s150x150/17265645_1686057661694242_1994307655182581760_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(173, 'antogriezmann', 'Antoine Griezmann', 22927143, 0, 0, '263110431', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/f69574fbcc53e422a66f8b8e3f32ef57/5CB97201/t51.2885-19/s150x150/42125470_247134055906047_4159882272369016832_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(174, 'pewdiepie', 'PewDiePie', 15021416, 0, 0, '13506898', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/472fd5c67727aec7e8881564b94efb0b/5C9BF2D5/t51.2885-19/s150x150/42802192_2147517745488519_3436095027892191232_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(175, 'playstation', 'PlayStation', 15395800, 0, 0, '9766379', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/35ae07bd07e44c3f40d4abf959a0dc1e/5CB957AE/t51.2885-19/s150x150/34503113_2133400580240744_4169158985116549120_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(176, 'psg', 'Paris Saint-Germain', 17723940, 0, 0, '232024162', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/3ab215f4e89f222f5f3694929d75020c/5CD9C3BF/t51.2885-19/s150x150/40639261_2005818639469518_6205927876693327872_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(177, 'premierleague', 'Premier League', 21992206, 0, 0, '208502444', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/1c9a39e38e43b54ab8b317a3bed34e33/5CB3EAE0/t51.2885-19/s150x150/46067945_201196274162065_5496258112409042944_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(178, 'paulodybala', 'Paulo Dybala', 25394404, 0, 0, '371299822', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/c598c5e320c93d5671b8b14ccf7a317f/5CB7CBFF/t51.2885-19/s150x150/38991696_298412237625190_7654889128982478848_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(179, 'prattprattpratt', 'chris pratt', 22096584, 0, 0, '24065795', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/93ed068a6041cc6fcf6b462761312de2/5CA2D31F/t51.2885-19/s150x150/35998514_2087445031478501_4129135104008126464_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(180, 'phil.coutinho', 'Philippe Coutinho', 19292359, 0, 0, '1382894360', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/440a49529004f7c37b1f4d4924f1d8f0/5CD6695F/t51.2885-19/s150x150/42603483_254926322047663_4562035749809029120_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(181, 'kevinho', 'Kevinho', 15794820, 0, 0, '548017775', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/27f2be87e67e21968a4a8f3040ff5af6/5CA4F3C9/t51.2885-19/s150x150/44755205_296674674387677_2229379989910847488_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(182, 'nehakakkar', 'Neha Kakkar', 16705830, 0, 0, '243103112', 'https://scontent-frt3-2.cdninstagram.com/vp/fbf242cea72fd253b1a03f656ea8cda5/5CD21166/t51.2885-19/s150x150/46988089_536460963534937_6207387478379200512_n.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(183, 'toni.kr8s', 'Toni Kroos', 20243597, 0, 0, '1635861286', 'https://instagram.fhan5-1.fna.fbcdn.net/vp/a11597d390dc1c351d923f91b9a30822/5CD552CC/t51.2885-19/s150x150/22802098_503478856676105_1612933203750813696_n.jpg?_nc_ht=instagram.fhan5-1.fna.fbcdn.net', NULL, NULL),
(184, 'xxxtentacion', 'MAKE OUT HILL', 15465032, 0, 0, '17078141', 'https://scontent-frx5-1.cdninstagram.com/vp/0274ba7d80ed380473a50632aeb29b8f/5C9AC76A/t51.2885-19/s150x150/34478447_2149588315274474_3457759693336739840_n.jpg?_nc_ht=scontent-frx5-1.cdninstagram.com', NULL, NULL),
(185, 'xxxibgdrgn', '권지용', 16153942, 0, 0, '196378455', 'https://scontent-frx5-1.cdninstagram.com/vp/de1fb1c2acccb561564a43f1e6a11135/5CB31EBD/t51.2885-19/s150x150/18950263_324780477958081_3378561527190650880_a.jpg?_nc_ht=scontent-frx5-1.cdninstagram.com', NULL, NULL),
(186, 'narendramodi', 'Narendra Modi', 15941393, 0, 0, '1550693326', 'https://scontent-frt3-2.cdninstagram.com/vp/f05e734deff60858c3058ca7dbc4bb2b/5C9EE86F/t51.2885-19/10785125_732015440209238_1064321366_a.jpg?_nc_ht=scontent-frt3-2.cdninstagram.com', NULL, NULL),
(187, 'lilpump', '', 17270907, 0, 0, '245009038', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/b721f56077382bf5e4430a54863539b4/5CA2F6A0/t51.2885-19/s150x150/46644011_513684722473784_1850387007650398208_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(188, 'luansantana', 'Luan Santana', 19886084, 0, 0, '6311667', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/f8655f6887b26fb366dba682450dc639/5CCEFADD/t51.2885-19/s150x150/40420715_2194297290826632_5848822425730416640_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(189, 'larissamanoela', 'Larissa Manoela', 17779027, 0, 0, '1665466078', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/3862a99b963a888e448a39c1c076a05d/5CD470BB/t51.2885-19/s150x150/39075486_924523051068250_5573780378021265408_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(190, 'liampayne', 'Liam Payne', 17304478, 0, 0, '1293310212', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/00c4078943e6b7e5d28ed3c4033a7179/5CCCC8BD/t51.2885-19/s150x150/45861723_806516593023783_2887624418543009792_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(191, 'loganpaul', 'Logan Paul', 16263937, 0, 0, '493525227', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/47d0cf0a7a7ac6856ac6b7a31c4c1e15/5C98AA22/t51.2885-19/s150x150/39486042_848335175290096_6625828085985968128_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(192, 'lukamodric10', 'Luka Modric', 16541883, 0, 0, '177031233', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/0d15378574eeaa691cb1bc501db7150f/5CBECB3E/t51.2885-19/s150x150/47161318_210271096543423_204430723778609152_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(193, 'lamborghini', 'Lamborghini', 16282346, 0, 0, '22686243', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/287584f82e7b71f7db49f234741cd6ed/5CD20214/t51.2885-19/10914351_445156875637393_373836994_a.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(194, 'gusttavolima', 'Gusttavo Lima', 15189043, 0, 0, '22079794', 'https://instagram.fhan5-4.fna.fbcdn.net/vp/d2741d75c440dec3432daa03244b99d8/5CB3013B/t51.2885-19/s150x150/43732665_182296949314929_7317430125446823936_n.jpg?_nc_ht=instagram.fhan5-4.fna.fbcdn.net', NULL, NULL),
(195, 'brunomars', 'Bruno Mars', 21796073, 0, 0, '20053826', 'https://scontent-sea1-1.cdninstagram.com/vp/391bf2001c5894356e4259547dcb7d74/5C9DB44B/t51.2885-19/s150x150/14676713_297352673997609_6758752023807524864_a.jpg?_nc_ht=scontent-sea1-1.cdninstagram.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `role`, `provider`, `provider_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'abc', 'admin@abc.vn', '$2y$10$.lyVBM0CHLhXg.B.TM3dV.DUeyFVYg8d1dR72ao2JtuzQNGeoFXmS', 'QBkGwYPpYmzTgCpyRkyf3LVFSyPRhdr3zeI0JF6Hcsdm3mjWAXPin38zxF5L', 'admin', NULL, NULL, NULL, '2018-03-15 07:48:45', '2018-03-20 17:07:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_groups`
--
ALTER TABLE `article_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_tags`
--
ALTER TABLE `article_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_blocks`
--
ALTER TABLE `client_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_groups`
--
ALTER TABLE `client_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_menus`
--
ALTER TABLE `client_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_tags`
--
ALTER TABLE `group_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_feeds`
--
ALTER TABLE `s_feeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`(191));

--
-- Indexes for table `s_locations`
--
ALTER TABLE `s_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`(191));

--
-- Indexes for table `s_tags`
--
ALTER TABLE `s_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`(191));

--
-- Indexes for table `s_users`
--
ALTER TABLE `s_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `key` (`key`(191));

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tops`
--
ALTER TABLE `tops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `article_groups`
--
ALTER TABLE `article_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `article_tags`
--
ALTER TABLE `article_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `client_blocks`
--
ALTER TABLE `client_blocks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_groups`
--
ALTER TABLE `client_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `client_menus`
--
ALTER TABLE `client_menus`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `group_tags`
--
ALTER TABLE `group_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `s_feeds`
--
ALTER TABLE `s_feeds`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s_locations`
--
ALTER TABLE `s_locations`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `s_tags`
--
ALTER TABLE `s_tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=779;
--
-- AUTO_INCREMENT for table `s_users`
--
ALTER TABLE `s_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tops`
--
ALTER TABLE `tops`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

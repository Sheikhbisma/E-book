-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 07:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(2, 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `adult_entries`
--

CREATE TABLE `adult_entries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pdf_file` varchar(255) NOT NULL,
  `status` enum('submitted','winner','loser') DEFAULT 'submitted',
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adult_entries`
--

INSERT INTO `adult_entries` (`id`, `user_id`, `name`, `email`, `pdf_file`, `status`, `submitted_at`) VALUES
(1, 7, 'subhan', 'subhan@gmail.com', '7_1765912987.pdf', 'submitted', '2025-12-17 00:23:07'),
(2, 1, 'Bisma sheikh', 'bismasheikh@gmail.com', '1_1766002389.pdf', 'winner', '2025-12-18 01:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(200) NOT NULL,
  `category` enum('Comics','Story Books','Novels','General Knowledge','Children Books') NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `pdf_path` varchar(300) DEFAULT NULL,
  `cover_image` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category`, `description`, `price`, `pdf_path`, `cover_image`, `created_at`) VALUES
(11, '100 Bullets', 'Brian Azzarello', 'Comics', '100 Bullets follows Agent Graves as he offers people a briefcase containing a gun, 100 untraceable bullets, and evidence to take revenge with no consequences. The story unravels into a dark, complex conspiracy involving a secret organization known as The Trust.', 27.00, 'pdfs/1765122767_100 Bullets _compressed.pdf', 'img/1765551727_100-bullets.jpg', '2025-12-07 10:52:47'),
(12, 'Aesops fables', 'Aesop', 'Comics', 'Aesop’s Fables is a classic collection of short moral stories featuring animals with human-like behavior. Each fable teaches a simple life lesson about wisdom, honesty, and good character.', 80.00, 'pdfs/1765123063_Aesops fables_compressed.pdf', 'img/1765123063_Aesops fables.jpg', '2025-12-07 10:57:43'),
(13, 'Space Rangers', 'Ben Bova', 'Comics', 'Space Rangers is a science-fiction adventure about a team of elite space heroes who protect the galaxy from alien threats and dangerous missions. The story focuses on action, exploration, and futuristic technology as the Rangers travel across space to defend humanity.\r\n', 40.00, 'pdfs/1765123408_Space Rangers_compressed.pdf', 'img/1765123408_Space Rangers.jpg', '2025-12-07 11:03:28'),
(14, 'The Sandman', 'Neil Gaiman', 'Comics', 'The Sandman is a dark fantasy comic series that follows Dream (Morpheus), one of the Endless, as he rules the world of dreams and navigates myth, magic, and human stories. The series blends horror, fantasy, and mythology into deep, imaginative storytelling.', 70.00, 'pdfs/1765123606_The Sandman_compressed.pdf', 'img/1765554136_the-sandman.jpg', '2025-12-07 11:06:46'),
(15, 'The-Alchemist', 'Paulo Coelho ', 'Story Books', 'The Alchemist is an inspirational novel about Santiago, a young shepherd who follows his dream to find a hidden treasure. Along his journey, he learns about destiny, personal legend, and the importance of listening to his heart.', 90.00, 'pdfs/1765124424_15-05-2021-084550The-Alchemist-Paulo-Coelho_compressed_compressed.pdf', 'img/1765551894_alchemist.jpg', '2025-12-07 11:20:24'),
(16, 'The Da Vinci Code', 'Dan Brown', 'Story Books', 'The Da Vinci Code is a fast-paced mystery thriller that follows symbologist Robert Langdon as he uncovers hidden clues in famous artworks and religious symbols. The story revolves around a secret society, a murder in the Louvre, and a shocking conspiracy tied to Christian history.', 100.00, 'pdfs/1765124629_The Da Vinci Code_compressed.pdf', 'img/1765554377_the-da-vinci-code.jpg', '2025-12-07 11:23:49'),
(17, 'The girl with he dragon tattoo', 'Stieg Larsson', 'Story Books', 'The Girl with the Dragon Tattoo is a gripping mystery thriller about journalist Mikael Blomkvist and hacker Lisbeth Salander as they investigate a wealthy family’s dark secrets. The story blends crime, suspense, and psychological depth with a powerful, fast-paced narrative.', 120.00, 'pdfs/1765124926_the_girl_with_the_dragon_tattoo_compressed.pdf', 'img/1765124926_the_girl_with_the_dragon_tattoo.jpg', '2025-12-07 11:28:46'),
(18, 'The fault in our stars', 'John Green', 'Story Books', 'The Fault in Our Stars is an emotional love story about two teenagers, Hazel and Gus, who meet in a cancer support group and form a deep bond. The novel explores love, pain, hope, and the beauty of life even in difficult circumstances.', 150.00, 'pdfs/1765125063_the-fault-in-our-stars_compressed.pdf', 'img/1765551908_the-fault-in-our-star.jpg', '2025-12-07 11:31:03'),
(19, 'Heart_Darkness', 'Joseph Conrad', 'Novels', 'Heart of Darkness is a psychological and adventure novella about a man named Marlow who travels into the African Congo to find the mysterious ivory trader Kurtz. The story explores themes of imperialism, human nature, and the darkness that exists within civilization.', 110.00, 'pdfs/1765125402_Heart_Darkness_compressed.pdf', 'img/1765125402_Heart Darkness.jpg', '2025-12-07 11:36:42'),
(20, 'Hunting-Adeline', 'H. D. Carlton', 'Novels', 'Hunting Adeline is a dark romance thriller that follows Adeline, a young writer, and Zade, a dangerous stalker who becomes obsessed with her. The story blends suspense, obsession, fear, and intense attraction as their twisted connection grows.', 170.00, 'pdfs/1765125629_Preview-Hunting-Adeline-by-H.D.Carlton_compressed_compressed.pdf', 'img/1765551928_hunting-adeline.jpg', '2025-12-07 11:40:29'),
(21, 'Pride and Prejudice', 'Jane Austen', 'Novels', 'Pride and Prejudice is a classic romantic novel that follows Elizabeth Bennet and her evolving relationship with the wealthy, mysterious Mr. Darcy. The story explores love, class, pride, and misunderstandings in 19th-century society.', 160.00, 'pdfs/1765125762_Pride_compressed.pdf', 'img/1765553955_pride-and-prejudice.jpg', '2025-12-07 11:42:42'),
(22, 'The advance of the English', 'William Lyon Phelps', 'Novels', 'The Advance of the English Novel is a literary study that explores how the English novel evolved in style, themes, and storytelling from its early beginnings to the modern era. Phelps analyzes major authors and trends, showing how the novel became a powerful form of artistic expression.', 115.00, 'pdfs/1765125959_The_advance_of_the_English_novel.pdf', 'img/1765125959_The_advance_of_the_English_novel.jpg', '2025-12-07 11:45:59'),
(23, 'Confessions of a British Spy', 'Anonymous (Attributed to “Hempher”)', 'General Knowledge', 'Confessions of a British Spy is a controversial narrative presented as the diary of a British agent sent to the Ottoman Empire to undermine Islam from within. The text is generally regarded as a fabricated story created for political or ideological purposes rather than a factual historical account.', 130.00, 'pdfs/1765127191_Confessions_of_a_British_Spy_compressed.pdf', 'img/1765551950_confession-of-a-british-spy.webp', '2025-12-07 12:06:31'),
(24, 'Encyclopedia of General Knowledge', 'A. R. Farooq', 'General Knowledge', 'Encyclopedia of General Knowledge is a comprehensive reference book that covers important facts, concepts, and information from various subjects such as history, science, geography, and current affairs. It is designed to help students and competitive exam candidates improve their general knowledge quickly and effectively.', 210.00, 'pdfs/1765127460_Encyclopedia of General Knowledge_compressed.pdf', 'img/1765127460_Encyclopedia of General Knowledge.jpg', '2025-12-07 12:11:00'),
(25, 'General Knowledge 2025', 'Adeel Niaz', 'General Knowledge', 'General Knowledge 2025 is a comprehensive exam-preparation book that covers updated information from Pakistan Affairs, World General Knowledge, Science, Geography, IT, and Current Affairs. It is designed to help students prepare for competitive exams by providing concise facts, practice questions, and updated data.', 119.00, 'pdfs/1765128367_General Knowledge 2025_compressed.pdf', 'img/1765128367_General Knowledge 2025.jpg', '2025-12-07 12:26:07'),
(26, 'General Knowledge Refresher ', 'O. P. Khanna', 'General Knowledge', 'General Knowledge Refresher is a comprehensive guide that covers key facts from science, history, geography, civics, and current affairs. It is designed to help students strengthen their general knowledge and prepare for competitive exams with clear, concise information.', 160.00, 'pdfs/1765128884_General Knowledge Refresher_compressed.pdf', 'img/1765128884_General Knowledge Refresher.jpg', '2025-12-07 12:34:44'),
(27, '12-CarRace-by-Starfall', 'Starfall Education Foundation', 'Children Books', 'Description:\r\n12 Car Race is a simple educational story designed to help young children learn counting and number recognition. The book uses colorful cars racing together to teach basic math skills in a fun and engaging way.', 210.00, 'pdfs/1765129756_12-CarRace-by-Starfall_compressed.pdf', 'img/1765129756_12-CarRace-by-Starfall.jpg', '2025-12-07 12:49:16'),
(28, 'Goodnight Moon', 'Margaret Wise Brown Illustrator: Clement Hurd', 'Children Books', 'Goodnight Moon is a gentle bedtime story in which a young bunny says goodnight to everything around him. Its simple, soothing rhythm helps children relax and drift peacefully to sleep.', 116.00, 'pdfs/1765130217_Goodnight-Moon-Book_compressed.pdf', 'img/1765551975_goodnight-moon.webp', '2025-12-07 12:56:57'),
(29, 'kids', 'Laurie Schneider Adams', 'Children Books', 'Kids is a nonfiction book that explores childhood, culture, and the ways children grow and learn in different societies. It presents meaningful stories and insights about children’s lives and development.', 210.00, 'pdfs/1765130381_kids_compressed.pdf', 'img/1765551988_homework-yuck.jpg', '2025-12-07 12:59:41'),
(30, 'THE CAT IN THE HAT ', 'Dr. Seuss', 'Children Books', 'The Cat in the Hat is a fun and imaginative children’s book about a mischievous cat who brings chaos and excitement into the home of two kids while their mother is away. Filled with rhyme and humor, it’s one of the most beloved early reading classics.', 217.00, 'pdfs/1765130626_THE-CAT-IN-THE-HAT_compressed.pdf', 'img/1765130626_THE-CAT-IN-THE-HAT.jpg', '2025-12-07 13:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `competition_entries`
--

CREATE TABLE `competition_entries` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `essay_text` text DEFAULT NULL,
  `word_count` int(11) DEFAULT 0,
  `status` enum('submitted','winner','loser','abandoned') DEFAULT 'submitted',
  `submitted_at` datetime DEFAULT current_timestamp(),
  `topic_id` int(11) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competition_entries`
--

INSERT INTO `competition_entries` (`id`, `event_id`, `user_id`, `topic`, `essay_text`, `word_count`, `status`, `submitted_at`, `topic_id`, `start_time`, `end_time`) VALUES
(9, 1, 3, 'my lovely home', 'hello', 1, '', '2025-12-17 21:11:14', NULL, '2025-12-17 16:11:14', '2025-12-17 16:12:14'),
(10, 1, 1, 'my lovely home', 'hello', 1, 'winner', '2025-12-18 01:15:30', 0, '2025-12-17 20:35:32', '2025-12-17 20:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `competition_events`
--

CREATE TABLE `competition_events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `min_words` int(11) DEFAULT 1000,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `end_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competition_events`
--

INSERT INTO `competition_events` (`id`, `name`, `min_words`, `start_time`, `end_time`, `created_at`) VALUES
(1, 'Children Essay Competition', 1000, '2025-12-16 05:23:56', '2025-12-16 05:24:43', '2025-12-15 11:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `competition_topics`
--

CREATE TABLE `competition_topics` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competition_topics`
--

INSERT INTO `competition_topics` (`id`, `event_id`, `topic_name`, `created_at`) VALUES
(10, 1, 'my lovely home', '2025-12-15 19:06:54'),
(11, 1, 'A day in my life', '2025-12-15 19:07:09'),
(12, 1, 'education', '2025-12-15 19:12:46'),
(13, 1, 'picnic', '2025-12-16 16:07:13'),
(15, 1, 'my hero', '2025-12-16 16:50:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_register`
--

CREATE TABLE `customer_register` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_image` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_location` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_register`
--

INSERT INTO `customer_register` (`customer_id`, `customer_name`, `customer_email`, `customer_contact`, `customer_image`, `customer_address`, `customer_location`, `customer_pass`) VALUES
(1, 'Bisma sheikh', 'bismasheikh@gmail.com', '03212038938', '176510222969355295756bc-add.jfif', 'kljlknfwhjholKM', 'KarachiPakistan', '$2y$10$7fvwUZNEFCak/cIKfOJmq.QtWa9Sj/fUl5h8FGTpaTdueGRZzjgTC'),
(2, 'Sidra', 'sidra@gmail.com', '03987058903', '1765722453693ec95532d82-register-1.jfif', 'H-no-24,north karachi', 'KarachiPakistan', '$2y$10$5ADmfNcj1ojS6NtFciy1neQKAqMDL.LTCDecss3dna9Q/tqB2p9i6'),
(3, 'sawera', 'sawera@gmail.com', '03874390876', '1765722599693ec9e7483d1-register-1.jfif', 'Apt 504, north nazimabad', 'KarachiPakistan', '$2y$10$JnDcYXU6nDvQ4mzESu6ViOLDyJKGa51w0YKvkiIzm/a00JU0nbP8q'),
(4, 'wania', 'wania@gmail.com', '03892689765', '1765722658693eca229b11d-register-1.jfif', 'Apt 404, surjani town', 'KarachiPakistan', '$2y$10$iihHqHwwD8Yfo8h1kn7G0uaGzV.hgWEMlZ5seGDQSuZ5ATU/t6B4.'),
(5, 'nimra', 'nimra@gmail.com', '03560912467', '1765722716693eca5c3e90e-register-1.jfif', 'Apt 108, north karachi', 'lahorepakistan', '$2y$10$JqyX3xs1xOdWd/YecPX2GOP8liKLu4mIBnrwMNsG0QaN2Sxz9PjRC'),
(6, 'Ali', 'ali@gmail.com', '03680987245', '1765722865693ecaf124353-register-2.jfif', 'Apt 504, gulshan e iqbal', 'multanPakistan', '$2y$10$r.42NNlJ/10ZmbFQtm2fHOBb7T4YcMbRXsgu4033H5uM4U0vQuTTu'),
(7, 'subhan', 'subhan@gmail.com', '03670147800', '1765722922693ecb2a5f77d-register-2.jfif', 'Apt 504, gulshan e hadeed', 'LahorePakistan', '$2y$10$uXmwj197/BqUuorCvlh..uqTGoIG6odThvVCYpB3yOt2SQAhRlASm'),
(8, 'saad', 'saad@gmail.com', '03670987654', '1765723010693ecb820a1f4-register-2.jfif', 'Apt 504, north nazimabad', 'KarachiPakistan', '$2y$10$9XHLClegPH.HeYic4WWH2uNs5i03gGJ6UAX6E1lNJujf3id1XPgSW'),
(9, 'bilal', 'bilal@gmail.com', '03780987439', '1765723059693ecbb37e9e9-register-2.jfif', 'Apt 504, north nazimabad', 'KarachiPakistan', '$2y$10$jzN7yUVQLcVRyAmxP5.kqemurjL.VkmMcg4LownN0/siMuYC.d9cK'),
(10, 'rafay', 'rafay@gmail.com', '03679812456', '1765723116693ecbec3d272-register-2.jfif', 'Apt 504, north karachi', 'KarachiPakistan', '$2y$10$gAwOpgbQLTnK1U9uyHOin.gXdw8Px06ZEawpUzE1kYnqQcWLezaH6'),
(11, 'mehjabeen', 'mehjabeenrehman@gmail.com', '03987058903', '17661481136945481182a7d-lucent-general-knowledge.jpg', 'h-no:xyz.north karahi', 'KarachiPakistan', '$2y$10$GIJ.WRR2vTeRxxUoHGMwlu/EuPj.XXR2J8bXwxpSCDdsxv/nmdKeK');

-- --------------------------------------------------------

--
-- Table structure for table `freebooks`
--

CREATE TABLE `freebooks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(200) NOT NULL,
  `category` enum('Comics','Story Books','Novels','General Knowledge','Children Books') NOT NULL,
  `description` text DEFAULT NULL,
  `pdf_path` varchar(300) DEFAULT NULL,
  `cover_image` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `freebooks`
--

INSERT INTO `freebooks` (`id`, `title`, `author`, `category`, `description`, `pdf_path`, `cover_image`, `created_at`) VALUES
(1, 'The Very Hungry Caterpillar', 'Eric Carle', 'Children Books', 'It tells the story of a tiny caterpillar who emerges from an egg and eats his way through a variety of foods, growing bigger each day. Through this simple narrative, the book teaches young children about numbers, days of the week, and the process of metamorphosis', 'pdfs/1765725397_THE-VERY-HUNGRY-CATERPILLAR_compressed.pdf', 'img/1765725397_the-very-hungry-caterpillar.jpg', '2025-12-14 15:16:37'),
(2, 'Alice through the looking glass', 'Lewis Carroll', 'Novels', 'The story plays with logic, language, and imagination, creating whimsical adventures while exploring themes of identity, time, and reality. Like its predecessor, it is celebrated for its playful poetry, clever wordplay, and imaginative narrative that continues to captivate both children and adults.', 'pdfs/1765726197_Through_the_Looking_glass_and_what_Alice_compressed.pdf', 'img/1765733740_Through_the_Looking_glass_and_what_Alice.jpg', '2025-12-14 15:29:57'),
(3, 'Lucent General Knowledge', 'Dr. Binay Karna', 'General Knowledge', 'Lucent General Knowledge is a popular reference book widely used by students and competitive exam aspirants in India. It covers a broad range of topics including History, Geography, Polity, Economy, Science, Current Affairs, and General Science, presented in a concise and easy-to-understand format. The book is designed for quick revision and helps readers', 'pdfs/1765726568_Lucent’s General Knowledge_compressed.pdf', 'img/1765726568_lucent-general-knowledge.jpg', '2025-12-14 15:36:08'),
(4, 'Watchmen', 'Alan Moore', 'Comics', 'The story follows a group of former superheroes as they uncover a conspiracy that could threaten the world. Renowned for its dark, mature storytelling, intricate plotting, and deconstruction of the traditional superhero archetype, Watchmen is considered one of the most influential graphic novels of all time.', 'pdfs/1765733727_watchmen_compressed.pdf', 'img/1765733727_watchmen.jpg', '2025-12-14 17:35:27'),
(5, 'The Hitchhiker’s Guide to the Galaxy', 'Douglas Adams', 'Story Books', 'The story is famous for its humor, satire, and absurd take on life, the universe, and everything, blending science fiction with philosophical comedy. The book has become a cult classic, loved for its witty writing and imaginative storytelling.', 'pdfs/1765733838_The-Hitchhikers-Guide-to-the-Galaxy-Douglas-Adams_compressed.pdf', 'img/1765733838_The-Hitchhikers-Guide-to-the-Galaxy-Douglas-Adams.jpg', '2025-12-14 17:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `book_format` varchar(50) NOT NULL,
  `payment_method` enum('paypal','creditcard','debitcard') NOT NULL,
  `payment_status` enum('Pending','Received','Failed') DEFAULT 'Pending',
  `order_status` enum('Pending','Done','Shipped','delivered') DEFAULT 'Pending',
  `grand_total` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `full_name`, `email`, `city`, `address`, `book_format`, `payment_method`, `payment_status`, `order_status`, `grand_total`, `created_at`) VALUES
(17, 1, 'bisma', 'bismasheikh2006@gmail.com', 'karachi', ' h-no:xyz', 'cd', 'creditcard', 'Pending', 'Pending', 54.00, '2025-12-21 07:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `book_title` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `book_id`, `quantity`, `book_title`) VALUES
(23, 17, 11, 2, '100 Bullets');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'shipping_rate', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adult_entries`
--
ALTER TABLE `adult_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `competition_entries`
--
ALTER TABLE `competition_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_topic_id` (`topic_id`);

--
-- Indexes for table `competition_events`
--
ALTER TABLE `competition_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `competition_topics`
--
ALTER TABLE `competition_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competition_topics_ibfk_1` (`event_id`);

--
-- Indexes for table `customer_register`
--
ALTER TABLE `customer_register`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `freebooks`
--
ALTER TABLE `freebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `adult_entries`
--
ALTER TABLE `adult_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `competition_entries`
--
ALTER TABLE `competition_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `competition_topics`
--
ALTER TABLE `competition_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `customer_register`
--
ALTER TABLE `customer_register`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `freebooks`
--
ALTER TABLE `freebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adult_entries`
--
ALTER TABLE `adult_entries`
  ADD CONSTRAINT `adult_entries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_register` (`customer_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customer_register` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `competition_topics`
--
ALTER TABLE `competition_topics`
  ADD CONSTRAINT `competition_topics_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `competition_events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

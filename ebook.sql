-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2025 at 04:02 AM
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
(3, 2, 'Sidra', 'sidra@gmail.com', '2_1766534143.pdf', 'submitted', '2025-12-24 04:55:43'),
(4, 3, 'sawera', 'sawera@gmail.com', '3_1766534237.pdf', 'winner', '2025-12-24 04:57:17'),
(5, 4, 'wania', 'wania@gmail.com', '4_1766534314.pdf', 'winner', '2025-12-24 04:58:34'),
(6, 2, 'Sidra', 'sidra@gmail.com', '2_1766857817.pdf', 'winner', '2025-12-27 22:50:17'),
(8, 11, 'mehjabeen', 'mehjabeenrehman@gmail.com', '11_1766993140.pdf', 'submitted', '2025-12-29 12:25:40'),
(10, 18, 'Bisma', 'bismasheikh2006@gmail.com', '18_1767040940.pdf', 'loser', '2025-12-30 01:42:20'),
(11, 3, 'sawera', 'sawera@gmail.com', '3_1767044318.pdf', 'submitted', '2025-12-30 02:38:38');

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
(12, 1, 5, 'A day in my life', 'A day in my life', 5, 'loser', '2025-12-24 05:06:40', 0, '2025-12-29 20:48:44', '2025-12-24 00:07:40'),
(13, 1, 9, 'education', 'Education is very powerful key', 5, 'winner', '2025-12-24 05:08:26', 0, '2025-12-27 20:05:32', '2025-12-24 00:09:26'),
(14, 1, 6, 'picnic', 'A perfect day for me and you.', 7, 'winner', '2025-12-24 05:14:08', 0, '2025-12-27 20:05:26', '2025-12-24 00:15:08'),
(15, 1, 8, 'my hero', 'my hero is Muhammad He is the best personailty', 9, 'winner', '2025-12-24 05:17:07', 0, '2025-12-27 20:05:20', '2025-12-24 00:18:07'),
(21, 1, 18, 'picnic', 'A picnic is a wonderful way to spend quality time with loved ones, surrounded by nature and delicious food. In this essay, we will explore the joys of a picnic', 30, 'winner', '2025-12-30 01:41:05', 0, '2025-12-29 20:41:33', '2025-12-29 20:42:05'),
(22, 1, 3, 'my hero', 'my hero is my father.', 5, '', '2025-12-30 02:39:03', NULL, '2025-12-29 21:39:03', '2025-12-29 21:40:03');

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
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(24, 'subhan', 'subhan@gmail.com', 'i have a query about books!', '2025-12-30 07:35:44'),
(25, 'wania', 'wania@gmail.com', 'How To Place Order?', '2025-12-30 07:36:45'),
(26, 'sawera', 'sawera@gmail.com', 'This Website Is Very Informative!', '2025-12-30 07:37:52'),
(27, 'Sidra', 'sidra@gmail.com', 'how many categories you have?', '2025-12-30 07:39:07'),
(28, 'Bisma', 'bismasheikh2006@gmail.com', 'winner prize?', '2025-12-30 07:41:07');

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
(2, 'Sidra', 'sidra@gmail.com', '03987058903', '1765722453693ec95532d82-register-1.jfif', 'H-no-24,north karachi', 'KarachiPakistan', '$2y$10$5ADmfNcj1ojS6NtFciy1neQKAqMDL.LTCDecss3dna9Q/tqB2p9i6'),
(3, 'sawera', 'sawera@gmail.com', '03874390876', '1765722599693ec9e7483d1-register-1.jfif', 'Apt 504, north nazimabad', 'KarachiPakistan', '$2y$10$JnDcYXU6nDvQ4mzESu6ViOLDyJKGa51w0YKvkiIzm/a00JU0nbP8q'),
(4, 'wania', 'wania@gmail.com', '03892689765', '1765722658693eca229b11d-register-1.jfif', 'Apt 404, surjani town', 'KarachiPakistan', '$2y$10$iihHqHwwD8Yfo8h1kn7G0uaGzV.hgWEMlZ5seGDQSuZ5ATU/t6B4.'),
(5, 'nimra', 'nimra@gmail.com', '03560912467', '1765722716693eca5c3e90e-register-1.jfif', 'Apt 108, north karachi', 'lahorepakistan', '$2y$10$JqyX3xs1xOdWd/YecPX2GOP8liKLu4mIBnrwMNsG0QaN2Sxz9PjRC'),
(6, 'Ali', 'ali@gmail.com', '03680987245', '1765722865693ecaf124353-register-2.jfif', 'Apt 504, gulshan e iqbal', 'multanPakistan', '$2y$10$r.42NNlJ/10ZmbFQtm2fHOBb7T4YcMbRXsgu4033H5uM4U0vQuTTu'),
(7, 'subhan', 'subhan@gmail.com', '03670147800', '1765722922693ecb2a5f77d-register-2.jfif', 'Apt 504, gulshan e hadeed', 'LahorePakistan', '$2y$10$uXmwj197/BqUuorCvlh..uqTGoIG6odThvVCYpB3yOt2SQAhRlASm'),
(8, 'saad', 'saad@gmail.com', '03670987654', '1765723010693ecb820a1f4-register-2.jfif', 'Apt 504, north nazimabad', 'KarachiPakistan', '$2y$10$9XHLClegPH.HeYic4WWH2uNs5i03gGJ6UAX6E1lNJujf3id1XPgSW'),
(9, 'bilal', 'bilal@gmail.com', '03780987439', '1765723059693ecbb37e9e9-register-2.jfif', 'Apt 504, north nazimabad', 'KarachiPakistan', '$2y$10$jzN7yUVQLcVRyAmxP5.kqemurjL.VkmMcg4LownN0/siMuYC.d9cK'),
(10, 'rafay', 'rafay@gmail.com', '03679812456', '1765723116693ecbec3d272-register-2.jfif', 'Apt 504, north karachi', 'KarachiPakistan', '$2y$10$gAwOpgbQLTnK1U9uyHOin.gXdw8Px06ZEawpUzE1kYnqQcWLezaH6'),
(11, 'mehjabeen', 'mehjabeenrehman@gmail.com', '03987058903', '17661481136945481182a7d-lucent-general-knowledge.jpg', 'h-no:xyz.north karahi', 'KarachiPakistan', '$2y$10$GIJ.WRR2vTeRxxUoHGMwlu/EuPj.XXR2J8bXwxpSCDdsxv/nmdKeK'),
(15, 'sawera', 'subhan12890973@gmail.com', '03212038938', '1766795423694f289fb1bde-3.jpg', 'h-no:xyzhello', 'Karachi,Pakistan', '$2y$10$4NwW.ck9G27D1tDg5YnRF.ajTpDHCgVFNZXkGA3C3WFhNdXWud8j2'),
(18, 'Bisma', 'bismasheikh2006@gmail.com', '03212038938', '17670403006952e52c5a03f-register-1.jfif', 'h-no:xyz,north', 'Karachi,Pakistan', '$2y$10$LUMOubG.ZCmBlpdSV8Pd/exwoj.LzTqjgQo3wmQ9pNEhCP9a5PeHK');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `dealer_id` int(11) NOT NULL,
  `dealer_name` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`dealer_id`, `dealer_name`, `city`, `contact_number`, `email`, `status`, `password`) VALUES
(2, 'sawera', 'karachi', '0317837338823', 'syedasaweranoorhussainshah27@gmail.com', 'Active', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_books`
--

CREATE TABLE `dealer_books` (
  `dealer_book_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dealer_books`
--

INSERT INTO `dealer_books` (`dealer_book_id`, `dealer_id`, `title`, `author`, `category`, `description`, `price`, `pdf_path`, `cover_image`, `created_at`) VALUES
(2, 2, 'Super Kid Adventures', ' Alex Martin', 'Comics', 'This comic follows the exciting adventures of a young boy who gains superpowers after a science experiment. He uses his abilities to protect his city and help people in need.\r\n \r\n', 200.00, 'pdfs/1766768737_Super Kid Adventures_compressed.pdf', 'img/1766768737_The super kid adventure.jpg', '2025-12-26 17:05:37'),
(3, 2, 'Robo Boy', 'Kevin Turner', 'Comics', 'Robo Boy is a fun and futuristic comic about a robot with human emotions. The story focuses on friendship, technology, and the importance of using power wisely.\r\n', 230.00, 'pdfs/1766768823_Robo Boy_compressed.pdf', 'img/1766768823_Robo Boy.jpg', '2025-12-26 17:07:03'),
(4, 2, 'The Secret of the Old Tree', 'James Anderson', 'Story Books', 'This story follows a group of children who discover a mysterious old tree in their village. As they uncover its secrets, they learn valuable lessons about friendship, teamwork, and bravery.\r\n', 240.00, 'pdfs/1766768966_The Secret of the Old Tree_compressed.pdf', 'img/1766768966_The Secret of the Old Tree.jpg', '2025-12-26 17:09:26'),
(5, 2, ' The Lost Necklace', 'Sophia Martin', 'Story Books', 'A touching story about a young girl who loses a precious necklace and goes on an emotional journey to find it. Along the way, she learns the importance of honesty and patience.\r\n', 280.00, 'pdfs/1766769046_The Lost Necklace_compressed.pdf', 'img/1766769046_The lost necklace.jpg', '2025-12-26 17:10:46'),
(6, 2, 'Beyond the Horizon', 'Michael Anderson', 'Novels', 'A motivational novel about a man who leaves his hometown to chase his dreams. The story focuses on courage, self-discovery, and the power of hope.\r\n', 215.00, 'pdfs/1766769248_Beyond the Horizon_compressed.pdf', 'img/1766769248_Beyond the Horizon.jpg', '2025-12-26 17:14:08'),
(7, 2, 'Whispers of the Past', 'Emma Collins', 'Novels', 'This novel revolves around old memories and forgotten secrets. When the past returns, the main character must face the truth to find peace and happiness.\r\n', 220.00, 'pdfs/1766769365_Whispers of the Past_compressed.pdf', 'img/1766769365_Whispers of the Past.jpg', '2025-12-26 17:16:05'),
(8, 2, ' Brain Booster GK', 'Nancy Clark', 'General Knowledge', 'A perfect book for children and teenagers to enhance their thinking skills. It includes quizzes, short questions, and informative content to boost memory and learning.\r\n', 255.00, 'pdfs/1766769466_Brain Booster GK_compressed.pdf', 'img/1766769466_Brain Booster GK.jpg', '2025-12-26 17:17:46'),
(9, 2, 'Exploring Maps and World Mountains', 'David Miller', 'General Knowledge', 'This book provides detailed information about world maps, continents, oceans, and major mountain ranges. It helps readers understand geographical locations, map reading skills, and famous mountains such as Mount Everest, K2, and the Andes. The book is specially designed for students, children, and general knowledge learners to improve their understanding of world geography in a simple and engaging way.\r\n', 270.00, 'pdfs/1766769545_Exploring Maps_compressed.pdf', 'img/1766769545_Exploring Maps.jpg', '2025-12-26 17:19:05'),
(10, 2, 'The Magical Fairy Garden', 'Emma Wilson', 'Children Books', 'This book tells the story of a magical garden where fairies live happily among flowers and animals. It teaches children about kindness, friendship, and helping others through colorful characters and simple storytelling.\r\n', 280.00, 'pdfs/1766769679_The Magical Fairy Garden_compressed.pdf', 'img/1766769679_The Magical Fairy Garden.jpg', '2025-12-26 17:21:19'),
(11, 2, 'Tommy and the Talking Train', 'Robert Green', 'Children Books', 'A fun and exciting story about a little boy named Tommy who discovers a talking train. Together, they go on amazing adventures while learning lessons about courage, honesty, and curiosity.\r\n\r\n\r\n', 290.00, 'pdfs/1766769749_Tommy and the Talking Train_compressed.pdf', 'img/1766769749_Tommy and the Talking Train.jpg', '2025-12-26 17:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_orders`
--

CREATE TABLE `dealer_orders` (
  `order_id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `dealer_book_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `city` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `book_title` varchar(200) NOT NULL,
  `book_format` varchar(50) NOT NULL,
  `payment_method` enum('paypal','creditcard','debitcard') NOT NULL,
  `payment_status` enum('Pending','Received','Failed') DEFAULT 'Pending',
  `order_status` enum('Pending','Done','Shipped') DEFAULT 'Pending',
  `grand_total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(27, 18, 'Bisma', 'bismasheikh2006@gmail.com', 'karachi', ' h-no:xyz', 'hardcopy', 'creditcard', 'Received', 'delivered', 170.00, '2025-12-29 20:33:28'),
(28, 18, 'Bisma', 'bismasheikh2006@gmail.com', 'karachi', ' h-no:xyz', 'pdf', 'paypal', 'Received', 'Done', 70.00, '2025-12-29 20:37:56'),
(30, 2, 'Bisma', 'sidra@gmail.com', 'karachi', ' h-no:xyz', 'pdf', 'creditcard', 'Received', 'Done', 90.00, '2025-12-29 22:14:00');

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
(34, 27, 11, 2, '100 Bullets'),
(35, 27, 28, 1, 'Goodnight Moon'),
(36, 28, 14, 1, 'The Sandman'),
(38, 30, 15, 1, 'The-Alchemist');

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
(1, 'shipping_rate', 5),
(2, 'price', 25),
(3, 'essay_prize', 10);

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
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_register`
--
ALTER TABLE `customer_register`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`dealer_id`);

--
-- Indexes for table `dealer_books`
--
ALTER TABLE `dealer_books`
  ADD PRIMARY KEY (`dealer_book_id`),
  ADD KEY `fk_dealer` (`dealer_id`);

--
-- Indexes for table `dealer_orders`
--
ALTER TABLE `dealer_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `dealer_id` (`dealer_id`),
  ADD KEY `dealer_book_id` (`dealer_book_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `competition_entries`
--
ALTER TABLE `competition_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `competition_topics`
--
ALTER TABLE `competition_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customer_register`
--
ALTER TABLE `customer_register`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `dealer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dealer_books`
--
ALTER TABLE `dealer_books`
  MODIFY `dealer_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dealer_orders`
--
ALTER TABLE `dealer_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `freebooks`
--
ALTER TABLE `freebooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `dealer_books`
--
ALTER TABLE `dealer_books`
  ADD CONSTRAINT `fk_dealer` FOREIGN KEY (`dealer_id`) REFERENCES `dealers` (`dealer_id`) ON DELETE CASCADE;

--
-- Constraints for table `dealer_orders`
--
ALTER TABLE `dealer_orders`
  ADD CONSTRAINT `dealer_orders_ibfk_1` FOREIGN KEY (`dealer_id`) REFERENCES `dealers` (`dealer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dealer_orders_ibfk_2` FOREIGN KEY (`dealer_book_id`) REFERENCES `dealer_books` (`dealer_book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

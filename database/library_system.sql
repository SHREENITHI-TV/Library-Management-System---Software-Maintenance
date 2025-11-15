-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 07:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `action` varchar(50) NOT NULL,
  `entity` varchar(50) NOT NULL,
  `entity_id` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_name`, `role`, `action`, `entity`, `entity_id`, `details`, `created_at`) VALUES
(26, 'alice_J', 'admin', 'LOGIN', 'user', 'alice_J', NULL, '2025-11-13 19:48:25'),
(27, 'alice_J', 'admin', 'UPDATE', 'book', '119', '{\"title_before\":\"Digital Marketing Fundamentals\",\"title_after\":\"Digital Marketing Fundamentals\",\"author_before\":\"Philip Kotler\",\"author_after\":\"Philip Kotler\",\"publisher_before\":\"Pearson\",\"publisher_after\":\"Person\",\"year_before\":\"2021\",\"year_after\":\"2021\",\"category_before\":\"Marketing\",\"category_after\":\"Marketing\"}', '2025-11-13 19:50:31'),
(28, 'alice_J', 'admin', 'DELETE', 'book', '119', '{\"soft\":true}', '2025-11-13 19:52:06'),
(29, 'alice_J', 'admin', 'RESTORE', 'book', '119', NULL, '2025-11-13 19:54:25'),
(30, 'alice_J', 'admin', 'DELETE', 'book', '119', '{\"soft\":true}', '2025-11-13 19:54:32'),
(31, 'alice_J', 'admin', 'HARD_DELETE', 'book', '127', '{\"hard\":true,\"title\":\"ABC\"}', '2025-11-13 19:54:41'),
(32, 'alice_J', 'admin', 'LOGOUT', 'user', 'alice_J', NULL, '2025-11-13 22:50:55'),
(33, 'alice_J', 'admin', 'LOGIN', 'user', 'alice_J', NULL, '2025-11-14 10:42:32'),
(34, 'alice_J', 'admin', 'CREATE', 'book', '128', '{\"title\":\"Test Book Name\",\"author\":\"Unknown\",\"publisher\":\"Anonymous\",\"year\":\"2025\",\"category\":\"Test\"}', '2025-11-14 10:58:28'),
(35, 'alice_J', 'admin', 'LOGOUT', 'user', 'alice_J', NULL, '2025-11-14 15:46:46'),
(54, 'TVS', 'admin', 'LOGIN', 'user', 'TVS', NULL, '2025-11-14 16:18:52'),
(55, 'TVS', 'admin', 'RESTORE', 'book', '122', NULL, '2025-11-14 16:49:17'),
(56, 'TVS', 'admin', 'DELETE', 'book', '122', '{\"soft\":true}', '2025-11-14 17:01:50'),
(57, 'TVS', 'admin', 'LOGOUT', 'user', 'TVS', NULL, '2025-11-14 19:24:16'),
(58, 'TVS', 'admin', 'LOGIN', 'user', 'TVS', NULL, '2025-11-14 19:24:28'),
(59, 'TVS', 'admin', 'DELETE', 'book', '117', '{\"soft\":true}', '2025-11-14 19:24:34'),
(60, 'TVS', 'admin', 'RESTORE', 'book', '128', NULL, '2025-11-14 19:24:40');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `username`, `password`) VALUES
(5, 'Alice', 'Johnson', 'alice_J', '12345'),
(6, 'Bob', 'Smith', 'bsmith', 'securepass'),
(7, 'Carla', 'Lopez', 'clopez', 'admin2025'),
(8, 'David', 'Nguyen', 'dnguyen', 'lib2025'),
(9, 'Elena', 'Brown', 'ebrown', 'password1'),
(10, 'Farid', 'Ali', 'fali', 'admin@lib'),
(11, 'Grace', 'Patel', 'gpatel', 'gracepwd'),
(12, 'Hector', 'Lee', 'hlee', 'libstaff'),
(13, 'Irene', 'Khan', 'ikhan', 'ikhanpass'),
(25, 'Shreenithi', 'T V', 'TVS', 'Shree');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `year` varchar(4) NOT NULL,
  `category` varchar(100) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `publisher`, `year`, `category`, `deleted_at`) VALUES
(1, 'Book Thief', 'Mark Zuzak', 'Publish House', '2012', 'Historical Fiction', NULL),
(40, 'Journey to the Center of the Earth', 'Jules Verne', 'Published', '1864', 'Science Fiction', NULL),
(41, 'Data Structures and Algorithms', 'Mark Weiss', 'Pearson', '2020', 'Computer Science', NULL),
(42, 'Introduction to Psychology', 'James W. Kalat', 'Cengage', '2018', 'Psychology', NULL),
(43, 'Modern Physics', 'Kenneth Krane', 'Wiley', '2019', 'Physics', NULL),
(44, 'Principles of Economics', 'N. Gregory Mankiw', 'Cengage', '2021', 'Economics', NULL),
(45, 'Discrete Mathematics', 'Kenneth Rosen', 'McGraw Hill', '2019', 'Mathematics', NULL),
(46, 'Database System Concepts', 'Abraham Silberschatz', 'McGraw Hill', '2020', 'Computer Science', NULL),
(47, 'Operating Systems: Internals and Design', 'William Stallings', 'Pearson', '2021', 'Computer Science', NULL),
(48, 'Linear Algebra and Its Applications', 'David Lay', 'Pearson', '2016', 'Mathematics', NULL),
(49, 'Artificial Intelligence: A Modern Approach', 'Russell & Norvig', 'Pearson', '2021', 'Computer Science', NULL),
(50, 'Engineering Mechanics', 'R.C. Hibbeler', 'Pearson', '2017', 'Engineering', NULL),
(51, 'Communication Skills', 'John Seely', 'Oxford', '2015', 'English', NULL),
(52, 'Ethics in Information Technology', 'George Reynolds', 'Cengage', '2020', 'IT Ethics', NULL),
(53, 'Computer Networks', 'Andrew Tanenbaum', 'Pearson', '2021', 'Computer Science', NULL),
(54, 'Calculus', 'James Stewart', 'Cengage', '2021', 'Mathematics', NULL),
(55, 'Physics for Scientists and Engineers', 'Serway & Jewett', 'Cengage', '2020', 'Physics', NULL),
(56, 'Introduction to Sociology', 'Anthony Giddens', 'Polity', '2019', 'Sociology', NULL),
(57, 'Human Anatomy', 'Elaine Marieb', 'Pearson', '2018', 'Biology', NULL),
(58, 'Environmental Science', 'Richard Wright', 'Jones & Bartlett', '2019', 'Science', NULL),
(59, 'Software Engineering', 'Ian Sommerville', 'Pearson', '2020', 'Computer Science', NULL),
(60, 'Microeconomics', 'Paul Krugman', 'Worth', '2018', 'Economics', NULL),
(61, 'Cloud Computing', 'Rajkumar Buyya', 'Wiley', '2022', 'Computer Science', NULL),
(62, 'Computer Security', 'William Stallings', 'Pearson', '2021', 'Cybersecurity', NULL),
(63, 'Machine Learning', 'Tom Mitchell', 'McGraw Hill', '2019', 'AI', NULL),
(64, 'Digital Logic Design', 'Morris Mano', 'Pearson', '2017', 'Engineering', NULL),
(65, 'Organizational Behavior', 'Stephen Robbins', 'Pearson', '2019', 'Business', NULL),
(66, 'Biochemistry', 'Lehninger', 'W.H. Freeman', '2021', 'Biology', NULL),
(67, 'Artificial Neural Networks', 'Simon Haykin', 'Prentice Hall', '2020', 'AI', NULL),
(68, 'Advanced Database Systems', 'C.J. Date', 'Addison Wesley', '2018', 'Computer Science', NULL),
(69, 'Econometrics', 'Jeffrey Wooldridge', 'Cengage', '2020', 'Economics', NULL),
(70, 'Java Programmings', 'Herbert Schildt', 'McGraw Hill', '2022', 'Computer Science', NULL),
(71, 'Modern Chemistry', 'Raymond Chang', 'McGraw Hill', '2021', 'Chemistry', NULL),
(72, 'Genetics', 'Benjamin Pierce', 'Macmillan', '2018', 'Biology', NULL),
(73, 'Quantum Mechanics', 'David Griffiths', 'Pearson', '2021', 'Physics', NULL),
(74, 'Sociological Theory', 'George Ritzer', 'McGraw Hill', '2020', 'Sociology', NULL),
(75, 'Public Speaking Made Easy', 'Dale Carnegie', 'Penguin', '2015', 'Communication', NULL),
(76, 'Business Law', 'Kenneth Clarkson', 'Pearson', '2018', 'Law', NULL),
(77, 'Statistics for Engineers', 'Navidi & Monk', 'McGraw Hill', '2020', 'Mathematics', NULL),
(78, 'Digital Marketing Fundamentals', 'Philip Kotler', 'Pearson', '2021', 'Marketing', NULL),
(79, 'Introduction to Philosophy', 'Simon Blackburn', 'Oxford', '2017', 'Philosophy', NULL),
(80, 'Project Management', 'Harold Kerzner', 'Wiley', '2021', 'Management', NULL),
(81, 'Networking Essentials', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', NULL),
(82, 'Data Structures and Algorithms', 'Mark Weiss', 'Pearson', '2020', 'Computer Science', NULL),
(83, 'Introduction to Psychology', 'James W. Kalat', 'Cengage', '2018', 'Psychology', NULL),
(84, 'Modern Physics', 'Kenneth Krane', 'Wiley', '2019', 'Physics', NULL),
(85, 'Principles of Economics', 'N. Gregory Mankiw', 'Cengage', '2021', 'Economics', NULL),
(86, 'Discrete Mathematics', 'Kenneth Rosen', 'McGraw Hill', '2019', 'Mathematics', NULL),
(87, 'Database System Concepts', 'Abraham Silberschatz', 'McGraw Hill', '2020', 'Computer Science', NULL),
(88, 'Operating Systems: Internals and Design', 'William Stallings', 'Pearson', '2021', 'Computer Science', NULL),
(89, 'Linear Algebra and Its Applications', 'David Lay', 'Pearson', '2016', 'Mathematics', NULL),
(90, 'Artificial Intelligence: A Modern Approach', 'Russell & Norvig', 'Pearson', '2021', 'Computer Science', NULL),
(91, 'Engineering Mechanics', 'R.C. Hibbeler', 'Pearson', '2017', 'Engineering', NULL),
(92, 'Communication Skills', 'John Seely', 'Oxford', '2015', 'English', NULL),
(93, 'Ethics in Information Technology', 'George Reynolds', 'Cengage', '2020', 'IT Ethics', NULL),
(94, 'Computer Networks', 'Andrew Tanenbaum', 'Pearson', '2021', 'Computer Science', NULL),
(95, 'Calculus', 'James Stewart', 'Cengage', '2021', 'Mathematics', NULL),
(96, 'Physics for Scientists and Engineers', 'Serway & Jewett', 'Cengage', '2020', 'Physics', NULL),
(97, 'Introduction to Sociology', 'Anthony Giddens', 'Polity', '2019', 'Sociology', NULL),
(98, 'Human Anatomy', 'Elaine Marieb', 'Pearson', '2018', 'Biology', NULL),
(99, 'Environmental Science', 'Richard Wright', 'Jones & Bartlett', '2019', 'Science', NULL),
(100, 'Software Engineering', 'Ian Sommerville', 'Pearson', '2020', 'Computer Science', NULL),
(101, 'Microeconomics', 'Paul Krugman', 'Worth', '2018', 'Economics', NULL),
(102, 'Cloud Computing', 'Rajkumar Buyya', 'Wiley', '2022', 'Computer Science', NULL),
(103, 'Computer Security', 'William Stallings', 'Pearson', '2021', 'Cybersecurity', NULL),
(104, 'Machine Learning', 'Tom Mitchell', 'McGraw Hill', '2019', 'AI', NULL),
(105, 'Digital Logic Design', 'Morris Mano', 'Pearson', '2017', 'Engineering', NULL),
(106, 'Organizational Behavior', 'Stephen Robbins', 'Pearson', '2019', 'Business', NULL),
(107, 'Biochemistry', 'Lehninger', 'W.H. Freeman', '2021', 'Biology', '2025-11-12 10:49:09'),
(108, 'Artificial Neural Networks', 'Simon Haykin', 'Prentice Hall', '2020', 'AI', NULL),
(109, 'Advanced Database Systems', 'C.J. Date', 'Addison Wesley', '2018', 'Computer Science', '2025-11-12 11:03:28'),
(110, 'Econometrics', 'Jeffrey Wooldridge', 'Cengage', '2020', 'Economics', NULL),
(112, 'Modern Chemistry', 'Raymond Chang', 'McGraw Hill', '2021', 'Chemistry', NULL),
(113, 'Genetics', 'Benjamin Pierce', 'Macmillan', '2018', 'Biology', NULL),
(114, 'Quantum Mechanics', 'David Griffiths', 'Pearson', '2021', 'Physics', NULL),
(115, 'Sociological Theory', 'George Ritzer', 'McGraw Hill', '2020', 'Sociology', NULL),
(116, 'Public Speaking Made Easy', 'Dale Carnegie', 'Penguin', '2015', 'Communication', NULL),
(117, 'Business Law', 'Kenneth Clarkson', 'Pearson', '2018', 'Law', '2025-11-14 19:24:34'),
(118, 'Statistics for Engineers', 'Navidi & Monk', 'McGraw Hill', '2020', 'Mathematics', '2025-11-14 16:05:02'),
(119, 'Digital Marketing Fundamentals', 'Philip Kotler', 'Person', '2021', 'Marketing', '2025-11-13 19:54:32'),
(120, 'Introduction to Philosophy', 'Simon Blackburn', 'Oxford', '20', 'Philosophy', '2025-11-13 11:39:32'),
(121, 'Project Management', 'Harold Kerzner', 'Wiley', '2021', 'Management', '2025-11-12 10:49:04'),
(122, 'Networking Essential', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', '2025-11-14 17:01:50'),
(124, 'New Title', 'Shreenithi', 'CSULB', '2027', 'Test trial', '2025-11-13 09:58:51'),
(128, 'Test Book Name', 'Unknown', 'Anonymous', '2024', 'Test', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_versions`
--

CREATE TABLE `book_versions` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `version_no` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `year` varchar(4) NOT NULL,
  `category` varchar(100) NOT NULL,
  `changed_by` varchar(100) DEFAULT NULL,
  `diff_json` text DEFAULT NULL,
  `changed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `book_versions`
--

INSERT INTO `book_versions` (`id`, `book_id`, `version_no`, `title`, `author`, `publisher`, `year`, `category`, `changed_by`, `diff_json`, `changed_at`) VALUES
(6, 40, 1, 'Journey to the Center of the Earth', 'Jules Verne', 'Published', '2000', 'Science Fiction', 'guest', NULL, '2025-11-10 14:46:28'),
(7, 40, 2, 'Journey to the Center of the Earth', 'Jules Verne', 'Published', '0000', 'Science Fiction', 'guest', '{\"year\":{\"before\":\"0000\",\"after\":\"1864\"}}', '2025-11-10 15:36:56'),
(10, 122, 1, 'Networking Essentials', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', 'guest', '{\"title\":{\"before\":\"Networking Essentials\",\"after\":\"Networking\"}}', '2025-11-10 16:42:21'),
(11, 122, 2, 'Networking', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', 'alicej', '{\"year\":{\"before\":\"2019\",\"after\":\"2020\"}}', '2025-11-12 11:15:59'),
(12, 122, 3, 'Networking', 'Jeffrey Beasley', 'Pearson', '2020', 'Computer Science', 'alicej', '{\"year\":{\"before\":\"2020\",\"after\":\"2019\"}}', '2025-11-12 11:16:37'),
(13, 122, 4, 'Networking', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', 'alicej', '{\"title\":{\"before\":\"Networking\",\"after\":\"Networking Ess\"}}', '2025-11-12 11:38:49'),
(14, 122, 5, 'Networking Ess', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', 'admin', '{\"title\":{\"before\":\"Networking Ess\",\"after\":\"Networking Essential\"}}', '2025-11-12 11:39:22'),
(21, 120, 1, 'Introduction to Philosophy', 'Simon Blackburn', 'Oxford', '2017', 'Philosophy', 'alice_J', '{\"year\":{\"before\":\"2017\",\"after\":\"20\"}}', '2025-11-13 11:39:22'),
(22, 119, 1, 'Digital Marketing Fundamentals', 'Philip Kotler', 'Pearson', '2021', 'Marketing', 'alice_J', '{\"publisher\":{\"before\":\"Pearson\",\"after\":\"Person\"}}', '2025-11-13 19:50:31'),
(23, 128, 1, 'Test Book Name', 'Unknown', 'Anonymous', '2025', 'Test', 'alice_J', '{\"year\":{\"before\":\"2025\",\"after\":\"2024\"}}', '2025-11-14 15:57:17'),
(24, 70, 1, 'Java Programming', 'Herbert Schildt', 'McGraw Hill', '2022', 'Computer Science', 'alice_J', '{\"title\":{\"before\":\"Java Programming\",\"after\":\"Java Programmings\"}}', '2025-11-14 16:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `batch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `firstname`, `lastname`, `department`, `batch`) VALUES
(1, 'Sparkle', 'Dog', 'CSE', '2020-2024'),
(4, 'Alice', 'Johnson', 'College of Engineering (COE) - Computer Engineering', '2018-2022'),
(5, 'Brian', 'Lopez', 'College of Engineering (COE) - Mechanical Engineering', '2019-2023'),
(6, 'Chitra', 'Rao', 'College of Engineering (COE) - Electrical Engineering', '2020-2024'),
(7, 'David', 'Nguyen', 'College of Engineering (COE) - Civil Engineering', '2021-2025'),
(8, 'Emma', 'Kim', 'College of Engineering (COE) - Software Engineering', '2022-2026'),
(9, 'Farah', 'Hassan', 'College of Business (COB) - Accounting', '2018-2022'),
(10, 'George', 'Patel', 'College of Business (COB) - Finance', '2019-2023'),
(11, 'Hannah', 'Smith', 'College of Business (COB) - Marketing', '2020-2024'),
(12, 'Ivan', 'Garcia', 'College of Business (COB) - Management', '2021-2025'),
(13, 'Julia', 'Brown', 'College of Business (COB) - Information Systems', '2022-2026'),
(14, 'Karthik', 'Iyer', 'College of Natural Sciences & Mathematics (CNSM) - Mathematics', '2018-2023'),
(15, 'Lena', 'Miller', 'College of Natural Sciences & Mathematics (CNSM) - Physics', '2019-2024'),
(16, 'Marco', 'Silva', 'College of Natural Sciences & Mathematics (CNSM) - Chemistry', '2020-2025'),
(17, 'Nina', 'Khan', 'College of Natural Sciences & Mathematics (CNSM) - Biology', '2021-2026'),
(18, 'Owen', 'Reed', 'College of Natural Sciences & Mathematics (CNSM) - Statistics', '2022-2027'),
(19, 'Priya', 'Singh', 'College of Health & Human Services (CHHS) - Nursing', '2018-2022'),
(20, 'Quentin', 'Wong', 'College of Health & Human Services (CHHS) - Public Health', '2019-2023'),
(21, 'Riya', 'Desai', 'College of Health & Human Services (CHHS) - Social Work', '2020-2024'),
(22, 'Samuel', 'Carter', 'College of Health & Human Services (CHHS) - Kinesiology', '2021-2025'),
(23, 'Tara', 'Evans', 'College of Health & Human Services (CHHS) - Nutrition', '2022-2026'),
(24, 'Uma', 'Reddy', 'College of the Arts (COTA) - Graphic Design', '2018-2022'),
(25, 'Victor', 'Martinez', 'College of the Arts (COTA) - Music', '2019-2023'),
(26, 'Wendy', 'Hughes', 'College of the Arts (COTA) - Theatre Arts', '2020-2024'),
(27, 'Xiang', 'Li', 'College of Education (CED) - Elementary Education', '2019-2024'),
(28, 'Yasmin', 'Ali', 'College of Education (CED) - Secondary Education', '2020-2025'),
(29, 'Zack', 'Foster', 'College of Liberal Arts (CLA) - History', '2018-2022'),
(30, 'Anita', 'Gupta', 'College of Liberal Arts (CLA) - English', '2019-2023'),
(31, 'Bruno', 'Costa', 'College of Professional & Continuing Education (CPaCE) - IT', '2020-2024'),
(32, 'Clara', 'James', 'College of Professional & Continuing Education (CPaCE) - Business Analytics', '2021-2025'),
(33, 'Dinesh', 'Kumar', 'University Library - Library & Information Science', '2019-2024'),
(35, 'Shreenithi', 'V', 'COE - Computer Science', '2024-2026');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tran_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_borrowed` date NOT NULL DEFAULT current_timestamp(),
  `date_due` date NOT NULL,
  `date_returned` date DEFAULT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tran_id`, `book_id`, `student_id`, `date_borrowed`, `date_due`, `date_returned`, `status`) VALUES
(11, 120, 1, '2025-11-12', '2025-11-30', NULL, 'borrowed'),
(12, 121, 1, '2025-11-12', '2025-09-12', '2025-11-12', 'returned'),
(13, 101, 29, '2025-11-13', '2025-11-14', NULL, 'borrowed'),
(14, 41, 1, '2025-09-01', '2025-09-15', '2025-09-14', 'returned'),
(15, 47, 1, '2025-11-05', '2025-11-25', NULL, 'borrowed'),
(16, 59, 4, '2025-09-10', '2025-09-25', '2025-09-30', 'returned'),
(17, 49, 4, '2025-10-10', '2025-10-25', NULL, 'borrowed'),
(18, 50, 5, '2025-08-20', '2025-09-05', '2025-09-04', 'returned'),
(19, 53, 6, '2025-09-01', '2025-09-15', '2025-09-20', 'returned'),
(20, 58, 7, '2025-11-01', '2025-11-20', NULL, 'borrowed'),
(21, 61, 8, '2025-09-05', '2025-09-20', '2025-09-18', 'returned'),
(22, 62, 8, '2025-10-01', '2025-10-15', NULL, 'borrowed'),
(23, 44, 9, '2025-08-25', '2025-09-10', '2025-09-09', 'returned'),
(24, 60, 10, '2025-08-28', '2025-09-12', '2025-09-18', 'returned'),
(25, 51, 11, '2025-09-02', '2025-09-16', '2025-09-16', 'returned'),
(26, 52, 12, '2025-11-10', '2025-12-05', NULL, 'borrowed'),
(27, 46, 13, '2025-09-15', '2025-10-01', '2025-10-08', 'returned'),
(28, 45, 14, '2025-09-10', '2025-09-25', '2025-09-23', 'returned'),
(29, 43, 15, '2025-09-05', '2025-09-18', '2025-09-22', 'returned'),
(30, 58, 16, '2025-09-12', '2025-09-26', '2025-09-25', 'returned'),
(31, 57, 17, '2025-10-05', '2025-10-20', NULL, 'borrowed'),
(32, 54, 18, '2025-09-20', '2025-10-05', '2025-10-03', 'returned'),
(33, 57, 19, '2025-09-01', '2025-09-14', '2025-09-20', 'returned'),
(34, 56, 20, '2025-09-10', '2025-09-24', '2025-09-23', 'returned'),
(35, 42, 21, '2025-10-01', '2025-10-15', NULL, 'borrowed'),
(36, 55, 22, '2025-09-08', '2025-09-22', '2025-09-29', 'returned'),
(37, 58, 23, '2025-09-15', '2025-09-30', '2025-09-29', 'returned'),
(38, 51, 24, '2025-11-05', '2025-11-25', '2025-11-13', 'returned'),
(39, 107, 17, '2025-11-14', '2025-11-15', NULL, 'borrowed'),
(40, 107, 17, '2025-11-14', '2025-11-15', '2025-11-14', 'returned'),
(41, 128, 35, '2025-11-14', '2025-11-22', NULL, 'borrowed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_activity_logs_entity` (`entity`,`entity_id`),
  ADD KEY `idx_activity_logs_user` (`user_name`,`created_at`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `book_versions`
--
ALTER TABLE `book_versions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_book_versions_book` (`book_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tran_id`),
  ADD KEY `transaction_ibfk_1` (`book_id`),
  ADD KEY `transaction_ibfk_2` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `book_versions`
--
ALTER TABLE `book_versions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_versions`
--
ALTER TABLE `book_versions`
  ADD CONSTRAINT `fk_book_versions_book` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

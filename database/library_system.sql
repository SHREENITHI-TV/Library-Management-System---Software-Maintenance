-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2025 at 01:39 AM
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
(1, 'Rengar', 'Bear', 'admin', 'admin'),
(4, 'Rengar', 'Bear', 'admin', 'admin'),
(5, 'Alice', 'Johnson', 'alicej', 'pass123'),
(6, 'Bob', 'Smith', 'bsmith', 'securepass'),
(7, 'Carla', 'Lopez', 'clopez', 'admin2025'),
(8, 'David', 'Nguyen', 'dnguyen', 'lib2025'),
(9, 'Elena', 'Brown', 'ebrown', 'password1'),
(10, 'Farid', 'Ali', 'fali', 'admin@lib'),
(11, 'Grace', 'Patel', 'gpatel', 'gracepwd'),
(12, 'Hector', 'Lee', 'hlee', 'libstaff'),
(13, 'Irene', 'Khan', 'ikhan', 'ikhanpass'),
(14, 'Rengar', 'Bear', 'admin', 'admin'),
(15, 'Alice', 'Johnson', 'alicej', 'pass123'),
(16, 'Bob', 'Smith', 'bsmith', 'securepass'),
(17, 'Carla', 'Lopez', 'clopez', 'admin2025'),
(18, 'David', 'Nguyen', 'dnguyen', 'lib2025'),
(19, 'Elena', 'Brown', 'ebrown', 'password1'),
(20, 'Farid', 'Ali', 'fali', 'admin@lib'),
(21, 'Grace', 'Patel', 'gpatel', 'gracepwd'),
(22, 'Hector', 'Lee', 'hlee', 'libstaff'),
(23, 'Irene', 'Khan', 'ikhan', 'ikhanpass');

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
(39, 'Dog\'s Purpose', 'W. Bruce Cameron', 'Publisher', '2010', 'Makes you cry', NULL),
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
(70, 'Java Programming', 'Herbert Schildt', 'McGraw Hill', '2022', 'Computer Science', NULL),
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
(107, 'Biochemistry', 'Lehninger', 'W.H. Freeman', '2021', 'Biology', NULL),
(108, 'Artificial Neural Networks', 'Simon Haykin', 'Prentice Hall', '2020', 'AI', NULL),
(109, 'Advanced Database Systems', 'C.J. Date', 'Addison Wesley', '2018', 'Computer Science', NULL),
(110, 'Econometrics', 'Jeffrey Wooldridge', 'Cengage', '2020', 'Economics', NULL),
(111, 'Java Programming', 'Herbert Schildt', 'McGraw Hill', '2022', 'Computer Science', NULL),
(112, 'Modern Chemistry', 'Raymond Chang', 'McGraw Hill', '2021', 'Chemistry', NULL),
(113, 'Genetics', 'Benjamin Pierce', 'Macmillan', '2018', 'Biology', NULL),
(114, 'Quantum Mechanics', 'David Griffiths', 'Pearson', '2021', 'Physics', NULL),
(115, 'Sociological Theory', 'George Ritzer', 'McGraw Hill', '2020', 'Sociology', NULL),
(116, 'Public Speaking Made Easy', 'Dale Carnegie', 'Penguin', '2015', 'Communication', NULL),
(117, 'Business Law', 'Kenneth Clarkson', 'Pearson', '2018', 'Law', NULL),
(118, 'Statistics for Engineers', 'Navidi & Monk', 'McGraw Hill', '2020', 'Mathematics', NULL),
(119, 'Digital Marketing Fundamentals', 'Philip Kotler', 'Pearson', '2021', 'Marketing', NULL),
(120, 'Introduction to Philosophy', 'Simon Blackburn', 'Oxford', '2017', 'Philosophy', NULL),
(121, 'Project Management', 'Harold Kerzner', 'Wiley', '2021', 'Management', NULL),
(122, 'Networking Essentials', 'Jeffrey Beasley', 'Pearson', '2019', 'Computer Science', NULL);

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
(8, 39, 1, 'Dog\'s Purpose', 'I forgot', 'Publisher', '2001', 'Makes you cry', 'guest', '{\"author\":{\"before\":\"I forgot\",\"after\":\"Bruce Cameron\"},\"year\":{\"before\":\"2001\",\"after\":\"2010\"}}', '2025-11-10 15:37:59'),
(9, 39, 2, 'Dog\'s Purpose', 'Bruce Cameron', 'Publisher', '2010', 'Makes you cry', 'guest', '{\"author\":{\"before\":\"Bruce Cameron\",\"after\":\"W. Bruce Cameron\"}}', '2025-11-10 15:38:29');

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
(1, 'Sprinkle', 'Dog', 'BSIT', '3C');

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
(3, 1, 1, '2022-01-13', '2022-01-25', '2022-01-13', 'returned'),
(4, 1, 1, '2022-01-13', '2022-01-26', '2022-01-13', 'returned'),
(5, 1, 1, '2022-01-13', '2022-01-27', '2022-01-13', 'returned'),
(6, 1, 1, '2022-01-13', '2022-01-28', NULL, 'borrowed'),
(7, 1, 1, '2022-01-14', '2022-01-12', NULL, 'borrowed'),
(8, 1, 1, '2022-01-14', '2022-01-19', '2022-01-14', 'returned');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `book_versions`
--
ALTER TABLE `book_versions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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

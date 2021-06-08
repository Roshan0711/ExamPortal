-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2020 at 11:23 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `ans_id` int(10) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `qid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_id`, `answer`, `qid`) VALUES
(111, 'Last Byte number', 11),
(112, 'Previous ACK Number', 11),
(113, 'Middle Byte Number', 11),
(121, 'Connection Less', 12),
(131, 'PSH=1', 13),
(132, 'ACK=1', 13),
(133, 'SYN=1', 13),
(141, 'Data', 14),
(142, 'Frame', 14),
(143, 'Packet', 14),
(151, 'FTP and HTTP', 15),
(152, 'UDP and FTP', 15),
(153, 'TCP and FTP', 15),
(161, 'Host to process communication', 16),
(162, 'Node to Node Communication', 16),
(163, 'Host to host communication', 16),
(171, 'Managing Error', 17),
(172, 'Managing Destination flow', 17),
(173, 'Managing Source flow', 17),
(181, 'System', 18),
(182, 'Link', 18),
(183, 'port', 18),
(191, 'link', 19),
(192, 'socket', 19),
(193, 'SAP', 19),
(201, '32, 32', 20),
(202, '16, 32', 20),
(203, '32, 16', 20),
(211, 'Datagram Socket(int port)', 21),
(221, 'TCP is reliable', 22),
(231, 'Time wait', 23),
(241, 'tresh=1/2 cwnd, cwnd=tresh, start with phase 1', 24),
(251, 'tresh=1/2 cwnd, cwnd=1, start with phase 2', 25),
(261, 'True', 26),
(271, 'Syndrome created by receiver', 27),
(281, 'Syndrome created by sender', 28),
(291, 'MAC and IP', 29),
(301, 'Persistence timer', 30),
(911, 'start byte number', 11),
(912, 'Connection Oriented', 12),
(913, 'URG=1', 13),
(914, 'Segment', 14),
(915, 'TCP and UDP', 15),
(916, 'Process to Process Communication', 16),
(917, 'Managing Traffic', 17),
(918, 'Socket', 18),
(919, 'port', 19),
(920, '16, 16', 20),
(921, 'Datagram Socket(int port, Int Address address)', 21),
(922, 'UDP is reliable', 22),
(923, 'Persistence', 23),
(924, 'tresh=1/2 cwnd, cwnd=1, start with phase 1', 24),
(925, 'tresh=1/2 cwnd, cwnd=tresh, start with phase 2', 25),
(926, 'False', 26),
(927, 'Syndrome created by sender', 27),
(928, 'Syndrome created by receiver', 28),
(929, 'IP and Port', 29),
(930, 'Re transmission timer', 30),
(2111, '2MB', 211),
(2112, '64KB', 211),
(2121, '16-bit data bus', 212),
(2122, '32-bit registers', 212),
(2131, '8-bytes,', 213),
(2132, '16-bytes', 213),
(2141, '64KB', 214),
(2142, '128KB', 214),
(2151, '8,8 & 16 bit', 215),
(2152, '8,16 & 20 bit', 215),
(2161, 'SP', 216),
(2162, 'BP', 216),
(2171, '21020H', 217),
(2172, '12000H', 217),
(2181, 'IF flag', 218),
(2191, 'SS:[BP+1 & BP+2]', 219),
(2201, 'Stack Segment', 220),
(2211, '1050H', 221),
(2221, '40H', 222),
(2231, '5001H', 223),
(2241, '50H', 224),
(2251, 'CF', 225),
(2261, '1FFFH', 226),
(2271, 'SI Times', 227),
(2281, 'BX', 228),
(2291, 'DS & SS', 229),
(2301, '16KB', 230),
(3111, 'Data and the database', 311),
(3112, 'The user and the database application', 311),
(3113, 'Database application and SQL', 311),
(3121, 'creating databases', 312),
(3122, 'processing data', 312),
(3123, 'administrating databases', 312),
(3131, 'ΠaccountNo,balance(σbalance<1000(account))', 313),
(3132, 'σbalance<1000(ΠaccountNo,balance(account))', 313),
(3133, 'σbalance<1000(ΠbranchName(account))', 313),
(3141, 'FALSE', 314),
(3151, 'Partial', 315),
(3152, 'complete', 315),
(3153, 'none of these', 315),
(3161, 'view level', 316),
(3162, 'conceptual level', 316),
(3163, 'none of these', 316),
(3171, 'view level', 317),
(3172, 'conceptual level', 317),
(3173, 'None of the above', 317),
(3181, 'Consistency Constraints', 318),
(3182, 'Data Schema', 318),
(3183, 'Data', 318),
(3191, 'Database Instance', 319),
(3192, 'Database Abstraction', 319),
(3193, 'None of these', 319),
(3201, 'Database system', 320),
(3202, 'Database Manager', 320),
(3203, 'Database users', 320),
(3211, 'Entity diagram', 321),
(3212, 'Database diagram', 321),
(3213, 'Architectural representation', 321),
(3221, 'Double diamonds', 322),
(3222, 'Undivided rectangles', 322),
(3223, 'Dashed lines', 322),
(3231, 'σname=’Aditya’(Πname,phonenumber,address(customer))', 323),
(3232, 'σname=’Aditya’(Πphonenumber,address(customer))', 323),
(3233, 'ρphonenumber,name(σname=’Aditya’(customer))', 323),
(3241, 'Strong entity set', 324),
(3242, 'Variant set', 324),
(3243, 'Variable set', 324),
(3251, 'To modify schema definition in one level without affecting schema definition in the next lower level', 325),
(3252, 'To modify data in one level without affecting the data in the next lower level', 325),
(3253, 'To modify data in one level without affecting the data in the next higher level', 325),
(3261, 'Some entity in E1 is associated with more than one entity in E2', 326),
(3262, 'Every entity in E2 is associated with exactly one entity in E1', 326),
(3263, 'Every entity in E2 is associated with at most one entity in E1', 326),
(3271, 'An attribute of an entity can have more than one value', 327),
(3272, 'An attribute of an entity can be composite', 327),
(3273, 'In a row of a relational table, an attribute can have exactly one value or a NULL value', 327),
(3281, 'primary key ⊆ super key ⊆ candidate key', 328),
(3282, 'super key ⊆ primary key ⊆ candidate key', 328),
(3283, 'super key ⊆ candidate key ⊆ primary key', 328),
(3291, 'avoiding data inconsistency', 329),
(3292, 'being able to construct query easily', 329),
(3293, 'being able to access data efficiently', 329),
(3301, 'Join', 330),
(3302, 'Extract', 330),
(3303, 'Substitute', 330),
(9211, '1MB', 211),
(9212, '16-bit ALU', 212),
(9213, '6-bytes', 213),
(9214, '512KB', 214),
(9215, '16,16 & 20', 215),
(9216, 'IP', 216),
(9217, '12020H', 217),
(9218, 'TF Flag', 218),
(9219, 'SS:[SP-1 & SP-2]', 219),
(9220, 'Data Segment', 220),
(9221, '1000H', 221),
(9222, '60H', 222),
(9223, '5000H', 223),
(9224, '5FH', 224),
(9225, 'ZF', 225),
(9226, 'FFFFH', 226),
(9227, 'CX Times', 227),
(9228, 'AX', 228),
(9229, 'DS & ES', 229),
(9230, '64KB', 230),
(9311, 'Database application and the database', 311),
(9312, 'creating and processing forms', 312),
(9313, 'ΠaccountNo,branchName(σbalance<1000(account))', 313),
(9314, 'TRUE', 314),
(9315, 'abstract', 315),
(9316, 'physical level', 316),
(9317, 'physical level', 317),
(9318, 'All of these', 318),
(9319, 'Database Schema', 319),
(9320, 'Database Administrator', 320),
(9321, 'Entity-relationship diagram', 321),
(9322, 'Diamond', 322),
(9323, 'Πphonenumber,address(σname=’Aditya’(customer))', 323),
(9324, 'Weak entity set', 324),
(9325, 'To modify schema definition in one level without affecting schema definition in the next higher level', 325),
(9326, 'Every entity in E1 is associated with exactly one entity in E2', 326),
(9327, 'In a row of a relational table, an attribute can have more than one value', 327),
(9328, 'primary key ⊆ candidate key ⊆ super key', 328),
(9329, 'All of the above', 329),
(9330, 'Project', 330);

-- --------------------------------------------------------

--
-- Table structure for table `correct_answer`
--

CREATE TABLE `correct_answer` (
  `qid` int(10) NOT NULL,
  `ans_id` int(10) NOT NULL,
  `exam_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `correct_answer`
--

INSERT INTO `correct_answer` (`qid`, `ans_id`, `exam_id`) VALUES
(11, 911, 1),
(12, 912, 1),
(13, 913, 1),
(14, 914, 1),
(15, 915, 1),
(16, 916, 1),
(17, 917, 1),
(18, 918, 1),
(19, 919, 1),
(20, 920, 1),
(21, 921, 1),
(22, 922, 1),
(23, 923, 1),
(24, 924, 1),
(25, 925, 1),
(26, 926, 1),
(27, 927, 1),
(28, 928, 1),
(29, 929, 1),
(30, 930, 1),
(211, 9211, 2),
(212, 9212, 2),
(213, 9213, 2),
(214, 9214, 2),
(215, 9215, 2),
(216, 9216, 2),
(217, 9217, 2),
(218, 9218, 2),
(219, 9219, 2),
(220, 9220, 2),
(221, 9221, 2),
(222, 9222, 2),
(223, 9223, 2),
(224, 9224, 2),
(225, 9225, 2),
(226, 9226, 2),
(227, 9227, 2),
(228, 9228, 2),
(229, 9229, 2),
(230, 9230, 2),
(311, 9311, 3),
(312, 9312, 3),
(313, 9313, 3),
(314, 9314, 3),
(315, 9315, 3),
(316, 9316, 3),
(318, 9318, 3),
(319, 9319, 3),
(320, 9320, 3),
(321, 9321, 3),
(322, 9322, 3),
(323, 9323, 3),
(324, 9324, 3),
(325, 9325, 3),
(326, 9326, 3),
(327, 9327, 3),
(328, 9328, 3),
(329, 9329, 3),
(330, 9330, 3),
(317, 9317, 3);

-- --------------------------------------------------------

--
-- Table structure for table `difficulty`
--

CREATE TABLE `difficulty` (
  `did` int(10) NOT NULL,
  `marks` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `difficulty`
--

INSERT INTO `difficulty` (`did`, `marks`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_id` int(11) NOT NULL,
  `exam_name` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `exam_name`, `duration`) VALUES
(1, 'Computer Network', 300),
(2, 'Microprocessor', 300),
(3, 'DBMS', 300);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `exam_id` int(11) NOT NULL,
  `qid` int(10) NOT NULL,
  `question` varchar(500) NOT NULL,
  `diff_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`exam_id`, `qid`, `question`, `diff_id`) VALUES
(1, 11, 'In tcp sequence number is ', 1),
(1, 12, 'Tcp is ', 1),
(1, 13, 'When urgent pointer is valid ', 1),
(1, 14, 'Transport layer encapsulates data into ', 1),
(1, 15, 'Which of the following are transport layer protocols used in networking ', 1),
(1, 16, 'Transport layer performs', 1),
(1, 17, 'What is goal of congestion control?', 1),
(1, 18, 'An endpoint of an inter process communication flow across a computer ', 2),
(1, 19, 'An endpoint of an inter process communication flow across a computer ', 2),
(1, 20, 'The sizes of source and destination port address in tcp header are ', 2),
(1, 21, 'Which constructor of datagram socket class is used to create a datagram  the given port number', 2),
(1, 22, 'Which of the following is false', 2),
(1, 23, 'Which timer handles issue of window advertisement?', 2),
(1, 24, 'Multiplicative decrease for timeout is', 2),
(1, 25, 'Multiplicative decrease for 3ACK is', 2),
(1, 26, 'UDP has options in header', 3),
(1, 27, 'Nagle\'s solution handles', 3),
(1, 28, 'Clark\'s solution is handles', 3),
(1, 29, 'Socket address is combination of', 3),
(1, 30, 'Round trip timer is calculated using', 3),
(2, 211, 'What is the memory addressing capacity of 8086 ?', 1),
(2, 212, '8086 is 16-bit processor, because of', 1),
(2, 213, 'Pre fetch queue on 8086 is how many bytes ?', 1),
(2, 214, 'Lower bank & Higher bank are each of maximum', 1),
(2, 215, 'Segment address, Offset address & Physical address are', 1),
(2, 216, 'Offset register associated with CS is given by', 1),
(2, 217, 'If DS=1000H, BX=2000H, then Physical address accessed on the execution of MOV AL, [BX+20H] instruction is', 1),
(2, 218, 'Single Stepping mode for 8086 is programmed by setting which flag', 2),
(2, 219, 'PUSH BX will push [BH] & [BL] at', 2),
(2, 220, 'MOV [BX], AL will write AL at the offset pointed by [BX] in which segment', 2),
(2, 221, 'If BP=1000H, [1000H]=50H, then LEA BX, [BP] will load BX with', 2),
(2, 222, 'If BL=20H, SI=2000H, [2000H]=40H then on ADD BL, [SI] the result stored in BL is', 2),
(2, 223, 'If DX=5000H, [5000H]=40H then on INC [DX] the contents of DX will be', 2),
(2, 224, 'If AL=50H & BL=0FH, then on the execution of XOR AL, BL result stored in AL is', 2),
(2, 225, 'If DX=0000H, then on TEST DX, 8000H which flag is set', 2),
(2, 226, 'If AX=1000H, then on the execution of OR AX, FFFFH the result in AX will be', 3),
(2, 227, 'In case of REP MOVSB, MOVSB is executed how many times', 3),
(2, 228, 'On the execution of LODSW which register gets loaded from memory', 3),
(2, 229, 'On the execution of CMPSB contents of which segment compared with contents of which segment', 3),
(2, 230, 'Every segment in 8086 memory is of maximum', 3),
(3, 311, 'The DBMS acts as an interface between what two components of an enterprise-class database system?', 1),
(3, 312, 'The following are functions of a DBMS except ________ .', 1),
(3, 313, 'Database schema is given below: customer (customerId, name, phonenumber, address) account (accountNo, balance, branchName ) Find out the accountNo and branchName of all those account where the balance is less than 1000 in relational algebra from the above database schema.', 1),
(3, 314, 'Data Redundancy increases the cost of storing and retrieving data.', 1),
(3, 315, 'A main purpose of DBMS is to provide ____________ view of data to user.', 1),
(3, 316, 'In data abstraction which is lowest level of abstraction ?', 1),
(3, 317, '_______ of abstraction explains how data is actually stored and describes the Data Structure and Access methods used by database.', 1),
(3, 318, 'Data Model is collection of conceptual tools for describing -', 2),
(3, 319, 'Overall design of the database is called as _________.', 2),
(3, 320, 'Monitoring the jobs running on the database,should be supervised by', 2),
(3, 321, 'Which of the following gives a logical structure of the database graphically?', 2),
(3, 322, 'The entity relationship set is represented in E-R diagram as', 2),
(3, 323, 'Database schema is given below: customer (customerId, name, phonenumber, address) account (accountNo, balance, branchName ) (i) Find out the phonenumber and address of the customer named by Aditya in relational algebra from the above database schema.', 2),
(3, 324, 'An entity set that does not have sufficient attributes to form a primary key is termed a __________', 2),
(3, 325, 'Which of the following is true about Data Independence?', 2),
(3, 326, 'In an ER model,suppose R is many-to one relation from entity set E1 to entity set E2.Assume that E1 and E2 participate totally in R and the cardinality of E1 is greater than cardinality of E2.Which one of the following is true about R?', 3),
(3, 327, 'Given the basic ER and relational models, which of the following is INCORRECT?', 3),
(3, 328, 'Which one is correct w.r.t. RDBMS ?', 3),
(3, 329, 'Goals for the design of the logical scheme include', 3),
(3, 330, 'Which operation is used to extract specified columns from a table?', 3);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total` int(5) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `user_id`, `exam_id`, `score`, `total`, `time`) VALUES
(4, 5, 1, 21, 28, '2020-11-19 17:00:30'),
(5, 5, 2, 16, 28, '2020-11-19 17:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone_no`, `created_at`) VALUES
(5, 'kirpan.vivek@gmail.com', '$2y$10$fyc.aGE.RuUQenkS21Z7cOd4mqfE/nkx7lwRR89egzQXkD6gzuESm', 'Vivek Kirpan', '8365423720', '2020-11-08 21:53:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`ans_id`),
  ADD KEY `answer_ibfk_1` (`qid`);

--
-- Indexes for table `correct_answer`
--
ALTER TABLE `correct_answer`
  ADD KEY `ans_id` (`ans_id`),
  ADD KEY `qid` (`qid`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `difficulty`
--
ALTER TABLE `difficulty`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `diff_id` (`diff_id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`user_id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `correct_answer`
--
ALTER TABLE `correct_answer`
  ADD CONSTRAINT `correct_answer_ibfk_1` FOREIGN KEY (`ans_id`) REFERENCES `answers` (`ans_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `correct_answer_ibfk_2` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `correct_answer_ibfk_3` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`diff_id`) REFERENCES `difficulty` (`did`) ON UPDATE CASCADE;

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`exam_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `result_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

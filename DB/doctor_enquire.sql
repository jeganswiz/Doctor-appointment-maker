-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2022 at 07:35 AM
-- Server version: 5.7.39-0ubuntu0.18.04.2
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_enquire`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL DEFAULT '',
  `email` varchar(220) NOT NULL DEFAULT '',
  `password` varchar(220) NOT NULL DEFAULT '',
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0-admin;1;doctor',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `role`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '123456', 0, 0),
(2, 'Doctor', 'doctor@gmail.com', '123456', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `name` varchar(220) NOT NULL DEFAULT '',
  `email` varchar(220) NOT NULL DEFAULT '',
  `phone` varchar(220) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `fees` double NOT NULL DEFAULT '0',
  `allocated_date` date DEFAULT NULL,
  `allocated_time` varchar(200) DEFAULT '',
  `payment_type` varchar(50) NOT NULL DEFAULT '' COMMENT 'stripe;razorpay;',
  `payment_transaction_id` varchar(220) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-applied;1-admintimeupdated;2-patient_time_chosen_and_patient_payment_completed;3-admin_approved;',
  `notes` text,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiry_id`, `name`, `email`, `phone`, `description`, `fees`, `allocated_date`, `allocated_time`, `payment_type`, `payment_transaction_id`, `status`, `notes`, `created_on`, `updated_on`) VALUES
(1, 'Jegan', 'jeganathans@hitasoft.com', '8525050312', 'i got a cold', 0, NULL, NULL, '', '', 0, '', '2022-09-13 07:57:41', NULL),
(2, 'Meena', 'jeganathans@hitasoft.com', '8525050312', 'i got a cold - new', 300.05, '2022-09-14', '10.00 AM - 11.00 AM', 'razor', 'pay_KHo9867NVHOBcp', 3, '', '2022-09-13 10:42:16', '2022-09-15 05:31:34'),
(5, 'Jammy', 'mad@gmail.com', '9645213256', 'newBackpain', 0, NULL, NULL, '', '', 0, '', '2022-09-14 05:18:16', NULL),
(6, 'Meena', 'meenav@hitasoft.com', '8608155944', 'hi', 200, '2022-09-15', '09.00 AM - 10.00 AM', 'stripe', 'pi_3LiCQAIKcHe9zMIW18rmD5ji', 3, 'fsdffsdd', '2022-09-15 07:19:16', '2022-09-15 07:25:41'),
(7, 'Saravana Shankar', 's.saravanashankarmca@gmail.com', '9843949085', 'Test Message', 200, NULL, '', '', '', 1, NULL, '2022-09-15 07:28:10', '2022-09-15 07:29:33'),
(8, 'Saravanan', 'saravanapandianp@hitasoft.com', '923223432', 'Testing...', 250, '2022-09-19', '10.00 AM - 11.00 AM', 'stripe', 'pi_3LiCYlIKcHe9zMIW0YiMqLgZ', 3, 'Tetsing.f..d', '2022-09-15 07:29:30', '2022-09-15 07:35:18'),
(9, 'HTS Shankar', 'shankarhitasoft@gmail.com', '9843949085', 'TEST', 200, '2022-09-16', '11.00 AM - 12.00 PM', 'stripe', 'pi_3LiCaYIKcHe9zMIW1IJOtZ4N', 3, 'TEST NOTES', '2022-09-15 07:33:01', '2022-09-15 07:35:53'),
(10, 'Test', 'test@gmail.com', '2132432', 'qwasd', 0, NULL, '', '', '', 0, NULL, '2022-09-15 07:33:08', NULL),
(11, 'Prime', 'prime@mailinator.com', '7667653926', 'Hi, i want need your appointment for my cushions treatment.', 199, '2022-09-17', '09.00 AM - 10.00 AM', 'razorpay', 'pay_KISD4HnuQpR29A', 3, 'Test new hi ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss the osandf;osnf ;sodboawj s;awb aow e;web aw a wvobwevoBWVOLWUEOL WOEF OWE FUWEIWUBFIA wi viauwebuiwoabev a;q ODUHWEOUJFNSJ AVUH[982Y3QNC V PO [0Y83WONE WE Y 0823YR08WNCKL A P893Y 0823WJEIHW9EP47Y2389YOIWHW 79 PH923 9DSFYGWEOFOIQBWEFPUIWPEFOIWENFIBQWEIBF QKWJE ;IJQWB EKJQ WE;OQOWUEBFKLSD;OWAEINMLKDS', '2022-09-16 05:08:31', '2022-09-16 05:42:07'),
(12, 'The North Water', 'prime@mailinator.com', '2342342342', 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n\r\nWhere does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\r\n\r\nWhere can I get some?\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 350, '2022-09-16', '11.00 AM - 12.00 PM', 'stripe', 'pi_3LiXPEIKcHe9zMIW1DrnEmuZ', 3, 'rxhtxfthtg', '2022-09-16 05:28:04', '2022-09-16 12:22:24'),
(13, 'Vikky', 'prime@mailinator.com', 'wwwwwwww', 'dsfsdfsdfsdfsd', 350, NULL, '', '', '', 1, NULL, '2022-09-16 06:27:59', '2022-09-16 06:47:08'),
(14, 'd', 'prime@mailinator.com', 's', 'g', 400, '2022-09-16', '01.00 PM - 02.00 PM', 'razorpay', 'pay_KITpx1u26EPX4f', 2, NULL, '2022-09-16 06:29:30', '2022-09-16 06:56:21'),
(15, 'we', 'prime@mailinator.com', '2', '3', 400, '2022-09-16', '06.00 PM - 07.00 PM', 'stripe', 'pi_3LifP9IKcHe9zMIW1h2TPxKL', 2, NULL, '2022-09-16 06:30:40', '2022-09-16 14:21:03'),
(16, '345345@##@@', 'karavindhvalan@hitasoft.com', '+919809879922', 'qweqwe', 0, NULL, '', '', '', 0, NULL, '2022-09-16 06:43:40', NULL),
(17, 'jegan', 'jeganathans@hitasoft.com', '8525050312', 'boom', 400, '2022-09-19', '10.00 AM - 11.00 AM', 'razorpay', 'pay_KIZRHOycgggF3b', 3, NULL, '2022-09-16 12:20:49', '2022-09-16 12:24:47'),
(18, 'Tiger', 'fs@mailinator.com', '+917667653926', 'sssssss', 250, '2022-09-16', '06.00 PM - 07.00 PM', 'stripe', 'pi_3LiepjIKcHe9zMIW05fSjFFt', 3, 'dsfgsdfsdfsdf', '2022-09-16 13:42:26', '2022-09-16 13:47:11'),
(19, 'Miller', 'mill@mailinator.com', '23423423423', 'sdfsdfsdf', 400, '2022-09-16', '04.00 PM - 05.00 PM', 'stripe', 'pi_3LifG5IKcHe9zMIW11zqhTKm', 2, NULL, '2022-09-16 14:10:25', '2022-09-16 14:11:25'),
(20, 'sadasd', 'ambi@mailinator.com', '23423423', 'sdvzsdfvzsvd', 400, '2022-09-16', '07.00 PM - 08.00 PM', 'stripe', 'pi_3LifIZIKcHe9zMIW0w4b32qZ', 2, NULL, '2022-09-16 14:12:02', '2022-09-16 14:14:23'),
(21, 'mee', 'jeganathans@hitasoft.com', '8525064525', '123456', 400, '2022-09-21', '11.00 AM - 12.00 PM', 'stripe', 'pi_3LifNyIKcHe9zMIW0rgxC4gQ', 2, NULL, '2022-09-16 14:17:09', '2022-09-16 14:19:38'),
(22, 'The North Water', 'prime@mailinator.com', '3242344545', 'awefaef', 400, '2022-09-16', '06.00 PM - 07.00 PM', 'razorpay', 'pay_KIbbO9bzuVjsqm', 2, NULL, '2022-09-16 14:29:46', '2022-09-16 14:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_optional_dates`
--

CREATE TABLE `enquiry_optional_dates` (
  `id` int(11) NOT NULL,
  `enquiry_id` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry_optional_dates`
--

INSERT INTO `enquiry_optional_dates` (`id`, `enquiry_id`, `date`, `time`, `status`) VALUES
(1, 2, '2022-09-14', NULL, 0),
(2, 2, '2022-09-23', NULL, 0),
(3, 2, '2022-09-25', NULL, 0),
(4, 2, '2022-09-24', NULL, 0),
(5, 6, '2022-09-15', NULL, 0),
(6, 6, '2022-09-19', NULL, 0),
(7, 6, '2022-09-28', NULL, 0),
(8, 6, '2022-09-30', NULL, 0),
(9, 7, '2022-09-15', NULL, 0),
(10, 7, '2022-09-17', NULL, 0),
(11, 7, '2022-09-19', NULL, 0),
(12, 7, '2022-09-20', NULL, 0),
(13, 8, '2022-09-16', NULL, 0),
(14, 8, '2022-09-19', NULL, 0),
(15, 8, '2022-09-20', NULL, 0),
(16, 8, '2022-09-21', NULL, 0),
(17, 9, '2022-09-19', NULL, 0),
(18, 9, '2022-09-16', NULL, 0),
(19, 9, '2022-09-20', NULL, 0),
(20, 9, '2022-09-21', NULL, 0),
(21, 11, '2022-09-17', NULL, 0),
(22, 11, '2022-09-18', NULL, 0),
(23, 11, '2022-09-19', NULL, 0),
(24, 11, '2022-09-21', NULL, 0),
(25, 12, '2022-09-16', NULL, 0),
(26, 13, '2022-09-16', NULL, 0),
(27, 14, '2022-09-16', NULL, 0),
(28, 14, '2022-09-17', NULL, 0),
(29, 17, '2022-09-19', NULL, 0),
(30, 17, '2022-09-21', NULL, 0),
(31, 18, '2022-09-16', NULL, 0),
(32, 19, '2022-09-16', NULL, 0),
(33, 20, '2022-09-16', NULL, 0),
(34, 21, '2022-09-21', NULL, 0),
(35, 21, '2022-09-28', NULL, 0),
(36, 15, '2022-09-16', NULL, 0),
(37, 22, '2022-09-16', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `smtpemail` varchar(220) NOT NULL DEFAULT '',
  `smtppassword` varchar(220) NOT NULL DEFAULT '',
  `smtpport` varchar(220) NOT NULL DEFAULT '',
  `smtphost` varchar(220) NOT NULL DEFAULT '',
  `smtpenable` varchar(220) NOT NULL DEFAULT '',
  `sitename` varchar(220) NOT NULL DEFAULT '',
  `default_fees` double NOT NULL DEFAULT '0',
  `stripe_keys` text NOT NULL,
  `razor_keys` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `smtpemail`, `smtppassword`, `smtpport`, `smtphost`, `smtpenable`, `sitename`, `default_fees`, `stripe_keys`, `razor_keys`) VALUES
(1, 'jegans797@gmail.com', 'lyejnewgfzjutjqm', '465', 'smtp.gmail.com', '1', 'Doctorenqs', 400, '{\"Stripe_Public_Key\":\"pk_test_3ypGlAi5cdmhGVMLnd8ppxcg009ufFj9XR\",\"Stripe_Private_Id\":\"sk_test_IYv2RKTMuskg2NdXP0sP5Xnq00yWfZQ0R0\"}', '{\"razorPublicKey\":\"rzp_test_RAweENKg7RtKb9\",\"razorPrivateKey\":\"3NUkdOnU8A7sYr7yvzOnZeak\"}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `enquiry_optional_dates`
--
ALTER TABLE `enquiry_optional_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `enquiry_optional_dates`
--
ALTER TABLE `enquiry_optional_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

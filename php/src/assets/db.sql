-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2017 at 08:15 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `photo` varchar(50) NOT NULL DEFAULT 'default.jpg',
  `hash_for_email` varchar(50) DEFAULT NULL,
  `remember_me_token` varchar(200) DEFAULT NULL,
  `group` int(11) NOT NULL,
  `author_name` varchar(500) DEFAULT NULL,
  `author_short_description` text,
  `author_facebook_link` varchar(500) DEFAULT NULL,
  `author_twitter_link` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `photo`, `hash_for_email`, `remember_me_token`, `group`, `author_name`, `author_short_description`, `author_facebook_link`, `author_twitter_link`) VALUES
(1, 'ankursinghagra@gmail.com', '70395e1a90265a4145a0cb19c5fe215b', 'Admin', '1479549876.jpg', '8b8389f20e57a86940754a82a6aac0df', '09bd682d68bcedcf805934dad6cd0c25b62e9367', 1, 'Ankur Singh', 'Ankur is the developer and creator of this blog.', 'http://facebook.com/ankursinghagra/', 'http://twitter.com/ankursinghagra/');

-- --------------------------------------------------------

--
-- Table structure for table `admin_groups`
--

DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL DEFAULT '0',
  `group_color` varchar(100) NOT NULL DEFAULT 'info',
  `edit_site_options` enum('1','0') NOT NULL DEFAULT '0',
  `add_users` enum('0','1') NOT NULL DEFAULT '0',
  `edit_users` enum('1','0') NOT NULL DEFAULT '0',
  `edit_permissions` enum('1','0') NOT NULL DEFAULT '0',
  `edit_seo` enum('0','1') NOT NULL DEFAULT '0',
  `edit_pages` enum('1','0') NOT NULL DEFAULT '0',
  `edit_menu` enum('1','0') NOT NULL DEFAULT '0',
  `edit_slider` enum('1','0') NOT NULL DEFAULT '0',
  `edit_blog` enum('1','0') NOT NULL DEFAULT '0',
  `edit_assets` enum('1','0') NOT NULL DEFAULT '0',
  `edit_projects` enum('0','1') NOT NULL DEFAULT '0',
  `edit_footer` enum('0','1') NOT NULL DEFAULT '0',
  `edit_photos` enum('0','1') NOT NULL DEFAULT '0',
  `edit_videos` enum('0','1') NOT NULL DEFAULT '0',
  `edit_team` enum('0','1') NOT NULL DEFAULT '0',
  `see_visitors_msgs` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_groups`
--

INSERT INTO `admin_groups` (`id`, `group_name`, `group_color`, `edit_site_options`, `add_users`, `edit_users`, `edit_permissions`, `edit_seo`, `edit_pages`, `edit_menu`, `edit_slider`, `edit_blog`, `edit_assets`, `edit_projects`, `edit_footer`, `edit_photos`, `edit_videos`, `edit_team`, `see_visitors_msgs`) VALUES
(1, 'Adminstrators', 'primary', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(2, 'Owners', 'success', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1'),
(3, 'Bloggers', 'info', '0', '0', '0', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(200) DEFAULT NULL,
  `blog_slug` varchar(200) DEFAULT NULL,
  `blog_seo_title` varchar(500) DEFAULT NULL,
  `blog_seo_keywords` varchar(2000) DEFAULT NULL,
  `blog_seo_description` varchar(1000) DEFAULT NULL,
  `blog_category_slug` varchar(200) DEFAULT NULL,
  `blog_author_email` varchar(100) DEFAULT NULL,
  `blog_photo` varchar(200) DEFAULT NULL,
  `blog_content` text,
  `active` enum('1','0') NOT NULL DEFAULT '1',
  `date` varchar(10) DEFAULT NULL,
  `tags` varchar(3000) DEFAULT NULL,
  `time_stamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL,
  `blog_category_slug` varchar(300) NOT NULL,
  `blog_category_image` varchar(100) NOT NULL,
  `blog_category_title` varchar(300) NOT NULL,
  `blog_category_description` varchar(1000) NOT NULL,
  `blog_category_seo_title` varchar(100) NOT NULL,
  `blog_category_seo_keywords` varchar(2000) DEFAULT NULL,
  `blog_category_seo_description` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `custom_block`
--

DROP TABLE IF EXISTS `custom_block`;
CREATE TABLE `custom_block` (
  `id` int(11) NOT NULL,
  `part_id` varchar(50) NOT NULL DEFAULT '0',
  `field_id` varchar(50) NOT NULL DEFAULT '0',
  `content_html` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_block`
--

INSERT INTO `custom_block` (`id`, `part_id`, `field_id`, `content_html`) VALUES
(1, 'footer', 'footer_1', '<ul>\n<li><a href="/home">Home</a></li>\n<li><a href="/about-us">About Us</a></li>\n<li><a href="/our-team">Our Team</a></li>\n</ul>'),
(2, 'footer', 'footer_2', '<ul>\n<li><a href="http://sapricami.com/" target="_blank">Sapricami.com</a></li>\n<li><a href="/terms">Terms of Use</a></li>\n<li><a href="/privacy-statement">Privacy Statement</a></li>\n</ul>'),
(3, 'footer', 'footer_3', '<p><a href="/blog">Blog</a> <a href="/our-work">Our Work</a> <a href="/contact">Contact Us</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `important_info`
--

DROP TABLE IF EXISTS `important_info`;
CREATE TABLE `important_info` (
  `id` int(11) NOT NULL,
  `og_status` varchar(5) DEFAULT NULL,
  `seo_og_appid` varchar(20) DEFAULT NULL,
  `tc_status` varchar(5) DEFAULT NULL,
  `seo_image` varchar(50) DEFAULT NULL,
  `seo_sitename` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `important_info`
--

INSERT INTO `important_info` (`id`, `og_status`, `seo_og_appid`, `tc_status`, `seo_image`, `seo_sitename`) VALUES
(1, 'ON', '', 'ON', 'default.jpg', 'Sapricami');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `link` varchar(50) DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `link`, `parent`, `sort`) VALUES
(1, 'Home', '', 0, 1),
(2, 'About Us', 'about-us', 0, 2),
(3, 'Our Work', 'our-work', 0, 3),
(4, 'Our Team', 'our-team', 0, 4),
(5, 'Gallery', '', 0, 5),
(6, 'Photos', 'photos', 5, 1),
(7, 'Videos', 'videos', 5, 2),
(8, 'Blog', 'blog', 0, 6),
(9, 'Contact', 'contact', 0, 8),
(10, 'Pricing', 'pricing', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_slug` varchar(100) DEFAULT '0',
  `page_title` varchar(100) DEFAULT '0',
  `page_subtitle` varchar(200) DEFAULT '0',
  `meta_title` varchar(500) DEFAULT '0',
  `meta_keywords` varchar(1000) DEFAULT '0',
  `meta_description` varchar(1000) DEFAULT '0',
  `page_content` text,
  `page_content_HTML` text,
  `custom_function` varchar(100) DEFAULT '0' COMMENT 'for checking if page is home or contact and act accordingly',
  `active` enum('1','0') DEFAULT '1',
  `fixed` enum('1','0') DEFAULT '0',
  `editable` enum('1','0') DEFAULT '1',
  `og_title` varchar(70) DEFAULT NULL,
  `og_type` varchar(20) DEFAULT NULL,
  `og_image` varchar(20) DEFAULT NULL,
  `og_description` varchar(200) DEFAULT NULL,
  `tw_title` varchar(70) DEFAULT NULL,
  `tw_card` varchar(20) DEFAULT NULL,
  `tw_image` varchar(20) DEFAULT NULL,
  `tw_description` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_slug`, `page_title`, `page_subtitle`, `meta_title`, `meta_keywords`, `meta_description`, `page_content`, `page_content_HTML`, `custom_function`, `active`, `fixed`, `editable`, `og_title`, `og_type`, `og_image`, `og_description`, `tw_title`, `tw_card`, `tw_image`, `tw_description`) VALUES
(1, '', 'Home', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Home', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'home', '1', '1', '1', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(2, 'about-us', 'About Us', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - About Us', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', '0', '1', '1', '1', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(3, 'our-team', 'Our Team', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Our Team', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'team', '1', '1', '0', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(4, 'our-work', 'Our Work', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Our Work Samples', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'photos', '1', '1', '0', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(6, 'videos', 'Video Gallery', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Video Gallery', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'videos', '1', '1', '0', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(7, 'blog', 'Blog', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Our Blog', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'blog', '1', '1', '1', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(8, 'contact', 'Contact Us', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Contact Us', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'contact', '1', '1', '0', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(5, 'Photos', 'Photo Gallery', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Photo Gallery', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', 'videos', '1', '1', '0', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION'),
(9, 'pricing', 'Pricing', 'Lorem Ipsum has been the industrys standard dummy text', 'Sapricami CMS - Pricing Section', 'Content Management System, CMS, Admin Panel, Sapricami, Keywords', 'Lorem Ipsum has been the industrys standard dummy text, Lorem Ipsum has been the industrys standard dummy text', '{"data":[{"type":"columns","data":{"columns":[{"width":6,"blocks":[]},{"width":6,"blocks":[]}],"preset":"columns-6-6"}}]}', '<div class=''row''><div class=''col-md-6''></div><div class=''col-md-6''></div></div>', '0', '1', '0', '1', 'OG TITLE', 'website', '', 'OG DESCRIPTION', 'TWITTER CARD', 'summary', '', 'TWITTER DESCRIPTION');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photo_title` varchar(50) NOT NULL,
  `photo_description` varchar(100) NOT NULL,
  `photo_filename` varchar(50) NOT NULL,
  `out_link` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_html` text,
  `project_title` varchar(200) NOT NULL,
  `project_slug` varchar(200) NOT NULL,
  `project_seo_title` varchar(400) NOT NULL,
  `project_description` text NOT NULL,
  `project_seo_description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_photos`
--

DROP TABLE IF EXISTS `project_photos`;
CREATE TABLE `project_photos` (
  `id` int(11) NOT NULL,
  `photo_title` varchar(500) NOT NULL,
  `photo_description` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `photo_filename` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

DROP TABLE IF EXISTS `site_options`;
CREATE TABLE `site_options` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL DEFAULT '0',
  `logo_or_text` varchar(100) NOT NULL DEFAULT 'TEXT',
  `site_description` text NOT NULL,
  `logo_file` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `theme` varchar(100) NOT NULL DEFAULT '0',
  `indexing` varchar(100) NOT NULL DEFAULT '0',
  `email_for_sendmail` varchar(100) NOT NULL DEFAULT '0',
  `cc_for_sendmail` varchar(100) NOT NULL DEFAULT '0',
  `email1` varchar(100) NOT NULL DEFAULT '0',
  `email2` varchar(100) NOT NULL DEFAULT '0',
  `phone1` varchar(100) NOT NULL DEFAULT '0',
  `phone2` varchar(100) NOT NULL DEFAULT '0',
  `address1` varchar(100) NOT NULL DEFAULT '0',
  `address2` varchar(100) NOT NULL DEFAULT '0',
  `facebook_link` varchar(100) NOT NULL DEFAULT '0',
  `google_link` varchar(100) NOT NULL DEFAULT '0',
  `twitter_link` varchar(100) NOT NULL DEFAULT '0',
  `linkedin_link` varchar(100) NOT NULL DEFAULT '0',
  `smtp_hostname` varchar(100) NOT NULL DEFAULT '0',
  `smtp_port` varchar(100) NOT NULL DEFAULT '0',
  `smtp_username` varchar(100) NOT NULL DEFAULT '0',
  `smtp_password` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` (`id`, `site_name`, `logo_or_text`, `site_description`, `logo_file`, `theme`, `indexing`, `email_for_sendmail`, `cc_for_sendmail`, `email1`, `email2`, `phone1`, `phone2`, `address1`, `address2`, `facebook_link`, `google_link`, `twitter_link`, `linkedin_link`, `smtp_hostname`, `smtp_port`, `smtp_username`, `smtp_password`) VALUES
(1, 'Sapricami CMS', 'TEXT', 'A Very User Friendly Content Management System specifically designed for business websites. Includes Blog, User Management, Menu Control, Pages Control, and many other features. ', 'logo.png', 'material', 'OFF', 'no-reply@yourdomain.com', '0', 'info@yourdomain.com', 'contact@yourdomain.com', '+91XXXXXXXXXX', '', 'Address Line 1', 'Address line 2', 'http://facebook.com/sapricami', 'http://plus.google.com/+Sapricami', 'http://twitter.com/sapricami', '', 'smtp_hostname', 'smtp_port', 'smtp_username', 'smtp_password');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `photo_title` varchar(50) NOT NULL,
  `photo_description` varchar(100) NOT NULL,
  `photo_filename` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `photo_title`, `photo_description`, `photo_filename`) VALUES
(14, 'SapricamiCMS', 'Easy Manageable Admin Panel', 'default.jpg'),
(15, 'SapricamiCMS', 'Custom Designs Available', 'default.jpg'),
(16, 'SapricamiCMS', 'Content Management System Made on Codeingiter', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team_member`
--

DROP TABLE IF EXISTS `team_member`;
CREATE TABLE `team_member` (
  `id` int(11) NOT NULL,
  `member_name` varchar(500) DEFAULT NULL,
  `member_title` varchar(500) DEFAULT NULL,
  `member_description` varchar(1000) DEFAULT NULL,
  `member_facebook_link` varchar(255) DEFAULT NULL,
  `member_twitter_link` varchar(255) DEFAULT NULL,
  `member_photo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_link` varchar(200) DEFAULT NULL,
  `video_hash` varchar(50) DEFAULT NULL,
  `video_title` varchar(200) DEFAULT NULL,
  `video_description` varchar(500) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_log`
--

DROP TABLE IF EXISTS `visitor_log`;
CREATE TABLE `visitor_log` (
  `id` int(11) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `page_link` varchar(50) DEFAULT NULL,
  `browser` varchar(40) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  `device` varchar(30) DEFAULT NULL,
  `device_str` varchar(100) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_groups`
--
ALTER TABLE `admin_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_block`
--
ALTER TABLE `custom_block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `important_info`
--
ALTER TABLE `important_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_photos`
--
ALTER TABLE `project_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_options`
--
ALTER TABLE `site_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_member`
--
ALTER TABLE `team_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_log`
--
ALTER TABLE `visitor_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_groups`
--
ALTER TABLE `admin_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `custom_block`
--
ALTER TABLE `custom_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `important_info`
--
ALTER TABLE `important_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_photos`
--
ALTER TABLE `project_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_options`
--
ALTER TABLE `site_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `team_member`
--
ALTER TABLE `team_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `visitor_log`
--
ALTER TABLE `visitor_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



CREATE TABLE IF NOT EXISTS `accnt_invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_description` text NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_discount` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accnt_invoice_items`
--

INSERT INTO `accnt_invoice_items` (`id`, `invoice_id`, `item_name`, `item_description`, `item_price`, `item_quantity`, `item_discount`, `staff_id`) VALUES
(1, 1, 'Test', 'asdf', 11, 1, 1, 2),
(4, 3, 'Test', 'This is desc', 23, 1, 3, 2),
(3, 2, 'asfdasdf', '23', 22, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `accnt_invoice_payments`
--

CREATE TABLE IF NOT EXISTS `accnt_invoice_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `date_paid` varchar(20) NOT NULL,
  `method` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accnt_pay_bank`
--

CREATE TABLE IF NOT EXISTS `accnt_pay_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_no` blob NOT NULL,
  `routing` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accnt_pay_cards`
--

CREATE TABLE IF NOT EXISTS `accnt_pay_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `name_on_card` varchar(50) NOT NULL,
  `card_no` blob NOT NULL,
  `expiry` varchar(10) NOT NULL,
  `ccv` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accnt_pay_methods`
--

CREATE TABLE IF NOT EXISTS `accnt_pay_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `accnt_pay_methods`
--

INSERT INTO `accnt_pay_methods` (`id`, `name`) VALUES
(1, 'check'),
(2, 'wire'),
(3, 'paypal'),
(4, 'credit'),
(5, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `backup_csv`
--

CREATE TABLE IF NOT EXISTS `backup_csv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_path` varchar(255) NOT NULL,
  `backup_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `backup_sql`
--

CREATE TABLE IF NOT EXISTS `backup_sql` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_path` varchar(255) NOT NULL,
  `backup_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `broadcast`
--

CREATE TABLE IF NOT EXISTS `broadcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(60) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip_address` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `broadcast`
--

INSERT INTO `broadcast` (`id`, `user`, `message`, `date_time`, `ip_address`) VALUES
(1, '1', 'hello', '2014-12-24 22:13:30', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` date NOT NULL,
  `start_t` time NOT NULL,
  `end` date DEFAULT NULL,
  `end_t` time NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `allDay` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `company`, `title`, `start`, `start_t`, `end`, `end_t`, `description`, `allDay`) VALUES
(1, 1, 'Launching test', '0000-00-00', '00:00:00', '0000-00-00', '01:22:00', 'Hello there. fired', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE IF NOT EXISTS `children` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `ssn` blob NOT NULL,
  `bday` varchar(12) NOT NULL,
  `gender` int(2) NOT NULL,
  `blood_type` varchar(20) NOT NULL,
  `enroll_date` varchar(20) NOT NULL,
  `last_update` varchar(20) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `company`, `fname`, `lname`, `ssn`, `bday`, `gender`, `blood_type`, `enroll_date`, `last_update`, `photo`, `status`) VALUES
(1, 1, 'Alice', 'Debby', 0x376a344851766c416168527239556e766b78516e645a466f51632b35516559445a38685275426f414330446e4f496d53304c45786c614e6e794c65647653654362664343542f465a50686149666764356d6f306147673d3d, '2000-02-22', 2, 'O-', '1418000806', '1418612495', '2a7c05f586c02c396b0abeea5e02db3e.jpg', 1),
(2, 1, 'Ann', 'Corr', 0x6c5a514d3847376b3736385a5459377343695749366f48594f335474567867737a6d7036584d5330435057466d564f76586c692b512f542f4368694a594848344a7834437a6852504c306f7356576d68327a466875513d3d, '2010-02-22', 2, '--select--', '1419396068', '1419396226', '78202dbdf8549209d757c78e508a471f.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `child_allergy`
--

CREATE TABLE IF NOT EXISTS `child_allergy` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `child_id` int(10) NOT NULL,
  `allergy` varchar(20) NOT NULL,
  `reaction` varchar(50) NOT NULL,
  `notes` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `child_allergy`
--

INSERT INTO `child_allergy` (`id`, `child_id`, `allergy`, `reaction`, `notes`) VALUES
(2, 1, 'Dust', 'Sneezing', '');

-- --------------------------------------------------------

--
-- Table structure for table `child_checkin`
--

CREATE TABLE IF NOT EXISTS `child_checkin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `in_parent_id` int(11) NOT NULL,
  `time_in` int(11) DEFAULT NULL,
  `in_staff_id` int(11) NOT NULL,
  `out_parent_id` int(11) NOT NULL,
  `time_out` int(11) DEFAULT NULL,
  `out_staff_id` int(11) NOT NULL,
  `checkin_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `child_checkin`
--

INSERT INTO `child_checkin` (`id`, `child_id`, `in_parent_id`, `time_in`, `in_staff_id`, `out_parent_id`, `time_out`, `out_staff_id`, `checkin_status`) VALUES
(1, 1, 2, 1418266724, 1, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `child_emergency`
--

CREATE TABLE IF NOT EXISTS `child_emergency` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `child_id` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `cell` varchar(12) NOT NULL,
  `other_phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `relation` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `child_foodpref`
--

CREATE TABLE IF NOT EXISTS `child_foodpref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `food` varchar(50) NOT NULL,
  `food_time` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `child_foodpref`
--

INSERT INTO `child_foodpref` (`id`, `child_id`, `food`, `food_time`, `comment`) VALUES
(1, 1, 'Cereal', 'breakfast', 'With milk');

-- --------------------------------------------------------

--
-- Table structure for table `child_insurance`
--

CREATE TABLE IF NOT EXISTS `child_insurance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `child_id` int(11) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_num` int(20) NOT NULL,
  `g_num` int(20) NOT NULL,
  `expiry` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `child_insurance`
--

INSERT INTO `child_insurance` (`id`, `child_id`, `p_name`, `p_num`, `g_num`, `expiry`) VALUES
(6, 1, 'asdfas', 222, 222, '2014-12-31'),
(7, 1, 'asdfas', 222, 222, '2014-12-08'),
(8, 1, 'asdfas', 222, 222, '2014-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `child_meds`
--

CREATE TABLE IF NOT EXISTS `child_meds` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `child_id` int(10) NOT NULL,
  `med_name` varchar(30) NOT NULL,
  `med_notes` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `child_meds`
--

INSERT INTO `child_meds` (`id`, `child_id`, `med_name`, `med_notes`) VALUES
(1, 1, 'Tylenol', '650mg by mouth at lunch');

-- --------------------------------------------------------

--
-- Table structure for table `child_notes`
--

CREATE TABLE IF NOT EXISTS `child_notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `child_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `child_pickup`
--

CREATE TABLE IF NOT EXISTS `child_pickup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `child_id` int(10) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `cell` varchar(12) NOT NULL,
  `other_phone` varchar(12) NOT NULL,
  `address` text NOT NULL,
  `pin` int(6) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `child_pickup`
--

INSERT INTO `child_pickup` (`id`, `child_id`, `fname`, `lname`, `cell`, `other_phone`, `address`, `pin`, `relation`, `photo`, `status`) VALUES
(1, 1, 'Philip', 'Doe', '2333333', '2333232', '123 Test st', 2222, 'PCP', '4b6fda34b3584090bdad637aa68fa7b4.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `child_status`
--

CREATE TABLE IF NOT EXISTS `child_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `child_status`
--

INSERT INTO `child_status` (`id`, `status_name`) VALUES
(1, 'active'),
(2, 'inactive'),
(3, 'graduated'),
(4, 'transferred');

-- --------------------------------------------------------

--
-- Table structure for table `child_users`
--

CREATE TABLE IF NOT EXISTS `child_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `child_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `child_users`
--

INSERT INTO `child_users` (`id`, `child_id`, `user_id`) VALUES
(1, 1, 0),
(2, 1, 2),
(3, 1, 3),
(4, 1, 1),
(5, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('898ca8ec9ff9510c22674f1a0b715218', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.101 Safari/537.36', 1427161890, 'a:9:{s:9:"user_data";s:0:"";s:9:"last_page";s:42:"http://127.0.0.1/products/daycare/children";s:10:"company_id";s:1:"1";s:8:"identity";s:14:"admin@demo.com";s:8:"username";s:5:"admin";s:5:"email";s:14:"admin@demo.com";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1426820730";s:13:"view_child_id";s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE IF NOT EXISTS `classrooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `slogan` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `allow_reg` int(2) NOT NULL,
  `captcha` int(2) NOT NULL,
  `maintenance` int(2) NOT NULL,
  `demo_mode` int(11) NOT NULL,
  `encrypt_key` varchar(100) NOT NULL,
  `paypal_email` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `website` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` int(5) NOT NULL,
  `country` varchar(20) NOT NULL,
  `time_zone` varchar(20) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `curr_symbol` varchar(5) NOT NULL,
  `date_format` varchar(20) NOT NULL,
  `google_analytics` varchar(50) NOT NULL,
  `reg_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `slogan`, `logo`, `allow_reg`, `captcha`, `maintenance`, `demo_mode`, `encrypt_key`, `paypal_email`, `email`, `phone`, `fax`, `website`, `street`, `city`, `state`, `zip`, `country`, `time_zone`, `currency`, `curr_symbol`, `date_format`, `google_analytics`, `reg_date`) VALUES
(1, '9174986712', 'DayCarePRO', 'Daycare Management system', 'logo.png', 1, 0, 0, 0, '12345678', 'jgatem@gmail.com', 'info@icoolpix.com', '3019098359', '123456', 'http://google.com', '123 Street', 'NYC', 'NY', 1234, 'US', 'US/Eastern', 'USD', '$', 'm-d-y', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE IF NOT EXISTS `event_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `event` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `event_log`
--

INSERT INTO `event_log` (`id`, `company`, `user_id`, `date`, `event`) VALUES
(1, 1, 1, '1418612491', 'Updated child Alice Debby'),
(2, 1, 1, '1418612495', 'Updated child Alice Debby'),
(3, 1, 1, '1418613685', 'Added insurance for  -Debby'),
(4, 1, 1, '1418613693', 'Added insurance for  -Debby'),
(5, 1, 1, '1418613712', 'Added insurance for  -Debby'),
(6, 1, 1, '1418613726', 'Added insurance for  -Debby'),
(7, 1, 1, '1418613741', 'Added insurance for  -Debby'),
(8, 1, 1, '1418613830', 'Added insurance for  -Debby'),
(9, 1, 1, '1418614078', 'Delete insurance for  -Debby'),
(10, 1, 1, '1418614092', 'Delete insurance for  -Debby'),
(11, 1, 1, '1418614109', 'Delete insurance for  -'),
(12, 1, 1, '1418614186', 'Delete insurance for  -Debby'),
(13, 1, 1, '1418614315', 'Added allergy for  -Debby'),
(14, 1, 1, '1418614379', 'Added insurance for 1 -Debby'),
(15, 1, 1, '1418614389', 'Added insurance for 1 -Debby'),
(16, 1, 1, '1418614482', 'Delete insurance for  -Debby'),
(17, 1, 1, '1419202905', 'Deactivated membership to upgrade'),
(18, 1, 1, '1419202905', 'Updated membereship to enterprise for 1'),
(19, 1, 1, '1419203878', 'deactivated membership'),
(20, 1, 1, '1419203878', 'Updated membereship to enterprise for 1'),
(21, 1, 1, '1419396068', 'Add child James Corr'),
(22, 1, 1, '1419396226', 'Updated child Ann Corr'),
(23, 1, 1, '1419459210', 'Sent broadcast {hello}'),
(24, 1, 1, '1420293524', 'Added allergy for 1 -Debby'),
(25, 1, 1, '1420293613', 'Added med for 1 -Debby'),
(26, 1, 1, '1426817385', 'updated test1'),
(27, 1, 1, '1427158881', 'updated jgmuchiri@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `company`, `name`, `description`) VALUES
(1, '', 'admin', 'Super admins'),
(2, '', 'manager', 'Managers'),
(3, '', 'staff', 'Staff members'),
(4, '', 'parent', 'Parents'),
(9, '', 'super', 'Super user');

-- --------------------------------------------------------

--
-- Table structure for table `help_articles`
--

CREATE TABLE IF NOT EXISTS `help_articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order` int(5) NOT NULL,
  `article_name` varchar(50) NOT NULL,
  `article_body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `msg_id` varchar(50) NOT NULL,
  `sender` int(10) NOT NULL,
  `receiver` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_sent` varchar(20) NOT NULL,
  `receiver_read` int(10) NOT NULL,
  `sender_read` int(11) NOT NULL,
  `sender_loc` varchar(20) NOT NULL,
  `receiver_loc` varchar(20) NOT NULL,
  `location` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`id`, `msg_id`, `sender`, `receiver`, `subject`, `message`, `date_sent`, `receiver_read`, `sender_read`, `sender_loc`, `receiver_loc`, `location`) VALUES
(1, '64238281418006714', 2, 1, 'hi admn', 'hi admi', '1418006714', 1, 0, '', '', 'inbox');

-- --------------------------------------------------------

--
-- Table structure for table `inbox_reply`
--

CREATE TABLE IF NOT EXISTS `inbox_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(10) NOT NULL,
  `parent` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_sent` varchar(20) NOT NULL,
  `is_read` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inbox_reply`
--

INSERT INTO `inbox_reply` (`id`, `sender`, `parent`, `message`, `date_sent`, `is_read`) VALUES
(1, '1', '64238281418006714', 'Hi', '1418220733', 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE IF NOT EXISTS `memberships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `member_type` varchar(20) NOT NULL,
  `pay_method` varchar(20) NOT NULL,
  `start_date` int(20) NOT NULL,
  `end_date` int(20) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`id`, `company`, `member_type`, `pay_method`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 'enterprise', 'PayPal', 1419199022, 1419199034, 0),
(2, 1, 'ultimate', 'PayPal', 1419199034, 1419199067, 0),
(3, 2, 'enterprise', 'PayPal', 1419199067, 0, 1),
(4, 1, 'enterprise', 'PayPal', 1419199088, 1419202905, 0),
(5, 1, 'enterprise', 'PayPal', 1419202905, 1419203878, 0),
(6, 1, 'enterprise', 'PayPal', 1419203878, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `order` int(5) NOT NULL,
  `article_name` varchar(50) NOT NULL,
  `article_body` text NOT NULL,
  `publish_date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `company`, `user_id`, `order`, `article_name`, `article_body`, `publish_date`) VALUES
(1, 1, 1, 0, 'This is a test article', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br></p><img  data-filename="paypal.png" ><p><br></p><p>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br></p>', '1419210480'),
(2, 1, 1, 0, 'asdf', 'asdf', '1419215877'),
(3, 1, 1, 0, 'This is a test article', '<p>asdfs</p>', '1419215918'),
(4, 1, 1, 0, 'This is a test article', '<p>&nbsp is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<span >&nbsp is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span >&nbsp is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span >&nbsp is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><span >&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '1419215947');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `slogan` varchar(50) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `allow_reg` int(2) NOT NULL,
  `captcha` int(2) NOT NULL,
  `maintenance` int(2) NOT NULL,
  `demo_mode` int(11) NOT NULL,
  `encrypt_key` varchar(100) NOT NULL,
  `paypal_email` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `website` varchar(100) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` int(5) NOT NULL,
  `country` varchar(20) NOT NULL,
  `time_zone` varchar(20) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `curr_symbol` varchar(5) NOT NULL,
  `date_format` varchar(20) NOT NULL,
  `google_analytics` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `name`, `slogan`, `logo`, `allow_reg`, `captcha`, `maintenance`, `demo_mode`, `encrypt_key`, `paypal_email`, `email`, `phone`, `fax`, `website`, `street`, `city`, `state`, `zip`, `country`, `time_zone`, `currency`, `curr_symbol`, `date_format`, `google_analytics`) VALUES
(1, 1, 'CarePRO', 'Childcare Management', 'paypal3.png', 1, 0, 0, 0, '12333', 'info@icoolpix.com', 'info@icoolpix.com', '+1 (301) 909-8359', '+1 (301) 909-8359', 'http://icoolpix.com', '123 Street St', 'New York', 'NY', 13601, 'USA', 'US/Eastern', 'USD', '$', 'm-d-y', 'UA-54280486-1');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `list_name` varchar(50) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`id`, `user_id`, `list_name`, `last_modified`, `status`) VALUES
(1, 2, 'My list', '2014-12-08 02:46:09', 'active'),
(2, 1, 'Test task', '2014-12-24 03:59:34', 'active'),
(3, 1, 'Test task 2', '2014-12-24 03:59:55', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `todo_items`
--

CREATE TABLE IF NOT EXISTS `todo_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todo_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `todo_items`
--

INSERT INTO `todo_items` (`id`, `todo_id`, `item_name`, `last_modified`, `item_status`) VALUES
(1, 1, 'test list', '2014-12-08 02:46:13', 'active'),
(2, 2, 'Item 1', '2014-12-24 03:59:40', 'active'),
(3, 2, 'Item 2', '2014-12-24 05:35:15', 'completed'),
(5, 3, 'item 3', '2014-12-24 03:59:59', 'active'),
(6, 3, 'item 4', '2014-12-24 04:00:02', 'active'),
(7, 3, 'item 0', '2014-12-24 04:00:05', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `company` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company`, `username`, `first_name`, `last_name`, `email`, `password`, `active`, `forgotten_password_code`, `forgotten_password_time`, `activation_code`, `remember_code`, `salt`, `created_on`, `last_login`, `ip_address`) VALUES
(1, 1, 'admin', 'Demo', 'Admin', 'admin@demo.com', '$2y$08$3tKDZ.t7m5Y6DYGWjJ5cOODDGMYrOUHHSCNVEulNJcSdXXYQRBgY6', 1, NULL, NULL, NULL, NULL, NULL, 1417992678, 1427158851, '::1'),
(2, 1, 'manager', 'Demo', 'Manager', 'manager@demo.com', '$2y$08$KbjOBTx9U10UPcxq8Eiuv.g6VI7BHVQK14Lw.b3BT7MvK3FVtL/2u', 1, NULL, NULL, NULL, NULL, NULL, 1418000273, 1418575357, '::1'),
(3, 1, 'staff', 'Demo', 'Staff', 'staff@demo.com', '$2y$08$mF52MtIXXrWzJNZTwqbJmemp0BT0XRFiTWCU.KhK8N//9dXOvcaBu', 1, NULL, NULL, NULL, NULL, NULL, 1418006359, 1418580454, '::1'),
(4, 1, 'parent', 'Demo', 'Parent', 'parent@demo.com', '$2y$08$XAtGTjW1W5/IQrM/.stsTeToijg.i/Egzu7Ev90NVHfOpsS9a4qNu', 1, NULL, NULL, NULL, NULL, NULL, 1418083168, 1418083195, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=267 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(219, 1, 1),
(220, 1, 2),
(221, 1, 3),
(222, 1, 4),
(223, 1, 9),
(215, 2, 1),
(216, 2, 2),
(217, 2, 3),
(218, 2, 4),
(238, 3, 1),
(239, 3, 4),
(264, 4, 1),
(265, 4, 3),
(266, 4, 4),
(242, 5, 4),
(209, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(5) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `street` varchar(50) NOT NULL,
  `street2` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` int(5) NOT NULL,
  `country` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `pin` int(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `phone`, `phone2`, `street`, `street2`, `city`, `state`, `zip`, `country`, `gender`, `pin`, `photo`) VALUES
(1, 1, '0', '0', '', '', '', 'NY', 0, 'United States', '', 1111, '1d05d1b45fd1271b5045c27bdb49285e.png'),
(2, 2, '', '', '', '', '', '', 0, '', '', 0, 'e194ca1f804a283cfbf74fc8691de226.png'),
(3, 3, '', '', '', '', '', '', 0, '', '', 0, 'a6f02f47cf065e02e2dea6b5b9609f17.png'),
(4, 8, '', '', '', '', '', '', 0, '', '', 0, ''),
(5, 4, '', '', '', '', '', '', 0, '', '', 0, ''),
(6, 0, '', '', '', '', '', '', 0, '', '', 0, ''),
(7, 5, '', '', '', '', '', '', 0, '', '', 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

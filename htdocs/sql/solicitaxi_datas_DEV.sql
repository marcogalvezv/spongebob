/*
*****************************
TESTING INITIAL DATA
*****************************
*/

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`id`, `name`, `homepage`, `created`, `updated`) VALUES
(1, 'Admin', '/admin/dashboard', NOW(), NOW()),
(2, 'Client', '/welcome', NOW(), NOW()),
(3, 'Company', '/radiotaxi/dashboard', NOW(), NOW()),
(4, 'Driver', '/driver/dashboard', NOW(), NOW());


--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `gid`, `idfacebook`, `username`, `password`, `activation_code`, `activation_expires`, `status`, `expiration`, `created`, `updated`) VALUES
(1, 1, NULL, 'admin', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-05-07 10:39:03', '2011-12-07 10:39:03'),
(2, 2, NULL, 'testuser1', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-05-07 10:39:03', '2011-12-07 10:39:03'),
(3, 2, NULL, 'testuser2', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-06-17 10:39:03', '2011-12-07 10:39:03'),
(4, 3, NULL, 'jardin', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-12-07 10:39:03', '2011-12-07 10:39:03'),
(5, 4, NULL, 'driver', 'bee9cef7c5d90536144a57bcb6fdf6be61703a414b09ae0d99', NULL, NULL, 1, NULL, '2011-12-07 10:39:03', '2011-12-07 10:39:03');

--
-- Dumping data for table `badge`
--
INSERT INTO `prize` (`id`, `name`, `desc`, `status`, `quantity`) VALUES
(1, 'First Prize', 'First Prize', 1, 100);


--
-- Dumping data for table `country`
--
INSERT INTO `country` (`id`, `code`, `name`) VALUES
(1, 'BO', 'Bolivia');

--
-- Dumping data for table `country_iso`
--

INSERT INTO `country_iso` (`name`, `fullname`, `prefix`, `currency`) VALUES
('AD', 'Andorra', '376', 'EUR'),
('AE', 'United Arab Emirates', '971', 'AED'),
('AF', 'Afghanistan', '93', 'AFA'),
('AG', 'Antigua And Barbuda', '126', 'XCD'),
('AI', 'Anguilla', '126', 'XCD'),
('AL', 'Albania', '355', 'ALL'),
('AM', 'Armenia', '374', 'AMD'),
('AN', 'Netherlands Antilles', '599', 'ANG'),
('AO', 'Angola', '244', 'AOK'),
('AQ', 'Antarctica', '672', 'BOB'),
('AR', 'Argentina', '54', 'ARP'),
('AS', 'American Samoa', '684', 'EUR'),
('AT', 'Austria', '43', 'EUR'),
('AU', 'Australia', '61', 'AUD'),
('AW', 'Aruba', '297', 'ANG'),
('AZ', 'Azerbaijan', '994', 'AZM'),
('BA', 'Bosnia and Herzegovina', '387', 'BAK'),
('BB', 'Barbados', '124', 'BBD'),
('BD', 'Bangladesh', '880', 'BDT'),
('BE', 'Belgium', '32', 'EUR'),
('BF', 'Burkina Faso', '226', 'XOF'),
('BG', 'Bulgaria', '359', 'BGL'),
('BH', 'Bahrain', '973', 'BHD'),
('BI', 'Burundi', '257', 'BIF'),
('BJ', 'Benin', '229', 'XOF'),
('BM', 'Bermuda', '144', 'BMD'),
('BN', 'Brunei Darussalam', '673', 'BND'),
('BO', 'Bolivia', '591', 'BOB'),
('BR', 'Brazil', '55', 'BRR'),
('BS', 'Bahamas', '124', 'BSD'),
('BT', 'Bhutan', '975', 'INR'),
('BV', 'Bouvet Island', '591', 'NOK'),
('BW', 'Botswana', '267', 'BWP'),
('BZ', 'Belize', '501', 'BZD'),
('CA', 'Canada', '1', 'CAD'),
('CC', 'Cocos (Keeling) Islands', '61', 'AUD'),
('CF', 'Central African Republic', '236', 'XAF'),
('CH', 'Switzerland', '41', 'CHF'),
('CK', 'Cook Islands', '682', 'NZD'),
('CL', 'Chile', '56', 'CLP'),
('CM', 'Cameroon', '237', 'XAF'),
('CN', 'China', '86', 'CNY'),
('CO', 'Colombia', '57', 'COP'),
('CR', 'Costa Rica', '506', 'CRC'),
('CV', 'Cape Verde', '238', 'CVE'),
('CX', 'Christmas Island', '61', 'AUD'),
('CY', 'Cyprus', '357', 'CYP'),
('CZ', 'Czech Republic', '420', 'CSK'),
('DE', 'Germany', '49', 'EUR'),
('DJ', 'Djibouti', '253', 'DJF'),
('DK', 'Denmark', '45', 'DKK'),
('DM', 'Dominica', '176', 'XCD'),
('DO', 'Dominican Republic', '180', 'DOP'),
('DZ', 'Algeria', '213', 'DZD'),
('EC', 'Ecuador', '593', 'ECS'),
('EE', 'Estonia', '372', 'EEK'),
('EG', 'Egypt', '20', 'EGP'),
('EH', 'Western Sahara', '212', 'MAD'),
('ER', 'Eritrea', '291', 'ETB'),
('ES', 'Spain', '34', 'EUR'),
('ET', 'Ethiopia', '251', 'ETB'),
('FI', 'Finland', '358', 'EUR'),
('FJ', 'Fiji', '679', 'FJD'),
('FK', 'Falkland Islands (Malvinas)', '500', 'FKP'),
('FM', 'Micronesia, Federated States Of', '691', 'USD'),
('FO', 'Faroe Islands', '298', 'DKK'),
('FR', 'France', '33', 'EUR'),
('FX', 'France, Metropolitan', '591', 'BOB'),
('GA', 'Gabon', '241', 'XAF'),
('GB', 'United Kingdom', '44', 'GBP'),
('GD', 'Grenada', '147', 'XCD'),
('GE', 'Georgia', '995', 'GEL'),
('GF', 'French Guiana', '594', 'EUR'),
('GH', 'Ghana', '233', 'GHC'),
('GI', 'Gibraltar', '350', 'GIP'),
('GL', 'Greenland', '299', 'DKK'),
('GM', 'Gambia', '220', 'GMD'),
('GN', 'Guinea', '224', 'GNF'),
('GP', 'Guadeloupe', '590', 'EUR'),
('GQ', 'Equatorial Guinea', '240', 'XAF'),
('GR', 'Greece', '30', 'EUR'),
('GS', 'S. Georgia &amp; S. Sandwich Isls.', '591', 'GBP'),
('GT', 'Guatemala', '502', 'GTQ'),
('GU', 'Guam', '167', 'USD'),
('GW', 'Guinea-Bissau', '245', 'XOF'),
('GY', 'Guyana', '592', 'GYD'),
('HK', 'Hong Kong SAR, PRC', '852', 'HKD'),
('HM', 'Heard And Mc Donald Islands', '591', 'AUD'),
('HN', 'Honduras', '504', 'HNL'),
('HR', 'Croatia (Hrvatska)', '385', 'HRK'),
('HT', 'Haiti', '509', 'HTG'),
('HU', 'Hungary', '36', 'HUF'),
('ID', 'Indonesia', '62', 'IDR'),
('IE', 'Ireland', '353', 'EUR'),
('IL', 'Israel', '972', 'ILS'),
('IN', 'India', '91', 'INR'),
('IO', 'British Indian Ocean Territory', '246', 'USD'),
('IS', 'Iceland', '354', 'ISK'),
('IT', 'Italy', '39', 'EUR'),
('JM', 'Jamaica', '187', 'JMD'),
('JO', 'Jordan', '962', 'JOD'),
('JP', 'Japan', '81', 'JPY'),
('KE', 'Kenya', '254', 'KES'),
('KG', 'Kyrgyzstan', '996', 'KGS'),
('KH', 'Cambodia', '855', 'KHR'),
('KI', 'Kiribati', '686', 'AUD'),
('KM', 'Comoros', '269', 'KMF'),
('KN', 'Saint Kitts And Nevis', '186', 'XCD'),
('KR', 'Korea, Republic of', '82', 'KRW'),
('KW', 'Kuwait', '965', 'KWD'),
('KY', 'Cayman Islands', '134', 'KYD'),
('KZ', 'Kazakhstan', '7', 'KZT'),
('LA', 'Lao, People''s Dem. Rep.', '856', 'LAK'),
('LB', 'Lebanon', '961', 'LBP'),
('LC', 'Saint Lucia', '175', 'XCD'),
('LI', 'Liechtenstein', '41', 'CHF'),
('LK', 'Sri Lanka', '94', 'LKR'),
('LS', 'Lesotho', '266', 'LSL'),
('LT', 'Lithuania', '370', 'LTL'),
('LU', 'Luxembourg', '352', 'EUR'),
('LV', 'Latvia', '371', 'LVL'),
('LY', 'Libya', '218', 'LYD'),
('MA', 'Morocco', '212', 'MAD'),
('MC', 'Monaco', '377', 'EUR'),
('MD', 'Moldova, Republic Of', '373', 'MDL'),
('ME', 'Montenegro', '591', 'BOB'),
('MG', 'Madagascar', '261', 'MGF'),
('MH', 'Marshall Islands', '692', 'USD'),
('MK', 'Macedonia', '389', 'MKD'),
('ML', 'Mali', '223', 'XOF'),
('MN', 'Mongolia', '976', 'MNT'),
('MO', 'Macau', '853', 'MOP'),
('MP', 'Northern Mariana Islands', '167', 'USD'),
('MQ', 'Martinique', '596', 'EUR'),
('MR', 'Mauritania', '222', 'MRO'),
('MS', 'Montserrat', '166', 'XCD'),
('MT', 'Malta', '356', 'MTL'),
('MU', 'Mauritius', '230', 'MUR'),
('MV', 'Maldives', '960', 'MVR'),
('MW', 'Malawi', '265', 'MWK'),
('MX', 'Mexico', '52', 'MXP'),
('MY', 'Malaysia', '60', 'MYR'),
('MZ', 'Mozambique', '258', 'MZM'),
('NA', 'Namibia', '264', 'NAD'),
('NC', 'New Caledonia', '687', 'XPF'),
('NE', 'Niger', '227', 'XOF'),
('NF', 'Norfolk Island', '672', 'AUD'),
('NG', 'Nigeria', '234', 'NGN'),
('NI', 'Nicaragua', '505', 'NIO'),
('NL', 'Netherlands', '31', 'EUR'),
('NO', 'Norway', '47', 'NOK'),
('NP', 'Nepal', '977', 'NPR'),
('NR', 'Nauru', '674', 'AUD'),
('NU', 'Niue', '683', 'NZD'),
('NZ', 'New Zealand', '64', 'NZD'),
('OM', 'Oman', '968', 'OMR'),
('OT', 'Others', '591', 'BOB'),
('PA', 'Panama', '507', 'PAB'),
('PE', 'Peru', '51', 'PEN'),
('PF', 'French Polynesia', '689', 'XPF'),
('PG', 'Papua New Guinea', '675', 'PGK'),
('PH', 'Philippines', '63', 'PHP'),
('PK', 'Pakistan', '92', 'PKR'),
('PL', 'Poland', '48', 'PLZ'),
('PM', 'St. Pierre And Miquelon', '508', 'BOB'),
('PN', 'Pitcairn', '872', 'NZD'),
('PR', 'Puerto Rico', '1', 'USD'),
('PS', 'Palestine', '970', 'BOB'),
('PT', 'Portugal', '351', 'EUR'),
('PW', 'Palau', '680', 'USD'),
('PY', 'Paraguay', '595', 'PYG'),
('QA', 'Qatar', '974', 'QAR'),
('RE', 'Reunion', '262', 'EUR'),
('RO', 'Romania', '40', 'ROL'),
('RS', 'Serbia', '591', 'BOB'),
('RU', 'Russia', '7', 'RUR'),
('RW', 'Rwanda', '250', 'RWF'),
('SA', 'Saudi Arabia', '966', 'SAR'),
('SB', 'Solomon Islands', '677', 'SBD'),
('SC', 'Seychelles', '248', 'SCR'),
('SE', 'Sweden', '46', 'SEK'),
('SG', 'Singapore', '65', 'SGD'),
('SH', 'St. Helena', '290', 'BOB'),
('SI', 'Slovenia', '386', 'EUR'),
('SJ', 'Svalbard And Jan Mayen Islands', '79', 'NOK'),
('SK', 'Slovak Republic', '421', 'SKK'),
('SL', 'Sierra Leone', '232', 'SLL'),
('SM', 'San Marino', '378', 'EUR'),
('SN', 'Senegal', '221', 'XOF'),
('SO', 'Somalia', '252', 'SOS'),
('SR', 'Suriname', '597', 'SRG'),
('ST', 'Sao Tome And Principe', '239', 'STD'),
('SV', 'El Salvador', '503', 'SVC'),
('SZ', 'Swaziland', '268', 'SZL'),
('TC', 'Turks And Caicos Islands', '164', 'USD'),
('TD', 'Chad', '235', 'XAF'),
('TF', 'French Southern Territories', '591', 'EUR'),
('TG', 'Togo', '228', 'XOF'),
('TH', 'Thailand', '66', 'THB'),
('TJ', 'Tajikistan', '992', 'TJR'),
('TK', 'Tokelau', '690', 'NZD'),
('TM', 'Turkmenistan', '993', 'TMM'),
('TN', 'Tunisia', '216', 'TND'),
('TO', 'Tonga', '676', 'TOP'),
('TP', 'East Timor', '670', 'IDR'),
('TR', 'Turkey', '90', 'TRL'),
('TT', 'Trinidad And Tobago', '186', 'TTD'),
('TV', 'Tuvalu', '688', 'AUD'),
('TW', 'Taiwan', '886', 'TWD'),
('TZ', 'Tanzania, United Republic Of', '255', 'TZS'),
('UA', 'Ukraine', '380', 'UAH'),
('UG', 'Uganda', '256', 'UGX'),
('UM', 'United States Minor Outlying Islands', '808', 'USD'),
('US', 'United States', '1', 'USD'),
('UY', 'Uruguay', '598', 'UYU'),
('UZ', 'Uzbekistan', '998', 'UZS'),
('VA', 'Holy See (Vatican City State)', '379', 'EUR'),
('VC', 'Saint Vincent And the Grenadines', '178', 'XCD'),
('VE', 'Venezuela', '58', 'VEB'),
('VG', 'Virgin Islands (British)', '128', 'USD'),
('VI', 'Virgin Islands (US)', '134', 'USD'),
('VN', 'Vietnam', '84', 'VND'),
('VU', 'Vanuatu', '678', 'VUV'),
('WF', 'Wallis And Futuna Islands', '681', 'XPF'),
('WS', 'Samoa', '685', 'EUR'),
('YE', 'Yemen', '967', 'YER'),
('YT', 'Mayotte', '269', 'EUR'),
('ZA', 'South Africa', '27', 'ZAR'),
('ZM', 'Zambia', '260', 'ZMK');

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `short`, `name`) VALUES
(1, 'en', 'English'),
(2, 'es', 'Espa&ntilde;ol'),
(3, 'pt', 'Portugu&eacute;s');

--
-- Dumping data for table `language_iso`
--

INSERT INTO `language_iso` (`short`, `name`, `nameen`) VALUES
('aa', 'afar', 'afar'),
('ab', 'abjaso (o abjasiano)', 'Abkhazia (or Abkhazians)'),
('ae', 'av&eacute;stico', 'Avestan'),
('af', 'afrikaans', 'afrikaans'),
('ak', 'akano', 'Akano'),
('am', 'am&aacute;rico', 'Amharic'),
('an', 'aragon&eacute;s', 'Aragonese'),
('ar', '&aacute;rabe', 'Arabic'),
('as', 'asam&eacute;s', 'Assamese'),
('av', 'avar', 'avar'),
('ay', 'aimara', 'Aymara'),
('az', 'azer&iacute;', 'Azeri'),
('ba', 'baskir', 'Bashkir'),
('be', 'bielorruso', 'Belarus'),
('bg', 'b&uacute;lgaro', 'Bulgarian'),
('bh', 'bhojpur&iacute;', 'bhojpuri'),
('bi', 'bislama', 'bislama'),
('bm', 'bambara', 'bambara'),
('bn', 'bengal&iacute;', 'Bengali'),
('bo', 'tibetano', 'Tibetan'),
('br', 'bret&oacute;n', 'Breton'),
('bs', 'bosnio', 'Bosnian'),
('ca', 'catal&aacute;n', 'Catalan'),
('ce', 'checheno', 'Chechen'),
('ch', 'chamorro', 'chamorro'),
('co', 'corso', 'Corsican'),
('cr', 'cree', 'cree'),
('cs', 'checo', 'Czech'),
('cu', 'eslavo eclesi&aacute;stico antiguo', 'Old Church Slavonic'),
('cv', 'chuvasio', 'Chuvash'),
('cy', 'gal&eacute;s', 'Welsh'),
('da', 'dan&eacute;s', 'Danish'),
('de', 'alem&aacute;n', 'German'),
('dv', 'maldivo', 'Maldivian'),
('dz', 'dzongkha', 'dzongkha'),
('ee', 'ewe', 'ewe'),
('el', 'griego (moderno)', 'Greek (Modern)'),
('en', 'ingl&eacute;s', 'English'),
('eo', 'Esperanto', 'Esperanto'),
('es', 'Espa&ntilde;ol', 'Spanish'),
('et', 'Estonio', 'Estonian'),
('eu', 'Vascuence (o euskera)', 'Basque (or Euskera)'),
('fa', 'Persa', 'Persian'),
('ff', 'fula', 'Fula'),
('fi', 'fin&eacute;s (o finland&eacute;s)', 'Finnish (or Finnish)'),
('fj', 'fijiano (o fidji)', 'Fijians (or fidji)'),
('fo', 'fero&eacute;s', 'Faroese'),
('fr', 'franc&eacute;s', 'French'),
('fy', 'fris&oacute;n (o frisio)', 'Frisian (or Frisian)'),
('ga', 'irland&eacute;s (o ga&eacute;lico)', 'Irish (or Gaelic)'),
('gd', 'ga&eacute;lico escoc&eacute;s', 'Scottish Gaelic'),
('gl', 'gallego', 'Galician'),
('gn', 'guaran&iacute;', 'Guarani'),
('gu', 'guyarat&iacute; (o guyarat&iacute;)', 'Gujarat (or Gujarat)'),
('gv', 'man&eacute;s (ga&eacute;lico man&eacute;s o de Isla de Man)', 'Manx (Manx Gaelic or Manx)'),
('ha', 'hausa', 'hausa'),
('he', 'hebreo', 'Hebrew'),
('hi', 'hindi (o hind&uacute;)', 'Hindi (or Indian)'),
('ho', 'hiri motu', 'Hiri Motu'),
('hr', 'croata', 'Croatian'),
('ht', 'haitiano', 'Haitian'),
('hu', 'h&uacute;ngaro', 'Hungarian'),
('hy', 'armenio', 'Armenian'),
('hz', 'herero', 'herero'),
('ia', 'interlingua', 'interlingua'),
('id', 'indonesio', 'Indonesian'),
('ie', 'occidental', 'western'),
('ig', 'igbo', 'igbo'),
('ii', 'yi de Sichu&aacute;n', 'Sichuan Yi'),
('ik', 'inupiaq', 'inupiaq'),
('io', 'ido', 'gone'),
('is', 'island&eacute;s', 'Icelandic'),
('it', 'italiano', 'Italian'),
('iu', 'inuktitut', 'inuktitut'),
('ja', 'japon&eacute;s', 'Japanese'),
('jv', 'javan&eacute;s', 'Javanese'),
('ka', 'georgiano', 'Georgian'),
('kg', 'kongo', 'kongo'),
('ki', 'kikuyu', 'Kikuyu'),
('kj', 'kuanyama', 'kuanyama'),
('kk', 'kazajo (o kazajio)', 'Kazakh (or Kazakhstan)'),
('kl', 'groenland&eacute;s (o kalaallisut)', 'Greenlandic (Kalaallisut or)'),
('km', 'camboyano (o jemer)', 'Cambodian (or Khmer)'),
('kn', 'canar&eacute;s', 'Kannada'),
('ko', 'coreano', 'Korean'),
('kr', 'kanuri', 'kanuri'),
('ks', 'cachemiro', 'Kashmiri'),
('ku', 'kurdo', 'Kurdish'),
('kv', 'komi', 'komi'),
('kw', 'c&oacute;rnico', 'Cornish'),
('ky', 'kirgu&iacute;s', 'Kyrgyz'),
('la', 'lat&iacute;n', 'Latin'),
('lb', 'luxemburgu&eacute;s', 'Luxembourg'),
('lg', 'luganda', 'Luganda'),
('li', 'limburgu&eacute;s', 'Limburgs'),
('ln', 'lingala', 'lingala'),
('lo', 'lao', 'lao'),
('lt', 'lituano', 'Lithuanian'),
('lu', 'luba-katanga', 'Luba-Katanga'),
('lv', 'let&oacute;n', 'Latvian'),
('mg', 'malgache (o malagasy)', 'Malagasy (Malagasy or)'),
('mh', 'marshal&eacute;s', 'Marshallese'),
('mi', 'maor&iacute;', 'Maori'),
('mk', 'macedonio', 'Macedonian'),
('ml', 'malayalam', 'Malayalam'),
('mn', 'mongol', 'Mongolian'),
('mo', 'moldavo', 'Moldavian'),
('mr', 'marat&iacute;', 'Marathi'),
('ms', 'malayo', 'Malay'),
('mt', 'malt&eacute;s', 'Maltese'),
('my', 'birmano', 'Burmese'),
('na', 'nauruano', 'Nauruan'),
('nb', 'noruego bokmal', 'Norwegian Bokmal'),
('nd', 'ndebele del norte', 'North Ndebele'),
('ne', 'nepal&iacute;', 'Nepali'),
('ng', 'ndonga', 'ndonga'),
('nl', 'neerland&eacute;s (u holand&eacute;s)', 'Dutch (or Dutch)'),
('nn', 'nynorsk', 'Nynorsk'),
('no', 'noruego', 'Norwegian'),
('nr', 'ndebele del sur', 'South Ndebele'),
('nv', 'navajo', 'navajo'),
('ny', 'chichewa', 'Chichewa'),
('oc', 'occitano', 'Occitan'),
('oj', 'ojibwa', 'ojibwa'),
('om', 'oromo', 'Oromo'),
('or', 'oriya', 'oriya'),
('os', 'os&eacute;tico', 'Ossetian'),
('pa', 'panyab&iacute; (o penyabi)', 'Punjabi (or Punjabi)'),
('pi', 'pali', 'pali'),
('pl', 'polaco', 'Polish'),
('ps', 'past&uacute; (o pashto)', 'past&uacute; (or Pashto)'),
('pt', 'portugu&eacute;s', 'Portuguese'),
('qu', 'quechua', 'Quechua'),
('rm', 'retorrom&aacute;nico', 'Romansh'),
('rn', 'kirundi', 'Kirundi'),
('ro', 'rumano', 'Romanian'),
('ru', 'ruso', 'Russian'),
('rw', 'ruand&eacute;s', 'Rwanda'),
('sa', 's&aacute;nscrito', 'Sanskrit'),
('sc', 'sardo', 'Sardinian'),
('sd', 'sindhi', 'sindhi'),
('se', 'sami septentrional', 'northern Sami'),
('sg', 'sango', 'sango'),
('si', 'cingal&eacute;s', 'Singhalese'),
('sk', 'eslovaco', 'Slovak'),
('sl', 'esloveno', 'Slovenian'),
('sm', 'samoano', 'Samoan'),
('sn', 'shona', 'shona'),
('so', 'somal&iacute;', 'Somali'),
('sq', 'alban&eacute;s', 'Albanian'),
('sr', 'serbio', 'Serbian'),
('ss', 'suazi (swati o siSwati)', 'Swazi (Swati or siSwati)'),
('st', 'sesotho', 'Sesotho'),
('su', 'sundan&eacute;s', 'Sundanese'),
('sv', 'sueco', 'Swedish'),
('sw', 'suajili', 'Swahili'),
('ta', 'tamil', 'tamil'),
('te', 'telug&uacute;', 'Telugu'),
('tg', 'tayiko', 'Tajik'),
('th', 'tailand&eacute;s', 'Thai'),
('ti', 'tigri&ntilde;a', 'Tigrinya'),
('tk', 'turcomano', 'Turkmen'),
('tl', 'tagalo', 'Tagalog'),
('tn', 'setsuana', 'Tswana'),
('to', 'tongano', 'Tongan'),
('tr', 'turco', 'Turkish'),
('ts', 'tsonga', 'tsonga'),
('tt', 't&aacute;rtaro', 'tartar'),
('tw', 'twi', 'twi'),
('ty', 'tahitiano', 'Tahitian'),
('ug', 'uigur', 'Uigur'),
('uk', 'ucraniano', 'Ukrainian'),
('ur', 'urdu', 'urdu'),
('uz', 'uzbeko', 'Uzbek'),
('ve', 'venda', 'band'),
('vi', 'vietnamita', 'Vietnamese'),
('vo', 'volap&uuml;k', 'volap&uuml;k'),
('wa', 'val&oacute;n', 'Walloon'),
('wo', 'wolof', 'wolof'),
('xh', 'xhosa', 'xhosa'),
('yi', 'y&iacute;dish (o yiddish)', 'Yiddish (or Yiddish)'),
('yo', 'yoruba', 'yoruba'),
('za', 'chuan (o zhuang)', 'chuan (or Zhuang)'),
('zh', 'chino', 'Chinese'),
('zu', 'zul&uacute;', 'Zulu');

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_email`, `notification_email`) VALUES
(1, 'info@solicitaxi.com', 'farmatestuser1@solicitaxi.com');

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `uid`, `lat`, `lng`, `title`, `created`) VALUES
(1, 2,  -17.383037,-66.145357, 'Checkin Carlos Department', NOW());

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `code`, `uri`, `name`, `lat`, `lng`, `idcountry`) VALUES
(1, 'CB','cochabamba','Cochabamba',	-17.393603, -66.156946, 1),
(2, 'SC','santa-cruz','Santa Cruz', -17.783589, -63.182122, 1),
(3, 'LP','la-paz','La Paz', -16.495658, -68.133562, 1);

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `uid`, `lat`, `lng`, `address1`, `address2`, `state`, `zip`, `phone`, `extension`, `main`, `status`, `idcity`) VALUES
(1,  2,  '-17.393201','-66.162281','Avenida Heroinas #0666 Entre Tumusla y Falsuri', '', 'Cercado', '0666', '79733312', '', 1, 1, 1);




--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `uid`, `firstname`, `lastname`, `gender`, `document`, `typedoc`, `email`, `company`, `mobile`, `avatar`, `created`, `updated`, `idcountry`, `idcity`) VALUES
(1,  1,  'Admin', 'Admin', NULL, NULL, NULL, 'admin@solicitaxi.com', NULL, NULL, NULL, NOW(), NOW(), 1 , 1),
(2,  2,  'Marco','Galvez', NULL, '4918359', 'Carnet de Identidad', 'marco@solicitaxi.com', NULL, '79733312', NULL, NOW(), NOW(), 1 , 1),
(3,  3,  'Freddy','Maldonado', NULL, '564654', 'Carnet de Identidad', 'freddy@solicitaxi.com', NULL, '60737698', NULL, NOW(), NOW(), 1 , 1),
(4,  4,  'Ciudad','Jardin', NULL, NULL, NULL, 'taxi@solicitaxi.com', NULL, NULL, NULL, NOW(), NOW(), 1, 1),
(5, 5, 'Juan','Perez', NULL, '12313', 'Carnet De Identidad', 'test1@solicitaxi.com',  NULL, NULL, 'temp/user/person1.jpg', NOW(), NOW(), 1, 1);



INSERT INTO `taxi` (`id` ,`uid` ,`plate` ,`uri` ,`desc` ,`rating` ,`taxiphoto`, `taxicolor` ,`status`, `idcity` ,`lat` ,`lng` ,`created` ,`updated`, `number`) VALUES
(1 , '5', '2121-ABC', '2121-ABC', 'Taxi de Prueba', '5.0', 'temp/taxi/verde.jpg','verde', '0', '2', '-17.378826', '-66.160908', NOW() ,CURRENT_TIMESTAMP, '1');


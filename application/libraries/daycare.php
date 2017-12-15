<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: daycare.php
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 12/8/2014
 *
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class daycare
{
	public function __construct()
	{
		$ci = &get_instance();

		$ci->load->helper('cookie');
		$ci->load->helper('language');
		$ci->load->helper('url');
		//$ci->load->model('conf');
	}

	function paypal($item, $due, $invoice_id = "service")
	{
		$url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick';
		$business = $this->config->item('email', 'company');
		$lc = "US";
		$item_name = $item;
		$item_number = 'DayCare_' . $invoice_id;
		$amount = $due;
		$currency_code = $this->config->item('currency_abbr', 'company');
		$button_subtype = "services";
		$no_note = 0;
		$cn = "Add special remarks";
		$no_shipping = 2;
		$undefined_quantity = 1;
		$tax_rate = 0;
		//DO NOT EDIT BELOW HERE//
		$link = $url . '&business=' . $business . '&lc=' . $lc . '&item_name=' .
			$item_name . '&item_number=' .
			$item_number . '&amount=' . $amount . '&currency_code=' . $currency_code . '&button_subtype=' .
			$button_subtype . '&no_note=' . $no_note . '&cn=' . $cn . '&no_shipping=' . $no_shipping . '&undefined_quantity=' .
			$undefined_quantity . '&tax_rate=' . $tax_rate;
		return $link;

	}

	function pay_by_paypal($item = "", $due, $invoice_id = "service")
	{
		$ci = &get_instance();
		$url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick';
		$business = $ci->config->item('email', 'company');
		$lc = "US";
		$item_name = $item;
		$item_number = 'DayCare_' . $invoice_id;
		$amount = $due;
		$currency_code = $ci->config->item('currency', 'company');
		$button_subtype = "services";
		$no_note = 0;
		$cn = "Add special remarks";
		$no_shipping = 2;
		$undefined_quantity = 1;
		$tax_rate = 0;
		//DO NOT EDIT BELOW HERE//
		$link = $url . '&business=' . $business . '&lc=' . $lc . '&item_name=' .
			$item_name . '&item_number=' .
			$item_number . '&amount=' . $amount . '&currency_code=' . $currency_code . '&button_subtype=' .
			$button_subtype . '&no_note=' . $no_note . '&cn=' . $cn . '&no_shipping=' . $no_shipping . '&undefined_quantity=' .
			$undefined_quantity . '&tax_rate=' . $tax_rate;
		return $link;

	}

	function timezones()
	{
		$timezones = array(
			'Pacific/Midway' => "(GMT-11:00) Midway Island",
			'US/Samoa' => "(GMT-11:00) Samoa",
			'US/Hawaii' => "(GMT-10:00) Hawaii",
			'US/Alaska' => "(GMT-09:00) Alaska",
			'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
			'America/Tijuana' => "(GMT-08:00) Tijuana",
			'US/Arizona' => "(GMT-07:00) Arizona",
			'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
			'America/Chihuahua' => "(GMT-07:00) Chihuahua",
			'America/Mazatlan' => "(GMT-07:00) Mazatlan",
			'America/Mexico_City' => "(GMT-06:00) Mexico City",
			'America/Monterrey' => "(GMT-06:00) Monterrey",
			'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
			'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
			'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
			'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
			'America/Bogota' => "(GMT-05:00) Bogota",
			'America/Lima' => "(GMT-05:00) Lima",
			'America/Caracas' => "(GMT-04:30) Caracas",
			'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
			'America/La_Paz' => "(GMT-04:00) La Paz",
			'America/Santiago' => "(GMT-04:00) Santiago",
			'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
			'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
			'Greenland' => "(GMT-03:00) Greenland",
			'Atlantic/Stanley' => "(GMT-02:00) Stanley",
			'Atlantic/Azores' => "(GMT-01:00) Azores",
			'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
			'Africa/Casablanca' => "(GMT) Casablanca",
			'Europe/Dublin' => "(GMT) Dublin",
			'Europe/Lisbon' => "(GMT) Lisbon",
			'Europe/London' => "(GMT) London",
			'Africa/Monrovia' => "(GMT) Monrovia",
			'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
			'Europe/Belgrade' => "(GMT+01:00) Belgrade",
			'Europe/Berlin' => "(GMT+01:00) Berlin",
			'Europe/Bratislava' => "(GMT+01:00) Bratislava",
			'Europe/Brussels' => "(GMT+01:00) Brussels",
			'Europe/Budapest' => "(GMT+01:00) Budapest",
			'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
			'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
			'Europe/Madrid' => "(GMT+01:00) Madrid",
			'Europe/Paris' => "(GMT+01:00) Paris",
			'Europe/Prague' => "(GMT+01:00) Prague",
			'Europe/Rome' => "(GMT+01:00) Rome",
			'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
			'Europe/Skopje' => "(GMT+01:00) Skopje",
			'Europe/Stockholm' => "(GMT+01:00) Stockholm",
			'Europe/Vienna' => "(GMT+01:00) Vienna",
			'Europe/Warsaw' => "(GMT+01:00) Warsaw",
			'Europe/Zagreb' => "(GMT+01:00) Zagreb",
			'Europe/Athens' => "(GMT+02:00) Athens",
			'Europe/Bucharest' => "(GMT+02:00) Bucharest",
			'Africa/Cairo' => "(GMT+02:00) Cairo",
			'Africa/Harare' => "(GMT+02:00) Harare",
			'Europe/Helsinki' => "(GMT+02:00) Helsinki",
			'Europe/Istanbul' => "(GMT+02:00) Istanbul",
			'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
			'Europe/Kiev' => "(GMT+02:00) Kyiv",
			'Europe/Minsk' => "(GMT+02:00) Minsk",
			'Europe/Riga' => "(GMT+02:00) Riga",
			'Europe/Sofia' => "(GMT+02:00) Sofia",
			'Europe/Tallinn' => "(GMT+02:00) Tallinn",
			'Europe/Vilnius' => "(GMT+02:00) Vilnius",
			'Asia/Baghdad' => "(GMT+03:00) Baghdad",
			'Asia/Kuwait' => "(GMT+03:00) Kuwait",
			'Africa/Nairobi' => "(GMT+03:00) Nairobi",
			'Asia/Riyadh' => "(GMT+03:00) Riyadh",
			'Asia/Tehran' => "(GMT+03:30) Tehran",
			'Europe/Moscow' => "(GMT+04:00) Moscow",
			'Asia/Baku' => "(GMT+04:00) Baku",
			'Europe/Volgograd' => "(GMT+04:00) Volgograd",
			'Asia/Muscat' => "(GMT+04:00) Muscat",
			'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
			'Asia/Yerevan' => "(GMT+04:00) Yerevan",
			'Asia/Kabul' => "(GMT+04:30) Kabul",
			'Asia/Karachi' => "(GMT+05:00) Karachi",
			'Asia/Tashkent' => "(GMT+05:00) Tashkent",
			'Asia/Kolkata' => "(GMT+05:30) Kolkata",
			'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
			'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
			'Asia/Almaty' => "(GMT+06:00) Almaty",
			'Asia/Dhaka' => "(GMT+06:00) Dhaka",
			'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
			'Asia/Bangkok' => "(GMT+07:00) Bangkok",
			'Asia/Jakarta' => "(GMT+07:00) Jakarta",
			'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
			'Asia/Chongqing' => "(GMT+08:00) Chongqing",
			'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
			'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
			'Australia/Perth' => "(GMT+08:00) Perth",
			'Asia/Singapore' => "(GMT+08:00) Singapore",
			'Asia/Taipei' => "(GMT+08:00) Taipei",
			'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
			'Asia/Urumqi' => "(GMT+08:00) Urumqi",
			'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
			'Asia/Seoul' => "(GMT+09:00) Seoul",
			'Asia/Tokyo' => "(GMT+09:00) Tokyo",
			'Australia/Adelaide' => "(GMT+09:30) Adelaide",
			'Australia/Darwin' => "(GMT+09:30) Darwin",
			'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
			'Australia/Brisbane' => "(GMT+10:00) Brisbane",
			'Australia/Canberra' => "(GMT+10:00) Canberra",
			'Pacific/Guam' => "(GMT+10:00) Guam",
			'Australia/Hobart' => "(GMT+10:00) Hobart",
			'Australia/Melbourne' => "(GMT+10:00) Melbourne",
			'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
			'Australia/Sydney' => "(GMT+10:00) Sydney",
			'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
			'Asia/Magadan' => "(GMT+12:00) Magadan",
			'Pacific/Auckland' => "(GMT+12:00) Auckland",
			'Pacific/Fiji' => "(GMT+12:00) Fiji",
		);
		return $timezones;
	}

	function countries()
	{
		return array(
			'AF' => 'Afghanistan',
			'AL' => 'Albania',
			'DZ' => 'Algeria',
			'AS' => 'American Samoa',
			'AD' => 'Andorra',
			'AO' => 'Angola',
			'AI' => 'Anguilla',
			'AQ' => 'Antarctica',
			'AG' => 'Antigua And Barbuda',
			'AR' => 'Argentina',
			'AM' => 'Armenia',
			'AW' => 'Aruba',
			'AU' => 'Australia',
			'AT' => 'Austria',
			'AZ' => 'Azerbaijan',
			'BS' => 'Bahamas',
			'BH' => 'Bahrain',
			'BD' => 'Bangladesh',
			'BB' => 'Barbados',
			'BY' => 'Belarus',
			'BE' => 'Belgium',
			'BZ' => 'Belize',
			'BJ' => 'Benin',
			'BM' => 'Bermuda',
			'BT' => 'Bhutan',
			'BO' => 'Bolivia',
			'BA' => 'Bosnia And Herzegovina',
			'BW' => 'Botswana',
			'BV' => 'Bouvet Island',
			'BR' => 'Brazil',
			'IO' => 'British Indian Ocean Territory',
			'BN' => 'Brunei',
			'BG' => 'Bulgaria',
			'BF' => 'Burkina Faso',
			'BI' => 'Burundi',
			'KH' => 'Cambodia',
			'CM' => 'Cameroon',
			'CA' => 'Canada',
			'CV' => 'Cape Verde',
			'KY' => 'Cayman Islands',
			'CF' => 'Central African Republic',
			'TD' => 'Chad',
			'CL' => 'Chile',
			'CN' => 'China',
			'CX' => 'Christmas Island',
			'CC' => 'Cocos (Keeling) Islands',
			'CO' => 'Columbia',
			'KM' => 'Comoros',
			'CG' => 'Congo',
			'CK' => 'Cook Islands',
			'CR' => 'Costa Rica',
			'CI' => 'Cote D\'Ivorie (Ivory Coast)',
			'HR' => 'Croatia (Hrvatska)',
			'CU' => 'Cuba',
			'CY' => 'Cyprus',
			'CZ' => 'Czech Republic',
			'CD' => 'Democratic Republic Of Congo (Zaire)',
			'DK' => 'Denmark',
			'DJ' => 'Djibouti',
			'DM' => 'Dominica',
			'DO' => 'Dominican Republic',
			'TP' => 'East Timor',
			'EC' => 'Ecuador',
			'EG' => 'Egypt',
			'SV' => 'El Salvador',
			'GQ' => 'Equatorial Guinea',
			'ER' => 'Eritrea',
			'EE' => 'Estonia',
			'ET' => 'Ethiopia',
			'FK' => 'Falkland Islands (Malvinas)',
			'FO' => 'Faroe Islands',
			'FJ' => 'Fiji',
			'FI' => 'Finland',
			'FR' => 'France',
			'FX' => 'France, Metropolitan',
			'GF' => 'French Guinea',
			'PF' => 'French Polynesia',
			'TF' => 'French Southern Territories',
			'GA' => 'Gabon',
			'GM' => 'Gambia',
			'GE' => 'Georgia',
			'DE' => 'Germany',
			'GH' => 'Ghana',
			'GI' => 'Gibraltar',
			'GR' => 'Greece',
			'GL' => 'Greenland',
			'GD' => 'Grenada',
			'GP' => 'Guadeloupe',
			'GU' => 'Guam',
			'GT' => 'Guatemala',
			'GN' => 'Guinea',
			'GW' => 'Guinea-Bissau',
			'GY' => 'Guyana',
			'HT' => 'Haiti',
			'HM' => 'Heard And McDonald Islands',
			'HN' => 'Honduras',
			'HK' => 'Hong Kong',
			'HU' => 'Hungary',
			'IS' => 'Iceland',
			'IN' => 'India',
			'ID' => 'Indonesia',
			'IR' => 'Iran',
			'IQ' => 'Iraq',
			'IE' => 'Ireland',
			'IL' => 'Israel',
			'IT' => 'Italy',
			'JM' => 'Jamaica',
			'JP' => 'Japan',
			'JO' => 'Jordan',
			'KZ' => 'Kazakhstan',
			'KE' => 'Kenya',
			'KI' => 'Kiribati',
			'KW' => 'Kuwait',
			'KG' => 'Kyrgyzstan',
			'LA' => 'Laos',
			'LV' => 'Latvia',
			'LB' => 'Lebanon',
			'LS' => 'Lesotho',
			'LR' => 'Liberia',
			'LY' => 'Libya',
			'LI' => 'Liechtenstein',
			'LT' => 'Lithuania',
			'LU' => 'Luxembourg',
			'MO' => 'Macau',
			'MK' => 'Macedonia',
			'MG' => 'Madagascar',
			'MW' => 'Malawi',
			'MY' => 'Malaysia',
			'MV' => 'Maldives',
			'ML' => 'Mali',
			'MT' => 'Malta',
			'MH' => 'Marshall Islands',
			'MQ' => 'Martinique',
			'MR' => 'Mauritania',
			'MU' => 'Mauritius',
			'YT' => 'Mayotte',
			'MX' => 'Mexico',
			'FM' => 'Micronesia',
			'MD' => 'Moldova',
			'MC' => 'Monaco',
			'MN' => 'Mongolia',
			'MS' => 'Montserrat',
			'MA' => 'Morocco',
			'MZ' => 'Mozambique',
			'MM' => 'Myanmar (Burma)',
			'NA' => 'Namibia',
			'NR' => 'Nauru',
			'NP' => 'Nepal',
			'NL' => 'Netherlands',
			'AN' => 'Netherlands Antilles',
			'NC' => 'New Caledonia',
			'NZ' => 'New Zealand',
			'NI' => 'Nicaragua',
			'NE' => 'Niger',
			'NG' => 'Nigeria',
			'NU' => 'Niue',
			'NF' => 'Norfolk Island',
			'KP' => 'North Korea',
			'MP' => 'Northern Mariana Islands',
			'NO' => 'Norway',
			'OM' => 'Oman',
			'PK' => 'Pakistan',
			'PW' => 'Palau',
			'PA' => 'Panama',
			'PG' => 'Papua New Guinea',
			'PY' => 'Paraguay',
			'PE' => 'Peru',
			'PH' => 'Philippines',
			'PN' => 'Pitcairn',
			'PL' => 'Poland',
			'PT' => 'Portugal',
			'PR' => 'Puerto Rico',
			'QA' => 'Qatar',
			'RE' => 'Reunion',
			'RO' => 'Romania',
			'RU' => 'Russia',
			'RW' => 'Rwanda',
			'SH' => 'Saint Helena',
			'KN' => 'Saint Kitts And Nevis',
			'LC' => 'Saint Lucia',
			'PM' => 'Saint Pierre And Miquelon',
			'VC' => 'Saint Vincent And The Grenadines',
			'SM' => 'San Marino',
			'ST' => 'Sao Tome And Principe',
			'SA' => 'Saudi Arabia',
			'SN' => 'Senegal',
			'SC' => 'Seychelles',
			'SL' => 'Sierra Leone',
			'SG' => 'Singapore',
			'SK' => 'Slovak Republic',
			'SI' => 'Slovenia',
			'SB' => 'Solomon Islands',
			'SO' => 'Somalia',
			'ZA' => 'South Africa',
			'GS' => 'South Georgia And South Sandwich Islands',
			'KR' => 'South Korea',
			'ES' => 'Spain',
			'LK' => 'Sri Lanka',
			'SD' => 'Sudan',
			'SR' => 'Suriname',
			'SJ' => 'Svalbard And Jan Mayen',
			'SZ' => 'Swaziland',
			'SE' => 'Sweden',
			'CH' => 'Switzerland',
			'SY' => 'Syria',
			'TW' => 'Taiwan',
			'TJ' => 'Tajikistan',
			'TZ' => 'Tanzania',
			'TH' => 'Thailand',
			'TG' => 'Togo',
			'TK' => 'Tokelau',
			'TO' => 'Tonga',
			'TT' => 'Trinidad And Tobago',
			'TN' => 'Tunisia',
			'TR' => 'Turkey',
			'TM' => 'Turkmenistan',
			'TC' => 'Turks And Caicos Islands',
			'TV' => 'Tuvalu',
			'UG' => 'Uganda',
			'UA' => 'Ukraine',
			'AE' => 'United Arab Emirates',
			'UK' => 'United Kingdom',
			'US' => 'United States',
			'UM' => 'United States Minor Outlying Islands',
			'UY' => 'Uruguay',
			'UZ' => 'Uzbekistan',
			'VU' => 'Vanuatu',
			'VA' => 'Vatican City (Holy See)',
			'VE' => 'Venezuela',
			'VN' => 'Vietnam',
			'VG' => 'Virgin Islands (British)',
			'VI' => 'Virgin Islands (US)',
			'WF' => 'Wallis And Futuna Islands',
			'EH' => 'Western Sahara',
			'WS' => 'Western Samoa',
			'YE' => 'Yemen',
			'YU' => 'Yugoslavia',
			'ZM' => 'Zambia',
			'ZW' => 'Zimbabwe'
		);
	}


}

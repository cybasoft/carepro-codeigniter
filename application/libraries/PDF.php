<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH. 'third_party/dompdf/lib/html5lib/Parser.php';
require_once APPPATH. 'third_party/dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once APPPATH. 'third_party/dompdf/lib/php-svg-lib/src/autoload.php';
require_once APPPATH. 'third_party/dompdf/src/Autoloader.php';

Dompdf\Autoloader::register();

class PDF
{

}
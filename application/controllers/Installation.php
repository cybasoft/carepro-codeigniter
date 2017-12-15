<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: installation
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/15/2014
 *
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class installation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //redirect session
        $this->conf->setRedirect();

        //local variables
        $this->module = '';
    }
	function index(){

	}

	function registerCompany($company){

		$path = 'c/'.$company;

		if (!file_exists($path)) {
			echo $path;
			mkdir($path, 0755, true);
		}

		$this->unzipFiles($path);

	}

	function unzipFiles($path){
		$file = 'c/daycare.zip';

		$zip = new ZipArchive;
		$res = $zip->open($file);
		if ($res === TRUE) {
			// extract it to the path we determined above
			$zip->extractTo($path);
			$zip->close();
			echo "WOOT! $file extracted to $path";
		} else {
			echo "Doh! I couldn't open $file";
		}
	}

	function randCompanyID(){
		$num1= rand(1000,9999);
		$num2 = rand(1000,9999);
		$num3 = rand(10,99);
		return $num1.''.$num2.''.$num3;
	}

	function writeDbFile(){
		$file = '../../application/config/database.php';
		$file_sample = '../../application/config/database-sample.php';

		copy($file_sample, $file);

		$host = $_POST['host'];
		$user = $_POST['user'];
		$pass = $_POST['password'];
		$db_name = $_POST['database'];

		$data = array(
			'/***********EDIT THIS****************/',
			'$db[\'default\'][\'hostname\'] = \''.$host.'\';',
			'$db[\'default\'][\'username\'] = \''.$user.'\';',
			'$db[\'default\'][\'password\'] = \''.$pass.'\';',
			'$db[\'default\'][\'database\'] = \''.$db_name.'\';',
			'/************************************/',
		);
		$a = explode("\r\n", file_get_contents($file));
		array_splice($a, 1, 0, $data);
		$a = implode("\r\n", $a);

		if(file_put_contents($file, $a))
			return true;
		return false;
	}

	function installDb(){
		ini_set('memory_limit', '5120M');
		set_time_limit ( 0 );

		$dbms_schema = '../bin/sql_daycare.sql';

		$host = $_POST['host'];
		$user = $_POST['user'];
		$pass = $_POST['password'];
		$db = $_POST['database'];

		if(!file_exists($dbms_schema))
			$errors['db_file']='Database schema file does not exist';

		$sql_query = @fread(@fopen($dbms_schema, 'r'), @filesize($dbms_schema)) or die('problem ');
		$sql_query = $this->remove_remarks($sql_query);
		$sql_query = $this->split_sql_file($sql_query, ';');

		$errors = array();    // array to hold validation errors
		$data = array();        // array to pass back data

		if (empty($host))
			$errors['host'] = 'Host is required.';

		if (empty($user))
			$errors['user'] = 'User is required.';

		if (empty($db))
			$errors['database'] = 'Database required.';

		if (empty($pass))
			$errors['password'] = 'Password required.';

		$mysqli = new mysqli($host, $user, $pass, $db);
		//$mysqli = new mysqli('localhost', 'root','mysql','sql_test');
		if (mysqli_connect_errno())
			$erros['db_error']= mysqli_connect_error();

		foreach ($sql_query as $sql) {
			if($mysqli->query($sql)){
				$data['success'] = true;
			}else{
				$data['success'] =false;
				$error['db_error'] = 'Error updating database';
			}
		}
		//final checks
		if (!empty($errors)) {
			$data['success'] = false;
			$data['errors'] = $errors;
		}else {
			$data['success'] = true;
			$data['message'] = 'Connected!';
		}
	}

	function remove_remarks($sql)
	{
		$lines = explode("\n", $sql);

		// try to keep mem. use down
		$sql = "";

		$linecount = count($lines);
		$output = "";

		for ($i = 0; $i < $linecount; $i++)
		{
			if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0))
			{
				if (isset($lines[$i][0]) && $lines[$i][0] != "#")
				{
					$output .= $lines[$i] . "\n";
				}
				else
				{
					$output .= "\n";
				}
				// Trading a bit of speed for lower mem. use here.
				$lines[$i] = "";
			}
		}

		return $output;

	}

	function split_sql_file($sql, $delimiter)
	{
		// Split up our string into "possible" SQL statements.
		$tokens = explode($delimiter, $sql);

		// try to save mem.
		$sql = "";
		$output = array();

		// we don't actually care about the matches preg gives us.
		$matches = array();

		// this is faster than calling count($oktens) every time thru the loop.
		$token_count = count($tokens);
		for ($i = 0; $i < $token_count; $i++)
		{
			// Don't wanna add an empty string as the last thing in the array.
			if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
			{
				// This is the total number of single quotes in the token.
				$total_quotes = preg_match_all("/'/", $tokens[$i], $matches);
				// Counts single quotes that are preceded by an odd number of backslashes,
				// which means they're escaped quotes.
				$escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$i], $matches);

				$unescaped_quotes = $total_quotes - $escaped_quotes;

				// If the number of unescaped quotes is even, then the delimiter did NOT occur inside a string literal.
				if (($unescaped_quotes % 2) == 0)
				{
					// It's a complete sql statement.
					$output[] = $tokens[$i];
					// save memory.
					$tokens[$i] = "";
				}
				else
				{
					// incomplete sql statement. keep adding tokens until we have a complete one.
					// $temp will hold what we have so far.
					$temp = $tokens[$i] . $delimiter;
					// save memory..
					$tokens[$i] = "";

					// Do we have a complete statement yet?
					$complete_stmt = false;

					for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
					{
						// This is the total number of single quotes in the token.
						$total_quotes = preg_match_all("/'/", $tokens[$j], $matches);
						// Counts single quotes that are preceded by an odd number of backslashes,
						// which means they're escaped quotes.
						$escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $tokens[$j], $matches);

						$unescaped_quotes = $total_quotes - $escaped_quotes;

						if (($unescaped_quotes % 2) == 1)
						{
							// odd number of unescaped quotes. In combination with the previous incomplete
							// statement(s), we now have a complete statement. (2 odds always make an even)
							$output[] = $temp . $tokens[$j];

							// save memory.
							$tokens[$j] = "";
							$temp = "";

							// exit the loop.
							$complete_stmt = true;
							// make sure the outer loop continues at the right point.
							$i = $j;
						}
						else
						{
							// even number of unescaped quotes. We still don't have a complete statement.
							// (1 odd and 1 even always make an odd)
							$temp .= $tokens[$j] . $delimiter;
							// save memory.
							$tokens[$j] = "";
						}

					} // for..
				} // else
			}
		}

		return $output;
	}

	function remove_comments($output)
	{
		$lines = explode("\n", $output);
		$output = "";

		// try to keep mem. use down
		$linecount = count($lines);

		$in_comment = false;
		for($i = 0; $i < $linecount; $i++)
		{
			if( preg_match("/^\/\*/", preg_quote($lines[$i])) )
			{
				$in_comment = true;
			}

			if( !$in_comment )
			{
				$output .= $lines[$i] . "\n";
			}

			if( preg_match("/\*\/$/", preg_quote($lines[$i])) )
			{
				$in_comment = false;
			}
		}

		unset($lines);
		return $output;
	}


}
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: subscription
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 12/21/2014
 *
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class billing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

        //redirect session
		$this->conf->setRedirect();

        //authenticate
		$this->conf->authenticate();

		$this->load->model('My_billing', 'billing');

	}
	function test()
	{
		$this->conf->allow('admin,manager,staff');
		$this->conf->page('billing/test');
	}
	//todo send email confrmation
	//todo post from paypal
	//todo log events

	function updateMembership($type = null)
	{
		//J9VA3EQ9BYDMS - standard
		//5WG3WMPGT297Q - ultimate
		//AH8BKGP7JVZFA - pro
		if ($type ! ==null) {
			$thisType = "";

			switch ($type) {
				case "J9VA3EQ9BYDMS":
					$thisType = "standard";
					break;
				case "5WG3WMPGT297Q":
					$thisType = "ultimate";
					break;
				case "AH8BKGP7JVZFA":
					$thisType = "enterprise";
					break;
			}

			$data = array(
				'company' => $this->company->cid(),
				'member_type' => $thisType,
				'pay_method' => 'PayPal',
				'start_date' => time(),
				'status' => 1
			);
			if ($this->deactivateCurrent()) {//remove current subscription
				//update membership
				if ($this->db->insert('memberships', $data)) {
					//log event
					$event = 'Updated membereship to ' . $thisType . ' for ' . $this->company->cid();
					$this->notify($event);

					//$this->conf->msg('success',"Your membership has been upgraded to -{$thisType}");
					redirect('billing/success', 'refresh');
				}
			}

		}
	}

	function success()
	{
		$this->conf->page('billing/subscription_success');
	}
	function cancel()
	{
		$this->conf->page('billing/subscription_cancel');
	}

	/**
	 * @return bool
	 */
	function hasSubscription()
	{
		$this->db->where('company', $this->company->cid());
		$this->db->where('status', 1);
		if ($this->db->get('memberships')->num_rows() > 0)
			return true;
		return false;
	}

	/**
	 * @return bool
	 */
	function deactivateCurrent()
	{
		if ($this->hasSubscription() == true) {
			$data = array('status' => 0, 'end_date' => time());

			$this->db->where('company', $this->company->cid());
			$this->db->where('status', 1);
			if ($this->db->update('memberships', $data)) {
				//log event
				$this->notify('deactivated membership');
				return true;
			} else {
				return false;
			}
			/*if($this->db->delete('memberships')){
				return true;
			}else{
				return false;
			}*/
		}
		return true;
	}

	function mySubscriptions()
	{
		$data = array(
			'active_mems' => $this->billing->my_active_memberships(),
			'expired_mems' => $this->billing->my_expired_memberships()
		);
		$this->load->view('billing/my_subscriptions', $data);
	}

	/*Notify admin of changes*/
	function notify($event)
	{
		$this->load->model('My_cron', 'cron');
		$this->cron->notify($event);
		$this->conf->log($event);
	}
	function paypal()
	{
		// STEP 1: read POST data

		// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
		// Instead, read raw POST data from the input stream.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
		$req = 'cmd=_notify-validate';
		if (function_exists('get_magic_quotes_gpc')) {
			$get_magic_quotes_exists = true;
		}
		foreach ($myPost as $key => $value) {
			if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
				$value = urlencode(stripslashes($value));
			} else {
				$value = urlencode($value);
			}
			//$req .= "&$key=$value";
		}


		// STEP 2: POST IPN data back to PayPal to validate

		$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

		// In wamp-like environments that do not come bundled with root authority certificates,
		// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set
		// the directory path of the certificate as shown below:
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		if (! ($res = curl_exec($ch))) {
			// error_log("Got " . curl_error($ch) . " when processing IPN data");
			curl_close($ch);
			exit;
		}
		curl_close($ch);


		// STEP 3: Inspect IPN validation result and act accordingly

		if (strcmp($res, "VERIFIED") == 0) {
			// The IPN is verified, process it:
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process the notification

			// assign posted variables to local variables
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$payment_amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];

			// IPN message values depend upon the type of notification sent.
			// To loop through the &_POST array and print the NV pairs to the screen:

			$data = array(
				'company' => $this->company->cid(),
				'member_type' => $item_name . '//' . $payment_amount . '//' . $payer_email,
				'pay_method' => 'PayPal',
				'start_date' => time(),
				'status' => 1
			);
			$this->db->insert('memberships', $data);

			foreach ($_POST as $key => $value) {
				echo $key . " = " . $value . "<br>";
			}
		} else if (strcmp($res, "INVALID") == 0) {
			// IPN invalid, log for manual investigation
			echo "The response from IPN was: <b>" . $res . "</b>";
		}
	}
}
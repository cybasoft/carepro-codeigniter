<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_billing
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 12/21/2014
 *
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class my_billing extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    function all_active_memberships()
    {
        $this->db->where('status', 1);
        return $this->db->get('memberships');
    }

    /**
     * @return mixed
     */
    function all_expired_memberships()
    {
        $this->db->where('status', 0);
        return $this->db->get('memberships');
    }

    /**
     * @param null $cid
     * @return mixed
     */
    function my_active_memberships($cid = null)
    {
        if ($cid == null) {
            $this->db->where('company', $this->company->cid());
        } else {
            $this->db->where('company', $cid);
        }
        $this->db->where('status', 1);
        return $this->db->get('memberships');
    }

    /**
     * @param null $cid
     * @return mixed
     */
    function my_expired_memberships($cid = null)
    {
        if ($cid == null) {
            $this->db->where('company', $this->company->cid());
        } else {
            $this->db->where('company', $cid);
        }
        $this->db->where('status', 0);
        return $this->db->get('memberships');
    }
}
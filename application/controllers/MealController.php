<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
class MealController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        auth(true);
        $this->load->model('My_meal','meal');
    }

    function create(){
        allow(['admin','manager','staff']);
        $this->form_validation->set_rules('name', 'Meal name', 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->meal->insert()){
                flash('success',lang('Meal added'));
            }else{
                flash('error',lang('request_error'));
            }

        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev(null,'meal');
    }

    function delete(){
        allow(['admin','manager','staff']);
        $id = uri_segment(3);
        $meal_details = $this->db->get_where('meal_plan',array(
            'id' => $id
        ));
        $meal_plan = $meal_details->row();
        $this->db->where('id',$id)->delete('meal_plan');
        logEvent($user_id = NULL,"Meals plan ID: {$id} for room ID: {$meal_plan->room_id}");
        flash('success',lang('Meal deleted'));
        redirectPrev(null,'meal');
    }

    function copy(){
        allow(['admin','manager','staff']);
        $this->meal->copy();
        flash('success',lang('Meal plan copied to next week'));
        redirectPrev(null,'meal');
    }

    function clear(){
        allow(['admin', 'manager', 'staff']);
        $this->meal->clear();
        logEvent($user_id = NULL,"Meal plan has been cleared");
        flash('success',lang('Meal plan has been cleared'));
        redirectPrev(null,'meal');
    }
}

?>
<?php
/**
 * @package     daycarepro
 * @copyright   2017 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
$users[] = array(
    'username'=>'admin',
    'first_name'=>'Admin',
    'last_name'=>'Admin',
    'email'=>'admin@app.com',
    'password'=>password_hash('password',PASSWORD_DEFAULT),
    'active'=>1,
    'created_at'=>date_stamp()
);
foreach ($groups as $group){
    $this->db->insert('groups',array('name'=>$group->name,'description'=>$group->description));
}
?>
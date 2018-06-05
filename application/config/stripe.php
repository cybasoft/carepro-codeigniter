<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
$config['stripe'] = array(
    'pk_test' => 'pk_test_bAGMhgdVKjz3XvlYP8yFbdpl',
    'pk_live'=>'pk_live_lHxyksrk3oEU45plqAgK2P3O',
    'sk_test' => 'sk_test_evCRES3sBkgApNglELrk37dr',
    'sk_live'=>'sk_live_VhTmJaKUVh8wj4qrX3yTzGJ1',
    'plans'=>array(
        'monthly'=>array(
            'price'=>70,
            'trial'=>0
        ),
        'yearly'=>array(
            'price'=>700,
            'trial'=>0
        )
    ),
    'currency'=>'usd'
);
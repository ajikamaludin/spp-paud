<?php
if(!function_exists('set_active')){
    function set_active($url, $output = 'active'){
        if(is_array($url)){
            foreach($url as $u){
                if(Route::is($u)){
                    return $output;
                }
            }
        }else{
            if(Route::is($url)){
                return $output;
            }
        }
    }
}
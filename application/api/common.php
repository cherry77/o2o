<?php
function return_value($status,$msg = '',$data = []){
    return [
        'status' => intval($status),
        'msg' => $msg,
        'data' => $data
    ];
}
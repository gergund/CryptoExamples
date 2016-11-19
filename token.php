<?php
/**
 * Created by PhpStorm.
 * User: denys
 * Date: 18.09.16
 * Time: 15:40
 */

//client
$token_type = 'auth';
$token_algo = 'sha512';
$uid = 1234567890;
$token_key = 'secret';

$hash = hash_hmac($token_algo,$uid,$token_key);
$msg_out = base64_encode(implode(array($token_type,':',$token_algo,':',$uid,':',$hash)));
printf("MSG CLIENT: %s \n", $msg_out);
$msg_in = explode(':',base64_decode($msg_out),4);

#var_dump($msg_in);

//server
$token_type_in = $msg_in[0];
$token_algo_in = $msg_in[1];
$uid_in = $msg_in[2];
$token_in = $msg_in[3];
$token = hash_hmac($token_algo_in,$uid_in,$token_key);

//printf("token_in: %s \ntoken:    %s\n",$token_in,$token);

if($token === $token_in){
    printf("Message validation: OK\n");
}
$msg = base64_encode(implode(array($token_type_in,':',$token_algo_in,':',$uid_in,':',$token_in)));
printf("MSG SERVER: %s \n", $msg);
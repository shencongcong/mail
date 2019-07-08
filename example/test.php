<?php
/**
 * Created by PhpStorm.
 * User: danielshen
 * Date: 2019/7/8
 * Time: 16:56
 */
require(dirname(__DIR__) . '/vendor/autoload.php');

$config = [
    'smtp_host'	=>	'smtp.exmail.qq.com',
    'smtp_port'	=>	587,
    'smtp_user'	=>	'info@123u.com',
    'smtp_pass'	=>	'ifwMORa9',
    'smtp_name'	=>	'smtp',
    'html'		=>	true,
];


$mail = new Shencongcong\Mail\Mail($config);

$mail->send('danielshen@123u.com','测试','邮件扩展包测试');


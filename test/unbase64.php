<?php

$b = 'JUUxJTg0JTkxJUUxJTg1JUExJUUxJTg0JThCJUUxJTg1JUI1JUUxJTg2JUFGKyVFMSU4NCU4QiVFMSU4NSVCNSVFMSU4NCU4NSVFMSU4NSVCMyVFMSU4NiVCNyVFMSU4NCU4QiVFMSU4NSVCNSslRTElODQlOEIlRTElODUlQjUlRTElODQlODAlRTElODUlQTUlRTElODYlQkErX3xfMA==';
echo $b . '<hr>';
$s = base64_decode($b);
echo $s . '<hr>';
echo urldecode($s);

<?php
//Attribution: found out how to build this file from https://www.youtube.com/watch?v=lnCcd-L250E

use Aws\S3\S3Client;
require 'awsSdk\aws-autoloader.php';
$config = require('frontend/php-inc/config.php');

$s3 = S3Client::factory([
    'key' => $config['s3']['key'],
    'secret' => $config['s3']['secret'],
    'region' => 'us-west-2',
    'version' => '2006-03-01',
    'credentials' => new Aws\Credentials\Credentials($config['s3']['key'], $config['s3']['secret'])
]);
?>
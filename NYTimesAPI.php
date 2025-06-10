<?php

$key = 'yzFAiL1uq5bJze9tBWcd4n7JrctGgQCQ';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.nytimes.com/svc/mostpopular/v2/viewed/7.json?api-key='.$key);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

echo $result;

?>
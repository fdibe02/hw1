<?php

$key = 'S5kgE9gNeRiNpjebnTjSF3bNG2QqvsjHyq89L-frQno';
$title_text = urlencode($_GET['title']);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.unsplash.com/photos/random?query='.$title_text.'&orientation=landscape&client_id='.$key);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

echo $result;

?>
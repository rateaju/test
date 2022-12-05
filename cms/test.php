<?php
$hash = password_hash('secret', PASSWORD_DEFAULT, array('cost'=>10));
echo $hash.'<br>'.'<br>';
$hash = "$2y$10\$Gijxx1MKggQOaIm5lIC5BuYyEb2Y/MqFwKaSINAqzcLqlipZ1CXby";
echo "{$hash}<br><br>";
echo password_verify('secret', $hash);
?>
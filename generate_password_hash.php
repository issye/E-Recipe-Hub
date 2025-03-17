
<?php
$password = 'ckitsupport@123'; // Replace with the desired password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo "Original Password: $password<br>";
echo "Hashed Password: $hashed_password<br>";
?>

/*  This file is to be used to generate hashed password
    to insert admin and it support into the database
*/
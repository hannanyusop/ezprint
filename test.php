<?php

$options = [
    'cost' => 12,
];

#admin
#bycript:$2y$12$ZFKsVh43.D3ywHIBFT51geNnwuEbiGsDAOofnpA1CZt8LJwo2VXxC
echo password_hash("secret", PASSWORD_BCRYPT, $options);
exit();
$hash = '$2y$12$ZFKsVh43.D3ywHIBFT51geNnwuEbiGsDAOofnpA1CZt8LJwo2VXxC';

if (password_verify('admin', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}

?>
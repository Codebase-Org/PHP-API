<?php

define('OPENSSL_CIPHERING', 'AES-128-CTR');
define('OPENSSL_OPTIONS', '0');
define('OPENSSL_ENCRYP_KEY', 'CodeBase4All');
define('OPENSSL_ENCRYPT_IV', '1234567891011121');
define('OPENSSL_IV_LENGTH', openssl_cipher_iv_length(OPENSSL_CIPHERING));
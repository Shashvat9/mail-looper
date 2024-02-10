<?php
    function generate_key_and_iv() {
        $key = openssl_random_pseudo_bytes(32); // 256-bit key
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
        return [$key, $iv];
    }

    function encrypt($plaintext, $key, $iv) {
        $ciphertext = openssl_encrypt($plaintext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        // Prepend IV for decryption
        return base64_encode($iv . $ciphertext);
    }

    function decrypt($ciphertext, $key) {
        $decoded = base64_decode($ciphertext);
        // Extract IV from the beginning of the ciphertext
        $iv_length = openssl_cipher_iv_length('AES-256-CBC');
        $iv = substr($decoded, 0, $iv_length);
        $ciphertext = substr($decoded, $iv_length);
        $plaintext = openssl_decrypt($ciphertext, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return $plaintext;
    }
//     list($key, $iv) = generate_key_and_iv();
    
//     $data="hithere";

//     $encdata=encrypt($data,$key, $iv);
//     echo $encdata;

//     echo "<br>";

//     echo decrypt($encdata,$key);
echo uniqid();
?>
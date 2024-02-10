<?php
    class Shift{
        function encrypt($plaintext, $key,$iv="") {
            $encryptedText = "";
            for ($i = 0; $i < strlen($plaintext); $i++) {
                $char = $plaintext[$i];
                $ascii = ord($char);
            
                // Handle uppercase letters
                if ($ascii >= 65 && $ascii <= 90) {
                    $shiftedAscii = ($ascii - 65 + $key) % 26 + 65;
                    $encryptedText .= chr($shiftedAscii);
                }
            
                // Handle lowercase letters
                else if ($ascii >= 97 && $ascii <= 122) {
                    $shiftedAscii = ($ascii - 97 + $key) % 26 + 97;
                    $encryptedText .= chr($shiftedAscii);
                }
            
                // Preserve non-alphabetical characters
                else {
                    $encryptedText .= $char;
                }
            }
            return $encryptedText;
        }

        function decrypt($plaintext, $key,$iv="") {
            $decryptedText = "";
            for ($i = 0; $i < strlen($plaintext); $i++) {
                $char = $plaintext[$i];
                $ascii = ord($char);
            
                // Handle uppercase letters
                if ($ascii >= 65 && $ascii <= 90) {
                    $shiftedAscii = ($ascii - 65 - $key + 26) % 26 + 65;
                    $decryptedText .= chr($shiftedAscii);
                }
            
                // Handle lowercase letters
                else if ($ascii >= 97 && $ascii <= 122) {
                    $shiftedAscii = ($ascii - 97 - $key + 26) % 26 + 97;
                    $decryptedText .= chr($shiftedAscii);
                }
            
                // Preserve non-alphabetical characters
                else {
                    $decryptedText .= $char;
                }
            }
        
            return $decryptedText;
        }
    }
    class AES{

        function replaceQuotesWithCommas($string) {
            $string = str_replace(["'", '"'], ",", $string);
            return $string;
        }
           
        function generate_key_and_iv() {
            $aes=new AES();
            $key = openssl_random_pseudo_bytes(32); // 256-bit key
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-256-CBC'));
            // echo "<br>key = ".$key." iv= ".$iv."<br>";
            // return [$key, $iv];
            return [$aes->replaceQuotesWithCommas($key), $aes->replaceQuotesWithCommas($iv)];
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
    }

    // class TwoFish{
    //     function generateUniqueKey($masterKey, $salt) {
    //         // You can adjust these parameters based on your security requirements
    //         $iterations = 10000;
    //         $keyLength = 32; // Adjust the key length as needed (e.g., 16, 24, or 32 bytes)
        
    //         // Generate a unique key using PBKDF2
    //         $key = hash_pbkdf2("sha256", $masterKey, $salt, $iterations, $keyLength, true);
        
    //         return $key;
    //     }

    //     function encrypt($data, $masterKey) {
    //         $twofish=new TwoFish();
    //         // Generate a unique salt or initialization vector for each encryption operation
    //         $salt = random_bytes(16); // 16 bytes for example, adjust as needed
        
    //         // Generate a unique key for encryption using the master key and salt
    //         $encryptionKey = $twofish->generateUniqueKey($masterKey, $salt);
        
    //         // Perform Twofish encryption
    //         $cipher = openssl_encrypt($data, 'twofish', $encryptionKey, OPENSSL_RAW_DATA, $salt);
        
    //         return ['cipher' => $cipher, 'salt' => $salt];
    //     }

    //     function decrypt($cipher, $masterKey, $salt) {
    //         $twofish=new TwoFish();

    //         // Generate a unique key for decryption using the master key and salt
    //         $decryptionKey = $twofish->generateUniqueKey($masterKey, $salt);
        
    //         // Perform Twofish decryption
    //         $decrypted = openssl_decrypt($cipher, 'twofish', $decryptionKey, OPENSSL_RAW_DATA, $salt);
        
    //         return $decrypted;
    //     }
    // }
?>
<?php
function scrypt( $string, $action = 'E') 
{
    $secret_key = "XoLQDFmBkyKj0fDFEUZCcQ6nExEbWiKr";
    $secret_iv = 'S5ibpaW8DFwj2EKnOI73bfIdoJEfcdpa';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'E' ) 
    {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }

    else if( $action == 'D' )
    {
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

?>
<?php
$ApiKey = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$Secret = "XXXXXXXXXX";

function XSIGNATURE($ApiKey, $Secret)
{
    $signature = hash("sha256", $ApiKey . $Secret . time());
    return $signature;
}

// Call the function and print the result
echo XSIGNATURE($ApiKey, $Secret);
?>

<?php
$Time 	= date('YmdHis');

$source = '/var/www/dmc/LOGS/hotelbedsrequestresponse.log';
$dest 	= '/var/www/dmc/LOGS/oldLogs/'.$Time.'-HotelBeds.log';
if(filesize($source) > 0){
    copy($source, $dest);
    file_put_contents($source, "");
}


?>
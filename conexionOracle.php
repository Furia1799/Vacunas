<?php

$conn = oci_connect('VACUNACION','12345','localhost/xe');

if(!$conn){
//echo 'connection error';
}
else{
//echo 'connection succesful';
}
?>
<?php 


$tmp_name = $_GET['file'];
$tmp_name = iconv('utf-8', 'windows-1251', $tmp_name);

if (file_exists($tmp_name)) {
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($tmp_name));
header('Content-Disposition: attachment; filename="' . $tmp_name . '";');

ob_clean();
flush();
readfile($tmp_name);
die;
} 

?>
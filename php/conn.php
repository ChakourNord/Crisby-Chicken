

<?php
$conn = oci_connect('C##BLACKSTAR', 'Mim922145', '10.133.203.182:1521/FREE.ORCL', 'AL32UTF8');
if (!$conn) {

  echo "bruder incorrect";
  $e = oci_error();
  trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}






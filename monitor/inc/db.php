<?php
function conexion() {
    include 'conect.php';
    $link = mysqli_connect($host, $user, $pass, $db_name);
    mysqli_set_charset($link, 'utf8');
    return $link;
}

function desconexion($link) {
    mysqli_close($link);
}
?>
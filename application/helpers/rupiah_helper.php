<?php


function rupiah_bulat($jml) {
    $int = number_format(ceil($jml), 0, '', '.');
    return $int;
}



?>
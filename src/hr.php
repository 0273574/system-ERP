<?php

if (isset($_POST['dodajclienta'])){
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];
    $dzial = $_POST['dzial'];
    $plik = fopen('dane.txt', "r+");
    $line = $wiek . ' ' . $dzial . '\n';
    fwrite($plik, $line . '\n');
}
if(isset($_POST['maxmin'])){
    $plik = fopen('dane.txt', "r");
    $wiektablica = [];
    if ($plik){
        while($linia = fgets($plik)!== false){
            $slowa = explode(' ', $linia);
            $wiektablica = $slowa[3];
        }
    }
    echo $wiektablica;
}
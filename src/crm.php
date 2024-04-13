<?php

if (isset($_POST['dodaj'])) {
    $plikZDanymi = fopen("plikZDanymi.txt", "a");
    $imie = $_POST['imie'];
    $email = $_POST['email'];
    $subStatus = $_POST['status'];
    $id = uniqid();
    $line = $id . ' ' . $imie . ' ' . $email . ' ' . $subStatus . "\n";
    fwrite($plikZDanymi, $line);
}
if (isset($_POST['wyswietl'])) {
    $plik = fopen("plikZDanymi.txt", "r");
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
            echo $line . "<br>";
        }
        fclose($plik);
    } else {
        echo "plik nie istnieje";
    }
}
if (isset($_POST["modyfikuj"])) {
    $plik = fopen("plikZDanymi.txt", "r+");
    $id = $_POST["id"];
    $imie = $_POST['imie'];
    $email = $_POST['email'];
    $subStatus = $_POST['status'];
    if ($plik) {
        $znaleziono = false;
        while (($linia = fgets($plik)) !== false) {
            $slowa = explode(' ', $linia);
            if ($slowa[0] === $id) {
                echo "Znaleziono klienta: $id\n";
                $linia =  $id . ' ' . $imie . ' ' . $email . ' ' . $subStatus . "\n";
                fseek($plik, -strlen($linia), SEEK_CUR);
                fwrite($plik, $linia);
                fclose($plik);
                $znaleziono = true;
                echo "Dane zostały zmodyfikowane<br>";
                echo $linia;
                break;
            }
        }
        if (!$znaleziono) {
            echo "Nie znaleziono klienta o podanym ID";
        }
    } else {
        echo "Nie udało się otworzyć pliku";
    }
}


if(isset($_POST["usun"])) {
    $id = $_POST["idold"];
    $plik = fopen("plikZDanymi.txt", "r+");
    
    if ($plik !== false) {
        $plikTmp = tmpfile();
        while (($linia = fgets($plik)) !== false) {
            $slowa = explode(' ', $linia);
            if ($slowa[0] != $id) {
                fwrite($plikTmp, $linia);
            }
        }
        ftruncate($plik, 0);
        rewind($plikTmp);
        while (($linia = fgets($plikTmp)) !== false) {
            fwrite($plik, $linia);
        }
        fclose($plikTmp);
        fclose($plik);
        echo "Usunięto klienta o ID: $id";
    } else {
        echo "Błąd otwierania pliku.";
    }
}
if(isset($_POST["pobierz"])) {
    $plik = fopen("plikZDanymi.txt", "r+");
    $mails = fopen("mails.txt", "r+");
    $listaMailow = []; 

    if ($plik){
        while (($linia = fgets($plik)) !== false) {
            $slowa = explode(' ', $linia);
            $listaMailow[] = $slowa[2]; 
            fwrite($mails, $slowa[2] . "\n");
        }
    }
    echo "<br>Lista maili:<br>";
    foreach ($listaMailow as $email) {
        echo $email . "<br>";
    }
}



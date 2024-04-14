<?php

if (isset($_POST['dodajclienta'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];
    $dzial = $_POST['dzial'];
    $urodzenie = $_POST['urodzenie'];
    $plik = fopen('dane.txt', "a+");
    $line = $imie . ' ' . $urodzenie . ' ' . $wiek . ' ' . $nazwisko . ' ' . $dzial;
    fwrite($plik, $line . "\n");
    echo "Pomyślnie dodano klienta do listy o danych : " . $line;
}
if (isset($_POST['usunclienta'])) {
    $id = $_POST["wiek"];
    $plik = fopen("dane.txt", "r+");

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
        echo "Usunięto klienta pomyślnie";
    } else {
        echo "Błąd otwierania pliku.";
    }
}
if (isset($_POST["pokazliste"])) {
    $plik = fopen('dane.txt', "r");
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
            echo $line . "<br>";
        }
        fclose($plik);
    } else {
        echo "plik nie istnieje";
    }
}
if (isset($_POST['maxmin'])) {
    $plik = fopen('dane.txt', "r");
    $wiektablica = [];
    if ($plik) {
        while (!feof($plik)) {
            $line = fgets($plik);
            $line = trim($line);
            $slowa = explode(' ', $line);
            if (!empty($slowa[0])) {
                $wiektablica[] = intval($slowa[0]);
            }
        }
        fclose($plik);

        if (!empty($wiektablica)) {
            $min = min($wiektablica);
            $max = max($wiektablica);

            echo "Najstarszy pracownik ma : " . $max . " lat";
            echo "<br>";
            echo "Najmłodszy pracownik ma : " . $min . " lat";
        } else {
            echo "Brak danych o pracownikach.";
        }
    } else {
        echo "Nie udało się otworzyć pliku.";
    }
}
if (isset($_POST['sredniwiek'])) {
    $plik = fopen('dane.txt', "r");
    $wiektablica = [];
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
            $line = trim($line);
            $slowa = explode(' ', $line);
            if (!empty($slowa[0])) {
                $wiektablica[] = intval($slowa[0]);
            }
        }
        fclose($plik);
    } else {
        echo "Nie udało się otworzyć pliku.";
    }
    $srednia = array_sum($wiektablica) / count($wiektablica);
    echo "Srednia wieku pracownikow : " . $srednia . " lat";
}








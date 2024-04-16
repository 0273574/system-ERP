<?php
//ten kod odnosi się tylko do sekcji sell
if (isset($_POST['dodaj2'])) {
    $nazwaTransakcji = $_POST['nazwa'];
    $cenaTransakcji = $_POST['cena'];
    $nazwaProduktu = $_POST['produkt'];
    $dataTransakcji = $_POST['data_transakcji'];
    $plik = fopen('transakcje.txt', "a+");
    $line = $nazwaTransakcji . ' ' . $cenaTransakcji . ' ' . $nazwaProduktu . ' ' . $dataTransakcji . "\n";
    fwrite($plik, $line);
    echo 'Produkt dodał dodany do listy transakcji';
    fclose($plik);
}
if (isset($_POST['wyswietl2'])) {
    $plik = fopen('transakcje.txt', 'r');
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
            echo $line . "<br>";
        }
        fclose($plik);
    } else {
        echo "plik nie istnieje";
    }
}
if (isset($_POST['modyfikuj2'])) {
    $plik = fopen("transakcje.txt", "r+");
    $nazwaTransakcji = $_POST['nazwa'];
    $cenaTransakcji = $_POST['cena'];
    $nazwaProduktu = $_POST['produkt'];
    $dataTransakcji = $_POST['data_transakcji'];
    if ($plik) {
        $znaleziono = false;
        while (($linia = fgets($plik)) !== false) {
            $slowa = explode(' ', $linia);
            if ($slowa[0] === $nazwaTransakcji) {
                echo "Znaleziono klienta: $id\n";
                $linia =  $nazwaTransakcji . ' ' . $cenaTransakcji . ' ' . $nazwaProduktu . ' ' . $dataTransakcji . "\n";
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
    fclose($plik);
}

if (isset($_POST['usun2'])) {
    fopen("transakcje.txt", "r+");
    $nazwaTransakcji = $_POST["nazwa"];
    $plik = fopen("transakcje.txt", "r+");

    if ($plik !== false) {
        $plikTmp = tmpfile();
        while (($linia = fgets($plik)) !== false) {
            $slowa = explode(' ', $linia);
            if ($slowa[0] != $nazwaTransakcji) {
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

if (isset($_POST['pobierz2'])) {
    $file = fopen("transakcje.txt", "r");
    $najwyzszaWartosc = PHP_INT_MIN;
    $produkt = "";
    while (!feof($file)) {
        $line = fgets($file);
        $slowa = explode(" ", $line);
        if (isset($slowa[1]) && is_numeric($slowa[1]) && $slowa[1] > $najwyzszaWartosc) {
            $najwyzszaWartosc = $slowa[1];
            $produkt = $slowa[0];
        }
    }
    fclose($file);
    echo "Najwyższa wartość to " . $najwyzszaWartosc . " dla produktu " . $produkt;
}

if (isset($_POST['pobierz3'])) {
    $sumaPrzychodow = array();
    $file = fopen("transakcje.txt", "r");
    while (!feof($file)) {
        $line = fgets($file);
        $elements = explode(" ", $line); 
        if (count($elements) === 4) {
            $produkt = $elements[2];
            $przychod = floatval($elements[1]);
            if (isset($sumaPrzychodow[$produkt])) {
                $sumaPrzychodow[$produkt] += $przychod;
            } else {
                $sumaPrzychodow[$produkt] = $przychod;
            }
        }
    }
    fclose($file);
    $maxPrzychodProdukt = "";
    $maxPrzychod = 0;
    foreach ($sumaPrzychodow as $produkt => $przychod) {
        if ($przychod > $maxPrzychod) {
            $maxPrzychod = $przychod;
            $maxPrzychodProdukt = $produkt;
        }
    }
    echo "Produkt przynoszący największe przychody ogółem to: $maxPrzychodProdukt, suma przychodów: $maxPrzychod";
}
if (isset($_POST['pobierz4'])) {
    $plik = fopen("transakcje.txt", "r");
    $dataPoczatkowa = strtotime($_POST['data1']);
    $dataKoncowa = strtotime($_POST['data2']); 
    $transakcje = array();
    while (!feof($plik)) {
        $linia = fgets($plik);
        $elementy = explode(" ", $linia);
        if (count($elementy) === 4) {
            $dataTransakcji = strtotime($elementy[3]);
            if ($dataTransakcji >= $dataPoczatkowa && $dataTransakcji <= $dataKoncowa) {
                $transakcje[] = $linia;
            }
        }
    }
    fclose($plik);
    echo "Transakcje między podanymi datami:<br>";
    foreach ($transakcje as $transakcja) {
        echo $transakcja . "<br>";
    }
}
if (isset($_POST['pobierz5'])) {
    $plik = fopen("transakcje.txt", "r");
    $dataPoczatkowa = strtotime($_POST['data3']);
    $dataKoncowa = strtotime($_POST['data4']); 
    $sumaPrzychodow = 0;
    while (!feof($plik)) {
        $linia = fgets($plik);
        $elementy = explode(" ", $linia);
        if (count($elementy) === 4) {
            $dataTransakcji = strtotime($elementy[3]);
            if ($dataTransakcji >= $dataPoczatkowa && $dataTransakcji <= $dataKoncowa) {
                $sumaPrzychodow += floatval($elementy[1]);
            }
        }
    }
    fclose($plik);
    echo "Suma przychodów z transakcji między podanymi datami: $sumaPrzychodow";
}

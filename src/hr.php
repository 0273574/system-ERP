<?php
// cały ten kod odnosi się tylko i wyłącznie do działu HR
if (isset($_POST['dodajclienta'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $wiek = $_POST['wiek'];
    $dzial = $_POST['dzial'];
    $urodzenie = $_POST['urodzenie'];
    $uprawnienia = $_POST['uprawnienia'];
    $plik = fopen('dane.txt', "a+");
    $line = $imie . ' ' . $urodzenie . ' ' . $wiek . ' ' . $nazwisko . ' ' . $dzial . ' ' . $uprawnienia;
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
            if (!empty($slowa[2])) {
                $wiektablica[] = intval($slowa[2]);
            }
        }
        fclose($plik);
    } else {
        echo "Nie udało się otworzyć pliku.";
    }
    $srednia = array_sum($wiektablica) / count($wiektablica);
    echo "Srednia wieku pracownikow : " . $srednia . " lat";
}


if(isset($_POST["uprawnienia"])) {
$plik = fopen("dane.txt","r");
$poziomUprawnien = $_POST["uprawnienia1"];
$licznik = 0;
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
            $line = trim($line);
            $slowa = explode(' ', $line);
            if ($slowa[5] == $poziomUprawnien && !empty($slowa[5])) {
                $licznik++;
            }
        }
        fclose($plik);
    } else {
        echo "Nie udało się otworzyć pliku.";
    }
    echo 'Liczba pracowników o podanym poziomie uprawnien : ' . $licznik;

}

if(isset($_POST['data'])) {
    $plik = fopen('dane.txt', 'r');
    if ($plik) {
        $data = strtotime($_POST['date']); 
        $data_plus_2_tygodnie = strtotime('+2 weeks', $data); 
        $znaleziono = false; 
        
        while (($line = fgets($plik)) !== false) {
            $elementy = explode(' ', $line);
            if (count($elementy) >= 2) { 
                $urodziny = strtotime($elementy[1]); 
                if ($urodziny >= $data && $urodziny <= $data_plus_2_tygodnie) {
                    echo "Osoba o nazwie " . $elementy[0] . " ma urodziny w ciągu najbliższych dwóch tygodni od daty " . date('Y-m-d', $data) . ".<br>";
                    $znaleziono = true;
                }
            } else {
                echo "Błąd: Nieprawidłowy format danych w pliku.<br>";
            }
        }
        if (!$znaleziono) {
            echo "Brak osób z urodzinami w ciągu najbliższych dwóch tygodni od daty " . date('Y-m-d', $data) . ".<br>";
        }
        fclose($plik);
    } else {
        echo "Błąd: Nie można otworzyć pliku dane.txt.<br>";
    }
}


if(isset($_POST["dzial"])) {
    $plik = fopen("dane.txt","r");
    $licznikiDzialow = array(); 
    if ($plik) {
        while (($line = fgets($plik)) !== false) {
            $line = trim($line);
            $slowa = explode(' ', $line);
            $dzial = $slowa[4];
            if (isset($licznikiDzialow[$dzial])) {
                $licznikiDzialow[$dzial]++;
            } else {
                $licznikiDzialow[$dzial] = 1;
            }
        }
        
        fclose($plik);
        foreach ($licznikiDzialow as $dzial => $licznik) {
            echo "W dziale " . $dzial . " jest " . $licznik . " pracowników<br>";
        }
    }
    echo "Wynik tablicy asocjacyjnej : <br>";
    echo json_encode($licznikiDzialow);
}

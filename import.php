<?php
/**
* usuń niewłaściwe znaki utf z plików
* zrób kopie tabel zdarzenie, uczestnicy, pojazdy w nowej bazie
* importuj dane z xml do nowej bazy danych
* zrób zrzut nowego roku do pliku
* wrzuć nowy rok na serwer do NOWEJ bazy
* usuń ze starej bazy rekordy które są w kolejnym roku (lokalnie i na serwerze)
* zaimportuj nowy rok do pełnej bazy
*/
$time_start = microtime(true);

function export($child)
{
    $row_array = array();

    $forbidden_keys = array('ZSZD_ID', 'NAWIERZCHNIA', 'STAN_NAWIERZCHNI', 'RODZAJ_DROGI', 'SYGNALIZACJA_SWIETLNA', 'OZNAKOWANIE_POZIOME', 'MIEJSCE', 'GEOMETRIA_DROGI', 'OBSZAR_ZABUDOWANY', 'CHARAKT_MIEJSCA', 'WARUNKI_ATMOSFERYCZNE', 'INFO_O_DRODZE', 'INNE_PRZYCZYNY', 'ID', 'USZKODZENIA_POZA_POJAZDAMI', 'SKRZYZOWANIE', 'PRZYCZYNY_KIEROWCY', 'ZSUC_ID', 'FIRMA_UBZ', 'INFO_DODATKOWE', 'JAZDA_BEZ', 'SUSW_TABK_TYPE', 'STAN_POJAZDU', 'POJAZD', 'INNE_CECHY_POJAZU', 'PRZYCZYNY_PIESZY', 'NADZOR', 'DZIELNICA', 'KOD_GUS', 'GPS_X_GUS', 'GPS_Y_GUS', 'LICZBA_PASOW', 'DATA_ZGLOSZENIA', 'DATA_PRZYJAZDU', 'ROK_PRODUKCJI', 'STREFA_RUCHU', 'POZIOM_ALKOHOLU', 'SPAK_KOD', 'DATA_OST_BAD_TECH', 'WYPOSAZENIE_DOD', 'RONDO_WEZEL', 'ODBLASKI');
    if ((!stristr($child->getName(), '_TABK_TYPE')) AND !(in_array($child->getName(), $forbidden_keys))) {
        if ($child != '') {
            $name = $child->getName();
            //echo $name.': '.$child.'<br>';
            //mysqli_query("UPDATE $table SET `$name`='".addslashes($child)."' WHERE id=$id) or die(mysql_error());
            $row_array[$name] = addslashes($child);
        }
    }
    foreach ($child->children() as $child) {
        $row_array = array_merge($row_array, export($child));
    }
    return $row_array;
}

function save_into_mysql($link, $insData, $table)
{
    $columns = implode(", ", array_keys($insData));
    $escaped_values = array_values($insData);
    $values = implode("', '", $escaped_values);
    $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
    //mysql_query("INSERT INTO zdarzenie_temp (`id`) VALUES ('$id')") or die(mysql_error());
    if (mysqli_query($link, $sql) === FALSE) {
        echo 'shit hit the fan';
        printf("Error: %s\n", mysqli_error($link));
        echo $sql . PHP_EOL;
        die();
    }
}

function load_db($name, $link)
{
    $time_start = microtime(true);
    $xml = simplexml_load_file($name);
    $rekordow = 0;
    echo 'Import bazy ' . $xml->getName() . ' z pliku ' . $name . PHP_EOL;
    foreach ($xml->ZDARZENIA->ZDARZENIE as $zdarzenie) {

        $id = $zdarzenie->ID;

        $accident_row = array('id' => $id);

        foreach ($zdarzenie->children() as $child) {
            if ($child->getName() != ('UCZESTNICY') AND ($child->getName() != 'POJAZDY') AND ($child->getName() != 'SZOS_TABK_TYPE') AND ($child->getName() != 'SZRD_TABK_TYPE')) {
                //var_dump($child->getName());
                $accident_row = array_merge($accident_row, export($child));
            }

        }
//        var_dump($accident_row);
        save_into_mysql($link, $accident_row, 'zdarzenie');

        foreach ($zdarzenie->POJAZDY->POJAZD as $pojazd) {
            //echo ('pojazd: ').$pojazd->ID .(' (').$pojazd->RODZAJ_POJAZDU.(')').$id.('<br>');
            $id_poj = $pojazd->ID;
            $vehicle_row = array(
                'id' => $id_poj,
                'zszd_id' => $id
            );
            foreach ($pojazd->children() as $child) {
                $vehicle_row = array_merge($vehicle_row, export($child));
            }
            save_into_mysql($link, $vehicle_row, 'pojazdy');
        }
//        var_dump($vehicle_row);

        foreach ($zdarzenie->UCZESTNICY->OSOBA as $osoba) {
            //echo ('osoba: ').$osoba->ID . ('<br>');
            $id_os = $osoba->ID;
            $person_row = array(
                'id' => $id_os,
                'zszd_id' => $id
            );
            foreach ($osoba->children() as $child) {
                $person_row = array_merge($person_row, export($child));
            }
            save_into_mysql($link, $person_row, 'uczestnicy');
        }
//        var_dump($person_row);
        $rekordow++;
        if ($rekordow % 5 === 0) echo '.';
        if ($rekordow % 500 === 0) echo ' ' . $rekordow . PHP_EOL;
    }
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    echo PHP_EOL . 'Importowano ' . $rekordow . ' rekordów z pliku ' . $name . ' w ' . $time . ' sekund.' . PHP_EOL;
    return $rekordow;
}

$link = mysqli_connect("127.0.0.1", "root", "very_secure89", "sewik_2022");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if (!mysqli_set_charset($link, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($link));
} else {
    printf("Current character set: %s\n", mysqli_character_set_name($link));
}
$total = 0;
$files = scandir('xml/');
foreach ($files as $file) {
    if ($file != '.' AND $file != '..') {
        echo 'xml/' . $file . PHP_EOL;
        $name = 'xml/' . $file;
        $total = $total + load_db($name, $link);
        echo $total . PHP_EOL;
    }
}

$time_end = microtime(true);
$time = $time_end - $time_start;
echo count($files) . ' plikow (' . $total . ' importowano w ' . $time . ' sekund)' . PHP_EOL;


SELECT szos.opis AS oswietlenie, zdarzenia
FROM (SELECT szos_kod, count(*) AS zdarzenia
      FROM zdarzenie
      WHERE miejscowosc = 'WARSZWA'
      GROUP BY SZOS_KOD) AS zdarzenie
         LEFT JOIN szos ON zdarzenie.szos_kod = szos.kod
ORDER BY zdarzenia DESC;


SELECT DISTINCT woj
FROM zdarzenie;


SELECT COUNT(*)
FROM zdarzenie
WHERE powiat = 'powiat warszawa'
  AND DATA_ZDARZ >= '2016-01-01'
  AND DATA_ZDARZ <= '2016-12-31';


SELECT YEAR(DATA_ZDARZ) AS rok, count(*) AS zdarzenia
FROM zdarzenie
GROUP BY rok;

SELECT r.rok, zdarzenia, zmarli, ciezko_ranni, lekko_ranni
FROM (SELECT YEAR(DATA_ZDARZ) AS rok, count(*) AS zdarzenia FROM zdarzenie GROUP BY rok) AS r
         LEFT JOIN (SELECT rok, count(*) AS zmarli
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC')) AS u
                             LEFT JOIN (SELECT id, YEAR(DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS zm ON r.rok = zm.rok
         LEFT JOIN (SELECT rok, count(*) AS ciezko_ranni
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RC') AS u
                             LEFT JOIN (SELECT id, YEAR(DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS rc ON r.rok = rc.rok
         LEFT JOIN (SELECT rok, count(*) AS lekko_ranni
                    FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RL') AS u
                             LEFT JOIN (SELECT id, YEAR(DATA_ZDARZ) AS rok FROM zdarzenie) AS z ON z.ID = u.ZSZD_ID
                    GROUP BY ROK) AS rl ON r.rok = rl.rok;


SELECT skar.opis AS rodzaj_pojazdu, wynik.ilosc AS pojazdy
FROM (
         skar
             INNER JOIN
             (SELECT pojazdy.rodzaj_pojazdu, COUNT(pojazdy.rodzaj_pojazdu) AS ilosc
              FROM pojazdy

              WHERE pojazdy.rodzaj_pojazdu IS NOT NULL
              GROUP BY pojazdy.rodzaj_pojazdu) AS wynik
             ON wynik.rodzaj_pojazdu = skar.kod)

UNION

SELECT 'Pieszy' AS opis, count(uczestnicy.ssru_kod) AS ilosc
FROM uczestnicy
WHERE ssru_kod = 'I'
GROUP BY ssru_kod

ORDER BY pojazdy DESC;


SELECT opis AS przyczyna_zdarzenia, ilosc
FROM spsz
         INNER JOIN (SELECT uczestnicy.spsz_kod AS przyczyna, COUNT(uczestnicy.spsz_kod) AS ilosc
                     FROM uczestnicy
                              INNER JOIN pojazdy ON pojazdy.id = uczestnicy.zspo_id
                     WHERE uczestnicy.spsz_kod IS NOT NULL
                     GROUP BY uczestnicy.spsz_kod) AS wynik ON wynik.przyczyna = spsz.kod
ORDER BY ilosc DESC;

SELECT sppi.opis AS opis, wynik AS ilosc
FROM (SELECT sppi_kod, count(sppi_kod) AS wynik
      FROM uczestnicy
      WHERE CHAR_LENGTH(sppi_kod) > 0
      GROUP BY sppi_kod) AS uczestnicy
         INNER JOIN sppi ON sppi.kod = uczestnicy.sppi_kod

ORDER BY ilosc DESC;


SELECT spip.opis AS inne_przyczyny, zdarzenia
FROM (SELECT spip_kod, COUNT(*) AS zdarzenia FROM zdarzenie GROUP BY spip_kod) AS z
         INNER JOIN spip ON spip.kod = z.spip_kod
ORDER BY zdarzenia DESC;


SELECT CONCAT_WS('. ', MONTH(DATA_ZDARZ), MONTHNAME(DATA_ZDARZ)) AS miesiac, COUNT(*) AS zdarzenia
FROM zdarzenie
GROUP BY miesiac
ORDER BY CAST(miesiac AS UNSIGNED) ASC;


SELECT CONCAT_WS('. ', DAYOFWEEK(DATA_ZDARZ), DAYNAME(DATA_ZDARZ)) AS dzien_tygodnia, COUNT(*) AS zdarzenia
FROM zdarzenie
GROUP BY dzien_tygodnia
ORDER BY CAST(dzien_tygodnia AS UNSIGNED) ASC;


UPDATE zdarzenie
SET powiat = 'POWIAT CIECHANOWSKI'
WHERE POWIAT = 'POWIAT  CIECHANOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT GRODZISKI'
WHERE POWIAT = 'POWIAT  GRODZISKI';
UPDATE zdarzenie
SET powiat = 'POWIAT GRÓJECKI'
WHERE POWIAT = 'POWIAT  GRÓJECKI';
UPDATE zdarzenie
SET powiat = 'POWIAT KOZIENICKI'
WHERE POWIAT = 'POWIAT  KOZIENICKI';
UPDATE zdarzenie
SET powiat = 'POWIAT LEGIONOWSKI'
WHERE POWIAT = 'POWIAT  LEGIONOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT ŁOSICKI'
WHERE POWIAT = 'POWIAT  ŁOSICKI';
UPDATE zdarzenie
SET powiat = 'POWIAT M . OSTROŁĘKA'
WHERE POWIAT = 'POWIAT  M . OSTROŁĘKA';
UPDATE zdarzenie
SET powiat = 'POWIAT M. PŁOCK'
WHERE POWIAT = 'POWIAT  M. PŁOCK';
UPDATE zdarzenie
SET powiat = 'POWIAT M. SIEDLCE'
WHERE POWIAT = 'POWIAT  M. SIEDLCE';
UPDATE zdarzenie
SET powiat = 'POWIAT M.ST. WARSZAWA'
WHERE POWIAT = 'POWIAT  M.ST. WARSZAWA';
UPDATE zdarzenie
SET powiat = 'POWIAT MAKOWSKI'
WHERE POWIAT = 'POWIAT  MAKOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT MŁAWSKI'
WHERE POWIAT = 'POWIAT  MŁAWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT NOWODWORSKI'
WHERE POWIAT = 'POWIAT  NOWODWORSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT OSTROŁĘCKI'
WHERE POWIAT = 'POWIAT  OSTROŁĘCKI';
UPDATE zdarzenie
SET powiat = 'POWIAT OSTROWSKI'
WHERE POWIAT = 'POWIAT  OSTROWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT OTWOCKI'
WHERE POWIAT = 'POWIAT  OTWOCKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PIASECZYŃSKI'
WHERE POWIAT = 'POWIAT  PIASECZYŃSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PŁOCKI'
WHERE POWIAT = 'POWIAT  PŁOCKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PŁOŃSKI'
WHERE POWIAT = 'POWIAT  PŁOŃSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PROSZOWICKI'
WHERE POWIAT = 'POWIAT  PROSZOWICKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PRUSZKOWSKI'
WHERE POWIAT = 'POWIAT  PRUSZKOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PRZASNYSKI'
WHERE POWIAT = 'POWIAT  PRZASNYSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PRZYSUSKI'
WHERE POWIAT = 'POWIAT  PRZYSUSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PUŁTUSKI'
WHERE POWIAT = 'POWIAT  PUŁTUSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SIEDLECKI'
WHERE POWIAT = 'POWIAT  SIEDLECKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SIERPECKI'
WHERE POWIAT = 'POWIAT  SIERPECKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SOCHACZEWSKI'
WHERE POWIAT = 'POWIAT  SOCHACZEWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SOKOŁOWSKI'
WHERE POWIAT = 'POWIAT  SOKOŁOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SUSKI'
WHERE POWIAT = 'POWIAT  SUSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SZYDŁOWIECKI'
WHERE POWIAT = 'POWIAT  SZYDŁOWIECKI';
UPDATE zdarzenie
SET powiat = 'POWIAT TARNOWSKI'
WHERE POWIAT = 'POWIAT  TARNOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT WARSZAWSKI ZACHODNI'
WHERE POWIAT = 'POWIAT WARSZAWSKI  ZACHODNI';
UPDATE zdarzenie
SET powiat = 'POWIAT WĘGROWSKI'
WHERE POWIAT = 'POWIAT  WĘGROWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT WOŁOMIŃSKI'
WHERE POWIAT = 'POWIAT  WOŁOMIŃSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT WYSZKOWSKI'
WHERE POWIAT = 'POWIAT  WYSZKOWSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT ZWOLEŃSKI'
WHERE POWIAT = 'POWIAT  ZWOLEŃSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT ŻUROMIŃSKI'
WHERE POWIAT = 'POWIAT  ŻUROMIŃSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT ŻYRARDOWSKI'
WHERE POWIAT = 'POWIAT  ŻYRARDOWSKI';


UPDATE zdarzenie
SET powiat = 'POWIAT OSTROŁĘKA'
WHERE powiat = 'POWIAT M . OSTROŁĘKA';
UPDATE zdarzenie
SET powiat = 'POWIAT BIAŁA PODLASKA'
WHERE powiat = 'POWIAT M. BIAŁA PODLASKA';
UPDATE zdarzenie
SET powiat = 'POWIAT BIAŁYSTOK'
WHERE powiat = 'POWIAT M. BIAŁYSTOK';
UPDATE zdarzenie
SET powiat = 'POWIAT BIELSKO-BIAŁA'
WHERE powiat = 'POWIAT M. BIELSKO-BIAŁA';
UPDATE zdarzenie
SET powiat = 'POWIAT BYDGOSZCZ'
WHERE powiat = 'POWIAT M. BYDGOSZCZ';
UPDATE zdarzenie
SET powiat = 'POWIAT BYTOM'
WHERE powiat = 'POWIAT M. BYTOM';
UPDATE zdarzenie
SET powiat = 'POWIAT CHEŁM'
WHERE powiat = 'POWIAT M. CHEŁM';
UPDATE zdarzenie
SET powiat = 'POWIAT CHORZÓW'
WHERE powiat = 'POWIAT M. CHORZÓW';
UPDATE zdarzenie
SET powiat = 'POWIAT CZĘSTOCHOWA'
WHERE powiat = 'POWIAT M. CZĘSTOCHOWA';
UPDATE zdarzenie
SET powiat = 'POWIAT DĄBROWA GÓRNICZA'
WHERE powiat = 'POWIAT M. DĄBROWA GÓRNICZA';
UPDATE zdarzenie
SET powiat = 'POWIAT ELBLĄG'
WHERE powiat = 'POWIAT M. ELBLĄG';
UPDATE zdarzenie
SET powiat = 'POWIAT GDAŃSK'
WHERE powiat = 'POWIAT M. GDAŃSK';
UPDATE zdarzenie
SET powiat = 'POWIAT GDYNIA'
WHERE powiat = 'POWIAT M. GDYNIA';
UPDATE zdarzenie
SET powiat = 'POWIAT GLIWICE'
WHERE powiat = 'POWIAT M. GLIWICE';
UPDATE zdarzenie
SET powiat = 'POWIAT GORZÓW WIELKOPOLSKI'
WHERE powiat = 'POWIAT M. GORZÓW WIELKOPOLSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT GRUDZIĄDZ'
WHERE powiat = 'POWIAT M. GRUDZIĄDZ';
UPDATE zdarzenie
SET powiat = 'POWIAT JASTRZĘBIE-ZDRÓJ'
WHERE powiat = 'POWIAT M. JASTRZĘBIE-ZDRÓJ';
UPDATE zdarzenie
SET powiat = 'POWIAT JAWORZNO'
WHERE powiat = 'POWIAT M. JAWORZNO';
UPDATE zdarzenie
SET powiat = 'POWIAT JELENIA GÓRA'
WHERE powiat = 'POWIAT M. JELENIA GÓRA';
UPDATE zdarzenie
SET powiat = 'POWIAT KALISZ'
WHERE powiat = 'POWIAT M. KALISZ';
UPDATE zdarzenie
SET powiat = 'POWIAT KATOWICE'
WHERE powiat = 'POWIAT M. KATOWICE';
UPDATE zdarzenie
SET powiat = 'POWIAT KIELCE'
WHERE powiat = 'POWIAT M. KIELCE';
UPDATE zdarzenie
SET powiat = 'POWIAT KONIN'
WHERE powiat = 'POWIAT M. KONIN';
UPDATE zdarzenie
SET powiat = 'POWIAT KOSZALIN'
WHERE powiat = 'POWIAT M. KOSZALIN';
UPDATE zdarzenie
SET powiat = 'POWIAT KRAKÓW'
WHERE powiat = 'POWIAT M. KRAKÓW';
UPDATE zdarzenie
SET powiat = 'POWIAT KROSNO'
WHERE powiat = 'POWIAT M. KROSNO';
UPDATE zdarzenie
SET powiat = 'POWIAT LEGNICA'
WHERE powiat = 'POWIAT M. LEGNICA';
UPDATE zdarzenie
SET powiat = 'POWIAT LESZNO'
WHERE powiat = 'POWIAT M. LESZNO';
UPDATE zdarzenie
SET powiat = 'POWIAT LUBLIN'
WHERE powiat = 'POWIAT M. LUBLIN';
UPDATE zdarzenie
SET powiat = 'POWIAT ŁOMŻA'
WHERE powiat = 'POWIAT M. ŁOMŻA';
UPDATE zdarzenie
SET powiat = 'POWIAT ŁÓDŹ'
WHERE powiat = 'POWIAT M. ŁÓDŹ';
UPDATE zdarzenie
SET powiat = 'POWIAT MYSŁOWICE'
WHERE powiat = 'POWIAT M. MYSŁOWICE';
UPDATE zdarzenie
SET powiat = 'POWIAT NOWY SĄCZ'
WHERE powiat = 'POWIAT M. NOWY SĄCZ';
UPDATE zdarzenie
SET powiat = 'POWIAT OLSZTYN'
WHERE powiat = 'POWIAT M. OLSZTYN';
UPDATE zdarzenie
SET powiat = 'POWIAT OPOLE'
WHERE powiat = 'POWIAT M. OPOLE';
UPDATE zdarzenie
SET powiat = 'POWIAT PIEKARY ŚLĄSKIE'
WHERE powiat = 'POWIAT M. PIEKARY ŚLĄSKIE';
UPDATE zdarzenie
SET powiat = 'POWIAT PIOTRKÓW TRYBUNALSKI'
WHERE powiat = 'POWIAT M. PIOTRKÓW TRYBUNALSKI';
UPDATE zdarzenie
SET powiat = 'POWIAT PŁOCK'
WHERE powiat = 'POWIAT M. PŁOCK';
UPDATE zdarzenie
SET powiat = 'POWIAT POZNAŃ'
WHERE powiat = 'POWIAT M. POZNAŃ';
UPDATE zdarzenie
SET powiat = 'POWIAT PRZEMYŚL'
WHERE powiat = 'POWIAT M. PRZEMYŚL';
UPDATE zdarzenie
SET powiat = 'POWIAT RADOM'
WHERE powiat = 'POWIAT M. RADOM';
UPDATE zdarzenie
SET powiat = 'POWIAT RUDA ŚLĄSKA'
WHERE powiat = 'POWIAT M. RUDA ŚLĄSKA';
UPDATE zdarzenie
SET powiat = 'POWIAT RYBNIK'
WHERE powiat = 'POWIAT M. RYBNIK';
UPDATE zdarzenie
SET powiat = 'POWIAT RZESZÓW'
WHERE powiat = 'POWIAT M. RZESZÓW';
UPDATE zdarzenie
SET powiat = 'POWIAT SIEDLCE'
WHERE powiat = 'POWIAT M. SIEDLCE';
UPDATE zdarzenie
SET powiat = 'POWIAT SIEMIANOWICE ŚLĄSKIE'
WHERE powiat = 'POWIAT M. SIEMIANOWICE ŚLĄSKIE';
UPDATE zdarzenie
SET powiat = 'POWIAT SKIERNIEWICE'
WHERE powiat = 'POWIAT M. SKIERNIEWICE';
UPDATE zdarzenie
SET powiat = 'POWIAT SŁUPSK'
WHERE powiat = 'POWIAT M. SŁUPSK';
UPDATE zdarzenie
SET powiat = 'POWIAT SOPOT'
WHERE powiat = 'POWIAT M. SOPOT';
UPDATE zdarzenie
SET powiat = 'POWIAT SOSNOWIEC'
WHERE powiat = 'POWIAT M. SOSNOWIEC';
UPDATE zdarzenie
SET powiat = 'POWIAT SUWAŁKI'
WHERE powiat = 'POWIAT M. SUWAŁKI';
UPDATE zdarzenie
SET powiat = 'POWIAT SZCZECIN'
WHERE powiat = 'POWIAT M. SZCZECIN';
UPDATE zdarzenie
SET powiat = 'POWIAT ŚWIĘTOCHŁOWICE'
WHERE powiat = 'POWIAT M. ŚWIĘTOCHŁOWICE';
UPDATE zdarzenie
SET powiat = 'POWIAT ŚWINOUJŚCIE'
WHERE powiat = 'POWIAT M. ŚWINOUJŚCIE';
UPDATE zdarzenie
SET powiat = 'POWIAT TARNOBRZEG'
WHERE powiat = 'POWIAT M. TARNOBRZEG';
UPDATE zdarzenie
SET powiat = 'POWIAT TARNÓW'
WHERE powiat = 'POWIAT M. TARNÓW';
UPDATE zdarzenie
SET powiat = 'POWIAT TORUŃ'
WHERE powiat = 'POWIAT M. TORUŃ';
UPDATE zdarzenie
SET powiat = 'POWIAT TYCHY'
WHERE powiat = 'POWIAT M. TYCHY';
UPDATE zdarzenie
SET powiat = 'POWIAT WAŁBRZYCH'
WHERE powiat = 'POWIAT M. WAŁBRZYCH';
UPDATE zdarzenie
SET powiat = 'POWIAT WŁOCŁAWEK'
WHERE powiat = 'POWIAT M. WŁOCŁAWEK';
UPDATE zdarzenie
SET powiat = 'POWIAT WROCŁAW'
WHERE powiat = 'POWIAT M. WROCŁAW';
UPDATE zdarzenie
SET powiat = 'POWIAT ZABRZE'
WHERE powiat = 'POWIAT M. ZABRZE';
UPDATE zdarzenie
SET powiat = 'POWIAT ZAMOŚĆ'
WHERE powiat = 'POWIAT M. ZAMOŚĆ';
UPDATE zdarzenie
SET powiat = 'POWIAT ZIELONA GÓRA'
WHERE powiat = 'POWIAT M. ZIELONA GÓRA';
UPDATE zdarzenie
SET powiat = 'POWIAT ŻORY'
WHERE powiat = 'POWIAT M. ŻORY';
UPDATE zdarzenie
SET powiat = 'POWIAT WARSZAWA'
WHERE powiat = 'POWIAT M.ST. WARSZAWA';
UPDATE zdarzenie
SET powiat = 'POWIAT TYCHY'
WHERE powiat = 'TYCHY';
UPDATE zdarzenie
SET powiat = 'POWIAT BIERUŃSKO-LĘDZIŃSKI'
WHERE powiat = 'POWIAT BIERUŃSKO - LĘDZIŃSKI';
UPDATE zdarzenie
SET SKRZ_KOD = NULL
WHERE SKRZ_KOD = '';
UPDATE zdarzenie
SET SPIP_KOD = NULL
WHERE SPIP_KOD = '';

UPDATE uczestnicy
SET STUC_KOD = NULL
WHERE STUC_KOD = '';

UPDATE uczestnicy
SET POD_WPLYWEM = NULL
WHERE POD_WPLYWEM = '';


UPDATE uczestnicy
SET SPPI_KOD = NULL
WHERE SPPI_KOD = '';

UPDATE zdarzenie
SET WSP_GPS_X = NULL,
    WSP_GPS_Y = NULL
WHERE WSP_GPS_X = '';

SELECT *
FROM zdarzenie
WHERE DATA_ZDARZ BETWEEN '2017-01-01' AND '2017-12-31'
  AND WSP_GPS_X IS NOT NULL;
SELECT COUNT(1)
FROM zdarzenie
WHERE DATA_ZDARZ BETWEEN '2017-01-01' AND '2017-12-31'
  AND WSP_GPS_X IS NULL;

SELECT zszd_id
FROM pojazdy
WHERE rodzaj_pojazdu IN ('IS01');


SELECT DISTINCT rodzaj_pojazdu
FROM pojazdy;

SELECT DISTINCT SPSZ_KOD
FROM uczestnicy;
SELECT DISTINCT SPPI_KOD
FROM uczestnicy;
SELECT DISTINCT SKRZ_KOD
FROM zdarzenie;

SELECT z.POWIAT,
       ROUND((r.z_winy_rowerzystow / z.wszystkie_zdarzenia) * 100) AS z_winy_rowerzystow_procent,
       z.wszystkie_zdarzenia
FROM (SELECT POWIAT, COUNT(*) z_winy_rowerzystow
      FROM zdarzenie
      WHERE id IN (SELECT ZSZD_ID
                   FROM uczestnicy
                   WHERE SPSZ_KOD IS NOT NULL
                     AND zspo_id IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY POWIAT) AS r
         LEFT JOIN (SELECT POWIAT, COUNT(*) wszystkie_zdarzenia
                    FROM zdarzenie
                    WHERE id IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                    GROUP BY POWIAT) AS z ON r.POWIAT = z.POWIAT
ORDER BY z_winy_rowerzystow_procent DESC;


SELECT COUNT(*)
FROM zdarzenie;


SELECT z.rok                                                       AS rok,
       ROUND((r.z_winy_rowerzystow / z.wszystkie_zdarzenia) * 100) AS z_winy_rowerzystow_procent,
       z.wszystkie_zdarzenia
FROM (SELECT YEAR(DATA_ZDARZ) AS rok, COUNT(*) z_winy_rowerzystow
      FROM zdarzenie
      WHERE id IN (SELECT ZSZD_ID
          FROM uczestnicy
          WHERE SPSZ_KOD IS NOT NULL
        AND zspo_id IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY rok) AS r
         LEFT JOIN (SELECT YEAR(DATA_ZDARZ) AS rok, COUNT(*) wszystkie_zdarzenia
                    FROM zdarzenie
                    WHERE id IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                    GROUP BY rok) AS z ON r.rok = z.rok
ORDER BY rok ASC;

SELECT DISTINCT SPSZ_KOD
FROM uczestnicy;

SELECT *
FROM (SELECT ZSZD_ID
      FROM uczestnicy
      WHERE DATA_UR = '1988-08-20'
        AND ZSPO_ID IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')) AS ja
         LEFT JOIN zdarzenie AS z ON ja.ZSZD_ID = z.id;


SELECT COALESCE(skar.opis, 'Pieszy'), ofiary_smiertelne, ranni_ciezko, ranni_lekko, razem
FROM (SELECT COALESCE(RODZAJ_POJAZDU, 'Pieszy') AS uczestnik, COUNT(*) AS razem
      FROM (SELECT ZSPO_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IS NOT NULL) AS u
               LEFT JOIN (SELECT id, rodzaj_pojazdu FROM pojazdy) AS p ON p.id = u.ZSPO_ID
      GROUP BY uczestnik) AS w
         LEFT JOIN (SELECT COALESCE(RODZAJ_POJAZDU, 'Pieszy') AS uczestnik, COUNT(*) AS ofiary_smiertelne
                    FROM (SELECT ZSPO_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC')) AS u
                             LEFT JOIN (SELECT id, rodzaj_pojazdu FROM pojazdy) AS p ON p.id = u.ZSPO_ID
                    GROUP BY uczestnik) AS s ON w.uczestnik = s.uczestnik
         LEFT JOIN (SELECT COALESCE(RODZAJ_POJAZDU, 'Pieszy') AS uczestnik, COUNT(*) AS ranni_ciezko
                    FROM (SELECT ZSPO_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RC') AS u
                             LEFT JOIN (SELECT id, rodzaj_pojazdu FROM pojazdy) AS p ON p.id = u.ZSPO_ID
                    GROUP BY RODZAJ_POJAZDU) AS rc on rc.uczestnik = s.uczestnik
         LEFT JOIN (SELECT COALESCE(RODZAJ_POJAZDU, 'Pieszy') AS uczestnik, COUNT(*) AS ranni_lekko
                    FROM (SELECT ZSPO_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD = 'RL') AS u
                             LEFT JOIN (SELECT id, rodzaj_pojazdu FROM pojazdy) AS p ON p.id = u.ZSPO_ID
                    GROUP BY RODZAJ_POJAZDU) AS rl on rl.uczestnik = s.uczestnik
         LEFT JOIN skar on skar.kod = w.uczestnik
ORDER BY ofiary_smiertelne DESC;

SELECT stuc_kod, COUNT(*)
FROM (SELECT * FROM uczestnicy WHERE ZSPO_ID IS NULL) as u
         LEFT JOIN zdarzenie as z ON z.ID = u.ZSZD_ID

WHERE z.DATA_ZDARZ >= '2017-01-01'
GROUP BY STUC_KOD;


SELECT stuc_kod, COUNT(*)
FROM (SELECT *
      FROM uczestnicy
      WHERE ZSPO_ID IS NULL
        AND ZSZD_ID IN (SELECT ZSZD_ID
                        FROM pojazdy
                        WHERE RODZAJ_POJAZDU = 'IS101'
                          AND id IN (SELECT ZSPO_ID FROM uczestnicy WHERE SPSZ_KOD IS NOT NULL))) as u
         LEFT JOIN zdarzenie as z ON z.ID = u.ZSZD_ID

WHERE z.DATA_ZDARZ >= '2017-01-01'
GROUP BY STUC_KOD;

SELECT *
FROM (SELECT zszd_id, DATA_UR FROM uczestnicy WHERE STUC_KOD = 'ZM' LIMIT 10) as u
         LEFT JOIN (SELECT id, DATA_ZDARZ FROM zdarzenie) as z on z.ID = u.ZSZD_ID;


SELECT w.wiek, p.liczba as piesi, r.liczba as rowerzysci, w.liczba as wszyscy
FROM (SELECT (FLOOR(
            (YEAR(DATA_ZDARZ) - YEAR(DATA_UR) - (DATE_FORMAT(DATA_ZDARZ, '%m%d') < DATE_FORMAT(DATA_UR, '%m%d'))) /
            10))
                 *
             10       AS wiek,
             COUNT(*) AS liczba
      FROM (SELECT ID, ZSZD_ID, ZSPO_ID, DATA_UR
            FROM uczestnicy
            WHERE DATA_UR != '0000-00-00'
              AND STUC_KOD IN ('RL', 'RC')) AS u
               LEFT JOIN (SELECT id, DATA_ZDARZ FROM zdarzenie) AS z ON z.ID = u.zszd_id
      GROUP BY wiek) as w
         LEFT JOIN (SELECT (FLOOR((YEAR(DATA_ZDARZ) - YEAR(DATA_UR) -
                                      (DATE_FORMAT(DATA_ZDARZ, '%m%d') < DATE_FORMAT(DATA_UR, '%m%d'))) / 10))
                               *
                           10       AS wiek,
                           COUNT(*) AS liczba
                    FROM (SELECT ID, ZSZD_ID, ZSPO_ID, DATA_UR
                          FROM uczestnicy
                          WHERE DATA_UR != '0000-00-00'
                            AND STUC_KOD IN ('RL', 'RC')
                            AND ZSPO_ID IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')) AS u
                             LEFT JOIN (SELECT id, DATA_ZDARZ FROM zdarzenie) AS z ON z.ID = u.zszd_id
                    GROUP BY wiek) as r ON r.wiek = w.wiek
         LEFT JOIN (SELECT (FLOOR((YEAR(DATA_ZDARZ) - YEAR(DATA_UR) -
                                      (DATE_FORMAT(DATA_ZDARZ, '%m%d') < DATE_FORMAT(DATA_UR, '%m%d'))) / 10))
                               *
                           10       AS wiek,
                           COUNT(*) AS liczba
                    FROM (SELECT ID, ZSZD_ID, ZSPO_ID, DATA_UR
                          FROM uczestnicy
                          WHERE DATA_UR != '0000-00-00'
                            AND STUC_KOD IN ('RL', 'RC')
                            AND ZSPO_ID IS NULL) AS u
                             LEFT JOIN (SELECT id, DATA_ZDARZ FROM zdarzenie) AS z ON z.ID = u.zszd_id
                    GROUP BY wiek) as p ON p.wiek = w.wiek;

(SELECT skar.opis as 'pojazd sprawcy', sum(o.liczba) as 'ofiary śmiertelne'
 FROM (SELECT count(*) as liczba, ZSZD_ID
       FROM uczestnicy
       WHERE STUC_KOD IN ('ZM', 'ZC')
         AND SPSZ_KOD IS NULL
         and SPPI_KOD IS NULL
       GROUP BY ZSZD_ID) as o
          LEFT JOIN (SELECT ZSZD_ID, ZSPO_ID
                     FROM uczestnicy
                     WHERE SPSZ_KOD IS NOT NULL
                        OR SPPI_KOD IS NOT NULL) as s ON o.ZSZD_ID = s.ZSZD_ID
          LEFT JOIN (SELECT ID, RODZAJ_POJAZDU FROM pojazdy) as p on s.ZSPO_ID = p.ID
          LEFT JOIN skar on RODZAJ_POJAZDU = skar.kod
 GROUP BY RODZAJ_POJAZDU
 HAVING `pojazd sprawcy` IS NOT NULL
 ORDER BY `ofiary śmiertelne` DESC);


SELECT count(*), DATA_UR
FROM uczestnicy
group by DATA_UR;


(SELECT skar.opis as 'pojazd ofiary', count(*) as liczba
 FROM (SELECT ZSPO_ID, ZSZD_ID
       FROM uczestnicy
       WHERE STUC_KOD IN ('ZM', 'ZC')
         AND SPSZ_KOD IS NULL
         and SPPI_KOD IS NULL
         AND ZSZD_ID IN (SELECT ZSZD_ID
                         FROM uczestnicy
                         WHERE SPSZ_KOD IS NOT NULL
                           AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))) as o
          LEFT JOIN (SELECT RODZAJ_POJAZDU, ID FROM pojazdy) as po on po.ID = o.ZSPO_ID
          LEFT JOIN skar on po.RODZAJ_POJAZDU = skar.kod
 group by `pojazd ofiary`
 ORDER BY liczba DESC);


SELECT COUNT(*) as ofiary_wypadkow, YEAR(DATA_ZDARZ) as rok
FROM (SELECT ZSPO_ID, ZSZD_ID, STUC_KOD
    FROM uczestnicy
    WHERE STUC_KOD IN ('RL', 'RC', 'ZM', 'ZC')
    AND ZSPO_ID IS NOT NULL) as u
    LEFT JOIN (SELECT ID, RODZAJ_POJAZDU FROM pojazdy) as p on u.ZSPO_ID = p.ID
    LEFT JOIN (SELECT id, POWIAT, DATA_ZDARZ FROM zdarzenie) as z on u.zszd_id = z.id
WHERE p.RODZAJ_POJAZDU = 'IS101'
  AND POWIAT = 'POWIAT BIAŁYSTOK'
GROUP BY rok
ORDER BY rok ASC;


SELECT COUNT(*) as ofiary_wypadkow, YEAR(DATA_ZDARZ) as rok
FROM (SELECT ZSPO_ID, ZSZD_ID, STUC_KOD
    FROM uczestnicy
    WHERE STUC_KOD IN ('RL', 'RC', 'ZM', 'ZC')
    AND ZSPO_ID IS NOT NULL) as u
    LEFT JOIN (SELECT ID, RODZAJ_POJAZDU FROM pojazdy) as p on u.ZSPO_ID = p.ID
    LEFT JOIN (SELECT id, POWIAT, DATA_ZDARZ FROM zdarzenie) as z on u.zszd_id = z.id
WHERE p.RODZAJ_POJAZDU = 'IS101'
  AND POWIAT = 'POWIAT BIAŁYSTOK'
GROUP BY rok
ORDER BY rok ASC;


SELECT r.wiek, r.liczba as rowerzysci
FROM (SELECT (FLOOR(
            (YEAR(DATA_ZDARZ) - YEAR(DATA_UR) - (DATE_FORMAT(DATA_ZDARZ, '%m%d') < DATE_FORMAT(DATA_UR, '%m%d'))) /
            10))
                 * 10 AS wiek,
             COUNT(*) AS liczba,
             POWIAT
      FROM (SELECT ID, ZSZD_ID, ZSPO_ID, DATA_UR
            FROM uczestnicy
            WHERE DATA_UR != '0000-00-00'
              AND STUC_KOD IN ('RL', 'RC', 'ZM', 'ZC')
              AND ZSPO_ID IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')) AS u
               LEFT JOIN (SELECT id, DATA_ZDARZ, POWIAT FROM zdarzenie) AS z ON z.ID = u.zszd_id
      WHERE z.POWIAT = 'POWIAT BIAŁYSTOK'
      GROUP BY wiek) as r;


SELECT MONTH(DATA_ZDARZ) as 'miesiąc', count(*) as zdarzenia
FROM zdarzenie
WHERE zdarzenie.DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY miesiąc
ORDER BY miesiąc ASC;

SELECT DAYOFWEEK(DATA_ZDARZ) as 'dzień_tygodnia', count(*) as zdarzenia
FROM zdarzenie
WHERE POWIAT = 'POWIAT BIAŁYSTOK'
  AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY dzień_tygodnia
ORDER BY dzień_tygodnia ASC;


SELECT SZOS_KOD, count(*) as zdarzenia
FROM zdarzenie
WHERE POWIAT = 'POWIAT BIAŁYSTOK'
  AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY SZOS_KOD
ORDER BY SZOS_KOD ASC;


SELECT HOUR(GODZINA_ZDARZ) AS godzina, COUNT(*) AS zdarzenia
FROM zdarzenie
WHERE POWIAT = 'POWIAT BIAŁYSTOK'
  AND data_zdarz >= '2017-01-01'
  AND data_zdarz <= '2017-12-31'
  AND id IN (SELECT zszd_id FROM uczestnicy WHERE zspo_id IS NULL)
GROUP BY godzina;

(SELECT skar.opis as 'pojazd sprawcy', sum(o.liczba) as 'ofiary śmiertelne'
 FROM (SELECT count(*) as liczba, ZSZD_ID
       FROM uczestnicy
       WHERE STUC_KOD IN ('ZM', 'ZC', 'RL', 'RC')
         AND SPSZ_KOD IS NULL
         and SPPI_KOD IS NULL
         AND zszd_ID in (SELECT id
                         FROM zdarzenie
                         WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                           AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31')
       GROUP BY ZSZD_ID) as o
          LEFT JOIN (SELECT ZSZD_ID, ZSPO_ID
                     FROM uczestnicy
                     WHERE SPSZ_KOD IS NOT NULL
                        OR SPPI_KOD IS NOT NULL) as s ON o.ZSZD_ID = s.ZSZD_ID
          LEFT JOIN (SELECT ID, RODZAJ_POJAZDU FROM pojazdy) as p on s.ZSPO_ID = p.ID
          LEFT JOIN skar on RODZAJ_POJAZDU = skar.kod
 GROUP BY RODZAJ_POJAZDU
 HAVING `pojazd sprawcy` IS NOT NULL
 ORDER BY `ofiary śmiertelne` DESC);

SELECT ZSZD_ID
FROM uczestnicy
WHERE STUC_KOD IN ('ZM', 'ZC')
  AND ZSZD_ID IN (SELECT id FROM zdarzenie WHERE POWIAT = 'POWIAT BIAŁYSTOK')
  AND ZSZD_ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101');


SELECT z.rok                                                       as rok,
       ROUND((r.z_winy_rowerzystow / z.wszystkie_zdarzenia) * 100) AS z_winy_rowerzystow_procent,
       z.wszystkie_zdarzenia
FROM (SELECT YEAR(DATA_ZDARZ) as rok, COUNT(*) z_winy_rowerzystow
      FROM zdarzenie
      WHERE POWIAT = 'POWIAT BIAŁYSTOK'
        AND id IN (SELECT ZSZD_ID
          FROM uczestnicy
          WHERE SPSZ_KOD IS NOT NULL
        AND zspo_id IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY rok) AS r
         LEFT JOIN (SELECT YEAR(DATA_ZDARZ) as rok, COUNT(*) wszystkie_zdarzenia
                    FROM zdarzenie
                    WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                      AND id IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                    GROUP BY rok) AS z ON r.rok = z.rok
ORDER BY rok ASC;

SELECT count(*)
FROM uczestnicy
WHERE STUC_KOD IS NOT NULL
  AND ZSZD_ID IN (SELECT id
                  FROM zdarzenie
                  WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                    AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31')
  AND ZSZD_ID IN (SELECT zszd_id
                  FROM uczestnicy
                  WHERE SPSZ_KOD IS NOT NULL
                    AND zspo_id IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'));


SELECT ZSZD_ID
FROM uczestnicy
WHERE STUC_KOD IS NOT NULL
  AND ZSPO_ID IS NULL
  AND ZSZD_ID IN (SELECT id
                  FROM zdarzenie
                  WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                    AND CHMZ_KOD = '10'
                    AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31')
  AND ZSZD_ID IN (SELECT ZSZD_ID from pojazdy WHERE RODZAJ_POJAZDU = 'IS121');


SELECT opis, sprawcy
FROM (SELECT SPSZ_KOD, count(*) as sprawcy
      FROM uczestnicy
      WHERE ZSZD_ID IN (SELECT ID
                        from zdarzenie
                        WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                          AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
                          AND SYSW_KOD = '01'
                          AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
        AND SPSZ_KOD IS NOT NULL
      GROUP BY SPSZ_KOD
      ORDER BY sprawcy DESC) as u
         LEFT JOIN spsz as s on s.kod = u.SPSZ_KOD;

SELECT opis, sprawcy
FROM (SELECT SPPI_KOD, count(*) as sprawcy
      FROM uczestnicy
      WHERE ZSZD_ID IN (SELECT ID
                        from zdarzenie
                        WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                          AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
                          AND SYSW_KOD = '01'
                          AND SKRZ_KOD IS NOT NULL
                          AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
        AND SPPI_KOD IS NOT NULL
      GROUP BY SPPI_KOD
      ORDER BY sprawcy DESC) as u
         LEFT JOIN sppi as s on s.kod = u.SPPI_KOD;

SELECT opis, rowerzyści, inni, razem
FROM (SELECT SPSZ_KOD, count(*) as razem
      FROM uczestnicy
      WHERE SPSZ_KOD IS NOT NULL
        AND ZSZD_ID IN (SELECT id
                        FROM zdarzenie
                        WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                          AND ULICA_ADRES IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                          AND ULICA_SKRZYZ IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                          AND DATA_ZDARZ BETWEEN '2011-01-01' AND '2017-12-31')
        AND ZSZD_ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
      GROUP BY SPSZ_KOD) as r
         LEFT JOIN (SELECT SPSZ_KOD, count(*) as rowerzyści
                    FROM uczestnicy
                    WHERE SPSZ_KOD IS NOT NULL
                      AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                      AND ZSZD_ID IN (SELECT id
                                      FROM zdarzenie
                                      WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                                        AND ULICA_ADRES IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                                        AND ULICA_SKRZYZ IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                                        AND DATA_ZDARZ BETWEEN '2011-01-01' AND '2017-12-31')
                    GROUP BY SPSZ_KOD) as c on c.SPSZ_KOD = r.SPSZ_KOD
         LEFT JOIN (SELECT SPSZ_KOD, count(*) as inni
                    FROM uczestnicy
                    WHERE SPSZ_KOD IS NOT NULL
                      AND ZSPO_ID NOT IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                      AND ZSZD_ID IN (SELECT id
                                      FROM zdarzenie
                                      WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                                        AND ULICA_ADRES IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                                        AND ULICA_SKRZYZ IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                                        AND DATA_ZDARZ BETWEEN '2011-01-01' AND '2017-12-31')
                      AND ZSZD_ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                    GROUP BY SPSZ_KOD) as i on i.SPSZ_KOD = r.SPSZ_KOD
         LEFT JOIN spsz on spsz.kod = r.SPSZ_KOD

ORDER BY razem DESC;


SELECT opis, piesi
FROM (SELECT SPPI_KOD, count(*) as piesi
      FROM uczestnicy
      WHERE ZSZD_ID IN (SELECT id
                        FROM zdarzenie
                        WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                          AND ULICA_ADRES IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                          AND ULICA_SKRZYZ IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
                          AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31')
        AND ZSZD_ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
        AND SPPI_KOD IS NOT NULL
      GROUP BY SPPI_KOD) as p
         LEFT JOIN sppi on sppi.kod = p.SPPI_KOD;

SELECT spip_kod
FROM zdarzenie
WHERE POWIAT = 'POWIAT BIAŁYSTOK'
  AND spip_kod IS NOT NULL
  AND ULICA_ADRES IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
  AND ULICA_SKRZYZ IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
  AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101');

SELECT SOBY_KOD, COUNT(*)
from uczestnicy
WHERE ZSZD_ID IN (SELECT id
                  FROM zdarzenie
                  WHERE POWIAT = 'POWIAT BIAŁYSTOK'
                    AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31')
  AND ZSZD_ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY SOBY_KOD;


SELECT *
FROM zdarzenie
WHERE POWIAT = 'POWIAT BIAŁYSTOK'
  AND ULICA_SKRZYZ IS NOT NULL
  AND ULICA_ADRES IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
  AND ULICA_SKRZYZ IN ('KOPERNIKA', 'ZWIERZYNIECKA', 'KACZOROWSKIEGO', 'WIEJSKA')
  AND DATA_ZDARZ BETWEEN '2013-01-01' AND '2017-12-31'
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101');

SELECT MARKA, count(*) as liczba
from pojazdy
WHERE RODZAJ_POJAZDU = 'IS101'
GROUP By MARKA
order by liczba DESC;


SELECT *
from chmz;

SELECT POWIAT, opis, zdarzenia
FROM (SELECT POWIAT, CHMZ_KOD, count(*) as zdarzenia FROM zdarzenie GROUP BY POWIAT, CHMZ_KOD) as z
         LEFT JOIN chmz ON chmz.kod = z.CHMZ_KOD;

SELECT z.pow,
       `Jezdnia`,
       `Pas dzielący jezdnie`,
       `Pobocze`,
       `Skarpa, rów`,
       `Chodnik, droga dla pieszych`,
       `Droga dla rowerzystów`,
       `Przejście dla pieszych`,
       `Przystanek komunikacji publicznej`,
       `Przystanek tramwajowy`,
       `Torowisko tramwajowe wydzielone`,
       `Torowisko tramwajowe w jezdni`,
       `Przejazd tramwajowy, torowisko`,
       `Przejazd kolejowy strzeżony`,
       `Przejazd kolejowy niestrzeżony`,
       `Most, wiadukt, estakada`,
       `Tunel`,
       `Most, wiadukt, łącznica, tunel`,
       `Przewiązka na drodze dwujezdniowej`,
       `Parking, plac`,
       `Wjazd, wyjazd z posesji, pola`,
       `Inne`,
       `Roboty drogowe, oznakowanie tymczasowe`,
       `Droga, pas ruchu, śluza dla rowerów`,
       `Przejazd dla rowerzystów`,
       `Parking, plac, MOP`
FROM (
         SELECT DISTINCT CONCAT_WS(' / ', WOJ, POWIAT) as pow
         from zdarzenie) as z
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Jezdnia`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A1'
                    GROUP BY POW) as t_A1 on t_A1.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Pas dzielący jezdnie`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '12'
                    GROUP BY POW) as t_12 on t_12.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Pobocze`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '11'
                    GROUP BY POW) as t_11 on t_11.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Skarpa, rów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A2'
                    GROUP BY POW) as t_A2 on t_A2.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Chodnik, droga dla pieszych`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '10'
                    GROUP BY POW) as t_10 on t_10.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Droga dla rowerzystów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A3'
                    GROUP BY POW) as t_A3 on t_A3.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejście dla pieszych`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '01'
                    GROUP BY POW) as t_01 on t_01.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przystanek komunikacji publicznej`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '02'
                    GROUP BY POW) as t_02 on t_02.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przystanek tramwajowy`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '03'
                    GROUP BY POW) as t_03 on t_03.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Torowisko tramwajowe wydzielone`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '04'
                    GROUP BY POW) as t_04 on t_04.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Torowisko tramwajowe w jezdni`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '05'
                    GROUP BY POW) as t_05 on t_05.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd tramwajowy, torowisko`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A4'
                    GROUP BY POW) as t_A4 on t_A4.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd kolejowy strzeżony`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '06'
                    GROUP BY POW) as t_06 on t_06.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd kolejowy niestrzeżony`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '07'
                    GROUP BY POW) as t_07 on t_07.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Most, wiadukt, estakada`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '08'
                    GROUP BY POW) as t_08 on t_08.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Tunel`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '09'
                    GROUP BY POW) as t_09 on t_09.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Most, wiadukt, łącznica, tunel`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A5'
                    GROUP BY POW) as t_A5 on t_A5.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przewiązka na drodze dwujezdniowej`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '13'
                    GROUP BY POW) as t_13 on t_13.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Parking, plac`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A6'
                    GROUP BY POW) as t_A6 on t_A6.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Wjazd, wyjazd z posesji, pola`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '14'
                    GROUP BY POW) as t_14 on t_14.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Inne`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '15'
                    GROUP BY POW) as t_15 on t_15.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Roboty drogowe, oznakowanie tymczasowe`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A7'
                    GROUP BY POW) as t_A7 on t_A7.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Droga, pas ruchu, śluza dla rowerów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A3_2015'
                    GROUP BY POW) as t_A3_2015 on t_A3_2015.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd dla rowerzystów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'B1'
                    GROUP BY POW) as t_B1 on t_B1.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Parking, plac, MOP`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A6_2015'
                    GROUP BY POW) as t_A6_2015 on t_A6_2015.pow = z.pow INTO OUTFILE '/var/lib/mysql-files/chmz.csv'
         FIELDS TERMINATED BY ',';


SELECT z.pow,
       `Jezdnia`,
       `Pas dzielący jezdnie`,
       `Pobocze`,
       `Skarpa, rów`,
       `Chodnik, droga dla pieszych`,
       `Droga dla rowerzystów`,
       `Przejście dla pieszych`,
       `Przystanek komunikacji publicznej`,
       `Przystanek tramwajowy`,
       `Torowisko tramwajowe wydzielone`,
       `Torowisko tramwajowe w jezdni`,
       `Przejazd tramwajowy, torowisko`,
       `Przejazd kolejowy strzeżony`,
       `Przejazd kolejowy niestrzeżony`,
       `Most, wiadukt, estakada`,
       `Tunel`,
       `Most, wiadukt, łącznica, tunel`,
       `Przewiązka na drodze dwujezdniowej`,
       `Parking, plac`,
       `Wjazd, wyjazd z posesji, pola`,
       `Inne`,
       `Roboty drogowe, oznakowanie tymczasowe`,
       `Droga, pas ruchu, śluza dla rowerów`,
       `Przejazd dla rowerzystów`,
       `Parking, plac, MOP`
FROM (
         SELECT DISTINCT CONCAT_WS(' / ', WOJ, POWIAT) as pow
         from zdarzenie) as z
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Jezdnia`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A1'
                    GROUP BY POW) as t_A1 on t_A1.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Pas dzielący jezdnie`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '12'
                    GROUP BY POW) as t_12 on t_12.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Pobocze`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '11'
                    GROUP BY POW) as t_11 on t_11.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Skarpa, rów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A2'
                    GROUP BY POW) as t_A2 on t_A2.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Chodnik, droga dla pieszych`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '10'
                    GROUP BY POW) as t_10 on t_10.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Droga dla rowerzystów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A3'
                    GROUP BY POW) as t_A3 on t_A3.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejście dla pieszych`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '01'
                    GROUP BY POW) as t_01 on t_01.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przystanek komunikacji publicznej`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '02'
                    GROUP BY POW) as t_02 on t_02.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przystanek tramwajowy`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '03'
                    GROUP BY POW) as t_03 on t_03.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Torowisko tramwajowe wydzielone`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '04'
                    GROUP BY POW) as t_04 on t_04.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Torowisko tramwajowe w jezdni`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '05'
                    GROUP BY POW) as t_05 on t_05.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd tramwajowy, torowisko`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A4'
                    GROUP BY POW) as t_A4 on t_A4.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd kolejowy strzeżony`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '06'
                    GROUP BY POW) as t_06 on t_06.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd kolejowy niestrzeżony`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '07'
                    GROUP BY POW) as t_07 on t_07.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Most, wiadukt, estakada`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '08'
                    GROUP BY POW) as t_08 on t_08.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Tunel`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '09'
                    GROUP BY POW) as t_09 on t_09.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Most, wiadukt, łącznica, tunel`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A5'
                    GROUP BY POW) as t_A5 on t_A5.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przewiązka na drodze dwujezdniowej`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '13'
                    GROUP BY POW) as t_13 on t_13.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Parking, plac`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A6'
                    GROUP BY POW) as t_A6 on t_A6.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Wjazd, wyjazd z posesji, pola`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '14'
                    GROUP BY POW) as t_14 on t_14.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Inne`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = '15'
                    GROUP BY POW) as t_15 on t_15.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Roboty drogowe, oznakowanie tymczasowe`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A7'
                    GROUP BY POW) as t_A7 on t_A7.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Droga, pas ruchu, śluza dla rowerów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A3_2015'
                    GROUP BY POW) as t_A3_2015 on t_A3_2015.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Przejazd dla rowerzystów`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'B1'
                    GROUP BY POW) as t_B1 on t_B1.pow = z.pow
         LEFT JOIN (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, count(1) as `Parking, plac, MOP`
                    FROM zdarzenie
                    WHERE CHMZ_KOD = 'A6_2015'
                    GROUP BY POW) as t_A6_2015 on t_A6_2015.pow = z.pow INTO OUTFILE '/var/lib/mysql-files/chmz.csv'
         FIELDS TERMINATED BY ',';

use sewik;

SELECT pow, opis as przyczyna, liczba
FROM (SELECT pow, spsz_kod, COUNT(1) AS liczba
      FROM (SELECT ZSZD_ID, SPSZ_KOD FROM uczestnicy WHERE SPSZ_KOD IS NOT NULL) as u
               LEFT JOIN (SELECT ID, CONCAT_WS(' / ', WOJ, POWIAT) as pow FROM zdarzenie) as z ON u.ZSZD_ID = z.ID
      GROUP BY pow, SPSZ_KOD) as k
         LEFT JOIN spsz as s on spsz_kod = s.kod

UNION

SELECT pow, opis as przyczyna, liczba
FROM (SELECT pow, sppi_kod, COUNT(1) AS liczba
      FROM (SELECT ZSZD_ID, SPPI_KOD FROM uczestnicy WHERE SPPI_KOD IS NOT NULL) as u
               LEFT JOIN (SELECT ID, CONCAT_WS(' / ', WOJ, POWIAT) as pow FROM zdarzenie) as z ON u.ZSZD_ID = z.ID
      GROUP BY pow, SPPI_KOD) as p
         LEFT JOIN sppi as p on sppi_kod = p.kod

UNION

SELECT pow, opis as przyczyna, liczba
FROM (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, spip_kod, COUNT(1) as liczba
      FROM zdarzenie
      WHERE spip_kod IS NOT NULL
      GROUP BY pow
             , spip_kod) as z
         LEFT JOIN spip on spip.kod = z.spip_kod;


SELECT *
FROM spip;

SELECT *
FROM stuc;


SELECT rl.pow, zmarli, ranni_ciezko, ranni_lekko
FROM (
         SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, STUC_KOD, count(1) as ranni_lekko
         FROM (SELECT STUC_KOD, ZSZD_ID FROM uczestnicy WHERE STUC_KOD = 'RL') as u
                  LEFT JOIN
              zdarzenie ON u.ZSZD_ID = zdarzenie.id

         WHERE DATA_ZDARZ BETWEEN '2017-01-01' AND '2017-12-31'

         GROUP BY pow
     ) as rl
         LEFT JOIN
     (
         SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, STUC_KOD, count(1) as ranni_ciezko
         FROM (SELECT STUC_KOD, ZSZD_ID FROM uczestnicy WHERE STUC_KOD = 'RC') as u
                  LEFT JOIN
              zdarzenie ON u.ZSZD_ID = zdarzenie.id

         WHERE DATA_ZDARZ BETWEEN '2017-01-01' AND '2017-12-31'

         GROUP BY pow
     ) as rc ON rc.pow = rl.pow
         LEFT JOIN
     (
         SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow, STUC_KOD, count(1) as zmarli
         FROM (SELECT STUC_KOD, ZSZD_ID FROM uczestnicy WHERE STUC_KOD = 'ZM' OR STUC_KOD = 'ZC') as u
                  LEFT JOIN
              zdarzenie ON u.ZSZD_ID = zdarzenie.id

         WHERE DATA_ZDARZ BETWEEN '2017-01-01' AND '2017-12-31'

         GROUP BY pow
     ) as zm ON rc.pow = zm.pow;

SET GLOBAL sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));

SET sql_mode = '';
USE sewik;
SELECT z.pow, z.rok, z.miesiac, zdarzenia, wypadki
FROM (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow,
          YEAR(DATA_ZDARZ)              as rok,
          MONTH(DATA_ZDARZ)             as miesiac,
          count(1)                      as zdarzenia
      FROM zdarzenie
      GROUP BY pow, rok, miesiac)
         as z
         LEFT OUTER JOIN
     (SELECT CONCAT_WS(' / ', WOJ, POWIAT) as pow,
          YEAR(DATA_ZDARZ)              as rok,
          MONTH(DATA_ZDARZ)             as miesiac,
          count(1)                      as wypadki
      FROM zdarzenie
      WHERE ID IN (SELECT ZSZD_ID FROM uczestnicy WHERE STUC_KOD IS NOT NULL)
      GROUP BY pow, rok, miesiac) as w ON z.pow = w.pow AND z.miesiac = w.miesiac AND z.rok = w.rok;
# ORDER BY z.pow, z.rok, z.miesiac ASC;

SELECT count(1)
FROM uczestnicy
WHERE STUC_KOD IN ('ZM', 'ZC')
    #   AND SPSZ_KOD IS NULL
  AND ZSZD_ID IN (SELECT ZSZD_ID FROM uczestnicy WHERE SPSZ_KOD IS NOT NULL AND SUSU_KOD = 'N' AND SSRU_KOD = 'K')
  AND ZSZD_ID IN (SELECT ID FROM zdarzenie WHERE DATA_ZDARZ BETWEEN '2017-01-01' AND '2017-12-31');

DELETE
from sewik.zdarzenie
WHERE ID IN (SELECT id FROM sewik_2018.zdarzenie);

use sewik;

SELECT z.powiat,
       ROUND((r.z_winy_rowerzystow / z.zdarzenia) * 100) AS 'z winy pijanych rowerzystow'
FROM (SELECT CONCAT_WS(" / ", WOJ, POWIAT) as powiat,
             COUNT(*)                         z_winy_rowerzystow
      FROM zdarzenie
      WHERE id IN (SELECT ZSZD_ID
                   FROM uczestnicy
                   WHERE SUSW_KOD = 'A'
                     AND SPSZ_KOD IS NOT NULL
                     AND zspo_id IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY POWIAT, WOJ) AS r
         LEFT JOIN
     (SELECT CONCAT_WS(" / ", WOJ, POWIAT) as powiat,
             COUNT(*)                         zdarzenia
      FROM zdarzenie
      WHERE id IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
      GROUP BY POWIAT, WOJ) AS z
     ON r.POWIAT = z.POWIAT
ORDER BY z_winy_rowerzystow DESC;

SELECT z.powiat,
       ROUND((r.z_winy_kierowciwow / z.zdarzenia) * 100) AS z_winy_pijanych_kierowcow
FROM (SELECT CONCAT_WS(" / ", WOJ, POWIAT) as powiat,
             COUNT(*)                         z_winy_kierowciwow
      FROM zdarzenie
      WHERE id IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
        AND id IN (SELECT ZSZD_ID
                   FROM uczestnicy
                   WHERE SUSW_KOD = 'A'
                     AND SPSZ_KOD IS NOT NULL
                     AND zspo_id IS NOT NULL
                     AND zspo_id NOT IN (SELECT id FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY POWIAT, WOJ) AS r
         LEFT JOIN
     (SELECT CONCAT_WS(" / ", WOJ, POWIAT) as powiat,
             COUNT(*)                         zdarzenia
      FROM zdarzenie
      WHERE id IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
      GROUP BY POWIAT, WOJ) AS z
     ON r.POWIAT = z.POWIAT
ORDER BY z_winy_pijanych_kierowcow DESC;

create index pod_wplywem
    on uczestnicy (POD_WPLYWEM);


SET sql_mode = '';

UPDATE uczestnicy
SET DATA_UR = NULL
WHERE DATA_UR = '0000-00-00';

SELECT DISTINCT SUSW_KOD
FROM uczestnicy;

SELECT WEEKDAY(DATA_ZDARZ) as dzien_tygodnia, COUNT(1) as ofiary_śmiertelne
FROM (SELECT *
      FROM uczestnicy
      WHERE STUC_KOD IN ('ZM', 'ZC')
        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
     ) as u
         Left JOIN (SELECT ID, DATA_ZDARZ FROM zdarzenie) as z on z.ID = u.ZSZD_ID
WHERE z.DATA_ZDARZ BETWEEN '2016-01-01' AND '2016-12-31'
GROUP BY dzien_tygodnia;

SELECT *
FROM (SELECT ID, ZSZD_ID, DATA_UR, ZSPO_ID
      FROM uczestnicy
      WHERE DATA_UR = '1964-09-09'
        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS121')) as karol
         LEFT JOIN
     (SELECT ID, WOJ, GMINA, POWIAT, DATA_ZDARZENIA FROM zdarzenie) as z ON z.id = karol.zszd_id
         LEFT JOIN (SELECT ID, MARKA FROM pojazdy) as p on p.id = karol.ZSPO_ID;


SELECT MONTH(DATA_ZDARZ) as miesiac, count(1)
FROM (SELECT ZSZD_ID, ZSPO_ID
    FROM uczestnicy
    WHERE STUC_KOD IN ('ZM', 'ZC')
    AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')) as u
    LEFT JOIN (SELECT ID, DATA_ZDARZ FROM zdarzenie) as z on z.ID = u.ZSZD_ID
WHERE DATA_ZDARZ BETWEEN '2016-01-01' AND '2016-12-31'
GROUP BY miesiac;


SELECT WEEKDAY(DATA_ZDARZ) as dzien_tygodnia, count(1)
FROM (SELECT ZSZD_ID, ZSPO_ID
      FROM uczestnicy
      WHERE STUC_KOD IN ('ZM', 'ZC')
          #         AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
     ) as u
         LEFT JOIN (SELECT ID, DATA_ZDARZ FROM zdarzenie) as z on z.ID = u.ZSZD_ID
WHERE DATA_ZDARZ BETWEEN '2016-01-01' AND '2016-12-31'
GROUP BY dzien_tygodnia;


SELECT SZOS_KOD, opis, count(1)
FROM (SELECT ZSZD_ID, ZSPO_ID
      FROM uczestnicy
      WHERE STUC_KOD IN ('ZM', 'ZC')
        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
     ) as u
         LEFT JOIN (SELECT ID, DATA_ZDARZ, SZOS_KOD FROM zdarzenie) as z on z.ID = u.ZSZD_ID
         LEFT JOIN szos as s on s.kod = z.SZOS_KOD
WHERE DATA_ZDARZ BETWEEN '2015-01-01' AND '2018-12-31'
GROUP BY SZOS_KOD;


SELECT CHMZ_KOD, opis, count(1) liczba
FROM (SELECT ZSZD_ID, ZSPO_ID
      FROM uczestnicy
      WHERE STUC_KOD IN ('ZM', 'ZC')
        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
     ) as u
         LEFT JOIN (SELECT ID, DATA_ZDARZ, CHMZ_KOD FROM zdarzenie) as z on z.ID = u.ZSZD_ID
         LEFT JOIN chmz as c on c.kod = z.CHMZ_KOD
WHERE DATA_ZDARZ BETWEEN '2018-01-01' AND '2018-12-31'
GROUP BY CHMZ_KOD;

SELECT s.opis, r.`z winy rowerzystow`, razem - r.`z winy rowerzystow` as inni, razem
FROM (SELECT SPSZ_KOD, COUNT(1) as razem
      FROM uczestnicy
      WHERE SPSZ_KOD IS NOT NULL
        AND ZSZD_ID IN (SELECT ID from zdarzenie WHERE DATA_ZDARZ BETWEEN '2015-01-01' AND '2018-12-31')
        AND ZSZD_ID IN (SELECT ZSZD_ID
                        FROM uczestnicy
                        WHERE STUC_KOD IN ('ZM', 'ZC')
                          AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY SPSZ_KOD
      ORDER BY razem DESC) as u
         left join (SELECT SPSZ_KOD, COUNT(1) 'z winy rowerzystow'
                    FROM uczestnicy
                    WHERE SPSZ_KOD IS NOT NULL
                      AND ZSZD_ID IN (SELECT ID from zdarzenie WHERE DATA_ZDARZ BETWEEN '2015-01-01' AND '2018-12-31')
                      AND ZSZD_ID IN (SELECT ZSZD_ID
                                      FROM uczestnicy
                                      WHERE STUC_KOD IN ('ZM', 'ZC')
                                        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
                      AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
                    GROUP BY SPSZ_KOD
                    ORDER BY 'z winy rowerzystow' DESC) as r on r.SPSZ_KOD = u.SPSZ_KOD
         LEFT JOIN spsz as s on s.kod = u.SPSZ_KOD
UNION
SELECT s.opis, 0 as `z winy rowerzystow`, razem as inni, razem
FROM (SELECT spip_kod, COUNT(1) as razem
      FROM zdarzenie
      WHERE DATA_ZDARZ BETWEEN '2015-01-01' AND '2018-12-31'
        AND spip_kod IS NOT NULL
        AND ID IN (SELECT ZSZD_ID
                   FROM uczestnicy
                   WHERE STUC_KOD IN ('ZM', 'ZC')
                     AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY spip_kod) as r
         LEFT JOIN spip as s on s.kod = r.spip_kod;

SELECT s.opis, razem, 0 as `z winy rowerzystow`
FROM (SELECT SPPI_KOD, COUNT(1) as razem
      FROM uczestnicy
      WHERE ZSZD_ID IN (SELECT ID FROM zdarzenie WHERE DATA_ZDARZ BETWEEN '2010-01-01' AND '2018-12-31')
        AND SPPI_KOD IS NOT NULL
        AND ZSZD_ID IN (SELECT ZSZD_ID
                        FROM uczestnicy
                        WHERE STUC_KOD IN ('ZM', 'ZC')
                          AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
      GROUP BY SPPI_KOD) as p
         LEFT JOIN sppi as s on s.kod = p.sppi_kod;

SELECT YEAR(DATA_ZDARZ) as year, count(1)
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID
    FROM uczestnicy
    WHERE SPSZ_KOD IS NOT NULL
  AND ZSPO_ID IN (
    SELECT ID
    FROM pojazdy
    WHERE RODZAJ_POJAZDU != 'IS101'
  AND RODZAJ_POJAZDU IS NOT NULL))
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY year;

SELECT YEAR(DATA_ZDARZ) as year, count(1)
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID
    FROM uczestnicy
    WHERE SPPI_KOD IS NOT NULL)
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY year;

SELECT YEAR(DATA_ZDARZ) as year, count(1)
FROM zdarzenie
WHERE spip_kod IS NOT NULL
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY year;

DELETE
FROM sewik.pojazdy
WHERE ZSZD_ID IN (SELECT id FROM sewik.zdarzenie WHERE DATA_ZDARZ < '2007-01-01');
DELETE
FROM sewik.uczestnicy
WHERE ZSZD_ID IN (SELECT id FROM sewik.zdarzenie WHERE DATA_ZDARZ < '2007-01-01');
DELETE
from sewik.zdarzenie
WHERE DATA_ZDARZ < '2007-01-01';

USE sewik_2020;

UPDATE uczestnicy
SET POD_WPLYWEM = NULL
WHERE POD_WPLYWEM = '';

SET sql_mode = '';

UPDATE uczestnicy
SET DATA_UR = NULL
WHERE DATA_UR = '0000-00-00';



SELECT u.ID, u.ZSZD_ID, u.STUC_KOD, z.POWIAT, z.GMINA, ZSSD_KOD, DATA_ZDARZ FROM (SELECT ID, ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IS NOT NULL) as u LEFT JOIN (SELECT ID, POWIAT, GMINA, ZSSD_KOD, DATA_ZDARZ FROM zdarzenie) as z on z.ID = u.ZSZD_ID
    INTO OUTFILE '/var/lib/mysql-files/krajowe.csv' FIELDS TERMINATED BY ','
    ENCLOSED BY '"' LINES TERMINATED BY '\n';
;


SELECT * FROM zdarzenie WHERE POWIAT = 'POWIAT POZNAŃ' AND DATA_ZDARZ >= '2019-07-01'
    INTO OUTFILE '/var/lib/mysql-files/poznan_zdarzenia.csv' FIELDS TERMINATED BY ','
    ENCLOSED BY '"' LINES TERMINATED BY '\n';

SELECT * FROM uczestnicy WHERE ZSZD_ID IN (
    SELECT ID FROM zdarzenie WHERE POWIAT = 'POWIAT POZNAŃ' AND DATA_ZDARZ >= '2019-07-01')
    INTO OUTFILE '/var/lib/mysql-files/poznan_uczestnicy.csv' FIELDS TERMINATED BY ','
    ENCLOSED BY '"' LINES TERMINATED BY '\n';

SELECT * FROM pojazdy WHERE ZSZD_ID IN (
    SELECT ID FROM zdarzenie WHERE POWIAT = 'POWIAT POZNAŃ' AND DATA_ZDARZ >= '2019-07-01')
    INTO OUTFILE '/var/lib/mysql-files/pojazdy_uczestnicy.csv' FIELDS TERMINATED BY ','
    ENCLOSED BY '"' LINES TERMINATED BY '\n';


## migrowanie pojazdów do wspolnego standardu

SELECT DISTINCT RODZAJ_POJAZDU from sewik_all.pojazdy;

UPDATE pojazdy SET RODZAJ_POJAZDU='IS201' WHERE RODZAJ_POJAZDU IN ('IS101');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS202' WHERE RODZAJ_POJAZDU IN ('IS102');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS207' WHERE RODZAJ_POJAZDU IN ('IS107');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS208' WHERE RODZAJ_POJAZDU IN ('IS108');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS218' WHERE RODZAJ_POJAZDU IN ('IS118');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS220' WHERE RODZAJ_POJAZDU IN ('IS120','IS14','IS19','IS26');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS221' WHERE RODZAJ_POJAZDU IN ('IS21','IS121');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS222' WHERE RODZAJ_POJAZDU IN ('IS122');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS223' WHERE RODZAJ_POJAZDU IN ('IS123');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS225' WHERE RODZAJ_POJAZDU IN ('IS125');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS227' WHERE RODZAJ_POJAZDU IN ('IS27','IS127');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS228' WHERE RODZAJ_POJAZDU IN ('IS03','IS128');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS229' WHERE RODZAJ_POJAZDU IN ('IS129');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS230' WHERE RODZAJ_POJAZDU IN ('IS130');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS231' WHERE RODZAJ_POJAZDU IN ('IS131');
UPDATE pojazdy SET RODZAJ_POJAZDU='IS232' WHERE RODZAJ_POJAZDU IN ('IS132');

UPDATE uczestnicy SET DATA_UR = null WHERE DATA_UR < '1900-01-01';

SELECT count(1), SSRU_KOD from uczestnicy GROUP BY SSRU_KOD;

SELECT ZSZD_ID FROM uczestnicy WHERE SSRU_KOD = 'O' LIMIT 10;

SELECT COUNT(1) as zdarzenia, YEAR(DATA_ZDARZ) as rok FROM zdarzenie GROUP BY rok;

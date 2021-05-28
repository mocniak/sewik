DELETE
FROM sewik.pojazdy
WHERE ZSZD_ID IN (SELECT id FROM sewik.zdarzenie WHERE DATA_ZDARZ >= '2020-01-01');
DELETE
FROM sewik.uczestnicy
WHERE ZSZD_ID IN (SELECT id FROM sewik.zdarzenie WHERE DATA_ZDARZ >= '2020-01-01');
DELETE
from sewik.zdarzenie
WHERE DATA_ZDARZ >= '2020-01-01';


create index PLEC
    on sewik.uczestnicy (PLEC);

create index SPPI_KOD
    on sewik.uczestnicy (SPPI_KOD);

create index SPSZ_KOD
    on sewik.uczestnicy (SPSZ_KOD);

create index SRUZ_KOD
    on sewik.uczestnicy (SRUZ_KOD);

create index SSRU_KOD
    on sewik.uczestnicy (SSRU_KOD);

create index STUC_KOD
    on sewik.uczestnicy (STUC_KOD);

create index SUSU_KOD
    on sewik.uczestnicy (SUSU_KOD);

create index ZSPO_ID
    on sewik.uczestnicy (ZSPO_ID);

create index ZSZD_ID
    on sewik.uczestnicy (ZSZD_ID);

create index data_ur
    on sewik.uczestnicy (DATA_UR);

create index ID
    on sewik.pojazdy (ID);

create index SPIC_KOD
    on sewik.pojazdy (SPIC_KOD);

create index SPSP_KOD
    on sewik.pojazdy (SPSP_KOD);

create index ZSZD_ID
    on sewik.pojazdy (ZSZD_ID);

create index ZSZD_ID_2
    on sewik.pojazdy (ZSZD_ID);

create index rodzaj_pojazdu
    on sewik.pojazdy (RODZAJ_POJAZDU);



USE sewik_2020;

UPDATE uczestnicy
SET POD_WPLYWEM = NULL
WHERE POD_WPLYWEM = '';

SET sql_mode = '';

UPDATE uczestnicy
SET DATA_UR = NULL
WHERE DATA_UR = '0000-00-00';


create index pod_wplywem
    on uczestnicy (POD_WPLYWEM);

SELECT DISTINCT SPSZ_KOD
from uczestnicy;


SELECT CHMZ_KOD, opis, count(1) liczba
FROM (SELECT ZSZD_ID, ZSPO_ID
      FROM uczestnicy
      WHERE STUC_KOD IN ('ZM', 'ZC')
        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
     ) as u
         LEFT JOIN (SELECT ID, DATA_ZDARZ, CHMZ_KOD FROM zdarzenie) as z on z.ID = u.ZSZD_ID
         LEFT JOIN chmz as c on c.kod = z.CHMZ_KOD
WHERE DATA_ZDARZ BETWEEN '2016-01-01' AND '2020-12-31'
GROUP BY CHMZ_KOD;

use sewik;

SELECT YEAR(DATA_ZDARZ) as year, count(1)
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
GROUP BY year;

SELECT YEAR(DATA_ZDARZ) as year, count(1)
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID
    FROM uczestnicy
    WHERE ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
GROUP BY year;

SELECT YEAR(DATA_ZDARZ) as year, count(1)
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
  AND ID NOT IN (SELECT ZSZD_ID
    FROM uczestnicy
    WHERE ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'))
GROUP BY year;

SELECT ID
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
  AND ID NOT IN (SELECT ZSZD_ID
                 FROM uczestnicy
                 WHERE ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101'));


SELECT spip_kod, count(*)
FROM zdarzenie
WHERE ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
  AND DATA_ZDARZ BETWEEN '2016-01-01' AND '2016-12-31'
GROUP BY spip_kod;

SELECT count(1)
from sewik_cache.cached_query_results;

SELECT *
FROM (SELECT z.ULICA_ADRES, COUNT(1) as zmarli
      FROM (SELECT ZSZD_ID FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC') AND ZSPO_ID is NULL) as p
               LEFT JOIN (SELECT ID, ULICA_ADRES, DATA_ZDARZ, POWIAT FROM zdarzenie) as z on z.id = p.ZSZD_ID
      WHERE z.POWIAT = 'POWIAT WARSZAWA'
        AND DATA_ZDARZ BETWEEN '2007-01-01' AND '2018-12-31'
      GROUP BY ULICA_ADRES
      ORDER BY zmarli DESC) as ulice
         LEFT JOIN
     (SELECT z.ULICA_SKRZYZ, COUNT(1) as zmarli
      FROM (SELECT ZSZD_ID FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC') AND ZSPO_ID is NULL) as p
               LEFT JOIN (SELECT ID, ULICA_SKRZYZ, DATA_ZDARZ, POWIAT FROM zdarzenie) as z on z.id = p.ZSZD_ID
      WHERE z.POWIAT = 'POWIAT WARSZAWA'
        AND DATA_ZDARZ BETWEEN '2007-01-01' AND '2018-12-31'
      GROUP BY ULICA_SKRZYZ
      ORDER BY zmarli DESC) as skrzyzowania on ulice.ULICA_ADRES = skrzyzowania.ULICA_SKRZYZ;


DELETE
from sewik.zdarzenie
WHERE ID IN (SELECT id FROM sewik_2021.zdarzenie);
DELETE
from sewik.pojazdy
WHERE ZSZD_ID IN (SELECT id FROM sewik_2021.zdarzenie);
DELETE
from sewik.uczestnicy
WHERE ZSZD_ID IN (SELECT id FROM sewik_2021.zdarzenie);

INSERT INTO sewik.zdarzenie
SELECT *
FROM sewik_2021.zdarzenie;
INSERT INTO sewik.pojazdy
SELECT *
FROM sewik_2021.pojazdy;
INSERT INTO sewik.uczestnicy
SELECT *
FROM sewik_2021.uczestnicy;


SELECT COUNT(*)
FROM sewik.zdarzenie;

SELECT *
FROM (SElECT id, SPSZ_KOD, ZSZD_ID, ZSPO_ID FROM uczestnicy WHERE DATA_UR = '1988-08-20') as u
         LEFT JOIN
     (SELECT ID, MARKA, RODZAJ_POJAZDU FROM pojazdy) as p ON p.ID = u.ZSPO_ID
         LEFT JOIN (SELECT ID, POWIAT, ULICA_ADRES, ULICA_SKRZYZ, DATA_ZDARZ FROM zdarzenie) as z on u.ZSZD_ID = z.ID
WHERE RODZAJ_POJAZDU = 'IS101';
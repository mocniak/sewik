DELETE
FROM sewik_all.pojazdy
WHERE ZSZD_ID IN (SELECT id FROM sewik.zdarzenie WHERE DATA_ZDARZ >= '2022-01-01');
DELETE
FROM sewik_all.uczestnicy
WHERE ZSZD_ID IN (SELECT id FROM sewik.zdarzenie WHERE DATA_ZDARZ >= '2022-01-01');
DELETE
from sewik_all.zdarzenie
WHERE DATA_ZDARZ >= '2022-01-01';


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



USE sewik_2021;

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
from sewik_all.zdarzenie
WHERE ID IN (SELECT id FROM sewik_2022.zdarzenie);
DELETE
from sewik_all.pojazdy
WHERE ZSZD_ID IN (SELECT id FROM sewik_2022.zdarzenie);
DELETE
from sewik_all.uczestnicy
WHERE ZSZD_ID IN (SELECT id FROM sewik_2022.zdarzenie);

INSERT INTO sewik_all.zdarzenie
SELECT *
FROM sewik_2022.zdarzenie;

INSERT INTO sewik_all.pojazdy
SELECT *
FROM sewik_2022.pojazdy;

INSERT INTO sewik_all.uczestnicy
SELECT *
FROM sewik_2022.uczestnicy;


SELECT COUNT(*)
FROM sewik.zdarzenie;

SELECT *
FROM (SElECT id, SPSZ_KOD, ZSZD_ID, ZSPO_ID FROM uczestnicy WHERE DATA_UR = '1988-08-20') as u
         LEFT JOIN
         (SELECT ID, MARKA, RODZAJ_POJAZDU FROM pojazdy) as p ON p.ID = u.ZSPO_ID
         LEFT JOIN (SELECT ID, POWIAT, ULICA_ADRES, ULICA_SKRZYZ, DATA_ZDARZ FROM zdarzenie) as z on u.ZSZD_ID = z.ID
WHERE RODZAJ_POJAZDU = 'IS101';


SELECT suma.rok                  as rok,
       auta_osobowa.liczba_ofiar as w_autach_osobowych,
       piesi.liczba_ofiar        as piesi,
       rowerzysci.liczba_ofiar   as rowerzysci,
       suma.liczba_ofiar         as suma
FROM (
         SELECT YEAR(z.DATA_ZDARZ) as rok, COUNT(1) as liczba_ofiar
         FROM (SELECT ZSZD_ID, STUC_KOD FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC')) as u
                  LEFT JOIN (SELECT ID, DATA_ZDARZ, POWIAT, WOJ FROM zdarzenie) as z on (z.ID = u.ZSZD_ID)
         WHERE z.POWIAT IN ('POWIAT WOŁOMIŃSKI')
           AND z.WOJ = 'WOJ. MAZOWIECKIE'
         GROUP BY rok) AS suma
         LEFT JOIN (
    SELECT YEAR(z.DATA_ZDARZ) as rok, COUNT(1) as liczba_ofiar
    FROM (SELECT ZSZD_ID, STUC_KOD, ZSPO_ID FROM uczestnicy WHERE STUC_KOD IN ('ZM', 'ZC') AND ZSPO_ID IS NULL) as u
             LEFT JOIN (SELECT ID, DATA_ZDARZ, POWIAT, WOJ FROM zdarzenie) as z on (z.ID = u.ZSZD_ID)
    WHERE z.POWIAT IN ('POWIAT WOŁOMIŃSKI')
      AND z.WOJ = 'WOJ. MAZOWIECKIE'
    GROUP BY rok) AS piesi on suma.rok = piesi.rok
         LEFT JOIN (
    SELECT YEAR(z.DATA_ZDARZ) as rok, COUNT(1) as liczba_ofiar
    FROM (SELECT ZSZD_ID, STUC_KOD, ZSPO_ID
          FROM uczestnicy
          WHERE STUC_KOD IN ('ZM', 'ZC')
            AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')) as u
             LEFT JOIN (SELECT ID, DATA_ZDARZ, POWIAT, WOJ FROM zdarzenie) as z on (z.ID = u.ZSZD_ID)
    WHERE z.POWIAT IN ('POWIAT WOŁOMIŃSKI')
      AND z.WOJ = 'WOJ. MAZOWIECKIE'
    GROUP BY rok) AS rowerzysci on suma.rok = rowerzysci.rok
         LEFT JOIN (
    SELECT YEAR(z.DATA_ZDARZ) as rok, COUNT(1) as liczba_ofiar
    FROM (SELECT ZSZD_ID, STUC_KOD, ZSPO_ID
          FROM uczestnicy
          WHERE STUC_KOD IN ('ZM', 'ZC')
            AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS121')) as u
             LEFT JOIN (SELECT ID, DATA_ZDARZ, POWIAT, WOJ FROM zdarzenie) as z on (z.ID = u.ZSZD_ID)
    WHERE z.POWIAT IN ('POWIAT WOŁOMIŃSKI')
      AND z.WOJ = 'WOJ. MAZOWIECKIE'
    GROUP BY rok) AS auta_osobowa on suma.rok = auta_osobowa.rok
ORDER BY rok ASC;

SELECT YEAR(data_zdarz) as rok, count(1)
FROM zdarzenie
WHERE POWIAT NOT IN ('POWIAT GRODZISKI', 'POWIAT LEGIONOWSKI', 'POWIAT MIŃSKI', 'POWIAT NOWODWORSKI', 'POWIAT OTWOCKI',
                 'POWIAT PIASECZYŃSKI', 'POWIAT PRUSZKOWSKI', 'POWIAT WARSZAWSKI ZACHODNI', 'POWIAT WOŁOMIŃSKI')
  AND WOJ = 'WOJ. MAZOWIECKIE'
  AND ID IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU = 'IS101')
  AND ID NOT IN (SELECT ZSZD_ID FROM pojazdy WHERE RODZAJ_POJAZDU != 'IS101')
  AND ID IN (SELECT ZSZD_ID FROM uczestnicy WHERE ZSPO_ID IS NULL)
  AND ID IN (SELECT ZSZD_ID FROM uczestnicy WHERE STUC_KOD IS NOT NULL)
GROUP BY rok
ORDER BY rok;

#
# WHERE z.POWIAT IN ('POWIAT GRODZISKI', 'POWIAT LEGIONOWSKI', 'POWIAT MIŃSKI', 'POWIAT NOWODWORSKI', 'POWIAT OTWOCKI',
#                    'POWIAT PIASECZYŃSKI', 'POWIAT PRUSZKOWSKI', 'POWIAT WARSZAWSKI ZACHODNI', 'POWIAT WOŁOWOŁOMIŃSKI')
USE sewik;
SELECT YEAR(DATA_ZDARZ) as rok, count(1) as liczba FROM
(SELECT id, ZSZD_ID FROM uczestnicy WHERE
    stuc_kod IN ('rl','rc')
    AND ZSZD_ID IN (SELECT ZSZD_ID FROM uczestnicy WHERE SPSZ_KOD IS NOT NULL
        AND ZSPO_ID IN (SELECT ID FROM pojazdy WHERE RODZAJ_POJAZDU='IS101'))
    ) as zm
LEFT JOIN
(SELECT ID, DATA_ZDARZ, POWIAT FROM zdarzenie) as z on z.id = zm.ZSZD_ID
WHERE POWIAT = "POWIAT WARSZAWA"
GROUP BY rok;

use sewik_all;

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


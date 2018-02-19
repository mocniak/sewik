INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('06e8a29a-44b7-47d0-bc7c-b2bfac91a916', 'Gmina', 'SELECT gmina, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY gmina ORDER BY ilosc DESC LIMIT 30', 'location');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('0fe6048a-4ebe-4a9f-adf0-09c879d5cc1c', 'Geometria drogi', 'SELECT geod.opis AS geometria, zdarzenia FROM
  (SELECT geod_KOD, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter%  GROUP BY geod_KOD) AS zdarzenie
  INNER JOIN geod ON geod.kod=zdarzenie.geod_kod ORDER BY zdarzenia DESC', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('13f0d5c9-092d-4f61-ac05-0c2b2d9cc58d', 'Rodzaj zdarzenia', 'SELECT szrd.opis AS rodzaj_zdarzenia, zdarzenia FROM
  (SELECT szrd_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY szrd_KOD) AS zdarzenie
  LEFT JOIN szrd ON szrd.kod=zdarzenie.szrd_kod ORDER BY zdarzenia DESC;', 'other');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('146bd589-fb42-4102-b6c4-d0e03d4eba1d', 'Pojazdy uczestników', 'SELECT skar.opis AS rodzaj_pojazdu, wynik.ilosc AS pojazdy FROM (
		skar 
		INNER JOIN
		(
		SELECT pojazdy.rodzaj_pojazdu, COUNT(pojazdy.rodzaj_pojazdu) AS ilosc 
		FROM  pojazdy %pojazdy_filter%

		GROUP BY pojazdy.rodzaj_pojazdu
		) AS wynik 

		ON wynik.rodzaj_pojazdu=skar.kod)
		ORDER BY pojazdy DESC', 'vehicles');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('19a27d27-9aa5-409b-ab36-40e5ba468460', 'Powiat', 'SELECT powiat, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY powiat ORDER BY ilosc DESC LIMIT 30', 'location');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('210ff851-09e9-4155-a9fa-588af3af7417', 'Sygnalizacja Świetlna', 'SELECT sysw.opis AS obecnosc_sygnalizacji, zdarzenia FROM
  (SELECT sysw_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY sysw_KOD) AS zdarzenie
  INNER JOIN sysw ON sysw.kod=zdarzenie.sysw_kod ORDER BY zdarzenia DESC;', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('2fc230c9-fa1f-4a04-b495-0ec13bcf12cb', 'Najniebezpieczniejsze skrzyżowania', 'SELECT CONCAT_WS('' / '', ulica1, ulica2) AS skrzyzowanie, count(*) AS ilosc FROM
(SELECT
CASE WHEN ULICA_ADRES < ULICA_SKRZYZ THEN ULICA_ADRES ELSE ULICA_SKRZYZ END ulica1,
CASE WHEN ULICA_ADRES < ULICA_SKRZYZ THEN ULICA_SKRZYZ ELSE ULICA_ADRES END ulica2
FROM zdarzenie  %zdarzenie_filter% AND ulica_skrzyz != ''''
) AS tablica
GROUP BY ulica1, ulica2
ORDER BY ilosc DESC LIMIT 50', 'location');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('3a16412c-e1bf-4039-afec-1a54596a7a9f', 'Nowy Raport', 'SELECT COUNT(*) FROM zdarzenie %zdarzenie_filter%;', 'other');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('431f604b-ee44-4ce8-ab38-993ae843bea7', 'Przyczyny pieszych', 'SELECT
  sppi.opis AS przyczyna_zdarzenia,
  wynik     AS ilosc
FROM (
       SELECT
         sppi_kod,
         count(sppi_kod) AS wynik
       FROM uczestnicy
       %uczestnicy_filter% AND CHAR_LENGTH(sppi_kod) > 0
       GROUP BY sppi_kod) AS uczestnicy

  INNER JOIN

  sppi

    ON sppi.kod = uczestnicy.sppi_kod

ORDER BY ilosc DESC', 'participants');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('4355ee95-561c-4fbc-9082-666bb6e22fae', 'Warunki atmosferyczne', 'SELECT sswa.opis AS warunki, zdarzenia FROM (
    SELECT SSWA_KOD, count(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%  GROUP BY SSWA_KOD) AS zdarzenie
LEFT JOIN sswa ON sswa.kod=zdarzenie.sswa_kod ORDER BY zdarzenia DESC', 'other');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('594095eb-ccb6-4121-94dd-ace27bc1ca82', 'Zmienność roczna', 'SELECT
  r.rok,
  zdarzenia,
  zmarli,
  ciezko_ranni,
  lekko_ranni
FROM
  (SELECT
     YEAR(DATA_ZDARZ) AS rok,
     count(*)         AS zdarzenia
   FROM zdarzenie %zdarzenie_filter%
   GROUP BY rok) AS r
  LEFT JOIN
  (SELECT
     rok,
     count(*) AS zmarli
   FROM
     (SELECT
        ZSZD_ID,
        STUC_KOD
      FROM uczestnicy %uczestnicy_filter%
      AND STUC_KOD IN (''ZM'', ''ZC'')) AS u
     LEFT JOIN
     (SELECT
        id,
        YEAR(DATA_ZDARZ) AS rok
      FROM zdarzenie) AS z
       ON z.ID = u.ZSZD_ID
   GROUP BY ROK
  ) AS zm
    ON r.rok = zm.rok
  LEFT JOIN
  (SELECT
     rok,
     count(*) AS ciezko_ranni
   FROM
     (SELECT
        ZSZD_ID,
        STUC_KOD
      FROM uczestnicy %uczestnicy_filter%
      AND STUC_KOD = ''RC'') AS u
     LEFT JOIN
     (SELECT
        id,
        YEAR(DATA_ZDARZ) AS rok
      FROM zdarzenie) AS z
       ON z.ID = u.ZSZD_ID
   GROUP BY ROK
  ) AS rc
    ON r.rok = rc.rok
  LEFT JOIN
  (SELECT
     rok,
     count(*) AS lekko_ranni
   FROM
     (SELECT
        ZSZD_ID,
        STUC_KOD
      FROM uczestnicy %uczestnicy_filter%
      AND STUC_KOD = ''RL'') AS u
     LEFT JOIN
     (SELECT
        id,
        YEAR(DATA_ZDARZ) AS rok
      FROM zdarzenie) AS z
       ON z.ID = u.ZSZD_ID
   GROUP BY ROK
  ) AS rl
    ON r.rok = rl.rok;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('59d266b1-ca93-44b3-befd-c71e33db967f', 'Przyczyny kierujących pojazdami', 'SELECT
  opis AS przyczyna_zdarzenia,
  ilosc
FROM
  spsz
  INNER JOIN (
               SELECT
                 uczestnicy.spsz_kod        AS przyczyna,
                 COUNT(uczestnicy.spsz_kod) AS ilosc
               FROM uczestnicy
                 INNER JOIN
                 pojazdy
                   ON pojazdy.id = uczestnicy.zspo_id
               %pojazdy_filter% AND uczestnicy.spsz_kod IS NOT NULL
               GROUP BY uczestnicy.spsz_kod
             ) AS wynik
    ON wynik.przyczyna = spsz.kod
ORDER BY ilosc DESC', 'participants');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('5d947d4e-0f0c-40f0-9c8e-7cffcc046efc', 'Inne przyczyny zdarzeń', 'SELECT
  spip.opis as inne_przyczyny,
  zdarzenia
FROM
  (SELECT
     spip_kod,
     COUNT(*) AS zdarzenia
   FROM zdarzenie %zdarzenie_filter%
   GROUP BY spip_kod) AS z
  INNER JOIN
  spip ON spip.kod = z.spip_kod
ORDER BY zdarzenia DESC;', 'other');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('6a0359a2-9bde-446e-ace1-cd67964fb90e', 'Prędkość dopuszczalna', 'SELECT predkosc_dopuszczalna, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY predkosc_dopuszczalna ORDER BY ilosc DESC LIMIT 15', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('6e33bdbf-a4de-434c-a8de-748373225407', 'Rodzaj skrzyżowania', 'SELECT skrz.opis AS skrzyżowanie, zdarzenia FROM
  (SELECT skrz_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY SKRZ_KOD) AS zdarzenie
  INNER JOIN skrz ON skrz.kod=zdarzenie.skrz_kod ORDER BY zdarzenia DESC;', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('8570a545-ca86-49fa-9951-0db9396c46b2', 'Zdarzenia wg dnia tygodnia', 'SELECT
  CONCAT_WS(''. '', DAYOFWEEK(DATA_ZDARZ),DAYNAME(DATA_ZDARZ)) AS dzien_tygodnia,
  COUNT(*)              AS zdarzenia
FROM zdarzenie %zdarzenie_filter%
GROUP BY dzien_tygodnia 
ORDER BY CAST(dzien_tygodnia AS UNSIGNED) ASC;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('92c66566-2f48-4d5d-8cca-219889208b1a', 'Zmienność miesięczna', 'SELECT CONCAT_WS(''. '', MONTH(DATA_ZDARZ), MONTHNAME(DATA_ZDARZ)) AS miesiac, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY miesiac ORDER BY CAST(miesiac AS UNSIGNED) ASC;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('98e81bc3-e88c-419c-a9c0-3295012c7285', 'Rodzaj drogi', 'SELECT rodr.opis AS rodzaj_drogi, zdarzenia FROM
  (SELECT rodr_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY rodr_KOD) AS zdarzenie
  INNER JOIN rodr ON rodr.kod=zdarzenie.rodr_kod ORDER BY zdarzenia DESC;', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('a0869a40-1b12-4e41-9862-090de17e76df', 'Zdarzenia wg godziny', 'SELECT HOUR(GODZINA_ZDARZ) AS godzina, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter%  GROUP BY godzina;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('a0e88208-09d6-4991-bc49-8c9b6a8fa224', 'Charakterystyka miejsca zdarzenia', 'SELECT chmz.opis AS miejsce, zdarzenia FROM
  (SELECT chmz_kod, COUNT(*) AS zdarzenia
   FROM zdarzenie %zdarzenie_filter%  GROUP BY chmz_kod) AS zdarzenie
  LEFT JOIN chmz ON chmz.kod=zdarzenie.chmz_kod
ORDER BY zdarzenia DESC', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('a1250aee-487e-4adb-b80e-f4e02d94ebbe', 'Najniebezpieczniejsze ulice', 'SELECT ulica_adres AS ulica, COUNT(ulica_adres) zdarzenia FROM
(SELECT ulica_adres FROM zdarzenie %zdarzenie_filter%
UNION ALL
SELECT ulica_skrzyz AS ulica_adres FROM zdarzenie %zdarzenie_filter%) AS zdarzenie
WHERE ulica_adres IS NOT NULL AND ulica_adres != '''' GROUP BY ulica_adres ORDER BY zdarzenia DESC LIMIT 50', 'location');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('a8c1989b-5a67-491f-a154-2e25d874b967', 'Oświetlenie', 'SELECT szos.opis AS oswietlenie, zdarzenia FROM (
    SELECT
      szos_kod, count(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%
  GROUP BY SZOS_KOD
  ) AS zdarzenie
    LEFT JOIN szos
    ON zdarzenie.szos_kod=szos.kod ORDER BY zdarzenia DESC', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('abb94a11-844d-4767-83ec-d0d2378fbcbf', 'Teren zabudowany', 'SELECT zabu.opis AS obszar, zdarzenia FROM
  (SELECT ZABU_KOD, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter% GROUP BY ZABU_KOD) AS zdarzenie
  INNER JOIN zabu ON zabu.kod=zdarzenie.zabu_kod ORDER BY zdarzenia DESC', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('b23d6540-0587-4bc8-9310-6616fd981b1d', 'Miejscowość', 'SELECT miejscowosc, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY miejscowosc ORDER BY ilosc DESC LIMIT 30', 'location');
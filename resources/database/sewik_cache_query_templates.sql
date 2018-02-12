INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('0fe6048a-4ebe-4a9f-adf0-09c879d5cc1c', 'Geometria drogi', 'SELECT geod.opis AS geometria, zdarzenia FROM
  (SELECT geod_KOD, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter%  GROUP BY geod_KOD) AS zdarzenie
  INNER JOIN geod ON geod.kod=zdarzenie.geod_kod ORDER BY zdarzenia DESC', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('13f0d5c9-092d-4f61-ac05-0c2b2d9cc58d', 'Rodzaj zdarzenia', 'SELECT szrd.opis AS rodzaj_zdarzenia, zdarzenia FROM
  (SELECT szrd_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY szrd_KOD) AS zdarzenie
  LEFT JOIN szrd ON szrd.kod=zdarzenie.szrd_kod ORDER BY zdarzenia DESC;', 'other');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('19a27d27-9aa5-409b-ab36-40e5ba468460', 'Powiat', 'SELECT powiat, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY powiat ORDER BY ilosc DESC LIMIT 30', 'location');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('210ff851-09e9-4155-a9fa-588af3af7417', 'Sygnalizacja Świetlna', 'SELECT sysw.opis AS obecnosc_sygnalizacji, zdarzenia FROM
  (SELECT sysw_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY sysw_KOD) AS zdarzenie
  INNER JOIN sysw ON sysw.kod=zdarzenie.sysw_kod ORDER BY zdarzenia DESC;', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('4355ee95-561c-4fbc-9082-666bb6e22fae', 'Warunki atmosferyczne', 'SELECT sswa.opis AS warunki, zdarzenia FROM (
    SELECT SSWA_KOD, count(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter%  GROUP BY SSWA_KOD) AS zdarzenie
LEFT JOIN sswa ON sswa.kod=zdarzenie.sswa_kod ORDER BY zdarzenia DESC', 'other');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('6a0359a2-9bde-446e-ace1-cd67964fb90e', 'Prędkość dopuszczalna', 'SELECT predkosc_dopuszczalna, COUNT(*) ilosc FROM zdarzenie %zdarzenie_filter%  GROUP BY predkosc_dopuszczalna ORDER BY ilosc DESC LIMIT 30', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('6e33bdbf-a4de-434c-a8de-748373225407', 'Rodzaj skrzyżowania', 'SELECT skrz.opis AS skrzyżowanie, zdarzenia FROM
  (SELECT skrz_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY SKRZ_KOD) AS zdarzenie
  INNER JOIN skrz ON skrz.kod=zdarzenie.skrz_kod ORDER BY zdarzenia DESC;', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('8570a545-ca86-49fa-9951-0db9396c46b2', 'Zdarzenia wg dnia tygodnia', 'SELECT DAYOFWEEK(DATA_ZDARZ) AS lp, DAYNAME(DATA_ZDARZ) AS dzien_tygodnia, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY lp,dzien_tygodnia ORDER BY lp ASC;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('92c66566-2f48-4d5d-8cca-219889208b1a', 'Zmienność miesięczna', 'SELECT MONTH(DATA_ZDARZ) AS lp, MONTHNAME(DATA_ZDARZ) AS miesiac, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY lp,miesiac ORDER BY lp ASC;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('98e81bc3-e88c-419c-a9c0-3295012c7285', 'Rodzaj drogi', 'SELECT rodr.opis AS rodzaj_drogi, zdarzenia FROM
  (SELECT rodr_KOD, COUNT(*) AS zdarzenia FROM zdarzenie %zdarzenie_filter% GROUP BY rodr_KOD) AS zdarzenie
  INNER JOIN rodr ON rodr.kod=zdarzenie.rodr_kod ORDER BY zdarzenia DESC;', 'site');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('a0869a40-1b12-4e41-9862-090de17e76df', 'Zdarzenia wg godziny', 'SELECT HOUR(GODZINA_ZDARZ) AS godzina, COUNT(*) AS zdarzenia FROM zdarzenie  %zdarzenie_filter%  GROUP BY godzina;', 'time');
INSERT INTO sewik_cache.query_templates (id, name, sql_query, category) VALUES ('a0e88208-09d6-4991-bc49-8c9b6a8fa224', 'Charakterystyka miejsca zdarzenia', 'SELECT chmz.opis AS miejsce, zdarzenia FROM
  (SELECT chmz_kod, COUNT(*) AS zdarzenia
   FROM zdarzenie %zdarzenie_filter%  GROUP BY chmz_kod) AS zdarzenie
  LEFT JOIN chmz ON chmz.kod=zdarzenie.chmz_kod
ORDER BY zdarzenia DESC', 'site');
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
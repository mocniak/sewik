<?php

namespace Sewik\Domain;

class Filter
{
    const ACCIDENTS_PLACEHOLDER = '%zdarzenie_filter%';
    const VEHICLES_PLACEHOLDER = '%pojazdy_filter%';
    const PARTICIPANTS_PLACEHOLDER = '%uczestnicy_filter%';

    const COLUMN_VOIVODESHIP = 'woj';
    const COLUMN_LOCALITY = 'miejscowosc';
    const COLUMN_DATE = 'data_zdarz';
    const COLUMN_STREET = 'ulica_adres';

    const COLUMNS = [
        self::COLUMN_VOIVODESHIP,
        self::COLUMN_LOCALITY,
        self::COLUMN_DATE,
        self::COLUMN_STREET,
    ];
    const VOIVODESHIP_DOLNOŚLĄSKIE = 'WOJ. DOLNOŚLĄSKIE';
    const VOIVODESHIP_KUJAWSKO_POMORSKIE = 'WOJ. KUJAWSKO-POMORSKIE';
    const VOIVODESHIP_LUBELSKIE = 'WOJ. LUBELSKIE';
    const VOIVODESHIP_LUBUSKIE = 'WOJ. LUBUSKIE';
    const VOIVODESHIP_MAZOWIECKIE = 'WOJ. MAZOWIECKIE';
    const VOIVODESHIP_MAŁOPOLSKIE = 'WOJ. MAŁOPOLSKIE';
    const VOIVODESHIP_OPOLSKIE = 'WOJ. OPOLSKIE';
    const VOIVODESHIP_PODKARPACKIE = 'WOJ. PODKARPACKIE';
    const VOIVODESHIP_PODLASKIE = 'WOJ. PODLASKIE';
    const VOIVODESHIP_POMORSKIE = 'WOJ. POMORSKIE';
    const VOIVODESHIP_WARMIŃSKO_MAZURSKIE = 'WOJ. WARMIŃSKO-MAZURSKIE';
    const VOIVODESHIP_WIELKOPOLSKIE = 'WOJ. WIELKOPOLSKIE';
    const VOIVODESHIP_ZACHODNIOPOMORSKIE = 'WOJ. ZACHODNIOPOMORSKIE';
    const VOIVODESHIP_ŁÓDZKIE = 'WOJ. ŁÓDZKIE';
    const VOIVODESHIP_ŚLĄSKIE = 'WOJ. ŚLĄSKIE';

    const VOIVODESHIP_ŚWIĘTOKRZYSKIE = 'WOJ. ŚWIĘTOKRZYSKIE';
    const VOIVODESHIPS = [
        'Dolnośląskie' => self::VOIVODESHIP_DOLNOŚLĄSKIE,
        'Kujawsko-Pomorskie' => self::VOIVODESHIP_KUJAWSKO_POMORSKIE,
        'Lubelskie' => self::VOIVODESHIP_LUBELSKIE,
        'Lubuskie' => self::VOIVODESHIP_LUBUSKIE,
        'Mazowieckie' => self::VOIVODESHIP_MAZOWIECKIE,
        'Małopolskie' => self::VOIVODESHIP_MAŁOPOLSKIE,
        'Opolskie' => self::VOIVODESHIP_OPOLSKIE,
        'Podkarpackie' => self::VOIVODESHIP_PODKARPACKIE,
        'Podlaskie' => self::VOIVODESHIP_PODLASKIE,
        'Pomorskie' => self::VOIVODESHIP_POMORSKIE,
        'Warmińsko-Mazurskie' => self::VOIVODESHIP_WARMIŃSKO_MAZURSKIE,
        'Wielkopolskie' => self::VOIVODESHIP_WIELKOPOLSKIE,
        'Zachodniopomorskie' => self::VOIVODESHIP_ZACHODNIOPOMORSKIE,
        'Łódzkie' => self::VOIVODESHIP_ŁÓDZKIE,
        'Śląskie' => self::VOIVODESHIP_ŚLĄSKIE,
        'Świętokrzyskie' => self::VOIVODESHIP_ŚWIĘTOKRZYSKIE,
    ];

    const PARTICIPANT_INJURY_SERIOUS = 'RC';
    const PARTICIPANT_INJURY_MINOR = 'RL';
    const PARTICIPANT_INJURY_DEATH = 'ZM,ZC';

    const PARTICIPANT_INJURIES = [
        'Ciężko ranny' => self::PARTICIPANT_INJURY_SERIOUS,
        'Lekko ranny' => self::PARTICIPANT_INJURY_MINOR,
        'Śmierć' => self::PARTICIPANT_INJURY_DEATH,
    ];

    const VEHICLE_TYPE_BICYCLE = 'IS101'; //Rower
    const VEHICLE_TYPE_MOPED = 'IS102'; //Motorower
    const VEHICLE_TYPE_MOTORBIKE = 'IS03,IS127,IS128'; //Motocykl
    const VEHICLE_TYPE_CAR = 'IS121'; //Samochód osobowy z przyczepą
    const VEHICLE_TYPE_BUS = 'IS107,IS108'; //Autobus
    const VEHICLE_TYPE_TRUCK = 'IS131,IS132'; //Samochód ciężarowy
    const VEHICLE_TYPE_TRACTOR = 'IS122'; //Ciągnik rolniczy
    const VEHICLE_TYPE_SLOW_MOVING = 'IS14'; //Pojazd wolnobieżny
    const VEHICLE_TYPE_TRAIN = 'IS118'; //Pociąg
    const VEHICLE_TYPE_EMERGENCY = 'IS19'; //Pojazd uprzywilejowany
    const VEHICLE_TYPE_TRAM_TROLLEY = 'IS123'; //Tramwaj, trolejbus
    const VEHICLE_TYPE_DANGER = 'IS123'; //Tramwaj, trolejbus
    const VEHICLE_TYPE_OTHER = 'IS120'; //Inny pojazd
    const VEHICLE_TYPE_UNKNOWN = 'IS125'; //Nieustalony
    const VEHICLE_TYPE_QUAD = 'IS129,IS130'; //Czterokołowiec lekki (od 11.2015)

    const VEHICLE_TYPES = [
        'Rower' => self::VEHICLE_TYPE_BICYCLE,
        'Skuter' => self::VEHICLE_TYPE_MOPED,
        'Motocykl' => self::VEHICLE_TYPE_MOTORBIKE,
        'Quad' => self::VEHICLE_TYPE_QUAD,
        'Samochód osobowy' => self::VEHICLE_TYPE_CAR,
        'Ciężarówka' => self::VEHICLE_TYPE_TRUCK,
        'Autobus' => self::VEHICLE_TYPE_BUS,
        'Tramwaj, trolejbus' => self::VEHICLE_TYPE_TRAM_TROLLEY,
        'Traktor' => self::VEHICLE_TYPE_TRACTOR,
        'Pojazd wolnobieżny' => self::VEHICLE_TYPE_SLOW_MOVING,
        'Pociąg' => self::VEHICLE_TYPE_TRAIN,
        'Pojazd uprzewilejowany' => self::VEHICLE_TYPE_EMERGENCY,
        'Przewożący mat. niebezpieczne' => self::VEHICLE_TYPE_DANGER,
        'Inny' => self::VEHICLE_TYPE_OTHER,
        'Nieznany' => self::VEHICLE_TYPE_UNKNOWN,
    ];

    const COUNTIES = [
        'POWIAT ALEKSANDROWSKI' => 'POWIAT ALEKSANDROWSKI',
        'POWIAT AUGUSTOWSKI' => 'POWIAT AUGUSTOWSKI',
        'POWIAT BARTOSZYCKI' => 'POWIAT BARTOSZYCKI',
        'POWIAT BEŁCHATOWSKI' => 'POWIAT BEŁCHATOWSKI',
        'POWIAT BĘDZIŃSKI' => 'POWIAT BĘDZIŃSKI',
        'POWIAT BIALSKI' => 'POWIAT BIALSKI',
        'POWIAT BIAŁA PODLASKA' => 'POWIAT BIAŁA PODLASKA',
        'POWIAT BIAŁOBRZESKI' => 'POWIAT BIAŁOBRZESKI',
        'POWIAT BIAŁOGARDZKI' => 'POWIAT BIAŁOGARDZKI',
        'POWIAT BIAŁOSTOCKI' => 'POWIAT BIAŁOSTOCKI',
        'POWIAT BIAŁYSTOK' => 'POWIAT BIAŁYSTOK',
        'POWIAT BIELSKI' => 'POWIAT BIELSKI',
        'POWIAT BIELSKO-BIAŁA' => 'POWIAT BIELSKO-BIAŁA',
        'POWIAT BIERUŃSKO-LĘDZIŃSKI' => 'POWIAT BIERUŃSKO-LĘDZIŃSKI',
        'POWIAT BIESZCZADZKI' => 'POWIAT BIESZCZADZKI',
        'POWIAT BIŁGORAJSKI' => 'POWIAT BIŁGORAJSKI',
        'POWIAT BOCHEŃSKI' => 'POWIAT BOCHEŃSKI',
        'POWIAT BOLESŁAWIECKI' => 'POWIAT BOLESŁAWIECKI',
        'POWIAT BRANIEWSKI' => 'POWIAT BRANIEWSKI',
        'POWIAT BRODNICKI' => 'POWIAT BRODNICKI',
        'POWIAT BRZESKI' => 'POWIAT BRZESKI',
        'POWIAT BRZEZINY' => 'POWIAT BRZEZINY',
        'POWIAT BRZEZIŃSKI' => 'POWIAT BRZEZIŃSKI',
        'POWIAT BRZOZOWSKI' => 'POWIAT BRZOZOWSKI',
        'POWIAT BUSKI' => 'POWIAT BUSKI',
        'POWIAT BYDGOSKI' => 'POWIAT BYDGOSKI',
        'POWIAT BYDGOSZCZ' => 'POWIAT BYDGOSZCZ',
        'POWIAT BYTOM' => 'POWIAT BYTOM',
        'POWIAT BYTOWSKI' => 'POWIAT BYTOWSKI',
        'POWIAT CHEŁM' => 'POWIAT CHEŁM',
        'POWIAT CHEŁMIŃSKI' => 'POWIAT CHEŁMIŃSKI',
        'POWIAT CHEŁMSKI' => 'POWIAT CHEŁMSKI',
        'POWIAT CHODZIESKI' => 'POWIAT CHODZIESKI',
        'POWIAT CHOJNICKI' => 'POWIAT CHOJNICKI',
        'POWIAT CHORZÓW' => 'POWIAT CHORZÓW',
        'POWIAT CHOSZCZEŃSKI' => 'POWIAT CHOSZCZEŃSKI',
        'POWIAT CHRZANOWSKI' => 'POWIAT CHRZANOWSKI',
        'POWIAT CIECHANOWSKI' => 'POWIAT CIECHANOWSKI',
        'POWIAT CIESZYŃSKI' => 'POWIAT CIESZYŃSKI',
        'POWIAT CZARNKOWSKO-TRZCIANECKI' => 'POWIAT CZARNKOWSKO-TRZCIANECKI',
        'POWIAT CZĘSTOCHOWA' => 'POWIAT CZĘSTOCHOWA',
        'POWIAT CZĘSTOCHOWSKI' => 'POWIAT CZĘSTOCHOWSKI',
        'POWIAT CZŁUCHOWSKI' => 'POWIAT CZŁUCHOWSKI',
        'POWIAT DĄBROWA GÓRNICZA' => 'POWIAT DĄBROWA GÓRNICZA',
        'POWIAT DĄBROWSKI' => 'POWIAT DĄBROWSKI',
        'POWIAT DĘBICKI' => 'POWIAT DĘBICKI',
        'POWIAT DRAWSKI' => 'POWIAT DRAWSKI',
        'POWIAT DZIAŁDOWSKI' => 'POWIAT DZIAŁDOWSKI',
        'POWIAT DZIERŻONIOWSKI' => 'POWIAT DZIERŻONIOWSKI',
        'POWIAT ELBLĄG' => 'POWIAT ELBLĄG',
        'POWIAT ELBLĄSKI' => 'POWIAT ELBLĄSKI',
        'POWIAT EŁCKI' => 'POWIAT EŁCKI',
        'POWIAT GARWOLIŃSKI' => 'POWIAT GARWOLIŃSKI',
        'POWIAT GDAŃSK' => 'POWIAT GDAŃSK',
        'POWIAT GDAŃSKI' => 'POWIAT GDAŃSKI',
        'POWIAT GDYNIA' => 'POWIAT GDYNIA',
        'POWIAT GIŻYCKI' => 'POWIAT GIŻYCKI',
        'POWIAT GLIWICE' => 'POWIAT GLIWICE',
        'POWIAT GLIWICKI' => 'POWIAT GLIWICKI',
        'POWIAT GŁOGOWSKI' => 'POWIAT GŁOGOWSKI',
        'POWIAT GŁUBCZYCKI' => 'POWIAT GŁUBCZYCKI',
        'POWIAT GNIEŹNIEŃSKI' => 'POWIAT GNIEŹNIEŃSKI',
        'POWIAT GOLENIOWSKI' => 'POWIAT GOLENIOWSKI',
        'POWIAT GOLUBSKO-DOBRZYŃSKI' => 'POWIAT GOLUBSKO-DOBRZYŃSKI',
        'POWIAT GOŁDAPSKI' => 'POWIAT GOŁDAPSKI',
        'POWIAT GORLICKI' => 'POWIAT GORLICKI',
        'POWIAT GORZOWSKI' => 'POWIAT GORZOWSKI',
        'POWIAT GORZÓW WIELKOPOLSKI' => 'POWIAT GORZÓW WIELKOPOLSKI',
        'POWIAT GOSTYNIŃSKI' => 'POWIAT GOSTYNIŃSKI',
        'POWIAT GOSTYŃSKI' => 'POWIAT GOSTYŃSKI',
        'POWIAT GÓROWSKI' => 'POWIAT GÓROWSKI',
        'POWIAT GRAJEWSKI' => 'POWIAT GRAJEWSKI',
        'POWIAT GRODZISKI' => 'POWIAT GRODZISKI',
        'POWIAT GRÓJECKI' => 'POWIAT GRÓJECKI',
        'POWIAT GRUDZIĄDZ' => 'POWIAT GRUDZIĄDZ',
        'POWIAT GRUDZIĄDZKI' => 'POWIAT GRUDZIĄDZKI',
        'POWIAT GRYFICKI' => 'POWIAT GRYFICKI',
        'POWIAT GRYFIŃSKI' => 'POWIAT GRYFIŃSKI',
        'POWIAT HAJNOWSKI' => 'POWIAT HAJNOWSKI',
        'POWIAT HRUBIESZOWSKI' => 'POWIAT HRUBIESZOWSKI',
        'POWIAT IŁAWSKI' => 'POWIAT IŁAWSKI',
        'POWIAT INOWROCŁAWSKI' => 'POWIAT INOWROCŁAWSKI',
        'POWIAT JANOWSKI' => 'POWIAT JANOWSKI',
        'POWIAT JAROCIŃSKI' => 'POWIAT JAROCIŃSKI',
        'POWIAT JAROSŁAWSKI' => 'POWIAT JAROSŁAWSKI',
        'POWIAT JASIELSKI' => 'POWIAT JASIELSKI',
        'POWIAT JASTRZĘBIE-ZDRÓJ' => 'POWIAT JASTRZĘBIE-ZDRÓJ',
        'POWIAT JAWORSKI' => 'POWIAT JAWORSKI',
        'POWIAT JAWORZNO' => 'POWIAT JAWORZNO',
        'POWIAT JELENIA GÓRA' => 'POWIAT JELENIA GÓRA',
        'POWIAT JELENIOGÓRSKI' => 'POWIAT JELENIOGÓRSKI',
        'POWIAT JĘDRZEJOWSKI' => 'POWIAT JĘDRZEJOWSKI',
        'POWIAT KALISKI' => 'POWIAT KALISKI',
        'POWIAT KALISZ' => 'POWIAT KALISZ',
        'POWIAT KAMIENNOGÓRSKI' => 'POWIAT KAMIENNOGÓRSKI',
        'POWIAT KAMIEŃSKI' => 'POWIAT KAMIEŃSKI',
        'POWIAT KARTUSKI' => 'POWIAT KARTUSKI',
        'POWIAT KATOWICE' => 'POWIAT KATOWICE',
        'POWIAT KAZIMIERSKI' => 'POWIAT KAZIMIERSKI',
        'POWIAT KĘDZIERZYŃSKO-KOZIELSKI' => 'POWIAT KĘDZIERZYŃSKO-KOZIELSKI',
        'POWIAT KĘPIŃSKI' => 'POWIAT KĘPIŃSKI',
        'POWIAT KĘTRZYŃSKI' => 'POWIAT KĘTRZYŃSKI',
        'POWIAT KIELCE' => 'POWIAT KIELCE',
        'POWIAT KIELECKI' => 'POWIAT KIELECKI',
        'POWIAT KLUCZBORSKI' => 'POWIAT KLUCZBORSKI',
        'POWIAT KŁOBUCKI' => 'POWIAT KŁOBUCKI',
        'POWIAT KŁODZKI' => 'POWIAT KŁODZKI',
        'POWIAT KOLBUSZOWSKI' => 'POWIAT KOLBUSZOWSKI',
        'POWIAT KOLNEŃSKI' => 'POWIAT KOLNEŃSKI',
        'POWIAT KOLSKI' => 'POWIAT KOLSKI',
        'POWIAT KOŁOBRZESKI' => 'POWIAT KOŁOBRZESKI',
        'POWIAT KONECKI' => 'POWIAT KONECKI',
        'POWIAT KONIN' => 'POWIAT KONIN',
        'POWIAT KONIŃSKI' => 'POWIAT KONIŃSKI',
        'POWIAT KOSZALIN' => 'POWIAT KOSZALIN',
        'POWIAT KOSZALIŃSKI' => 'POWIAT KOSZALIŃSKI',
        'POWIAT KOŚCIAŃSKI' => 'POWIAT KOŚCIAŃSKI',
        'POWIAT KOŚCIERSKI' => 'POWIAT KOŚCIERSKI',
        'POWIAT KOZIENICKI' => 'POWIAT KOZIENICKI',
        'POWIAT KRAKOWSKI' => 'POWIAT KRAKOWSKI',
        'POWIAT KRAKÓW' => 'POWIAT KRAKÓW',
        'POWIAT KRAPKOWICKI' => 'POWIAT KRAPKOWICKI',
        'POWIAT KRASNOSTAWSKI' => 'POWIAT KRASNOSTAWSKI',
        'POWIAT KRAŚNICKI' => 'POWIAT KRAŚNICKI',
        'POWIAT KROSNO' => 'POWIAT KROSNO',
        'POWIAT KROŚNIEŃSKI' => 'POWIAT KROŚNIEŃSKI',
        'POWIAT KROTOSZYŃSKI' => 'POWIAT KROTOSZYŃSKI',
        'POWIAT KUTNOWSKI' => 'POWIAT KUTNOWSKI',
        'POWIAT KWIDZYŃSKI' => 'POWIAT KWIDZYŃSKI',
        'POWIAT LEGIONOWSKI' => 'POWIAT LEGIONOWSKI',
        'POWIAT LEGNICA' => 'POWIAT LEGNICA',
        'POWIAT LEGNICKI' => 'POWIAT LEGNICKI',
        'POWIAT LESKI' => 'POWIAT LESKI',
        'POWIAT LESZCZYŃSKI' => 'POWIAT LESZCZYŃSKI',
        'POWIAT LESZNO' => 'POWIAT LESZNO',
        'POWIAT LEŻAJSKI' => 'POWIAT LEŻAJSKI',
        'POWIAT LĘBORSKI' => 'POWIAT LĘBORSKI',
        'POWIAT LIDZBARSKI' => 'POWIAT LIDZBARSKI',
        'POWIAT LIMANOWSKI' => 'POWIAT LIMANOWSKI',
        'POWIAT LIPNOWSKI' => 'POWIAT LIPNOWSKI',
        'POWIAT LIPSKI' => 'POWIAT LIPSKI',
        'POWIAT LUBACZOWSKI' => 'POWIAT LUBACZOWSKI',
        'POWIAT LUBAŃSKI' => 'POWIAT LUBAŃSKI',
        'POWIAT LUBARTOWSKI' => 'POWIAT LUBARTOWSKI',
        'POWIAT LUBELSKI' => 'POWIAT LUBELSKI',
        'POWIAT LUBIŃSKI' => 'POWIAT LUBIŃSKI',
        'POWIAT LUBLIN' => 'POWIAT LUBLIN',
        'POWIAT LUBLINIECKI' => 'POWIAT LUBLINIECKI',
        'POWIAT LWÓWECKI' => 'POWIAT LWÓWECKI',
        'POWIAT ŁAŃCUCKI' => 'POWIAT ŁAŃCUCKI',
        'POWIAT ŁASKI' => 'POWIAT ŁASKI',
        'POWIAT ŁĘCZYCKI' => 'POWIAT ŁĘCZYCKI',
        'POWIAT ŁĘCZYŃSKI' => 'POWIAT ŁĘCZYŃSKI',
        'POWIAT ŁOBESKI' => 'POWIAT ŁOBESKI',
        'POWIAT ŁOMŻA' => 'POWIAT ŁOMŻA',
        'POWIAT ŁOMŻYŃSKI' => 'POWIAT ŁOMŻYŃSKI',
        'POWIAT ŁOSICKI' => 'POWIAT ŁOSICKI',
        'POWIAT ŁOWICKI' => 'POWIAT ŁOWICKI',
        'POWIAT ŁÓDZKI WSCHODNI' => 'POWIAT ŁÓDZKI WSCHODNI',
        'POWIAT ŁÓDŹ' => 'POWIAT ŁÓDŹ',
        'POWIAT ŁUKOWSKI' => 'POWIAT ŁUKOWSKI',
        'POWIAT MAKOWSKI' => 'POWIAT MAKOWSKI',
        'POWIAT MALBORSKI' => 'POWIAT MALBORSKI',
        'POWIAT MIECHOWSKI' => 'POWIAT MIECHOWSKI',
        'POWIAT MIELECKI' => 'POWIAT MIELECKI',
        'POWIAT MIĘDZYCHODZKI' => 'POWIAT MIĘDZYCHODZKI',
        'POWIAT MIĘDZYRZECKI' => 'POWIAT MIĘDZYRZECKI',
        'POWIAT MIKOŁOWSKI' => 'POWIAT MIKOŁOWSKI',
        'POWIAT MILICKI' => 'POWIAT MILICKI',
        'POWIAT MIŃSKI' => 'POWIAT MIŃSKI',
        'POWIAT MŁAWSKI' => 'POWIAT MŁAWSKI',
        'POWIAT MOGILEŃSKI' => 'POWIAT MOGILEŃSKI',
        'POWIAT MONIECKI' => 'POWIAT MONIECKI',
        'POWIAT MRĄGOWSKI' => 'POWIAT MRĄGOWSKI',
        'POWIAT MYSŁOWICE' => 'POWIAT MYSŁOWICE',
        'POWIAT MYSZKOWSKI' => 'POWIAT MYSZKOWSKI',
        'POWIAT MYŚLENICKI' => 'POWIAT MYŚLENICKI',
        'POWIAT MYŚLIBORSKI' => 'POWIAT MYŚLIBORSKI',
        'POWIAT NAKIELSKI' => 'POWIAT NAKIELSKI',
        'POWIAT NAMYSŁOWSKI' => 'POWIAT NAMYSŁOWSKI',
        'POWIAT NIDZICKI' => 'POWIAT NIDZICKI',
        'POWIAT NIŻAŃSKI' => 'POWIAT NIŻAŃSKI',
        'POWIAT NOWODWORSKI' => 'POWIAT NOWODWORSKI',
        'POWIAT NOWOMIEJSKI' => 'POWIAT NOWOMIEJSKI',
        'POWIAT NOWOSĄDECKI' => 'POWIAT NOWOSĄDECKI',
        'POWIAT NOWOSOLSKI' => 'POWIAT NOWOSOLSKI',
        'POWIAT NOWOTARSKI' => 'POWIAT NOWOTARSKI',
        'POWIAT NOWOTOMYSKI' => 'POWIAT NOWOTOMYSKI',
        'POWIAT NOWY SĄCZ' => 'POWIAT NOWY SĄCZ',
        'POWIAT NYSKI' => 'POWIAT NYSKI',
        'POWIAT OBORNICKI' => 'POWIAT OBORNICKI',
        'POWIAT OLECKI' => 'POWIAT OLECKI',
        'POWIAT OLESKI' => 'POWIAT OLESKI',
        'POWIAT OLEŚNICKI' => 'POWIAT OLEŚNICKI',
        'POWIAT OLKUSKI' => 'POWIAT OLKUSKI',
        'POWIAT OLSZTYN' => 'POWIAT OLSZTYN',
        'POWIAT OLSZTYŃSKI' => 'POWIAT OLSZTYŃSKI',
        'POWIAT OŁAWSKI' => 'POWIAT OŁAWSKI',
        'POWIAT OPATOWSKI' => 'POWIAT OPATOWSKI',
        'POWIAT OPOCZYŃSKI' => 'POWIAT OPOCZYŃSKI',
        'POWIAT OPOLE' => 'POWIAT OPOLE',
        'POWIAT OPOLSKI' => 'POWIAT OPOLSKI',
        'POWIAT OSTROŁĘCKI' => 'POWIAT OSTROŁĘCKI',
        'POWIAT OSTROŁĘKA' => 'POWIAT OSTROŁĘKA',
        'POWIAT OSTROWIECKI' => 'POWIAT OSTROWIECKI',
        'POWIAT OSTROWSKI' => 'POWIAT OSTROWSKI',
        'POWIAT OSTRÓDZKI' => 'POWIAT OSTRÓDZKI',
        'POWIAT OSTRZESZOWSKI' => 'POWIAT OSTRZESZOWSKI',
        'POWIAT OŚWIĘCIMSKI' => 'POWIAT OŚWIĘCIMSKI',
        'POWIAT OTWOCKI' => 'POWIAT OTWOCKI',
        'POWIAT PABIANICKI' => 'POWIAT PABIANICKI',
        'POWIAT PAJĘCZAŃSKI' => 'POWIAT PAJĘCZAŃSKI',
        'POWIAT PARCZEWSKI' => 'POWIAT PARCZEWSKI',
        'POWIAT PIASECZYŃSKI' => 'POWIAT PIASECZYŃSKI',
        'POWIAT PIEKARY ŚLĄSKIE' => 'POWIAT PIEKARY ŚLĄSKIE',
        'POWIAT PILSKI' => 'POWIAT PILSKI',
        'POWIAT PIŃCZOWSKI' => 'POWIAT PIŃCZOWSKI',
        'POWIAT PIOTRKOWSKI' => 'POWIAT PIOTRKOWSKI',
        'POWIAT PIOTRKÓW TRYBUNALSKI' => 'POWIAT PIOTRKÓW TRYBUNALSKI',
        'POWIAT PISKI' => 'POWIAT PISKI',
        'POWIAT PLESZEWSKI' => 'POWIAT PLESZEWSKI',
        'POWIAT PŁOCK' => 'POWIAT PŁOCK',
        'POWIAT PŁOCKI' => 'POWIAT PŁOCKI',
        'POWIAT PŁOŃSKI' => 'POWIAT PŁOŃSKI',
        'POWIAT PODDĘBICKI' => 'POWIAT PODDĘBICKI',
        'POWIAT POLICKI' => 'POWIAT POLICKI',
        'POWIAT POLKOWICKI' => 'POWIAT POLKOWICKI',
        'POWIAT POZNAŃ' => 'POWIAT POZNAŃ',
        'POWIAT POZNAŃSKI' => 'POWIAT POZNAŃSKI',
        'POWIAT PROSZOWICKI' => 'POWIAT PROSZOWICKI',
        'POWIAT PRUDNICKI' => 'POWIAT PRUDNICKI',
        'POWIAT PRUSZKOWSKI' => 'POWIAT PRUSZKOWSKI',
        'POWIAT PRZASNYSKI' => 'POWIAT PRZASNYSKI',
        'POWIAT PRZEMYSKI' => 'POWIAT PRZEMYSKI',
        'POWIAT PRZEMYŚL' => 'POWIAT PRZEMYŚL',
        'POWIAT PRZEWORSKI' => 'POWIAT PRZEWORSKI',
        'POWIAT PRZYSUSKI' => 'POWIAT PRZYSUSKI',
        'POWIAT PSZCZYŃSKI' => 'POWIAT PSZCZYŃSKI',
        'POWIAT PUCKI' => 'POWIAT PUCKI',
        'POWIAT PUŁAWSKI' => 'POWIAT PUŁAWSKI',
        'POWIAT PUŁTUSKI' => 'POWIAT PUŁTUSKI',
        'POWIAT PYRZYCKI' => 'POWIAT PYRZYCKI',
        'POWIAT RACIBORSKI' => 'POWIAT RACIBORSKI',
        'POWIAT RADOM' => 'POWIAT RADOM',
        'POWIAT RADOMSKI' => 'POWIAT RADOMSKI',
        'POWIAT RADOMSZCZAŃSKI' => 'POWIAT RADOMSZCZAŃSKI',
        'POWIAT RADZIEJOWSKI' => 'POWIAT RADZIEJOWSKI',
        'POWIAT RADZYŃSKI' => 'POWIAT RADZYŃSKI',
        'POWIAT RAWICKI' => 'POWIAT RAWICKI',
        'POWIAT RAWSKI' => 'POWIAT RAWSKI',
        'POWIAT ROPCZYCKO-SĘDZISZOWSKI' => 'POWIAT ROPCZYCKO-SĘDZISZOWSKI',
        'POWIAT RUDA ŚLĄSKA' => 'POWIAT RUDA ŚLĄSKA',
        'POWIAT RYBNICKI' => 'POWIAT RYBNICKI',
        'POWIAT RYBNIK' => 'POWIAT RYBNIK',
        'POWIAT RYCKI' => 'POWIAT RYCKI',
        'POWIAT RYPIŃSKI' => 'POWIAT RYPIŃSKI',
        'POWIAT RZESZOWSKI' => 'POWIAT RZESZOWSKI',
        'POWIAT RZESZÓW' => 'POWIAT RZESZÓW',
        'POWIAT SANDOMIERSKI' => 'POWIAT SANDOMIERSKI',
        'POWIAT SANOCKI' => 'POWIAT SANOCKI',
        'POWIAT SEJNEŃSKI' => 'POWIAT SEJNEŃSKI',
        'POWIAT SĘPOLEŃSKI' => 'POWIAT SĘPOLEŃSKI',
        'POWIAT SIEDLCE' => 'POWIAT SIEDLCE',
        'POWIAT SIEDLECKI' => 'POWIAT SIEDLECKI',
        'POWIAT SIEMIANOWICE ŚLĄSKIE' => 'POWIAT SIEMIANOWICE ŚLĄSKIE',
        'POWIAT SIEMIATYCKI' => 'POWIAT SIEMIATYCKI',
        'POWIAT SIERADZKI' => 'POWIAT SIERADZKI',
        'POWIAT SIERPECKI' => 'POWIAT SIERPECKI',
        'POWIAT SKARŻYSKI' => 'POWIAT SKARŻYSKI',
        'POWIAT SKIERNIEWICE' => 'POWIAT SKIERNIEWICE',
        'POWIAT SKIERNIEWICKI' => 'POWIAT SKIERNIEWICKI',
        'POWIAT SŁAWIEŃSKI' => 'POWIAT SŁAWIEŃSKI',
        'POWIAT SŁUBICKI' => 'POWIAT SŁUBICKI',
        'POWIAT SŁUPECKI' => 'POWIAT SŁUPECKI',
        'POWIAT SŁUPSK' => 'POWIAT SŁUPSK',
        'POWIAT SŁUPSKI' => 'POWIAT SŁUPSKI',
        'POWIAT SOCHACZEWSKI' => 'POWIAT SOCHACZEWSKI',
        'POWIAT SOKOŁOWSKI' => 'POWIAT SOKOŁOWSKI',
        'POWIAT SOKÓLSKI' => 'POWIAT SOKÓLSKI',
        'POWIAT SOPOT' => 'POWIAT SOPOT',
        'POWIAT SOSNOWIEC' => 'POWIAT SOSNOWIEC',
        'POWIAT STALOWOWOLSKI' => 'POWIAT STALOWOWOLSKI',
        'POWIAT STARACHOWICKI' => 'POWIAT STARACHOWICKI',
        'POWIAT STARGARDZKI' => 'POWIAT STARGARDZKI',
        'POWIAT STAROGARDZKI' => 'POWIAT STAROGARDZKI',
        'POWIAT STASZOWSKI' => 'POWIAT STASZOWSKI',
        'POWIAT STRZELECKI' => 'POWIAT STRZELECKI',
        'POWIAT STRZELECKO-DREZDENECKI' => 'POWIAT STRZELECKO-DREZDENECKI',
        'POWIAT STRZELIŃSKI' => 'POWIAT STRZELIŃSKI',
        'POWIAT STRZYŻOWSKI' => 'POWIAT STRZYŻOWSKI',
        'POWIAT SULĘCIŃSKI' => 'POWIAT SULĘCIŃSKI',
        'POWIAT SUSKI' => 'POWIAT SUSKI',
        'POWIAT SUWALSKI' => 'POWIAT SUWALSKI',
        'POWIAT SUWAŁKI' => 'POWIAT SUWAŁKI',
        'POWIAT SZAMOTULSKI' => 'POWIAT SZAMOTULSKI',
        'POWIAT SZCZECIN' => 'POWIAT SZCZECIN',
        'POWIAT SZCZECINECKI' => 'POWIAT SZCZECINECKI',
        'POWIAT SZCZYCIEŃSKI' => 'POWIAT SZCZYCIEŃSKI',
        'POWIAT SZTUMSKI' => 'POWIAT SZTUMSKI',
        'POWIAT SZYDŁOWIECKI' => 'POWIAT SZYDŁOWIECKI',
        'POWIAT ŚREDZKI' => 'POWIAT ŚREDZKI',
        'POWIAT ŚREMSKI' => 'POWIAT ŚREMSKI',
        'POWIAT ŚWIDNICKI' => 'POWIAT ŚWIDNICKI',
        'POWIAT ŚWIDWIŃSKI' => 'POWIAT ŚWIDWIŃSKI',
        'POWIAT ŚWIEBODZIŃSKI' => 'POWIAT ŚWIEBODZIŃSKI',
        'POWIAT ŚWIECKI' => 'POWIAT ŚWIECKI',
        'POWIAT ŚWIĘTOCHŁOWICE' => 'POWIAT ŚWIĘTOCHŁOWICE',
        'POWIAT ŚWINOUJŚCIE' => 'POWIAT ŚWINOUJŚCIE',
        'POWIAT TARNOBRZEG' => 'POWIAT TARNOBRZEG',
        'POWIAT TARNOBRZESKI' => 'POWIAT TARNOBRZESKI',
        'POWIAT TARNOGÓRSKI' => 'POWIAT TARNOGÓRSKI',
        'POWIAT TARNOWSKI' => 'POWIAT TARNOWSKI',
        'POWIAT TARNÓW' => 'POWIAT TARNÓW',
        'POWIAT TATRZAŃSKI' => 'POWIAT TATRZAŃSKI',
        'POWIAT TCZEWSKI' => 'POWIAT TCZEWSKI',
        'POWIAT TOMASZOWSKI' => 'POWIAT TOMASZOWSKI',
        'POWIAT TORUŃ' => 'POWIAT TORUŃ',
        'POWIAT TORUŃSKI' => 'POWIAT TORUŃSKI',
        'POWIAT TRZEBNICKI' => 'POWIAT TRZEBNICKI',
        'POWIAT TUCHOLSKI' => 'POWIAT TUCHOLSKI',
        'POWIAT TURECKI' => 'POWIAT TURECKI',
        'POWIAT TYCHY' => 'POWIAT TYCHY',
        'POWIAT WADOWICKI' => 'POWIAT WADOWICKI',
        'POWIAT WAŁBRZYCH' => 'POWIAT WAŁBRZYCH',
        'POWIAT WAŁBRZYSKI' => 'POWIAT WAŁBRZYSKI',
        'POWIAT WAŁECKI' => 'POWIAT WAŁECKI',
        'POWIAT WARSZAWA' => 'POWIAT WARSZAWA',
        'POWIAT WARSZAWSKI ZACHODNI' => 'POWIAT WARSZAWSKI ZACHODNI',
        'POWIAT WĄBRZESKI' => 'POWIAT WĄBRZESKI',
        'POWIAT WĄGROWIECKI' => 'POWIAT WĄGROWIECKI',
        'POWIAT WEJHEROWSKI' => 'POWIAT WEJHEROWSKI',
        'POWIAT WĘGORZEWSKI' => 'POWIAT WĘGORZEWSKI',
        'POWIAT WĘGROWSKI' => 'POWIAT WĘGROWSKI',
        'POWIAT WIELICKI' => 'POWIAT WIELICKI',
        'POWIAT WIELUŃSKI' => 'POWIAT WIELUŃSKI',
        'POWIAT WIERUSZOWSKI' => 'POWIAT WIERUSZOWSKI',
        'POWIAT WŁOCŁAWEK' => 'POWIAT WŁOCŁAWEK',
        'POWIAT WŁOCŁAWSKI' => 'POWIAT WŁOCŁAWSKI',
        'POWIAT WŁODAWSKI' => 'POWIAT WŁODAWSKI',
        'POWIAT WŁOSZCZOWSKI' => 'POWIAT WŁOSZCZOWSKI',
        'POWIAT WODZISŁAWSKI' => 'POWIAT WODZISŁAWSKI',
        'POWIAT WOLSZTYŃSKI' => 'POWIAT WOLSZTYŃSKI',
        'POWIAT WOŁOMIŃSKI' => 'POWIAT WOŁOMIŃSKI',
        'POWIAT WOŁOWSKI' => 'POWIAT WOŁOWSKI',
        'POWIAT WROCŁAW' => 'POWIAT WROCŁAW',
        'POWIAT WROCŁAWSKI' => 'POWIAT WROCŁAWSKI',
        'POWIAT WRZESIŃSKI' => 'POWIAT WRZESIŃSKI',
        'POWIAT WSCHOWSKI' => 'POWIAT WSCHOWSKI',
        'POWIAT WYSOKOMAZOWIECKI' => 'POWIAT WYSOKOMAZOWIECKI',
        'POWIAT WYSZKOWSKI' => 'POWIAT WYSZKOWSKI',
        'POWIAT ZABRZE' => 'POWIAT ZABRZE',
        'POWIAT ZAMBROWSKI' => 'POWIAT ZAMBROWSKI',
        'POWIAT ZAMOJSKI' => 'POWIAT ZAMOJSKI',
        'POWIAT ZAMOŚĆ' => 'POWIAT ZAMOŚĆ',
        'POWIAT ZAWIERCIAŃSKI' => 'POWIAT ZAWIERCIAŃSKI',
        'POWIAT ZĄBKOWICKI' => 'POWIAT ZĄBKOWICKI',
        'POWIAT ZDUŃSKOWOLSKI' => 'POWIAT ZDUŃSKOWOLSKI',
        'POWIAT ZGIERSKI' => 'POWIAT ZGIERSKI',
        'POWIAT ZGORZELECKI' => 'POWIAT ZGORZELECKI',
        'POWIAT ZIELONA GÓRA' => 'POWIAT ZIELONA GÓRA',
        'POWIAT ZIELONOGÓRSKI' => 'POWIAT ZIELONOGÓRSKI',
        'POWIAT ZŁOTORYJSKI' => 'POWIAT ZŁOTORYJSKI',
        'POWIAT ZŁOTOWSKI' => 'POWIAT ZŁOTOWSKI',
        'POWIAT ZWOLEŃSKI' => 'POWIAT ZWOLEŃSKI',
        'POWIAT ŻAGAŃSKI' => 'POWIAT ŻAGAŃSKI',
        'POWIAT ŻARSKI' => 'POWIAT ŻARSKI',
        'POWIAT ŻNIŃSKI' => 'POWIAT ŻNIŃSKI',
        'POWIAT ŻORY' => 'POWIAT ŻORY',
        'POWIAT ŻUROMIŃSKI' => 'POWIAT ŻUROMIŃSKI',
        'POWIAT ŻYRARDOWSKI' => 'POWIAT ŻYRARDOWSKI',
        'POWIAT ŻYWIECKI' => 'POWIAT ŻYWIECKI',
    ];

    const ACCIDENT_TYPES = [
        'Zderzenie pojazdów czołowe' => '01',
        'Zderzenie pojazdów boczne' => '02',
        'Zderzenie pojazdów tylne' => '03',
        'Najechanie na pieszego' => '04',
        'Najechanie na pojazd unieruchomiony' => '05',
        'Najechanie na drzewo, słup, inny obiekt drogowy' => '06',
        'Najechanie na drzewo' => 'A1',
        'Najechanie na słup, znak' => 'A2',
        'Najechanie na zapore kolejową' => '07',
        'Najechanie na dziurę, wybój, garb' => '08',
        'Najechanie na zwierzę' => '09',
        'Najechanie na barierę ochronną' => 'A3',
        'Wywrócenie się pojazdu' => '10',
        'Wypadek z pasażerem' => '11',
        'Inne' => '12',
    ];

    const DRIVERS_CAUSES = [
        'Niedostosowanie prędkości do warunków ruchu' => '01',
        'Nieudzielenie pierwszeństwa przejazdu' => '02',
        'Nieudzielenie pierwszeństwa pieszemu' => 'A1',
        'Nieprawidłowe: wyprzedzanie' => '03',
        'Nieprawidłowe: omijanie' => '04',
        'Nieprawidłowe: wymijanie' => '05',
        'Nieprawidłowe: przejeżdżanie przejścia dla pieszych' => '06',
        'Nieprawidłowe: przejeżdżanie przejścia dla rowerów' => 'A2',
        'Nieprawidłowe: skręcanie' => '07',
        'Nieprawidłowe: zmienianie pasa ruchu' => 'A3',
        'Nieprawidłowe: Zawracanie' => 'A4',
        'Nieprawidłowe: zatrzymywanie, postój' => '08',
        'Nieprawidłowe: cofanie' => '09',
        'Jazda po niewłaściwej stronie drogi' => '10',
        'Wjazd przy czerwonym świetle' => '11',
        'Nieprzestrzeganie innych sygnałów' => '12',
        'Niezachowanie bezp. odl. między pojazdami' => '13',
        'Gwałtowne hamowanie' => '14',
        'Jazda bez wymaganego oświetlenia' => '15',
        'Zmęczenie, zaśnięcie' => '16',
        'Ograniczenie sprawności psychomotorycznej' => '17',
        'Nieustąpienie pierwszeństwa pieszemu na przejściu dla pieszych' => 'A1_2015',
        'Nieustąpienie pierwszeństwa pieszemu przy skręcaniu w drogę poprzeczną' => 'A11_2015',
        'Wyprzedzanie pojazdu przed przejściem dla pieszych' => 'A12_2015',
        'Omijanie pojazdu przed przejściem dla pieszych' => '06_2015',
        'Nieprawidłowe przejeżdżanie przejazdu dla rowerzystów' => 'A2_2015',
        'Nieustąpienie pierwszeństwa pieszemu w innych okolicznościach' => 'B1',
        'Niestosowanie się do sygnalizacji świetlnej' => 'B3',
        'Inne przyczyny' => 'B2',
        'Inne' => '18',
    ];

    const PEDESTRIAN_CAUSES = [
        'Stanie na jezdni, leżenie' => '01',
        'Chodzenie nieprawidłową stroną drogi' => '02',
        'Wejście na jezdnię przy czerwonym świetle' => '03',
        'Nieostrożne wejście na jezdnię: przed jadącym pojazdem' => '04',
        'Nieostrożne wejście na jezdnię: zza pojazdu, przeszkody' => '05',
        'Zatrzymanie, cofnięcie się' => '06',
        'Przebieganie przez jezdnię' => '07',
        'Przekraczanie jezdni w miejscu niedozwolonym' => '08',
        'Chodzenie po torowisku' => '09',
        'Wskakiwanie do pojazdu w ruchu' => '10',
        'Dzieci do lat 7: zabawa na jezdni' => '11',
        'Dzieci do lat 7: wtargnięcie na jezdnię' => '12',
        'Inne' => '13',
        'Inne przyczyny' => 'B1',
    ];

    const ACCIDENT_SITE = [
        'Jezdnia' => 'A1',
        'Pas dzielący jezdnie' => '12',
        'Pobocze' => '11',
        'Skarpa, rów' => 'A2',
        'Chodnik, droga dla pieszych' => '10',
        'Droga dla rowerzystów' => 'A3',
        'Przejście dla pieszych' => '01',
        'Przystanek komunikacji publicznej' => '02',
        'Przystanek tramwajowy' => '03',
        'Torowisko tramwajowe wydzielone' => '04',
        'Torowisko tramwajowe w jezdni' => '05',
        'Przejazd tramwajowy, torowisko' => 'A4',
        'Przejazd kolejowy strzeżony' => '06',
        'Przejazd kolejowy niestrzeżony' => '07',
        'Most, wiadukt, estakada' => '08',
        'Tunel' => '09',
        'Most, wiadukt, łącznica, tunel' => 'A5',
        'Przewiązka na drodze dwujezdniowej' => '13',
        'Parking, plac' => 'A6',
        'Wjazd, wyjazd z posesji, pola' => '14',
        'Inne' => '15',
        'Roboty drogowe, oznakowanie tymczasowe' => 'A7',
        'Droga, pas ruchu, śluza dla rowerów' => 'A3_2015',
        'Przejazd dla rowerzystów' => 'B1',
        'Parking, plac, MOP' => 'A6_2015',
    ];

    const ACCIDENT_LIGHT = [
        'Światło dzienne' => '01',
        'Zmrok, świt' => '02',
        'Noc - droga oświetlona' => '03',
        'Noc - droga niedostatecznie oświetlona' => '04',
        'Noc - droga nieoświetlona' => '05',
    ];

    const ACCIDENT_OTHER_CAUSES = [
        'Pożar pojazdu' => '01',
        'Niezawiniona niesprawność techniczna pojazdu' => '02',
        'Niewłaściwy stan jezdni' => '03',
        'Nieprawidłowa organizacja ruchu' => '04',
        'Nieprawidłowo zabezp. roboty drogowe' => '05',
        'Nieprawidłowo działająca sygn. świetlna' => '06',
        'Nieprawidłowo działająca zapora, rogatka' => '07',
        'Obiekty, zwierzęta na drodze' => '08',
        'Nagłe zasłabnięcie kierującego' => '09',
        'Oślepienie przez inny pojazd lub słońce' => '10',
        'Z winy pasażera: wyskak. z pojazdu w ruchu' => 'A1',
        'Z winy pasażera: wypadnięcie' => 'A2',
        'Z winy pasażera' => 'A3',
        'Nieustalone' => 'A4',
        'Inne, nieustalone' => '11',
        'Inne' => 'A5',
        'Niesprawność techniczna pojazdu' => '02_2015',
        'Utrata przytomności, śmierć kierującego' => '09_2015',
    ];
    const ACCIDENT_TRAFFIC_LIGHT = [
        'Jest, działa' => '01',
        'Jest, nie działa' => '02',
        'Brak' => '03',

    ];

    private $accidentsFilter;

    public function __construct(array $accidentsFilter)
    {
        $this->accidentsFilter = $accidentsFilter;
    }

    public function getAccidentsFilterSql(): string
    {
        if (!empty($this->accidentsFilter)) {
            $query = implode(' AND ', $this->accidentsFilter);
        } else {
            $query = '';
        }
        $query = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $query); //delete multiple spaces, newlines, etc.
        $query = trim($query);

        return $query;
    }
}
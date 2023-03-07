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

    const VEHICLE_TYPE_BICYCLE = 'IS201'; //Rower
    const VEHICLE_TYPE_MOPED = 'IS202'; //Motorower
    const VEHICLE_TYPE_MOTORBIKE = 'IS227,IS228'; //Motocykl
    const VEHICLE_TYPE_CAR = 'IS221'; //Samochód osobowy
    const VEHICLE_TYPE_BUS = 'IS207,IS208'; //Autobus
    const VEHICLE_TYPE_TRUCK = 'IS231,IS232'; //Samochód ciężarowy
    const VEHICLE_TYPE_TRACTOR = 'IS222'; //Ciągnik rolniczy
    const VEHICLE_TYPE_TRAIN = 'IS218'; //Pociąg
    const VEHICLE_TYPE_TRAM_TROLLEY = 'IS223'; //Tramwaj, trolejbus
    const VEHICLE_TYPE_OTHER = 'IS220'; //Inny pojazd
    const VEHICLE_TYPE_UNKNOWN = 'IS225'; //Nieustalony
    const VEHICLE_TYPE_QUAD = 'IS229,IS230'; //Czterokołowiec
    const VEHICLE_TYPE_ELECTRIC_SCOOTER = 'IS240'; //hulajnoga elektryczna
    const VEHICLE_TYPE_PERSONAL_TRANSPORT = 'IS241'; //urządzenie transportu osobistego

    const VEHICLE_TYPES = [
        'Rower' => self::VEHICLE_TYPE_BICYCLE,
        'Motorower' => self::VEHICLE_TYPE_MOPED,
        'Motocykl' => self::VEHICLE_TYPE_MOTORBIKE,
        'Hulajnoga elektryczna (od 2022)' => self::VEHICLE_TYPE_ELECTRIC_SCOOTER,
        'Urządzenie transportu osobistego' => self::VEHICLE_TYPE_PERSONAL_TRANSPORT,
        'Czterokołowiec (od 11.2015)' => self::VEHICLE_TYPE_QUAD,
        'Samochód osobowy' => self::VEHICLE_TYPE_CAR,
        'Samochód ciężarowy' => self::VEHICLE_TYPE_TRUCK,
        'Autobus' => self::VEHICLE_TYPE_BUS,
        'Tramwaj, trolejbus' => self::VEHICLE_TYPE_TRAM_TROLLEY,
        'Traktor' => self::VEHICLE_TYPE_TRACTOR,
        'Pociąg' => self::VEHICLE_TYPE_TRAIN,
        'Inny' => self::VEHICLE_TYPE_OTHER,
        'Nieznany' => self::VEHICLE_TYPE_UNKNOWN,
    ];

    const COUNTIES = [
        'ALEKSANDROWSKI' => 'POWIAT ALEKSANDROWSKI',
        'AUGUSTOWSKI' => 'POWIAT AUGUSTOWSKI',
        'BARTOSZYCKI' => 'POWIAT BARTOSZYCKI',
        'BEŁCHATOWSKI' => 'POWIAT BEŁCHATOWSKI',
        'BĘDZIŃSKI' => 'POWIAT BĘDZIŃSKI',
        'BIALSKI' => 'POWIAT BIALSKI',
        'BIAŁA PODLASKA' => 'POWIAT BIAŁA PODLASKA',
        'BIAŁOBRZESKI' => 'POWIAT BIAŁOBRZESKI',
        'BIAŁOGARDZKI' => 'POWIAT BIAŁOGARDZKI',
        'BIAŁOSTOCKI' => 'POWIAT BIAŁOSTOCKI',
        'BIAŁYSTOK' => 'POWIAT BIAŁYSTOK',
        'BIELSKI' => 'POWIAT BIELSKI',
        'BIELSKO-BIAŁA' => 'POWIAT BIELSKO-BIAŁA',
        'BIERUŃSKO-LĘDZIŃSKI' => 'POWIAT BIERUŃSKO-LĘDZIŃSKI',
        'BIESZCZADZKI' => 'POWIAT BIESZCZADZKI',
        'BIŁGORAJSKI' => 'POWIAT BIŁGORAJSKI',
        'BOCHEŃSKI' => 'POWIAT BOCHEŃSKI',
        'BOLESŁAWIECKI' => 'POWIAT BOLESŁAWIECKI',
        'BRANIEWSKI' => 'POWIAT BRANIEWSKI',
        'BRODNICKI' => 'POWIAT BRODNICKI',
        'BRZESKI' => 'POWIAT BRZESKI',
        'BRZEZINY' => 'POWIAT BRZEZINY',
        'BRZEZIŃSKI' => 'POWIAT BRZEZIŃSKI',
        'BRZOZOWSKI' => 'POWIAT BRZOZOWSKI',
        'BUSKI' => 'POWIAT BUSKI',
        'BYDGOSKI' => 'POWIAT BYDGOSKI',
        'BYDGOSZCZ' => 'POWIAT BYDGOSZCZ',
        'BYTOM' => 'POWIAT BYTOM',
        'BYTOWSKI' => 'POWIAT BYTOWSKI',
        'CHEŁM' => 'POWIAT CHEŁM',
        'CHEŁMIŃSKI' => 'POWIAT CHEŁMIŃSKI',
        'CHEŁMSKI' => 'POWIAT CHEŁMSKI',
        'CHODZIESKI' => 'POWIAT CHODZIESKI',
        'CHOJNICKI' => 'POWIAT CHOJNICKI',
        'CHORZÓW' => 'POWIAT CHORZÓW',
        'CHOSZCZEŃSKI' => 'POWIAT CHOSZCZEŃSKI',
        'CHRZANOWSKI' => 'POWIAT CHRZANOWSKI',
        'CIECHANOWSKI' => 'POWIAT CIECHANOWSKI',
        'CIESZYŃSKI' => 'POWIAT CIESZYŃSKI',
        'CZARNKOWSKO-TRZCIANECKI' => 'POWIAT CZARNKOWSKO-TRZCIANECKI',
        'CZĘSTOCHOWA' => 'POWIAT CZĘSTOCHOWA',
        'CZĘSTOCHOWSKI' => 'POWIAT CZĘSTOCHOWSKI',
        'CZŁUCHOWSKI' => 'POWIAT CZŁUCHOWSKI',
        'DĄBROWA GÓRNICZA' => 'POWIAT DĄBROWA GÓRNICZA',
        'DĄBROWSKI' => 'POWIAT DĄBROWSKI',
        'DĘBICKI' => 'POWIAT DĘBICKI',
        'DRAWSKI' => 'POWIAT DRAWSKI',
        'DZIAŁDOWSKI' => 'POWIAT DZIAŁDOWSKI',
        'DZIERŻONIOWSKI' => 'POWIAT DZIERŻONIOWSKI',
        'ELBLĄG' => 'POWIAT ELBLĄG',
        'ELBLĄSKI' => 'POWIAT ELBLĄSKI',
        'EŁCKI' => 'POWIAT EŁCKI',
        'GARWOLIŃSKI' => 'POWIAT GARWOLIŃSKI',
        'GDAŃSK' => 'POWIAT GDAŃSK',
        'GDAŃSKI' => 'POWIAT GDAŃSKI',
        'GDYNIA' => 'POWIAT GDYNIA',
        'GIŻYCKI' => 'POWIAT GIŻYCKI',
        'GLIWICE' => 'POWIAT GLIWICE',
        'GLIWICKI' => 'POWIAT GLIWICKI',
        'GŁOGOWSKI' => 'POWIAT GŁOGOWSKI',
        'GŁUBCZYCKI' => 'POWIAT GŁUBCZYCKI',
        'GNIEŹNIEŃSKI' => 'POWIAT GNIEŹNIEŃSKI',
        'GOLENIOWSKI' => 'POWIAT GOLENIOWSKI',
        'GOLUBSKO-DOBRZYŃSKI' => 'POWIAT GOLUBSKO-DOBRZYŃSKI',
        'GOŁDAPSKI' => 'POWIAT GOŁDAPSKI',
        'GORLICKI' => 'POWIAT GORLICKI',
        'GORZOWSKI' => 'POWIAT GORZOWSKI',
        'GORZÓW WIELKOPOLSKI' => 'POWIAT GORZÓW WIELKOPOLSKI',
        'GOSTYNIŃSKI' => 'POWIAT GOSTYNIŃSKI',
        'GOSTYŃSKI' => 'POWIAT GOSTYŃSKI',
        'GÓROWSKI' => 'POWIAT GÓROWSKI',
        'GRAJEWSKI' => 'POWIAT GRAJEWSKI',
        'GRODZISKI' => 'POWIAT GRODZISKI',
        'GRÓJECKI' => 'POWIAT GRÓJECKI',
        'GRUDZIĄDZ' => 'POWIAT GRUDZIĄDZ',
        'GRUDZIĄDZKI' => 'POWIAT GRUDZIĄDZKI',
        'GRYFICKI' => 'POWIAT GRYFICKI',
        'GRYFIŃSKI' => 'POWIAT GRYFIŃSKI',
        'HAJNOWSKI' => 'POWIAT HAJNOWSKI',
        'HRUBIESZOWSKI' => 'POWIAT HRUBIESZOWSKI',
        'IŁAWSKI' => 'POWIAT IŁAWSKI',
        'INOWROCŁAWSKI' => 'POWIAT INOWROCŁAWSKI',
        'JANOWSKI' => 'POWIAT JANOWSKI',
        'JAROCIŃSKI' => 'POWIAT JAROCIŃSKI',
        'JAROSŁAWSKI' => 'POWIAT JAROSŁAWSKI',
        'JASIELSKI' => 'POWIAT JASIELSKI',
        'JASTRZĘBIE-ZDRÓJ' => 'POWIAT JASTRZĘBIE-ZDRÓJ',
        'JAWORSKI' => 'POWIAT JAWORSKI',
        'JAWORZNO' => 'POWIAT JAWORZNO',
        'JELENIA GÓRA' => 'POWIAT JELENIA GÓRA',
        'JELENIOGÓRSKI' => 'POWIAT JELENIOGÓRSKI',
        'JĘDRZEJOWSKI' => 'POWIAT JĘDRZEJOWSKI',
        'KALISKI' => 'POWIAT KALISKI',
        'KALISZ' => 'POWIAT KALISZ',
        'KAMIENNOGÓRSKI' => 'POWIAT KAMIENNOGÓRSKI',
        'KAMIEŃSKI' => 'POWIAT KAMIEŃSKI',
        'KARTUSKI' => 'POWIAT KARTUSKI',
        'KATOWICE' => 'POWIAT KATOWICE',
        'KAZIMIERSKI' => 'POWIAT KAZIMIERSKI',
        'KĘDZIERZYŃSKO-KOZIELSKI' => 'POWIAT KĘDZIERZYŃSKO-KOZIELSKI',
        'KĘPIŃSKI' => 'POWIAT KĘPIŃSKI',
        'KĘTRZYŃSKI' => 'POWIAT KĘTRZYŃSKI',
        'KIELCE' => 'POWIAT KIELCE',
        'KIELECKI' => 'POWIAT KIELECKI',
        'KLUCZBORSKI' => 'POWIAT KLUCZBORSKI',
        'KŁOBUCKI' => 'POWIAT KŁOBUCKI',
        'KŁODZKI' => 'POWIAT KŁODZKI',
        'KOLBUSZOWSKI' => 'POWIAT KOLBUSZOWSKI',
        'KOLNEŃSKI' => 'POWIAT KOLNEŃSKI',
        'KOLSKI' => 'POWIAT KOLSKI',
        'KOŁOBRZESKI' => 'POWIAT KOŁOBRZESKI',
        'KONECKI' => 'POWIAT KONECKI',
        'KONIN' => 'POWIAT KONIN',
        'KONIŃSKI' => 'POWIAT KONIŃSKI',
        'KOSZALIN' => 'POWIAT KOSZALIN',
        'KOSZALIŃSKI' => 'POWIAT KOSZALIŃSKI',
        'KOŚCIAŃSKI' => 'POWIAT KOŚCIAŃSKI',
        'KOŚCIERSKI' => 'POWIAT KOŚCIERSKI',
        'KOZIENICKI' => 'POWIAT KOZIENICKI',
        'KRAKOWSKI' => 'POWIAT KRAKOWSKI',
        'KRAKÓW' => 'POWIAT KRAKÓW',
        'KRAPKOWICKI' => 'POWIAT KRAPKOWICKI',
        'KRASNOSTAWSKI' => 'POWIAT KRASNOSTAWSKI',
        'KRAŚNICKI' => 'POWIAT KRAŚNICKI',
        'KROSNO' => 'POWIAT KROSNO',
        'KROŚNIEŃSKI' => 'POWIAT KROŚNIEŃSKI',
        'KROTOSZYŃSKI' => 'POWIAT KROTOSZYŃSKI',
        'KUTNOWSKI' => 'POWIAT KUTNOWSKI',
        'KWIDZYŃSKI' => 'POWIAT KWIDZYŃSKI',
        'LEGIONOWSKI' => 'POWIAT LEGIONOWSKI',
        'LEGNICA' => 'POWIAT LEGNICA',
        'LEGNICKI' => 'POWIAT LEGNICKI',
        'LESKI' => 'POWIAT LESKI',
        'LESZCZYŃSKI' => 'POWIAT LESZCZYŃSKI',
        'LESZNO' => 'POWIAT LESZNO',
        'LEŻAJSKI' => 'POWIAT LEŻAJSKI',
        'LĘBORSKI' => 'POWIAT LĘBORSKI',
        'LIDZBARSKI' => 'POWIAT LIDZBARSKI',
        'LIMANOWSKI' => 'POWIAT LIMANOWSKI',
        'LIPNOWSKI' => 'POWIAT LIPNOWSKI',
        'LIPSKI' => 'POWIAT LIPSKI',
        'LUBACZOWSKI' => 'POWIAT LUBACZOWSKI',
        'LUBAŃSKI' => 'POWIAT LUBAŃSKI',
        'LUBARTOWSKI' => 'POWIAT LUBARTOWSKI',
        'LUBELSKI' => 'POWIAT LUBELSKI',
        'LUBIŃSKI' => 'POWIAT LUBIŃSKI',
        'LUBLIN' => 'POWIAT LUBLIN',
        'LUBLINIECKI' => 'POWIAT LUBLINIECKI',
        'LWÓWECKI' => 'POWIAT LWÓWECKI',
        'ŁAŃCUCKI' => 'POWIAT ŁAŃCUCKI',
        'ŁASKI' => 'POWIAT ŁASKI',
        'ŁĘCZYCKI' => 'POWIAT ŁĘCZYCKI',
        'ŁĘCZYŃSKI' => 'POWIAT ŁĘCZYŃSKI',
        'ŁOBESKI' => 'POWIAT ŁOBESKI',
        'ŁOMŻA' => 'POWIAT ŁOMŻA',
        'ŁOMŻYŃSKI' => 'POWIAT ŁOMŻYŃSKI',
        'ŁOSICKI' => 'POWIAT ŁOSICKI',
        'ŁOWICKI' => 'POWIAT ŁOWICKI',
        'ŁÓDZKI WSCHODNI' => 'POWIAT ŁÓDZKI WSCHODNI',
        'ŁÓDŹ' => 'POWIAT ŁÓDŹ',
        'ŁUKOWSKI' => 'POWIAT ŁUKOWSKI',
        'MAKOWSKI' => 'POWIAT MAKOWSKI',
        'MALBORSKI' => 'POWIAT MALBORSKI',
        'MIECHOWSKI' => 'POWIAT MIECHOWSKI',
        'MIELECKI' => 'POWIAT MIELECKI',
        'MIĘDZYCHODZKI' => 'POWIAT MIĘDZYCHODZKI',
        'MIĘDZYRZECKI' => 'POWIAT MIĘDZYRZECKI',
        'MIKOŁOWSKI' => 'POWIAT MIKOŁOWSKI',
        'MILICKI' => 'POWIAT MILICKI',
        'MIŃSKI' => 'POWIAT MIŃSKI',
        'MŁAWSKI' => 'POWIAT MŁAWSKI',
        'MOGILEŃSKI' => 'POWIAT MOGILEŃSKI',
        'MONIECKI' => 'POWIAT MONIECKI',
        'MRĄGOWSKI' => 'POWIAT MRĄGOWSKI',
        'MYSŁOWICE' => 'POWIAT MYSŁOWICE',
        'MYSZKOWSKI' => 'POWIAT MYSZKOWSKI',
        'MYŚLENICKI' => 'POWIAT MYŚLENICKI',
        'MYŚLIBORSKI' => 'POWIAT MYŚLIBORSKI',
        'NAKIELSKI' => 'POWIAT NAKIELSKI',
        'NAMYSŁOWSKI' => 'POWIAT NAMYSŁOWSKI',
        'NIDZICKI' => 'POWIAT NIDZICKI',
        'NIŻAŃSKI' => 'POWIAT NIŻAŃSKI',
        'NOWODWORSKI' => 'POWIAT NOWODWORSKI',
        'NOWOMIEJSKI' => 'POWIAT NOWOMIEJSKI',
        'NOWOSĄDECKI' => 'POWIAT NOWOSĄDECKI',
        'NOWOSOLSKI' => 'POWIAT NOWOSOLSKI',
        'NOWOTARSKI' => 'POWIAT NOWOTARSKI',
        'NOWOTOMYSKI' => 'POWIAT NOWOTOMYSKI',
        'NOWY SĄCZ' => 'POWIAT NOWY SĄCZ',
        'NYSKI' => 'POWIAT NYSKI',
        'OBORNICKI' => 'POWIAT OBORNICKI',
        'OLECKI' => 'POWIAT OLECKI',
        'OLESKI' => 'POWIAT OLESKI',
        'OLEŚNICKI' => 'POWIAT OLEŚNICKI',
        'OLKUSKI' => 'POWIAT OLKUSKI',
        'OLSZTYN' => 'POWIAT OLSZTYN',
        'OLSZTYŃSKI' => 'POWIAT OLSZTYŃSKI',
        'OŁAWSKI' => 'POWIAT OŁAWSKI',
        'OPATOWSKI' => 'POWIAT OPATOWSKI',
        'OPOCZYŃSKI' => 'POWIAT OPOCZYŃSKI',
        'OPOLE' => 'POWIAT OPOLE',
        'OPOLSKI' => 'POWIAT OPOLSKI',
        'OSTROŁĘCKI' => 'POWIAT OSTROŁĘCKI',
        'OSTROŁĘKA' => 'POWIAT OSTROŁĘKA',
        'OSTROWIECKI' => 'POWIAT OSTROWIECKI',
        'OSTROWSKI' => 'POWIAT OSTROWSKI',
        'OSTRÓDZKI' => 'POWIAT OSTRÓDZKI',
        'OSTRZESZOWSKI' => 'POWIAT OSTRZESZOWSKI',
        'OŚWIĘCIMSKI' => 'POWIAT OŚWIĘCIMSKI',
        'OTWOCKI' => 'POWIAT OTWOCKI',
        'PABIANICKI' => 'POWIAT PABIANICKI',
        'PAJĘCZAŃSKI' => 'POWIAT PAJĘCZAŃSKI',
        'PARCZEWSKI' => 'POWIAT PARCZEWSKI',
        'PIASECZYŃSKI' => 'POWIAT PIASECZYŃSKI',
        'PIEKARY ŚLĄSKIE' => 'POWIAT PIEKARY ŚLĄSKIE',
        'PILSKI' => 'POWIAT PILSKI',
        'PIŃCZOWSKI' => 'POWIAT PIŃCZOWSKI',
        'PIOTRKOWSKI' => 'POWIAT PIOTRKOWSKI',
        'PIOTRKÓW TRYBUNALSKI' => 'POWIAT PIOTRKÓW TRYBUNALSKI',
        'PISKI' => 'POWIAT PISKI',
        'PLESZEWSKI' => 'POWIAT PLESZEWSKI',
        'PŁOCK' => 'POWIAT PŁOCK',
        'PŁOCKI' => 'POWIAT PŁOCKI',
        'PŁOŃSKI' => 'POWIAT PŁOŃSKI',
        'PODDĘBICKI' => 'POWIAT PODDĘBICKI',
        'POLICKI' => 'POWIAT POLICKI',
        'POLKOWICKI' => 'POWIAT POLKOWICKI',
        'POZNAŃ' => 'POWIAT POZNAŃ',
        'POZNAŃSKI' => 'POWIAT POZNAŃSKI',
        'PROSZOWICKI' => 'POWIAT PROSZOWICKI',
        'PRUDNICKI' => 'POWIAT PRUDNICKI',
        'PRUSZKOWSKI' => 'POWIAT PRUSZKOWSKI',
        'PRZASNYSKI' => 'POWIAT PRZASNYSKI',
        'PRZEMYSKI' => 'POWIAT PRZEMYSKI',
        'PRZEMYŚL' => 'POWIAT PRZEMYŚL',
        'PRZEWORSKI' => 'POWIAT PRZEWORSKI',
        'PRZYSUSKI' => 'POWIAT PRZYSUSKI',
        'PSZCZYŃSKI' => 'POWIAT PSZCZYŃSKI',
        'PUCKI' => 'POWIAT PUCKI',
        'PUŁAWSKI' => 'POWIAT PUŁAWSKI',
        'PUŁTUSKI' => 'POWIAT PUŁTUSKI',
        'PYRZYCKI' => 'POWIAT PYRZYCKI',
        'RACIBORSKI' => 'POWIAT RACIBORSKI',
        'RADOM' => 'POWIAT RADOM',
        'RADOMSKI' => 'POWIAT RADOMSKI',
        'RADOMSZCZAŃSKI' => 'POWIAT RADOMSZCZAŃSKI',
        'RADZIEJOWSKI' => 'POWIAT RADZIEJOWSKI',
        'RADZYŃSKI' => 'POWIAT RADZYŃSKI',
        'RAWICKI' => 'POWIAT RAWICKI',
        'RAWSKI' => 'POWIAT RAWSKI',
        'ROPCZYCKO-SĘDZISZOWSKI' => 'POWIAT ROPCZYCKO-SĘDZISZOWSKI',
        'RUDA ŚLĄSKA' => 'POWIAT RUDA ŚLĄSKA',
        'RYBNICKI' => 'POWIAT RYBNICKI',
        'RYBNIK' => 'POWIAT RYBNIK',
        'RYCKI' => 'POWIAT RYCKI',
        'RYPIŃSKI' => 'POWIAT RYPIŃSKI',
        'RZESZOWSKI' => 'POWIAT RZESZOWSKI',
        'RZESZÓW' => 'POWIAT RZESZÓW',
        'SANDOMIERSKI' => 'POWIAT SANDOMIERSKI',
        'SANOCKI' => 'POWIAT SANOCKI',
        'SEJNEŃSKI' => 'POWIAT SEJNEŃSKI',
        'SĘPOLEŃSKI' => 'POWIAT SĘPOLEŃSKI',
        'SIEDLCE' => 'POWIAT SIEDLCE',
        'SIEDLECKI' => 'POWIAT SIEDLECKI',
        'SIEMIANOWICE ŚLĄSKIE' => 'POWIAT SIEMIANOWICE ŚLĄSKIE',
        'SIEMIATYCKI' => 'POWIAT SIEMIATYCKI',
        'SIERADZKI' => 'POWIAT SIERADZKI',
        'SIERPECKI' => 'POWIAT SIERPECKI',
        'SKARŻYSKI' => 'POWIAT SKARŻYSKI',
        'SKIERNIEWICE' => 'POWIAT SKIERNIEWICE',
        'SKIERNIEWICKI' => 'POWIAT SKIERNIEWICKI',
        'SŁAWIEŃSKI' => 'POWIAT SŁAWIEŃSKI',
        'SŁUBICKI' => 'POWIAT SŁUBICKI',
        'SŁUPECKI' => 'POWIAT SŁUPECKI',
        'SŁUPSK' => 'POWIAT SŁUPSK',
        'SŁUPSKI' => 'POWIAT SŁUPSKI',
        'SOCHACZEWSKI' => 'POWIAT SOCHACZEWSKI',
        'SOKOŁOWSKI' => 'POWIAT SOKOŁOWSKI',
        'SOKÓLSKI' => 'POWIAT SOKÓLSKI',
        'SOPOT' => 'POWIAT SOPOT',
        'SOSNOWIEC' => 'POWIAT SOSNOWIEC',
        'STALOWOWOLSKI' => 'POWIAT STALOWOWOLSKI',
        'STARACHOWICKI' => 'POWIAT STARACHOWICKI',
        'STARGARDZKI' => 'POWIAT STARGARDZKI',
        'STAROGARDZKI' => 'POWIAT STAROGARDZKI',
        'STASZOWSKI' => 'POWIAT STASZOWSKI',
        'STRZELECKI' => 'POWIAT STRZELECKI',
        'STRZELECKO-DREZDENECKI' => 'POWIAT STRZELECKO-DREZDENECKI',
        'STRZELIŃSKI' => 'POWIAT STRZELIŃSKI',
        'STRZYŻOWSKI' => 'POWIAT STRZYŻOWSKI',
        'SULĘCIŃSKI' => 'POWIAT SULĘCIŃSKI',
        'SUSKI' => 'POWIAT SUSKI',
        'SUWALSKI' => 'POWIAT SUWALSKI',
        'SUWAŁKI' => 'POWIAT SUWAŁKI',
        'SZAMOTULSKI' => 'POWIAT SZAMOTULSKI',
        'SZCZECIN' => 'POWIAT SZCZECIN',
        'SZCZECINECKI' => 'POWIAT SZCZECINECKI',
        'SZCZYCIEŃSKI' => 'POWIAT SZCZYCIEŃSKI',
        'SZTUMSKI' => 'POWIAT SZTUMSKI',
        'SZYDŁOWIECKI' => 'POWIAT SZYDŁOWIECKI',
        'ŚREDZKI' => 'POWIAT ŚREDZKI',
        'ŚREMSKI' => 'POWIAT ŚREMSKI',
        'ŚWIDNICKI' => 'POWIAT ŚWIDNICKI',
        'ŚWIDWIŃSKI' => 'POWIAT ŚWIDWIŃSKI',
        'ŚWIEBODZIŃSKI' => 'POWIAT ŚWIEBODZIŃSKI',
        'ŚWIECKI' => 'POWIAT ŚWIECKI',
        'ŚWIĘTOCHŁOWICE' => 'POWIAT ŚWIĘTOCHŁOWICE',
        'ŚWINOUJŚCIE' => 'POWIAT ŚWINOUJŚCIE',
        'TARNOBRZEG' => 'POWIAT TARNOBRZEG',
        'TARNOBRZESKI' => 'POWIAT TARNOBRZESKI',
        'TARNOGÓRSKI' => 'POWIAT TARNOGÓRSKI',
        'TARNOWSKI' => 'POWIAT TARNOWSKI',
        'TARNÓW' => 'POWIAT TARNÓW',
        'TATRZAŃSKI' => 'POWIAT TATRZAŃSKI',
        'TCZEWSKI' => 'POWIAT TCZEWSKI',
        'TOMASZOWSKI' => 'POWIAT TOMASZOWSKI',
        'TORUŃ' => 'POWIAT TORUŃ',
        'TORUŃSKI' => 'POWIAT TORUŃSKI',
        'TRZEBNICKI' => 'POWIAT TRZEBNICKI',
        'TUCHOLSKI' => 'POWIAT TUCHOLSKI',
        'TURECKI' => 'POWIAT TURECKI',
        'TYCHY' => 'POWIAT TYCHY',
        'WADOWICKI' => 'POWIAT WADOWICKI',
        'WAŁBRZYCH' => 'POWIAT WAŁBRZYCH',
        'WAŁBRZYSKI' => 'POWIAT WAŁBRZYSKI',
        'WAŁECKI' => 'POWIAT WAŁECKI',
        'WARSZAWA' => 'POWIAT WARSZAWA',
        'WARSZAWSKI ZACHODNI' => 'POWIAT WARSZAWSKI ZACHODNI',
        'WĄBRZESKI' => 'POWIAT WĄBRZESKI',
        'WĄGROWIECKI' => 'POWIAT WĄGROWIECKI',
        'WEJHEROWSKI' => 'POWIAT WEJHEROWSKI',
        'WĘGORZEWSKI' => 'POWIAT WĘGORZEWSKI',
        'WĘGROWSKI' => 'POWIAT WĘGROWSKI',
        'WIELICKI' => 'POWIAT WIELICKI',
        'WIELUŃSKI' => 'POWIAT WIELUŃSKI',
        'WIERUSZOWSKI' => 'POWIAT WIERUSZOWSKI',
        'WŁOCŁAWEK' => 'POWIAT WŁOCŁAWEK',
        'WŁOCŁAWSKI' => 'POWIAT WŁOCŁAWSKI',
        'WŁODAWSKI' => 'POWIAT WŁODAWSKI',
        'WŁOSZCZOWSKI' => 'POWIAT WŁOSZCZOWSKI',
        'WODZISŁAWSKI' => 'POWIAT WODZISŁAWSKI',
        'WOLSZTYŃSKI' => 'POWIAT WOLSZTYŃSKI',
        'WOŁOMIŃSKI' => 'POWIAT WOŁOMIŃSKI',
        'WOŁOWSKI' => 'POWIAT WOŁOWSKI',
        'WROCŁAW' => 'POWIAT WROCŁAW',
        'WROCŁAWSKI' => 'POWIAT WROCŁAWSKI',
        'WRZESIŃSKI' => 'POWIAT WRZESIŃSKI',
        'WSCHOWSKI' => 'POWIAT WSCHOWSKI',
        'WYSOKOMAZOWIECKI' => 'POWIAT WYSOKOMAZOWIECKI',
        'WYSZKOWSKI' => 'POWIAT WYSZKOWSKI',
        'ZABRZE' => 'POWIAT ZABRZE',
        'ZAMBROWSKI' => 'POWIAT ZAMBROWSKI',
        'ZAMOJSKI' => 'POWIAT ZAMOJSKI',
        'ZAMOŚĆ' => 'POWIAT ZAMOŚĆ',
        'ZAWIERCIAŃSKI' => 'POWIAT ZAWIERCIAŃSKI',
        'ZĄBKOWICKI' => 'POWIAT ZĄBKOWICKI',
        'ZDUŃSKOWOLSKI' => 'POWIAT ZDUŃSKOWOLSKI',
        'ZGIERSKI' => 'POWIAT ZGIERSKI',
        'ZGORZELECKI' => 'POWIAT ZGORZELECKI',
        'ZIELONA GÓRA' => 'POWIAT ZIELONA GÓRA',
        'ZIELONOGÓRSKI' => 'POWIAT ZIELONOGÓRSKI',
        'ZŁOTORYJSKI' => 'POWIAT ZŁOTORYJSKI',
        'ZŁOTOWSKI' => 'POWIAT ZŁOTOWSKI',
        'ZWOLEŃSKI' => 'POWIAT ZWOLEŃSKI',
        'ŻAGAŃSKI' => 'POWIAT ŻAGAŃSKI',
        'ŻARSKI' => 'POWIAT ŻARSKI',
        'ŻNIŃSKI' => 'POWIAT ŻNIŃSKI',
        'ŻORY' => 'POWIAT ŻORY',
        'ŻUROMIŃSKI' => 'POWIAT ŻUROMIŃSKI',
        'ŻYRARDOWSKI' => 'POWIAT ŻYRARDOWSKI',
        'ŻYWIECKI' => 'POWIAT ŻYWIECKI',
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
    const ACCIDENT_INTERSECTION_TYPE = [
        'Rejon skrzyżowania' => '05',
        'Równorzędne' => '06',
        'Z drogą z pierwsz.' => '07',
        'O ruchu okrężnym' => '08',
    ];
    const ACCIDENT_ROAD_TYPE = [
        'Autostrada' => '01',
        'Ekspresowa' => '02',
        'Dwie jezdnie jednokierunkowe' => '03',
        'Jednokierunkowa' => '04',
        'Jednojezdniowa dwukierunkowa' => '05',

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

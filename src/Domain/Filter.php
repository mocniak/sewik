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
    const PARTICIPANT_INJURY_DEATH = 'ZM';

    const PARTICIPANT_INJURIES = [
        'Ciężko ranny' => self::PARTICIPANT_INJURY_SERIOUS,
        'Lekko ranny' => self::PARTICIPANT_INJURY_MINOR,
        'Śmierć' => self::PARTICIPANT_INJURY_DEATH,
    ];


    const VEHICLE_TYPE_BICYCLE = 'IS01'; //Rower
    const VEHICLE_TYPE_MOPED = 'IS02'; //Motorower
    const VEHICLE_TYPE_MOTORBIKE = 'IS03'; //Motocykl
    const VEHICLE_TYPE_CAR = 'IS04'; //Samochód osobowy z przyczepą
    const VEHICLE_TYPE_TAXI = 'IS06'; //Samochód osobowy TAXI
    const VEHICLE_TYPE_BUS = 'IS07'; //Autobus komunikacji publicznej
    const VEHICLE_TYPE_TRUCK = 'IS09'; //Samochód ciężarowy
    const VEHICLE_TYPE_TRACTOR = 'IS12'; //Ciągnik rolniczy
    const VEHICLE_TYPE_SLOW_MOVING = 'IS14'; //Pojazd wolnobieżny
    const VEHICLE_TYPE_CART = 'IS17'; //Pojazd zaprzęgowy
    const VEHICLE_TYPE_TRAIN = 'IS18'; //Pociąg
    const VEHICLE_TYPE_EMERGENCY = 'IS19'; //Pojazd uprzywilejowany
    const VEHICLE_TYPE_OTHER = 'IS20'; //Inny pojazd
    const VEHICLE_TYPE_TRAM_TROLLEY = 'IS23'; //Tramwaj, trolejbus
    const VEHICLE_TYPE_UNKNOWN = 'IS25'; //Nieustalony
    const VEHICLE_TYPE_QUAD = 'IS29'; //Czterokołowiec lekki (od 11.2015)

    const VEHICLE_TYPES = [
        'Rower' => self::VEHICLE_TYPE_BICYCLE,
        'Skuter' => self::VEHICLE_TYPE_MOPED,
        'Motocykl' => self::VEHICLE_TYPE_MOTORBIKE,
        'Quad' => self::VEHICLE_TYPE_QUAD,
        'Samochód osobowy' => self::VEHICLE_TYPE_CAR,
        'Taksówka' => self::VEHICLE_TYPE_TAXI,
        'Ciężarówka' => self::VEHICLE_TYPE_TRUCK,
        'Autobus' => self::VEHICLE_TYPE_BUS,
        'Tramwaj, trolejbus' => self::VEHICLE_TYPE_TRAM_TROLLEY,
        'Traktor' => self::VEHICLE_TYPE_TRACTOR,
        'Pojazd wolnobieżny' => self::VEHICLE_TYPE_SLOW_MOVING,
        'Zaprzęg' => self::VEHICLE_TYPE_CART,
        'Pociąg' => self::VEHICLE_TYPE_TRAIN,
        'Pojazd uprzewilejowany' => self::VEHICLE_TYPE_EMERGENCY,
        'Inny' => self::VEHICLE_TYPE_OTHER,
        'Nieznany' => self::VEHICLE_TYPE_UNKNOWN,
    ];

    private $accidentsFilter;

    public function __construct(array $accidentsFilter)
    {
        $this->accidentsFilter = $accidentsFilter;
    }

    public function getAccidentsFilterSql(): string
    {
        if (!empty($this->accidentsFilter)) {
            $query = implode(' AND ', $this->accidentsFilter );
        } else {
            $query = '';
        }
        $query = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $query); //delete multiple spaces, newlines, etc.
        $query = trim($query);

        return $query;
    }
}
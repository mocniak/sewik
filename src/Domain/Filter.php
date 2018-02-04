<?php
namespace Sewik\Domain;

class Filter
{
    const ACCIDENTS_PLACEHOLDER = '%zdarzenie_filter%';

    const COLUMN_VOIVODESHIP = 'woj';
    const COLUMN_LOCALITY = 'miejscowosc';
    const COLUMN_DATE = 'data_zdarz';
    const COLUMN_STREET = 'ulica_adres';

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

    private $accidentsFilter;

    public function __construct(array $accidentsFilter)
    {
        $this->accidentsFilter = $accidentsFilter;
    }

    public function getAccidentsFilter(): array
    {
        return $this->accidentsFilter;
    }
}
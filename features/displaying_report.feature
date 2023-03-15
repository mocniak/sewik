Feature:
  Displaying number of accidents by time statistics

  Scenario: Number of accidents per year statistics
    Given there was an accident 1 on "2020-01-01"
    And there was an accident 2 on "2020-01-01"
    When I ask for accidents per year report
    Then I see 2 accidents in 2020

  Scenario: Number of accidents per year per county statistics
    Given there was an accident 1 on "2020-01-01" in "POWIAT WARSZAWA"
    And there was an accident 2 on "2020-01-01" in "POWIAT WARSZAWA"
    And there was an accident 3 on "2021-01-01" in "POWIAT WARSZAWA"
    And there was an accident 4 on "2022-01-01" in "POWIAT WARSZAWA"
    And there was an accident 5 on "2020-01-01" in "POWIAT WROCŁAW"
    And there was an accident 6 on "2022-01-01" in "POWIAT WROCŁAW"
    And there was an accident 7 on "2022-01-01" in "POWIAT WROCŁAW"
    And there was an accident 8 on "2022-01-01" in "POWIAT WROCŁAW"
    When I ask for accidents per year per county report
    Then I see 2 accidents in 2020 in "POWIAT WARSZAWA"
    And I see 1 accidents in 2021 in "POWIAT WARSZAWA"
    And I see 1 accidents in 2022 in "POWIAT WARSZAWA"
    And I see 1 accidents in 2020 in "POWIAT WROCŁAW"
    And I see 0 accidents in 2021 in "POWIAT WROCŁAW"
    And I see 3 accidents in 2022 in "POWIAT WROCŁAW"

  Scenario: Number of accidents per year per county statistics remembering that counties have duplicate names in voivodeships
    Given there was an accident 1 on "2020-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. PODLASKIE"
    And there was an accident 2 on "2020-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. PODLASKIE"
    And there was an accident 3 on "2021-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. PODLASKIE"
    And there was an accident 4 on "2022-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. PODLASKIE"
    And there was an accident 5 on "2020-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. ŚLĄSKIE"
    And there was an accident 6 on "2022-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. ŚLĄSKIE"
    And there was an accident 7 on "2022-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. ŚLĄSKIE"
    And there was an accident 8 on "2022-01-01" in "POWIAT BIELSKI" voivodeship "WOJ. ŚLĄSKIE"
    When I ask for accidents on pedestrian crossings per year per county report
    Then I see 2 accidents in 2020 in "WOJ. PODLASKIE/POWIAT BIELSKI"
    And I see 1 accidents in 2021 in "WOJ. PODLASKIE/POWIAT BIELSKI"
    And I see 1 accidents in 2022 in "WOJ. PODLASKIE/POWIAT BIELSKI"
    And I see 1 accidents in 2020 in "WOJ. ŚLĄSKIE/POWIAT BIELSKI"
    And I see 0 accidents in 2021 in "WOJ. ŚLĄSKIE/POWIAT BIELSKI"
    And I see 3 accidents in 2022 in "WOJ. ŚLĄSKIE/POWIAT BIELSKI"

Feature:
  Displaying general accident time statistics

  Scenario: General accidents per year statistics
    Given there was an accident 1 on "2020-01-01"
    And there was an accident 2 on "2020-01-01"
    When I ask for accidents per year report
    Then I see 2 accidents in 2020

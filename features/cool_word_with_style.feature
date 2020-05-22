Feature: Cool word with style

  Scenario: List cool word with style in json
    Given I do a "GET" request to "colorword" in json
    Then the response code should be "200"

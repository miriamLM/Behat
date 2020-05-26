@coolwordWithStyle
Feature: Cool word with style
  Scenario: List cool word with style in json
    Given I do a "GET" request to "colorword"
    Then the response code should be "200"
    And the response should be:
    """
    {
    "background color": "@string@",
    "font color": "@string@",
    "cool word": "@string@"
    }
    """


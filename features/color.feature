@color
Feature: Color
  Scenario: Color in string
    Given I do a "GET" request to "color"
    Then the response code should be "200"
    And the color response should be:
    """
    green
    """

  Scenario: Color in string
    Given I do a "GET" request to "color/61"
    Then the response code should be "404"
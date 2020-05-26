@color
Feature:
  Scenario: List colors in string
    Given I do a "GET" request to "color"
    Then the response code should be "200"
    And the color response should be:
    """
    green
    """
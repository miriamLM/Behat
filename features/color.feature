@color
Feature:
  Scenario: List colors in string
    Given I do a "GET" request to "color" in string
    Then the response color code should be "200"
    And the color response should be:
    """
    green
    """
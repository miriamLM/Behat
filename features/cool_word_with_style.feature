@coolwordWithStyle
Feature: Cool word with style
  Scenario: List cool word with style in json
    Given I do a "GET" request to "colorwordtest" in json
    Then the response code should be "200"
    And the response should be:
    """
    {
    "background color": "green",
    "font color": "cyan",
    "cool word": "Chachi pistachi!"
    }
    """


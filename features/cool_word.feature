@coolword
Feature: Cool word
  Scenario: Coolword in string
    Given I do a "GET" request to "coolword"
    Then the response code should be "200"
    And the coolword response should be:
    """
    Chachi pistachi!
    """

  Scenario: Coolword in string
    Given I do a "GET" request to "coolword/61"
    Then the response code should be "404"
@coolword
Feature:
  Scenario: List coolword in string
    Given I do a "GET" request to "coolword"
    Then the response code should be "200"
    And the coolword response should be:
    """
    Chachi pistachi!
    """
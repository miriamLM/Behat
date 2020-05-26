@coolword
Feature:
  Scenario: List coolword in string
    Given I do a "GET" request to coolword "coolword" in string
    Then the status coolword response should be "200"
    And the coolword response should be:
    """
    Chachi pistachi!
    """
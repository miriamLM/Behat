<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given /^I do a "([^"]*)" request to "([^"]*)" in json$/
     */
    public function iDoARequestToInJson($arg1, $arg2)
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}

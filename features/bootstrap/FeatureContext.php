<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var string
     */
    private $lastResponse;
    /**
     * @var int
     */
    private $lastStatusCode;

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
    public function iDoARequestToInJson($method, $uri)
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);

        try {
            $request = $client->request($method, $uri);

            $this->lastResponse   = $request->getBody()->getContents();
            $this->lastStatusCode = $request->getStatusCode();
        } catch (ClientException $exception) {
            $this->lastResponse   = $exception->getResponse()->getBody();
            $this->lastStatusCode = $exception->getResponse()->getStatusCode();
        }
    }

    /**
     * @Then /^the response code should be "([^"]*)"$/
     * @throws Exception
     */
    public function theResponseCodeShouldBe($expectedStatusCode)
    {
        echo $expectedStatusCode;
        if ($expectedStatusCode != $this->lastStatusCode) {
            throw new \Exception(sprintf("Expected %s vs Actual %s", $expectedStatusCode, $this->lastStatusCode));
        }
    }
}

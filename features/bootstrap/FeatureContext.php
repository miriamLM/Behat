<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Coduo\PHPMatcher\Factory\SimpleFactory;
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
     * @var array
     */
    private array $arrayOfColors;

    /**
     * @var array
     */
    private array $arrayOfCoolWords;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->arrayOfColors = ['red', 'cyan', 'magenta', 'green', 'black', 'yellow', 'blue', 'light_gray'];
        $this->arrayOfCoolWords = [
            'Chachi pistachi!',
            'Esto mola mogollón, tío!',
            'Mola mazo!',
            'Eres mazo guay',
            'Holiiiiii',
            'Besiis',
        ];
    }


    /**
     * @Given /^I do a "([^"]*)" request to "([^"]*)"$/
     */
    public function iDoARequestTo($method, $uri)
    {
        $client = new Client(['base_uri' => 'http://localhost:8000/']);

        try {
            $request = $client->request($method, $uri);

            $this->lastResponse = $request->getBody()->getContents();
            $this->lastStatusCode = $request->getStatusCode();

        } catch (ClientException $exception) {

            $this->lastResponse = $exception->getResponse()->getBody();
            $this->lastStatusCode = $exception->getResponse()->getStatusCode();
        }
    }


    /**
     * @Then /^the response code should be "([^"]*)"$/
     * @throws Exception
     */
    public function theResponseCodeShouldBe($expectedStatusCode)
    {
        if ($expectedStatusCode != $this->lastStatusCode) {
            throw new Exception(sprintf("Expected %s vs Actual %s", $expectedStatusCode, $this->lastStatusCode));
        }
    }


    /*
     * COOLWORD WITH STYLE JSON
     */


    /**
     * @Given /^the response should be:$/
     */
    public function theResponseShouldBe(PyStringNode $response)
    {
        $expectedJson = $response->getRaw();
        $responseJson = $this->lastResponse;

        if (null === $expectedJson) {
            throw new \RuntimeException("Can not convert given JSON string to valid JSON format.");
        }

        $factory = new SimpleFactory();

        $matcher = $factory->createMatcher();
        $match = $matcher->match($responseJson, $expectedJson);

        if ($match !== true) {
            throw new \RuntimeException("Expected JSON doesn't match response JSON.");
        }

    }


    /*
     * COLOR
     */


    /**
     * @Given /^the color response should be:$/
     */
    public function theColorResponseShouldBe(PyStringNode $response)
    {

        if ('string' !== gettype($response->getRaw())) {
            throw new Exception('String expected');
        }

        $existsInArrayOfColors = in_array($this->lastResponse, $this->arrayOfColors, true);

        if (false == $existsInArrayOfColors) {
            throw new Exception('Error value expected');
        }

    }


    /*
     * COOLWORD
     */


    /**
     * @Given /^the coolword response should be:$/
     */
    public function theCoolwordResponseShouldBe(PyStringNode $response)
    {
        if ('string' !== gettype($response->getRaw())) {
            throw new Exception('String expected');
        }

        $existsInArrayOfCoolWords = in_array($this->lastResponse, $this->arrayOfCoolWords, true);

        if (false == $existsInArrayOfCoolWords) {
            throw new Exception('Error value expected');
        }
    }




}

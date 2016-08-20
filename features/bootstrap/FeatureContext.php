<?php


use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    const APP = 'bin/sitemap ';

    private $rootDir;

    private $storage = array();

    /**
     * @Given I am in the project directory
     */
    public function iAmInTheProjectDirectory()
    {
        $this->rootDir = __DIR__ . '/../../';
    }

    /**
     * @Given No file :arg1 exists in the current folder
     */
    public function noFileExistsInTheCurrentFolder($arg1)
    {
        if (file_exists($this->rootDir . $arg1)) {
            unlink($this->rootDir . $arg1);
        }
    }

    /**
     * @When I run :arg1
     */
    public function iRun($arg1)
    {
        exec($this->rootDir . self::APP . $arg1, $output);
    }

    /**
     * @Then I should get a new file created named :arg1
     */
    public function iShouldGetANewFileCreatedNamed($arg1)
    {
        if (! file_exists($this->rootDir . $arg1)) {
            throw new \Exception(sprintf("File %s has not been created.", $arg1));
        }
    }

    /**
     * @Then The file :arg1 should not be empty
     */
    public function theFileShouldNotBeEmpty($arg1)
    {
        $content = file_get_contents($this->rootDir . $arg1);
        if (! strlen($content)) {
            throw new \Exception(sprintf("File %s is empty.", $arg1));
        }
    }

    /**
     * @Then I can delete the file :arg1
     */
    public function iCanDeleteTheFile($arg1)
    {
        unlink($this->rootDir . $arg1);
    }

    /**
     * @When I run :arg1 with option :arg2
     */
    public function iRunWithOption($arg1, $arg2)
    {
        exec($this->rootDir . self::APP . $arg1 . " $arg2", $output);
    }

    /**
     * @Then I want to store the filesize for file :arg1 and deep :arg2
     */
    public function iWantToStoreTheFilesizeForFileAndDeep($arg1, $arg2)
    {
        $this->storage[$arg2] = strlen(
            file_get_contents($this->rootDir . $arg1)
        );
    }

    /**
     * @Then The filesize :arg1 should be smaller then :arg2
     */
    public function theFilesizeShouldBeSmallerThen($arg1, $arg2)
    {
        if ($this->storage[$arg1] > $this->storage[$arg2]) {
            throw new \Exception(sprintf(
                "Actual sizes are d1: %s / d2: %s.", $this->storage[$arg1], $this->storage[$arg2]
            ));
        }
    }

}

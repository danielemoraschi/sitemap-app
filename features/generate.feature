Feature: generate
  In order to generate the XML sitemap file of a website
  As a UNIX user
  I must be able to provide the url to visit

  Scenario: Generate sitemap.xml passing url parameter
    Given I am in the project directory
    And No file "sitemap.xml" exists in the current folder
    When I run "generate -uhttp://google.com"
    Then I should get a new file created named "sitemap.xml"
    And The file "sitemap.xml" should not be empty
    Then I can delete the file "sitemap.xml"

  Scenario: Generate sitemap.xml passing url parameter and deep generate value
    Given I am in the project directory
    And No file "sitemap.xml" exists in the current folder
    When I run "generate -uhttp://google.com" with option "-d1"
    Then I should get a new file created named "sitemap.xml"
    And The file "sitemap.xml" should not be empty
    And I want to store the filesize for file "sitemap.xml" and deep "d1"
    When I run "generate -uhttp://google.com" with option "-d2"
    Then I should get a new file created named "sitemap.xml"
    And The file "sitemap.xml" should not be empty
    And I want to store the filesize for file "sitemap.xml" and deep "d2"
    And The filesize "d1" should be smaller then "d2"
    Then I can delete the file "sitemap.xml"

  Scenario: Generate sitemap-myname.xml passing url parameter and output filename value
    Given I am in the project directory
    And No file "sitemap-myname.xml" exists in the current folder
    When I run "generate -uhttp://google.com" with option "-ositemap-myname.xml"
    Then I should get a new file created named "sitemap-myname.xml"
    And The file "sitemap-myname.xml" should not be empty
    Then I can delete the file "sitemap-myname.xml"


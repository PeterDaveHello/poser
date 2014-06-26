@ui
Feature: Generation of an image by echo-ing the content
  In order to create image by command line
  As a visitor
  I want to use the poser script

  Scenario: Echo the image running a script
    When I run "poser license MIT blue"
    Then it should pass
    And the same output should be like the content of "bootstrap/fixtures/license-MIT-blue.svg"
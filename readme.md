# Pa11y PHP Bridge

This library runs th pa11y cli tool and converts the result to a PHP objects.

## Usage

```php
$uri = new Uri('https://www.example.com'); // UriInterface
$pa11yBridge = new Pa11yBridge();
$results = $pa11yBridge->runAudit($uri, Pa11yBridge::STANDARD_WCAG_2_A);

foreach($results as $result) {
    echo $result->getMessage() . ' - ' . $result->getCode(); // output: This element's role is "presentation" but contains child elements with semantic meaning. - WCAG2A.Principle1.Guideline1_3.1_3_1.F92,ARIA4
}
```

## Standards

- WCAG2 A
- WCAG2 AA
- WCAG2 AAA

## Pa11y

Pa11y is your automated accessibility testing pal. It runs accessibility tests on your pages via the command line or Node.js, so you can automate your testing process.

- [Project homepage](https://github.com/pa11y/pa11y)

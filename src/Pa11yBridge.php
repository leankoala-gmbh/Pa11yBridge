<?php

namespace Lenkoala\Pa11yBridge;

use Lenkoala\Pa11yBridge\Result\Result;
use Psr\Http\Message\UriInterface;

/**
 * Class Pa11yBridge
 *
 * @package Lenkoala\Pa11yBridge
 *
 * @see https://github.com/pa11y/pa11y
 *
 *
 * @author Nils Langner (nils.langner@leankoala.com)
 * @created 2020-11-20
 */
class Pa11yBridge
{
    const STANDARD_WCAG_2_A = 'WCAG2A';
    const STANDARD_WCAG_2_AA = 'WCAG2AA';
    const STANDARD_WCAG_2_AAA = 'WCAG2AAA';
    const STANDARD_SECTION_508 = 'Section508';

    const CONFIG_DEFAULT_FILE = __DIR__ . "/../pa11y/config.json";

    private $configFile;

    public function __construct($configFile = self::CONFIG_DEFAULT_FILE)
    {
        $this->configFile = $configFile;
    }

    /**
     * @param UriInterface $uri
     * @param string $standard
     *
     * @return Result[]
     */
    public function runAudit(UriInterface $uri, $standard = self::STANDARD_WCAG_2_A)
    {
        $command = "node " . __DIR__ . "/../pa11y/node_modules/pa11y/bin/pa11y.js";
        $command .= " -s " . $standard . " -r json  -c " . $this->configFile . " ";
        $command .= "\"" . (string)$uri . "\"";

        exec($command, $output, $code);
        $results = json_decode($output[0]);

        $pa11yResults = [];

        foreach ($results as $result) {
            $pa11yResults[] = new Result(
                $result->code,
                $result->type,
                $result->typeCode,
                $result->message,
                $result->context,
                $result->selector,
                $result->runner
            );
        }

        return $pa11yResults;
    }
}

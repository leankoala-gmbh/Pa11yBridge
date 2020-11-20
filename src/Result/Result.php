<?php

namespace Lenkoala\Pa11yBridge\Result;

use Psr\Http\Message\UriInterface;

/**
 * Class Result
 *
 * @package Lenkoala\Pa11yBridge\Result
 *
 * @author Nils Langner (nils.langner@leankoala.com)
 * @created 2020-11-20
 */
class Result implements \JsonSerializable
{
    private $detailLinks = [
        "WCAG2A.Principle1.Guideline1_3.1_3_1.F92,ARIA4" => "https://www.w3.org/TR/WCAG20-TECHS/F92.html"
    ];

    private $code;
    private $type;
    private $typeCode;
    private $content;
    private $selector;
    private $runner;
    private $message;

    /**
     * @var UriInterface
     */
    private $detailLink;

    /**
     * Result constructor.
     *
     * @param string $code
     * @param string $type
     * @param array $typeCode
     * @param string $message
     * @param string $content
     * @param string $selector
     * @param string $runner
     */
    public function __construct($code, $type, $typeCode, $message, $content, $selector, $runner)
    {
        $this->code = $code;
        $this->type = $type;
        $this->typeCode = $typeCode;
        $this->message = $message;
        $this->content = $content;
        $this->selector = $selector;
        $this->runner = $runner;

        $this->processDetailLink();
    }

    private function processDetailLink()
    {
        if (array_key_exists($this->code, $this->detailLinks)) {
            $this->detailLink = $this->detailLinks[$this->code];
        }
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return UriInterface
     */
    public function getDetailLink()
    {
        return $this->detailLink;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getTypeCode(): array
    {
        return $this->typeCode;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * @return string
     */
    public function getRunner(): string
    {
        return $this->runner;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'type' => $this->type,
            'typeCode' => $this->typeCode,
            'content' => $this->content,
            'selector' => $this->selector,
            'runner' => $this->runner,
            'message' => $this->message,
            'detailLink' => $this->detailLink
        ];
    }
}

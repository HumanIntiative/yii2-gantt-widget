<?php //src/api/PathInfoParser.php
namespace pkpudev\gantt\api;

class PathInfoParser
{
    const PUTDELETE_PATTERN = '/^\/gantt_api\/task\/(\d+)/';

    protected $method;
    protected $pathInfo;
    protected $urlPattern;

    public function __construct(string $method, string $pathInfo)
    {
        $this->method = $method;
        $this->pathInfo = $pathInfo;
        $this->urlPattern = $this->getUrlPattern();
    }

    protected function getUrlPattern()
    {
        $pattern = '/^project\/\d+(\/.+)/';
        if (preg_match($pattern, $this->pathInfo, $res)) {
            return $res[1];
        }
        return null;
    }

    public function isActionIndex()
    {
        $validMethod = $this->method == 'GET';
        $validUrl = $this->urlPattern == '/gantt_api';
        return $validMethod && $validUrl;
    }

    public function isActionCreate()
    {
        $validMethod = $this->method == 'POST';
        $validUrl = $this->urlPattern == '/gantt_api/task';
        return $validMethod && $validUrl;
    }

    public function isActionUpdate()
    {
        $validMethod = $this->method == 'PUT';
        $validUrl = preg_match(self::PUTDELETE_PATTERN, $this->urlPattern);
        return $validMethod && $validUrl;
    }

    public function isActionDelete()
    {
        $validMethod = $this->method == 'DELETE';
        $validUrl = preg_match(self::PUTDELETE_PATTERN, $this->urlPattern);
        return $validMethod && $validUrl;
    }
}
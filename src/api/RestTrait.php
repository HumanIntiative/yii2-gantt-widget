<?php //src/api/BaseController.php
namespace pkpudev\gantt\api;

/**
 * Create Rest Api in Yii2 from scratch
 * 
 * See: https://www.yiiframework.com/wiki/748/building-a-rest-api-in-yii2-0
 */
trait RestTrait
{
    protected function setHeader($statusCode)
    {
        $statusMessage = $this->getStatusCodeMessage($statusCode);
        $statusHeader = "HTTP/1.1 {$statusCode} {$statusMessage}";
        $contentType = "application/json; charset=utf-8";

        header($statusHeader);
        header("Content-type: {$contentType}");
        header("X-Powered-By: IT Revo <it.revo@pkpu.org>");
    }

    protected function getStatusCodeMessage($statusCode)
    {
        $codes = [
            200 => 'OK',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
        ];
        return $codes[$statusCode] ?? '';
    }
}
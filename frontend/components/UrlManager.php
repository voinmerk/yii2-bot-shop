<?php
namespace frontend\components;

class UrlManager extends \common\components\UrlManager
{
    public function createUrl($route, $params = [], $ampersand = '&')
    {
        return $this->fixPathSlashes(parent::createUrl($route, $params, $ampersand));
    }

    protected  function fixPathSlashes($url)
    {
        return preg_replace('|\%2F|i', '/', $url);
    }
}

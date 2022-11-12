<?php

namespace Webjump\HelloWorld\Block\ExemplePage;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @return string
     */
    public function helloWorld(): string
    {
        return "ola mundo";
    }
}

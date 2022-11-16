<?php

namespace Webjump\Pet\Block\Page;

use Magento\Framework\View\Element\Template;
use Webjump\Pet\Model\Config\Data;

class Header extends Template
{
    private Data $config;

    public function __construct(
        Template\Context $context,
        Data $config,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->config = $config;
    }


    public function getEnable()
    {
        if($this->config->getEnable()){
            return "ativado";
        }else{
            return "Não ativado";
        }
    }

}

<?php
namespace SmartOSC\HelloAnhTan\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Config extends AbstractHelper {
    
    /**
     *
     */
    public function getConfigEnable(){
        return $this->scopeConfig->getValue('enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}


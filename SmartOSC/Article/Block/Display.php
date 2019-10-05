<?php
namespace SmartOSC\Article\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use SmartOSC\Article\Model\ArticleFactory;
use SmartOSC\Article\Model\ResourceModel\Article\CollectionFactory;
use SmartOSC\Article\Helper\Config;

class Display extends Template
{
    protected $_articleFactory;
    protected $_collectionFactory;
    protected $_configData;
	public function __construct(
	    Context $context,
        ArticleFactory $articleFactory,
        CollectionFactory $collectionFactory,
        Config $configData
    )
	{
        $this->_articleFactory = $articleFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_configData = $configData;
		return parent::__construct($context);
	}

	public function displayArticle()
	{
        $config = $this->_configData->getGeneralConfig('limit_per_page');
        $config2 = $this->_configData->getGeneralConfig('enable');
		return __('
        <div style="text-align: center;">
            <h2>Articles</h2>
        </div>
        '.$config.$config2);
	}

    public function getArticleCollection(){
        $article = $this->_articleFactory->create();
        $collection = $this->_collectionFactory->create();
        return $collection;
    }
}
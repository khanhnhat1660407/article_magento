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

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Article list'));
        if ($this->getArticleCollection()) {
            $pager = $this->getLayout()->createBlock(
                'SmartOSC\Article\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getArticleCollection()
                );
            $this->setChild('pager', $pager);
            $this->getArticleCollection()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return int: limit per page has been configured in admin page
     */
    public function getDefaultLimitPerPageConfig()
    {
        $limitPerPage = intval($this->_configData->getGeneralCconfig('limit_per_page'));
        return $limitPerPage;
    }

    public function getArticleCollection(){
        $defaulLimitPerPage = $this->getDefaultLimitPerPageConfig();
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : $defaulLimitPerPage;
        $article = $this->_articleFactory->create();
        $collection = $this->_collectionFactory->create();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }
}
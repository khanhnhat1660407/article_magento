<?php
namespace SmartOSC\Article\Controller\Detail;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
/**
 * Class Display
 * @package SmartOSC\Article\Controller\Index
 */
class Detail extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * Display constructor.
     *
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }
}
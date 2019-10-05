<?php
namespace SmartOSC\HelloAnhTan\Controller\Index;

use Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
// use \Mageplaza\HelloWorld\Helper\Config;

/**
 * Class Display
 * @package SmartOSC\HelloAnhTan\Controller\Index
 */
class Display extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    // protected $configData;
    /**
     * Display constructor.
     *
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(Context $context,PageFactory $pageFactory)
    {
        //$this->configData = $configData;
        $this->_pageFactory = $pageFactory;
        // $this->configData = $configData;
        return parent::__construct($context);
    }

    public function execute()
    {
        echo '
        <html>
        <head>
        <title>Hello Anh Tân</title>
        </head>
        <body>
        <div style="margin-top: 100px; text-align: center;">
        <h2>Hello Anh Tân Vlog</h2>
        </div>
        </body>
        </html>
        ';
        exit;
    }
}
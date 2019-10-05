<?php
namespace SmartOSC\Article\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Action\Context as ActionContext;
use SmartOSC\Article\Model\ArticleFactory;
use SmartOSC\Article\Model\ResourceModel\Article\CollectionFactory;
use SmartOSC\Article\Helper\Config;
use SmartOSC\Article\Api\ArticleRepositoryInterface ;

class Detail extends Template
{
    protected $_actionContext;
    protected $_articleFactory;
    protected $_collectionFactory;
    protected $_configData;
    protected $_request;
    protected $_articleRepository;
    protected $_objectManager;
    protected $_url;
    public function __construct(
        Context $context,
        ArticleFactory $articleFactory,
        CollectionFactory $collectionFactory,
        Config $configData,
        RequestInterface $request,
        ObjectManagerInterface $objectManager,
        ArticleRepositoryInterface $articleRepository,
        UrlInterface $url,
        ActionContext $actionContext
    )
    {
        $this->_actionContext = $actionContext;
        $this->_articleFactory = $articleFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_configData = $configData;
        $this->_request = $request;
        $this->_objectManager = $objectManager;
        $this->_articleRepository = $articleRepository;
        $this->_url = $url;
        return parent::__construct($context);
    }

    /**
     * @param $paramName
     * @return $paramName value
     */
    public function getURLParam($paramName)
    {
        return $this->_request->getParam($paramName);
    }


    /**
     * @param $param get in URL request
     * @return bool if the param is number type interger
     */
    public function isInterger($param)
    {
        return (is_numeric($param) && is_int($param + 0)) ? true : false;
    }

    /**
     * @param $id
     * @return \SmartOSC\Article\Api\Data\ArticleInterface
     */
    public function getArticleById($id)
    {
        $article = $this->_articleRepository->getById($id);
        return $article;
    }

    public function redirectToPageNotFound()
    {
        $norouteUrl = $this->_url->getUrl('noroute');
        $response = $this->_actionContext->getResponse();
        $response->setRedirect($norouteUrl);
    }

    public function test()
    {
        $param = $this->getURLParam('id');
        if($param === null || !$this->isInterger($param))
        {
            return 'n';
        }
        else
        {
            return 'oke';
        }
    }


    /**
     * @return mixed
     */
    public function getArticleSelected(){
        $param = $this->getURLParam('id');
        if($param == null || !$this->isInterger($param))
        {
            $this->redirectToPageNotFound();
        }
        else
        {
            try{
                $article = $this->getArticleById(intval($param));
            }
            catch (\Exception $exception)
            {
                $this->redirectToPageNotFound();
            }
            return $article;

        }

    }
}
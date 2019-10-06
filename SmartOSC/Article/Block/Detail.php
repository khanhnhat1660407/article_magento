<?php
namespace SmartOSC\Article\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Action\Context as ActionContext;
use SmartOSC\Article\Helper\Config;
use SmartOSC\Article\Api\ArticleRepositoryInterface ;

class Detail extends Template
{

    protected $_configData;
    protected $_request;
    protected $_articleRepository;
    protected $_url;
    protected $_actionContext;

    public function __construct(
        Context $context,
        Config $configData,
        RequestInterface $request,
        ArticleRepositoryInterface $articleRepository,
        UrlInterface $url,
        ActionContext $actionContext
    )
    {
        $this->_configData = $configData;
        $this->_request = $request;
        $this->_articleRepository = $articleRepository;
        $this->_url = $url;
        $this->_actionContext = $actionContext;
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

    /**
     * Redirect to Page not Found
     */
    public function redirectToPageNotFound()
    {
        $norouteUrl = $this->_url->getUrl('noroute');
        $response = $this->_actionContext->getResponse();
        $response->setRedirect($norouteUrl);
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
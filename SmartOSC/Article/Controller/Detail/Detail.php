<?php
namespace SmartOSC\Article\Controller\Detail;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use SmartOSC\Article\Api\ArticleRepositoryInterface ;
use Magento\Framework\App\RequestInterface;

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
     * @var ArticleRepositoryInterface
     */
    protected $_articleRepository;

    /**
     * @var RequestInterface
     */
    protected $_request;

    /**
     * Display constructor.
     *
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ArticleRepositoryInterface $articleRepository,
        RequestInterface $request
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_articleRepository = $articleRepository;
        $this->_request = $request;

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
     * @param $id
     * @return \SmartOSC\Article\Api\Data\ArticleInterface
     */
    public function getArticleById($id)
    {
        $article = $this->_articleRepository->getById($id);
        return $article;
    }

    /**
     * @return string: article title
     */
    public function getArticleTitle()
    {
        $param = $this->getURLParam('id');
        $articleTitle = $this->getArticleById(intval($param))->getTitle();
        return $articleTitle;
    }

    public function execute()
    {
         $page = $this->_pageFactory->create();
         $articleTitle = $this->getArticleTitle();
         $page->getConfig()->getTitle()->set(__($articleTitle));
         return $page;
    }
}
<?php
namespace SmartOSC\Article\Api\ArticleRepositoryInterface;

use SmartOSC\Article\Api\ArticleRepositoryInterface;
use SmartOSC\Article\Api\Data\ArticleInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\ObjectManager\NoninterceptableInterface;
use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\App\ObjectManager;
/**
 * Proxy class for @see \SmartOSC\Article\Api\ProductRepositoryInterface
 */
class Proxy implements ArticleRepositoryInterface, NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \SmartOSC\Article\Api\ArticleRepositoryInterface
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        $instanceName = '\SmartOSC\Article\Api\ArticleRepositoryInterface',
        $shared = true
    )
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \SmartOSC\Article\Api\ArticleRepositoryInterface
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ArticleInterface $article, $saveOptions = false)
    {
        return $this->_getSubject()->save($article, $saveOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function get($id, $editMode = false, $storeId = null, $forceReload = false)
    {
        return $this->_getSubject()->get($id, $editMode, $storeId, $forceReload);
    }

    /**
     * {@inheritdoc}
     */
    public function getById($articleID, $editMode = false, $storeId = null, $forceReload = false)
    {
        return $this->_getSubject()->getById($articleID, $editMode, $storeId, $forceReload);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ArticleInterface $article)
    {
        return $this->_getSubject()->delete($article);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        return $this->_getSubject()->deleteById($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        return $this->_getSubject()->getList($searchCriteria);
    }
}

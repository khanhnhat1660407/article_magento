<?php
namespace SmartOSC\Article\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use SmartOSC\Article\Api\Data\ArticleInterface;

class Article extends AbstractModel implements ArticleInterface, IdentityInterface
{
    const CACHE_TAG = 'sm_article';

    protected $_cacheTag = 'sm_article';

    protected $_eventPrefix = 'sm_article';

    protected function _construct()
    {
        $this->_init(\SmartOSC\Article\Model\ResourceModel\Article::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set product sku
     *
     * @param string $sku
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Product name
     *
     * @return string|null
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @param $content
     * @return mixed
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @param $imagePath
     * @return mixed
     */
    public function setImage($imagePath)
    {
        return $this->setData(self::IMAGE, $imagePath);
    }

    /**
     * Product created date
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set product created date
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Product updated date
     *
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set product updated date
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
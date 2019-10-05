<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SmartOSC\Article\Model;

use SmartOSC\Article\Api\ArticleRepositoryInterface;
use SmartOSC\Article\Api\Data;
use SmartOSC\Article\Api\Data\ArticleInterface;
use SmartOSC\Article\Model\ResourceModel\Article as ResourceArticle;
use SmartOSC\Article\Model\ResourceModel\Article\CollectionFactory as ArticleCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ArticleRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @var ResourceArticle
     */
    protected $resource;

    /**
     * @var ArticleFactory
     */
    protected $articleFactory;

    /**
     * @var ArticleCollectionFactory
     */
    protected $articleCollectionFactory;

    /**
     * @var Data\ArticleSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;


    public function __construct(
        ResourceArticle $resource,
        ArticleFactory $articleFactory,
        ArticleCollectionFactory $articleCollectionFactory,
        Data\ArticleSearchResultsInterfaceFactory $searchResultsFactory,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor = null
    ) {
        $this->resource = $resource;
        $this->articleFactory = $articleFactory;
        $this->articleCollectionFactory = $articleCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor ? : $this->getCollectionProcessor();
    }


    /**
     * @param ArticleInterface $article
     * @param bool $saveOptions
     * @return ArticleInterface
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(ArticleInterface $article, $saveOptions = false)
    {
        if (empty($article->getStoreId())) {
            $article->setStoreId($this->storeManager->getStore()->getId());
        }

        try {
            $this->resource->save($article);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $article;
    }


    /**
     * @param $articleId
     * @param bool $editMode
     * @param null $storeId
     * @param bool $forceReload
     * @return ArticleInterface|Article
     * @throws NoSuchEntityException
     */
    public function getById($articleId, $editMode = false, $storeId = null, $forceReload = false)
    {
        $article = $this->articleFactory->create();
        $this->resource->load($article, $articleId);
        if (!$article->getId()) {
            throw new NoSuchEntityException(__('The CMS block with the "%1" ID doesn\'t exist.', $articleId));
        }
        return $article;
    }

    /**
     * @param ArticleInterface $article
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(ArticleInterface $article)
    {
        try {
            $this->resource->delete($article);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @param $id
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));

    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return Data\ArticleSearchResultsInterfaceFactory|Data\PageSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        $collection = $this->articleCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        /** @var Data\PageSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    private function getCollectionProcessor()
    {
        if (!$this->collectionProcessor) {
            $this->collectionProcessor = \Magento\Framework\App\ObjectManager::getInstance()->get(
                'Magento\Cms\Model\Api\SearchCriteria\PageCollectionProcessor'
            );
        }
        return $this->collectionProcessor;
    }
}

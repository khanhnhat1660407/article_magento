<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SmartOSC\Article\Api;
use SmartOSC\Article\Api\Data\ArticleInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
/**
 * @api
 * @since 100.0.2
 */
interface ArticleRepositoryInterface
{
    /**
     * @param ArticleInterface $article
     * @param bool $saveOptions
     * @return ArticleInterface
     */
    public function save(ArticleInterface $article, $saveOptions = false);


    /**
     * @param $articleId
     * @param bool $editMode
     * @param null $storeId
     * @param bool $forceReload
     * @return ArticleInterface
     */
    public function getById($articleId, $editMode = false, $storeId = null, $forceReload = false);

    /**
     * @param ArticleInterface $article
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function delete(ArticleInterface $article);

    /**
     * @param $id
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById($id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \SmartOSC\Article\Api\Data\ArticleSearchResultsInterfaceFactory
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}

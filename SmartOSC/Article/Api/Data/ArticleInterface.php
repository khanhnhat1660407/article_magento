<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace SmartOSC\Article\Api\Data;

/**
 * @api
 * @since 100.0.2
 */
interface ArticleInterface
{
    /**#@+
     * Constants defined for keys of  data array
     */
    const ID = 'article_id';

    const TITLE = 'title';

    const CONTENT = 'content';

    const IMAGE = 'image';

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    const ATTRIBUTES = [
        self::ID,
        self::TITLE,
        self::CONTENT,
        self::IMAGE,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];
    /**#@-*/

    /**
     * Product id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set product id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * Set product sku
     *
     * @param string $sku
     * @return $this
     */
    public function setTitle($title);

    /**
     * Product name
     *
     * @return string|null
     */
    public function getContent();

    /**
     * @param $content
     * @return mixed
     */
    public function setContent($content);

    /**
     * @return mixed
     */
    public function getImage();

    /**
     * @param $imagePath
     * @return mixed
     */
    public function setImage($imagePath);

    /**
     * Product created date
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set product created date
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Product updated date
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set product updated date
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);
}

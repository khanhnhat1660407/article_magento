<?php

namespace SmartOSC\Article\Model\Config\Source;
use Magento\Framework\Option\ArrayInterface;
/**
 * @api
 * @since 100.0.2
 */
class Limititem implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 5, 'label' => __('5')],['value' => 10, 'label' => __('10')], ['value' => 15, 'label' => __('15')],['value' => 20, 'label' => __('20')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [5 => __('5'),10 => __('10'), 15 => __('15'), 20 => __('20')];
    }
}

<?php

namespace Webjump\PetExt\Api\Data;

interface PetExtSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * Set items list.
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

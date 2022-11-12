<?php

namespace Webjump\HelloWorld\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Webjump\HelloWorld\Api\Data\HelloWorldInterface;

interface HelloWorldRepositoryInterface
{

    /**
     * @param HelloWorldInterface $petTable
     * @return bool
     */
    public function save(HelloWorldInterface $petTable): bool;

    /**
     * @param int $id
     * @return HelloWorldInterface
     */
    public function getById(int $id): HelloWorldInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param HelloWorldInterface $petTable
     * @return bool
     */
    public function delete(HelloWorldInterface $petTable): bool;
}

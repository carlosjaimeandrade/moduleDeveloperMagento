<?php

namespace Webjump\Pet\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Api\Data\PetSearchResultInterface;

interface PetRepositoryInterface
{

    /**
     * Save values in pet table
     *
     * @param PetInterface $pet
     * @return PetInterface
     * @throws CouldNotSaveException
     */
    public function save(PetInterface $pet): PetInterface;

    /**
     * Get first item with params id
     *
     * @param int $id
     * @return PetInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): PetInterface;

    /**
     * Get data list of table
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PetSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PetSearchResultInterface;

    /**
     * Delete one item of table, with base in param
     *
     * @param PetInterface $pet
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PetInterface $pet): bool;
}

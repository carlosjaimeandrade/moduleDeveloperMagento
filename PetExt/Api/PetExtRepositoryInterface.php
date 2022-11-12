<?php

namespace Webjump\PetExt\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Webjump\Pet\Api\Data\PetInterface;
use Webjump\Pet\Api\Data\PetSearchResultInterface;
use Webjump\PetExt\Api\Data\PetExtInterface;
use Webjump\PetExt\Api\Data\PetExtSearchResultInterface;

interface PetExtRepositoryInterface
{

    /**
     * Save values in petExt table
     *
     * @param PetExtInterface $petExt
     * @return PetExtInterface
     * @throws CouldNotSaveException
     */
    public function save(PetExtInterface $petExt): PetExtInterface;

    /**
     * Get first item with params id
     *
     * @param int $id
     * @return PetExtInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): PetExtInterface;

    /**
     * Get data list of table
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PetExtSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PetExtSearchResultInterface;

    /**
     * Delete one item of table, with base in param
     *
     * @param PetExtInterface $petExt
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(PetExtInterface $petExt): bool;
}

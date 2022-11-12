<?php

namespace Webjump\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Webjump\HelloWorld\Api\Data\HelloWorldInterface;
use Webjump\HelloWorld\Model\ResourceModel\HelloWorld as HelloWorldResource;

class HelloWorld extends AbstractModel implements HelloWorldInterface
{

    /**
     * @var string
     */
    protected $_eventObject = 'HelloWorld';

    /**
     * @var string
     */
    protected $_eventPrefix = 'webjump';

    protected function _construct()
    {
        $this->_init(HelloWorldResource::class);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getPetName()
    {
        return $this->getData(HelloWorldInterface::PET_NAME);
    }

    /**
     * @param $petName
     * @return mixed|HelloWorld
     */
    public function setPetName($petName)
    {
        return $this->setData(HelloWorldInterface::PET_NAME, $petName);
    }

    /**
     * @return array|mixed|null
     */
    public function getPetOwner()
    {
        return $this->getData(HelloWorldInterface::PET_OWNER);
    }

    /**
     * @param $petOwner
     * @return mixed|HelloWorld
     */
    public function setPetOwner($petOwner)
    {
        return $this->setData(HelloWorldInterface::PET_OWNER, $petOwner);
    }

    /**
     * @return array|mixed|null
     */
    public function getOwnerTelephone()
    {
        return $this->getData(HelloWorldInterface::OWNER_TELEPHONE);
    }

    /**
     * @param $ownerTelephone
     * @return mixed|HelloWorld
     */
    public function setOwnerTelephone($ownerTelephone)
    {
        return $this->setData(HelloWorldInterface::OWNER_TELEPHONE, $ownerTelephone);
    }

    /**
     * @return array|mixed|null
     */
    public function getOwnerId()
    {
        return $this->getData(HelloWorldInterface::OWNER_ID);
    }

    /**
     * @param $ownerId
     * @return mixed|HelloWorld
     */
    public function setOwnerId($ownerId)
    {
        return $this->setData(HelloWorldInterface::OWNER_ID, $ownerId);
    }
}

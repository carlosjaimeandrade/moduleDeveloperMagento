<?php

namespace Webjump\Pet\Block\Page;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Webjump\Pet\Model\Config\Data;
use Webjump\PetExt\Model\ResourceModel\Collection\Collection;
use Webjump\Pet\Model\Repository\PetRepository;
use Magento\Customer\Model\ResourceModel\Customer\Collection as CustomerCollection;

class Header extends Template
{
    private Data $config;
    private Session $session;
    private Collection $collection;
    private $petRepository;
    private CustomerCollection $customerCollection;

    public function __construct(
        Template\Context $context,
        Data $config,
        Session $session,
        Collection $collection,
        PetRepository $petRepository,
        CustomerCollection $customerCollection,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->session = $session;
        $this->collection = $collection;
        $this->petRepository = $petRepository;
        $this->customerCollection = $customerCollection;
    }


    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getEnable()
    {
        $id = $this->session->getId();

        $select = $this->customerCollection->getConnection()->select();

        $select->from(
            ['main_table' => "customer_entity"],
            ['entity_id']
        )
            ->join(
            ['cev' => 'customer_entity_varchar'],
            'main_table.entity_id=cev.entity_id',
        )->where("main_table.entity_id = ?", $id);

        $petName = $this->customerCollection->getConnection()->fetchAll($select);

        $petExt = $this->collection->addFieldToFilter('entity_id_customer', $id)->getFirstItem();
        $petKind = $this->petRepository->getById($petExt['entity_id_pet']);

        if($this->config->getEnable()){
            return "<b>Tipo de pet:</b> {$petKind['name']} | <b>nome do pet:</b> {$petName[0]['value']}";
        }

        return "";
    }

}

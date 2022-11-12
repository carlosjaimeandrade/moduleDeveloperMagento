<?php

namespace Webjump\Pet\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Actions extends Column
{
    const URL_PATH_EDIT = 'webjump_ibgecode/ibge/edit';

    private UrlInterface $urlBuilder;

    public function __construct(
        ContextInterface   $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface       $urlBuilder,
        array              $components = [], array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public
    function prepareDataSource(array $dataSource): array
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->urlBuilder->getUrl('webjump_pet/pet/edit',['petId' => $item['entity_id']]),
                        'label' => __('Edit')
                    ],
                    'remove' => [
                        'href' => $this->urlBuilder->getUrl('webjump_pet/pet/remove', ['petId' => $item['entity_id']]),
                        'label' => __('Remove'),
                        'confirm' => [
                            'title' => __("Delete " .  $item['entity_id']),
                            'message' => __('Are you sure you wan\'t to delete this code Pet?')
                        ]

                    ]
                ];
            }
        }

        return $dataSource;
    }
}

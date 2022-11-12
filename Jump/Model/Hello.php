<?php

namespace Webjump\Jump\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Webapi\Rest\Request;

class Hello implements \Webjump\Jump\Api\HelloInterface
{
    /**
     * @var Json
     */
    private Json $json;

    /**
     * @var Request
     */
    private Request $request;

    /**
     * @param Json $json
     * @param Request $request
     */
    public function __construct(Json $json, Request $request)
    {
        $this->json = $json;
        $this->request = $request;
    }

    /**
     * Returns greeting message to user
     *
     * @param string $name Users name.
     * @return bool|string Greeting message with users name.
     *@api
     */
    public function name($name): bool|string
    {
        return $this->json->serialize([
            'message' => ['success webapi' => $name]
        ]);
    }

    /**
     * @return bool|string
     */
    public function age(): bool|string
    {
        $params = $this->request->getRequestData();
        $age = $params['age'];

        return $this->json->serialize([
            'message' => ['success webapi' =>  $age]
        ]);
    }
}

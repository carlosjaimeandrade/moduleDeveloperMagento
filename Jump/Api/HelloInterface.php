<?php

namespace Webjump\Jump\Api;

use Magento\Framework\Controller\Result\Json;

interface HelloInterface
{

    /**
     * Returns greeting message to user
     *
     * @param string $name Users name.
     * @return bool|string Greeting message with users name.
     * @api
     */
    public function name($name): bool|string;

    /**
     * @return bool|string Greeting message with users name.
     */
    public function age(): bool|string;
}

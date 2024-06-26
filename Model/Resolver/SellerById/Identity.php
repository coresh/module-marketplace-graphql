<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/terms
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_MarketplaceGraphQl
 * @copyright  Copyright (c) 2021 Landofcoder (https://www.landofcoder.com/)
 * @license    https://landofcoder.com/terms
 */

namespace Lof\MarketplaceGraphQl\Model\Resolver\SellerById;

use Magento\Framework\GraphQl\Query\Resolver\IdentityInterface;

class Identity implements IdentityInterface
{
    /**
     * @var string
     */
    private $cacheTag = \Magento\Framework\App\Config::CACHE_TAG;

    /**
     * @inheritDoc
     */
    public function getIdentities(array $resolvedData): array
    {
        return empty($resolvedData['seller_id'])
            ? []
            : [$this->cacheTag, sprintf('%s_%s', $this->cacheTag, $resolvedData['seller_id'])];
    }
}

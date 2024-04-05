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
declare(strict_types=1);

namespace Lof\MarketplaceGraphQl\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface MessageRepositoryInterface
 */
interface MessageRepositoryInterface
{
    /**
     * Get list of Seller messages.
     *
     * @param int $sellerId
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Lof\MarketplaceGraphQl\Api\Data\MessageSearchResultsInterface
     */
    public function getListSellerMessages(
        int $sellerId,
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Get list messages.
     *
     * @param int $customerId
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Lof\MarketplaceGraphQl\Api\Data\MessageSearchResultsInterface
     */
    public function getListMessages(
        int $customerId,
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );
}

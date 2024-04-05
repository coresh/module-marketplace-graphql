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

namespace Lof\MarketplaceGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Lof\MarketPlace\Model\ResourceModel\MessageDetail\CollectionFactory;

class MessageDetail implements ResolverInterface
{

    /**
     * @var \Lof\MarketPlace\Model\ResourceModel\MessageDetail\CollectionFactory
     */
    protected $detailCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Lof\MarketPlace\Model\ResourceModel\MessageDetail\CollectionFactory $detailCollectionFactory
     *
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CollectionFactory $detailCollectionFactory
    ) {
        $this->request = $context->getRequest();
        $this->detailCollectionFactory = $detailCollectionFactory;
    }

    /**
     * @inheritDoc
     *
     * @throws GraphQlInputException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        if (!isset($value['message_id'])) {
            throw new GraphQlInputException(__('Value must contain "message_id" property.'));
        }

        if ($args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }
        if ($args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }

        $collection = $this->detailCollectionFactory->create()
                        ->addFieldToFilter('message_id', (int)$value['message_id'])
                        ->setPageSize($args['pageSize'])
                        ->setCurPage($args['currentPage'])
                        ->setOrder('created_at', 'DESC');

        $totalPages = $args['pageSize'] ? ((int)ceil($collection->getSize() / $args['pageSize'])) : 0;

        $items = [];

        foreach ($collection->getItems() as $messegedetail) {
            $items[] = [
                'content' => $messegedetail->getContent(),
                'sender_name' => $messegedetail->getSenderName(),
                'sender_email' => $messegedetail->getSenderEmail(),
                'receiver_name' => $messegedetail->getReceiverName(),
                'is_read' => $messegedetail->getIsRead(),
                'created_at' => $messegedetail->getCreatedAt()
            ];
        }

        return [
            'total_count' => $collection->getSize(),
            'items'       => $items,
            'page_info' => [
                'page_size' => $args['pageSize'],
                'current_page' => $args['currentPage'],
                'total_pages' => $totalPages
            ]
        ];
    }
}

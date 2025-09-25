<?php
/**
 * Mavenbird Technologies Private Limited
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://mavenbird.com/Mavenbird-Module-License.txt
 *
 * =================================================================
 *
 * @category    Mavenbird
 * @package     Mavenbird_CancelOrder
 * @author      Mavenbird Team
 * @copyright   Copyright (c) 2018-2024 Mavenbird Technologies Private Limited ( http://mavenbird.com )
 * @license     http://mavenbird.com/Mavenbird-Module-License.txt
 */
namespace Mavenbird\CancelOrder\Controller\Order;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Reason extends Action
{
    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $reasons = [
            'Ordered by mistake',
            'Found a better price elsewhere',
            'Delivery time too long',
            'Changed my mind',
            'Item no longer needed',
            'Applied wrong payment method',
            'Wanted a different product/variant',
            'Placed a duplicate order',
            'Seller hasn’t confirmed/shipped yet',
            'Other'
        ];

        $result = $this->resultJsonFactory->create();
        return $result->setData($reasons);
    }
}

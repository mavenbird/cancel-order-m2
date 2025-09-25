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
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;

class Cancel extends Action
{
    protected $resultJsonFactory;
    protected $orderRepository;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        OrderRepositoryInterface $orderRepository
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->orderRepository = $orderRepository;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $orderId = (int) $this->getRequest()->getParam('order_id');
        $reason = $this->getRequest()->getParam('reason');

        if (!$orderId) {
            return $result->setData(['success' => false, 'message' => __('Order ID is missing.')]);
        }

        try {
            $order = $this->orderRepository->get($orderId);
            if (!$order->canCancel()) {
                throw new LocalizedException(__('This order cannot be canceled.'));
            }

            $order->addStatusHistoryComment(__('Order canceled by customer. Reason: %1', $reason))
                  ->setIsCustomerNotified(true);
            $order->cancel();
            $this->orderRepository->save($order);

            return $result->setData(['success' => true, 'message' => __('Order canceled successfully.')]);

        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

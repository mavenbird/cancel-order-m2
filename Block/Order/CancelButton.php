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
 * @category    Mavenbird
 * @package     Mavenbird_CancelOrder
 * @author      Mavenbird Team
 * @copyright   Copyright (c) 2018-2024 Mavenbird Technologies Private Limited
 * @license     http://mavenbird.com/Mavenbird-Module-License.txt
 */

namespace Mavenbird\CancelOrder\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Sales\Api\OrderRepositoryInterface;
use Mavenbird\CancelOrder\Helper\Data as CancelHelper;

/**
 * Class CancelButton
 * Block to display the cancel order button on order view/history
 */
class CancelButton extends Template
{
    /**
     * @var OrderRepositoryInterface
     */
    protected OrderRepositoryInterface $orderRepository;

    /**
     * @var CancelHelper
     */
    protected CancelHelper $helper;

    /**
     * CancelButton constructor.
     *
     * @param Template\Context $context
     * @param OrderRepositoryInterface $orderRepository
     * @param CancelHelper $helper
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        OrderRepositoryInterface $orderRepository,
        CancelHelper $helper,
        array $data = []
    ) {
        $this->orderRepository = $orderRepository;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve order object
     *
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    public function getOrder()
    {
        $orderId = (int)$this->getRequest()->getParam('order_id');
        if ($orderId) {
            try {
                return $this->orderRepository->get($orderId);
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }

    /**
     * Retrieve cancel order helper
     *
     * @return CancelHelper
     */
    public function getHelper(): CancelHelper
    {
        return $this->helper;
    }
}

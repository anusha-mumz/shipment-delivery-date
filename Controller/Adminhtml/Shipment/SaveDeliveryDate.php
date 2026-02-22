<?php

declare(strict_types=1);

namespace Mumzworld\ShipmentDeliveryDate\Controller\Adminhtml\Shipment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Mumzworld\Shipment\Api\ShipmentDeliveredDateRepositoryInterface;

class SaveDeliveryDate extends Action
{
    public function __construct(
        Context $context,
        private readonly JsonFactory $resultJsonFactory,
        private readonly ShipmentDeliveredDateRepositoryInterface $deliveredDateRepository
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        
        try {
            $shipmentId = (int)$this->getRequest()->getParam('shipment_id');
            $deliveryDate = $this->getRequest()->getParam('delivery_date');
            
            if (!$shipmentId || !$deliveryDate) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => __('Invalid parameters')
                ]);
            }

            $timestamp = strtotime($deliveryDate);
            if ($timestamp === false) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => __('Invalid date format')
                ]);
            }

            $this->deliveredDateRepository->saveDeliveredDateByShipmentId($shipmentId, $timestamp);

            return $resultJson->setData([
                'success' => true,
                'message' => __('Delivery date saved successfully')
            ]);
        } catch (\Exception $e) {
            return $resultJson->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mumzworld_ShipmentDeliveryDate::shipment_delivery_date');
    }
}

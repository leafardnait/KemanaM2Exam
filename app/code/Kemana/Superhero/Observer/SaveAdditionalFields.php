<?php

namespace Kemana\Superhero\Observer;

use \Magento\Framework\Event\ObserverInterface;
use \Magento\Framework\Event\Observer;
use \Magento\Framework\Exception\LocalizedException;
class SaveAdditionalFields implements ObserverInterface
{
    /**
     * @var \Magento\Sales\Api\OrderAddressRepositoryInterface
     */
    protected $orderAddressRepository;
    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;
    /**
     * @param \Magento\Sales\Api\OrderAddressRepositoryInterface $orderAddressRepository
     */
    public function __construct(
        \Magento\Sales\Api\OrderAddressRepositoryInterface $orderAddressRepository,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->orderAddressRepository = $orderAddressRepository;
        $this->orderRepository = $orderRepository;
    }
    /**
     * {@inheritdoc}
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        try {

            $event = $observer->getEvent();
           
            $quote = $event->getQuote();
           
            $order = $event->getOrder();
           
            $order->setData('superhero_universes', $quote->getData('superhero_universes'));

        } catch (\Exception $e) {
 
            throw new LocalizedException(__('Something went wrong while saving additional fields to order'));
 
        }
    }
}
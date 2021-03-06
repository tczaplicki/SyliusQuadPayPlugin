<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * another great project.
 * You can find more information about us on https://bitbag.shop and write us
 * an email on mikolaj.krol@bitbag.pl.
 */

declare(strict_types=1);

namespace Tests\BitBag\SyliusQuadPayPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use BitBag\SyliusQuadPayPlugin\Client\QuadPayApiClientInterface;
use Sylius\Behat\Context\Ui\Admin\ManagingOrdersContext;
use Sylius\Component\Core\Model\OrderInterface;
use Tests\BitBag\SyliusQuadPayPlugin\Behat\Mocker\QuadPayApiMocker;

final class RefundContext implements Context
{
    /** @var QuadPayApiClientInterface */
    private $quadPayApiMocker;

    /** @var ManagingOrdersContext */
    private $managingOrdersContext;

    public function __construct(
        QuadPayApiMocker $quadPayApiMocker,
        ManagingOrdersContext $managingOrdersContext
    ) {
        $this->quadPayApiMocker = $quadPayApiMocker;
        $this->managingOrdersContext = $managingOrdersContext;
    }

    /**
     * @When /^I mark (this order)'s QuadPay payment as refunded$/
     */
    public function iMarkThisOrdersQuadPayPaymentAsRefunded(OrderInterface $order): void
    {
        $this->quadPayApiMocker->mockApiRefundedPayment(function () use ($order) {
            $this->managingOrdersContext->iMarkThisOrderSPaymentAsRefunded($order);
        });
    }
}

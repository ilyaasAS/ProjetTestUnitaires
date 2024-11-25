<?php
use PHPUnit\Framework\TestCase;

class ShoppingListManagerTest extends TestCase
{
    // Test ajout d'article sans nom
    public function testAddItemWithoutNameThrowsException()
    {
        $mockNotificationService = $this->createMock(NotificationService::class);
        $shoppingListManager = new ShoppingListManager($mockNotificationService);

        $this->expectException(InvalidArgumentException::class);
        $shoppingListManager->addItem(['name' => '']);
    }

    // Test ajout d'un article avec priorité élevée et envoi de notification
    public function testAddHighPriorityItemSendsNotification()
    {
        $mockNotificationService = $this->createMock(NotificationService::class);
        $mockNotificationService->expects($this->once())
            ->method('sendNotification')
            ->with("New high-priority item added to your shopping list");

        $shoppingListManager = new ShoppingListManager($mockNotificationService);

        $shoppingListManager->addItem(['name' => 'Urgent item', 'priority' => 'high']);
    }

    // Test suppression d'article
    public function testDeleteItem()
    {
        $mockNotificationService = $this->createMock(NotificationService::class);
        $shoppingListManager = new ShoppingListManager($mockNotificationService);

        $this->assertTrue($shoppingListManager->deleteItem(1));
    }

    // Test marquage d'un article comme acheté
    public function testMarkItemAsPurchased()
    {
        $mockNotificationService = $this->createMock(NotificationService::class);
        $shoppingListManager = new ShoppingListManager($mockNotificationService);

        $this->assertTrue($shoppingListManager->markItemAsPurchased(1));
    }
}

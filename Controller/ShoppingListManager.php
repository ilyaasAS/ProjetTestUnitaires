<?php

class ShoppingListManager
{
    private $notificationService;

    public function __construct($notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function addItem($item)
    {
        if (empty($item['name'])) {
            throw new InvalidArgumentException("Item name is required");
        }

        // Code pour ajouter l'article à la liste
        // Exemple simple : stockage dans un tableau
        // $this->shoppingList[] = $item;

        if ($item['priority'] === 'high') {
            $this->notificationService->sendNotification("New high-priority item added to your shopping list");
        }

        return true;
    }

    public function updateItem($itemId, $itemData)
    {
        // Code pour mettre à jour un article de la liste
        return true;
    }

    public function deleteItem($itemId)
    {
        // Code pour supprimer l'article de la liste
        return true;
    }

    public function markItemAsPurchased($itemId)
    {
        // Code pour marquer un article comme acheté
        return true;
    }
}

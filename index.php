<?php
// Define the list of products using an associative array (Product ID as the key)
$products = [
    1 => ["name" => "Fudge Cookie", "price" => 230],
    2 => ["name" => "Peanut Butter Cookie", "price" => 230],
    3 => ["name" => "Lemon Crinkle Cookie", "price" => 240],
    4 => ["name" => "Red Velvet Cookie", "price" => 245],
    5 => ["name" => "Oatmeal Cookie", "price" => 230]
];

// Initialize the cart and total amount variables
$cart = [];
$totalAmount = 0;

// Check if the form has been submitted (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through the products and check if the user selected a quantity for each product
    foreach ($products as $productId => $product) {
        // Check if a quantity is entered and greater than 0
        if (isset($_POST['quantity_' . $productId]) && $_POST['quantity_' . $productId] > 0) {
            $quantity = $_POST['quantity_' . $productId]; // Get the quantity entered by the user
            // Add the product to the cart array with details, including quantity and total
            $cart[] = [
                'id' => $productId,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'total' => $product['price'] * $quantity
            ];
            // Add the total price of this product to the grand total amount
            $totalAmount += $product['price'] * $quantity;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Ordering System with Key-Value Pair</title>
</head>
<body>

    <h1>Order Your Cookies</h1>

    <!-- Form to enter quantities for each product -->
    <form method="POST">
        <?php foreach ($products as $productId => $product): ?>
            <div>
                <label>
                    <?php echo $product['name'] . " - ₱" . number_format($product['price'], 2); ?>
                    <input type="number" name="quantity_<?php echo $productId; ?>" min="0" placeholder="Enter quantity">
                </label>
            </div>
        <?php endforeach; ?>

        <button type="submit">Purchase</button>
    </form>

    <!-- Display the order summary if the user has added items to the cart -->
    <?php if ($cart): ?>
        <h2>Your Order Summary</h2>
        <ul>
            <?php foreach ($cart as $item): ?>
                <li>
                    <?php echo $item['name'] . " - ₱" . number_format($item['price'], 2) . " x " . $item['quantity'] . " = ₱" . number_format($item['total'], 2); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <h3>Total Amount: ₱<?php echo number_format($totalAmount, 2); ?></h3>
    <?php endif; ?>

</body>
</html>





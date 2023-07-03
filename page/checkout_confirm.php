<?php
namespace Midtrans;

require_once 'vendor/Midtrans.php';

Config::$serverKey = 'SB-Mid-server-Qu4bvihLIlPfq5SBf4Cx1MzP';
Config::$clientKey = 'SB-Mid-client-y_QtrBno-npZszyu';

$result = get('user', 'WHERE email="' . $email . '"');
$data = mysqli_fetch_assoc($result);
$user_id = $data['user_id'];

$item_details = [];

$get_cart = get('cart', 'WHERE user_id=' . $user_id);
foreach ($get_cart as $data_cart) :
    $product_id = $data_cart['product_id'];
    $quantity = $data_cart['quantity'];
    
    $get_product = get('product', 'WHERE product_id=' . $product_id);
    $data_product = mysqli_fetch_assoc($get_product);

    $product_name = $data_product['product_name'];
    $price = $data_product['price'];

    $get_sale = get('sale', 'WHERE product_id='.$product_id);
    if (mysqli_num_rows($get_sale) > 0) {
        $data_sale = mysqli_fetch_assoc($get_sale);
        
        $sale = $data_sale['sale'];
        
        $price = $price - $price * (int)$sale / 100;
    }

    $item_details[] = [
        'id' => $product_id,
        'price' => $price,
        'quantity' => $quantity,
        'name' => $product_name,
    ];
endforeach;

$total_price = 0;
foreach ($item_details as $item) {
    $subtotal_price = (int)$item['price'];
    $quantity = (int)$item['quantity'];

    $total_price = $subtotal_price * $quantity;
}

$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $total_price // no decimal allowed for creditcard
);

$enable_payments = array('credit_card','cimb_clicks','mandiri_clickpay','echannel');

$billing_address = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'address'       => "Mangga 20",
    'city'          => "Jakarta",
    'postal_code'   => "16602",
    'phone'         => "081122334455",
    'country_code'  => 'IDN'
);

$shipping_address = array(
    'first_name'    => "Obet",
    'last_name'     => "Supriadi",
    'address'       => "Manggis 90",
    'city'          => "Jakarta",
    'postal_code'   => "16601",
    'phone'         => "08113366345",
    'country_code'  => 'IDN'
);

$customer_details = array(
    'first_name'    => "Andri",
    'last_name'     => "Litani",
    'email'         => "andri@litani.com",
    'phone'         => "081122334455",
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
);

$transaction = array(
    'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details
);

$snap_token = '';
$snap_token = Snap::getSnapToken($transaction);
try {
}
catch (\Exception $e) {
    echo $e->getMessage();
}

echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'<your server key>\';');
        die();
    } 
}
?>

<!DOCTYPE html>
<html>
    <body>
        <button id="pay-button">Pay!</button>
        <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token?>', {
                    // Optional
                    onSuccess: function(result){
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onPending: function(result){
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    },
                    // Optional
                    onError: function(result){
                        /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    }
                });
            };
        </script>
    </body>
</html>

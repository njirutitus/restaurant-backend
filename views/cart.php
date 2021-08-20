<?php

?>
<!-- About us main Section-->
<main class="container">
    <h1>Cart Items</h1>
    <div class="underline"></div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Dish</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody id="cartItems">

            </tbody>
        </table>
        <div class="flex-col-end p-3">
            <p>Subtotal: <span id="subtotal" class="b">Ksh 0</span></p>
            <p>VAT: <span id="vat" class="b">Ksh 0</span></p>
            <p>Total: <span id="total" class="b">Ksh 0</span></p>
            <div>
                <a href="/menu" class="btn bg-primary">Add more Items</a>
                <a href="/checkout" class="btn bg-warning" id="placeOrder">Place Order</a>
            </div>
        </div>
    </div>
</main>
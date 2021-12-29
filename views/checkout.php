<?php
use tn\phpmvc\Application;
?>
<!-- About us main Section-->
<main class="container flex-col-center">
    <h1>Place Your Order</h1>
    <div class="underline"></div>
    <div class="row orders">
        <div class="col-6 box">
            <h2>Checkout</h2>
            <div class="underline-thin mb-3"></div>
            <form action="" method="post" id="orderForm">
                <div class="form-group row mb-3">
                    <label class="col-3" for="ordered_by">Full Name</label>
                    <input type="text" name="ordered_by" value="<?php echo !Application::isGuest() ? Application::$app->user->getDisplayName() : '' ?>" class="form-control col-6" id="ordered_by">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-3" for="table_number">Table Number</label>
                    <input type="text" name="table_number" value="" class="form-control col-6" id="table_number">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-3" for="persons">Number of Persons</label>
                    <input type="number" name="persons" min="1"  value="1" class="form-control col-6" id="persons">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group row mb-3 b">
                    <span class="col-3" for="persons">Payment Method</span>
                    <div>
                        <label for="mpesa">Mpesa</label>
                        <input type="radio" name="payment_method" value="mpesa" class="input-radio" id="mpesa" required>
                        <label for="cash">Cash</label>
                        <input type="radio" name="payment_method" value="cash" class="input-radio" id="cash">
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-3" for="phone_number">Phone Number</label>
                    <input type="number" name="phone_number" placeholder="254xxxxxxxxx" class="form-control col-6" id="phone_number">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-3" for="amount">Amount to Pay</label>
                    <input type="text" name="amount" class="form-control col-6" id="amount" readonly>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-control row">
                    <div class="col-6">
                        <input
                            type="submit"
                            class="btn bg-primary"
                            name="submit"
                            value="Confirm and Pay"
                            id="submit"
                        />
                    </div>
                    <div class="col-3"></div>
                </div>
            </form>
        </div>
        <div class="col-6 box bg-success">
            <h2>Your Order</h2>
            <div class="underline-thin"></div>
            <div class="flex-col-end">
                <div class="order-items" id="orderItemsContainer">
                </div>
                <div class="flex-row-space-between">
                    <span>Total: Ksh. <span id="total"></span></span>
                </div>
            </div>
        </div>
    </div>
</main>
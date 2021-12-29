<?php
use tn\phpmvc\Application;
?>
<!-- About us main Section-->
<main class="container flex-col-center">
    <h1>Make a Payment</h1>
    <div class="underline"></div>
    <div class="row orders">
        <div class="col-6 box">
            <h2>Payment for order no 283</h2>
            <div class="underline-thin mb-3"></div>
            <form action="" method="post" id="paymentForm">
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
                    <label class="col-3" for="phone_number">Mpesa Number</label>
                    <input type="number" name="phone_number" placeholder="254xxxxxxxxx" class="form-control col-6" id="phone_number">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-3" for="amount">Amount to Pay</label>
                    <input type="text" name="amount" class="form-control col-6" id="amount">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-control row">
                    <div class="col-6">
                        <input
                            type="submit"
                            class="btn bg-primary"
                            name="submit"
                            value="Pay"
                            id="submit"
                        />
                    </div>
                    <div class="col-3"></div>
                </div>
            </form>
        </div>
    </div>
</main>
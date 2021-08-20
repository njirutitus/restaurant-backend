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
            <form action="" method="post" id="reservationForm">
                <div class="form-group row mb-3">
                    <label class="col-3" for="reserved_by">Full Name</label>
                    <input type="text" name="reserved_by" value="<?php echo !Application::isGuest() ? Application::$app->user->getDisplayName() : '' ?>" class="form-control col-6" id="reserved_by">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-3" for="date">Table Number</label>
                    <input type="text" name="table" value="" class="form-control col-6" id="date">
                    <div class="invalid-feedback"></div>
                </div>

                <div class="form-group row mb-3">
                    <label class="col-3" for="persons">Number of Persons</label>
                    <input type="number" name="persons" min="1"  value="1" class="form-control col-6" id="persons">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-3" for="mpesa">Mpesa Number</label>
                    <input type="number" name="mpesa" placeholder="254xxxxxxxxx" class="form-control col-6" id="mpesa">
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
                    <span>Total </span>
                    <span>Ksh. <span id="total"></span></span>
                </div>
            </div>
        </div>
    </div>
</main>
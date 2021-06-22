<?php

?>
<!-- Breadcrumb -->
<div class="breadcrumb row">
    <a href="/">Home</a>
    <div class="separator">/</div>
    <a href="">Contact</a>
</div>

<main class="container">
    <h1>Contact Us</h1>

    <div class="underline"></div>

    <section class="row">
        <div class="col-6">
            <h2>Address Information</h2>
            <address>
                <p>anniversary towers</p>
                <p>along University way</p>
                <p>
                    Email: <a href="mailto:info@mamafish.com">info@mamafish.com</a>
                </p>
                <p>Tel: <a href="tel:254701234567">254701234567</a></p>
                <div>
                    <button class="bg-primary">
                        <i class="fas fa-phone"></i> Call us
                    </button>
                    <button class="bg-primary">
                        <i class="fab fa-skype"></i> Skype
                    </button>
                    <button class="bg-primary">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </button>
                </div>
            </address>
        </div>

        <div class="col-6">
            <h2>Map of our location</h2>
            <!--Map to be placed here-->
        </div>
    </section>

    <!-- Feedback Form-->
    <section class="container box">
        <h2>Send us your feedback</h2>
        <form>
            <div class="form-control row">
                <label for="first-name" class="col-3">First Name</label>
                <input
                        type="text"
                        class="form-input col-6"
                        name="first-name"
                        id="first-name"
                />
            </div>

            <div class="form-control row">
                <label for="last-name" class="col-3">Last Name</label>
                <input
                        type="text"
                        class="form-input col-6"
                        name="last-name"
                        id="last-name"
                />
            </div>

            <div class="form-control row">
                <label for="email" class="col-3">Email</label>
                <input
                        type="email"
                        class="form-input col-6"
                        name="email"
                        id="email"
                />
            </div>

            <div class="form-control row">
                <label for="tel" class="col-3">Tel.</label>
                <input type="tel" class="form-input col-6" name="tel" id="tel" />
            </div>
            <div class="form-control row">
                <label for="message" class="col-3">Message</label>
                <textarea
                        cols="15"
                        rows="4"
                        class="form-input col-6"
                        name="message"
                        id="message"
                >
            </textarea>
            </div>
            <div class="form-control row">
                <div class="col-3"></div>
                <div class="col-6">
                    <input
                            type="submit"
                            class="btn bg-primary"
                            name="submit"
                            value="Send"
                            id="submit"
                    />
                </div>
            </div>
        </form>
    </section>
</main>
<?php
$this->title = "Home";
?>
<!-- Jumbotron -->
<header class="jumbotron row">
    <div class="col-6">
        <h1>Mama Fish Restaurant</h1>
        <p>
            We take inspiration from the World's best cuisines, and create a
            unique fusion experience. Our lipsmacking creations will tickle your
            culinary senses!
        </p>
        <button class="ml-auto nav--button bg-primary action-btn" data-target="reservationModal">Book a Table</button>
        <button class="ml-auto nav--button btn-link bg-error" data-target="/menu">View Menu</button>
    </div>
    <div class="col-6">
        <img class="img-fluid" src="./images/eating-together.png" alt="" />
    </div>
</header>

<main class="container">
    <div class="row row-content highlights-item">
        <div class="title">
            <h2 class="text-center">Featured Dishes</h2>
        </div>
        <div class="underline"></div>
        <div class="highlight">
            <div class="highlight-img">
                <img
                        src="./images/pizza.png"
                        alt="pizza"
                        class="img-thumbnail"
                />
            </div>
            <div class="highlight-description">
                <h3>Pizza</h3>
                <p>
                    A unique combination of Indian Uthappam (pancake) and Italian
                    pizza, topped with Cerignola olives, ripe vine cherry tomatoes,
                    Vidalia onion, Guntur chillies and Buffalo Paneer.
                </p>
            </div>
        </div>
    </div>

    <div class="row row-content highlights-item">
        <div class="title">
            <h2 class="text-center">This month's Promotions</h2>
        </div>
        <div class="underline"></div>
        <div class="highlight">
            <div class="highlight-img">
                <img
                        src="./images/buffet.png"
                        alt="Buffet"
                        class="img-thumbnail"
                />
            </div>
            <div class="highlight-description">
                <h3>Weekend Buffet</h3>
                <p>
                    Featuring mouthwatering combinations with a choice of five
                    different salads, six enticing appetizers, six main entrees and
                    five choicest desserts. Free flowing bubbly and soft drinks. All
                    for just KES 1,999 per person
                </p>
            </div>
        </div>
    </div>

    <div class="row row-content highlights-item">
        <div class="title">
            <h2 class="text-center">Meet our specialists</h2>
        </div>
        <div class="underline"></div>
        <div class="highlight">
            <div class="highlight-img">
                <img
                        src="./images/titus.jpg"
                        alt="Chef Titus"
                        class="img-thumbnail"
                />
            </div>
            <div class="highlight-description">
                <h3>Chef Titus</h3>
                <p>
                    Award winning three-star Kenyan chef with wide International
                    experience having worked closely with whos-who in the culinary
                    world, he specializes in creating mouthwatering Indo-Italian
                    fusion experiences.
                </p>
            </div>
        </div>
    </div>
</main>
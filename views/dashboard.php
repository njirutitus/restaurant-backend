<?php
/**
 * @var $users
 * @var $menus
 * @var $comments
 * @var $reservations
*/
?>

<main class="container">
    <div class="highlights">
        <a href="/admin_users" class="btn">Users: <?php echo $users;?></a>
        <a href="/admin_dishes" class="btn">Dishes: <?php echo $menus;?></a>
        <a href="/reservations" class="btn">Reservations: <?php echo $reservations;?></a>
        <button class="btn">Orders: 200</button>
        <button class="btn">Comments: <?php echo $comments;?></button>
    </div>
    <canvas id="myChart" width="400" height="400"></canvas>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'June','July','Aug','Sept','Oct','Nov','Dec'],
            datasets: [{
                label: '# of Orders',
                data: [200, 190, 300, 500, 200, 300,200, 190, 300, 500, 200, 300],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

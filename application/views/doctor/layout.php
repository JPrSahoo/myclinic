<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Drsatyagastro : Receptionist Dashboard</title>
    <link rel="icon" type="image/png" href="<?= base_url("assets/images/favicon.ico") ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/layout.css') ?>">
</head>
<body>

<?php $this->load->view('doctor/_sidebar'); ?>

<div class="content">
    <?php $this->load->view($page); ?>
</div>
<div id="customAlert" class="custom-alert"></div>

<style>
.custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #28a745;
    color: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 9999;
    font-size: 15px;
    max-width: 300px;
    opacity: 0;
    transform: translateY(-20px);
    transition: all 0.4s ease;
    pointer-events: none;
}

.custom-alert.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}
</style>



<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<!-- <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('1fc4423c6cd58353dd58', {
    cluster: 'ap2'
    });

    var channel = pusher.subscribe('clinic-channel');
    channel.bind('new-notification', function(data) {
        alert(data.message);
    });
</script> -->

<script>
    function showCustomAlert(message) {
        var alertBox = document.getElementById("customAlert");
        alertBox.textContent = message;
        alertBox.classList.add("show");

        // Hide after 4 seconds
        setTimeout(function () {
            alertBox.classList.remove("show");
        }, 4000);
    }

    document.addEventListener("DOMContentLoaded", function () {
        Pusher.logToConsole = true;

        var pusher = new Pusher('1fc4423c6cd58353dd58', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('clinic-channel');
        channel.bind('new-notification', function(data) {
            showCustomAlert(data.message);
        });
    });


</script>

</body>
</html>

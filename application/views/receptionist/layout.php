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

<?php $this->load->view('receptionist/_sidebar'); ?>

<div class="content">
    <?php $this->load->view($page); ?>
</div>

</body>
</html>

<h1><?= $page_title ?? 'Dashboard' ?></h1>

    <div class="grid">
        <div class="card">
            <h3><i class="fas fa-user-injured"></i> Patients Today</h3>
            <p>30</p>
        </div>
        <div class="card">
            <h3><i class="fas fa-user-plus"></i> New Registrations</h3>
            <p>12</p>
        </div>
        <div class="card">
            <h3><i class="fas fa-flask"></i> Tests Scheduled</h3>
            <p>6</p>
        </div>
    </div>

<script>
    const source = new EventSource("<?php echo base_url('notification/stream'); ?>");

    source.onmessage = function(event) {
        if (event.data) {
            const data = JSON.parse(event.data); 
            alert("🔔 " + data.message);  // or show it as a toast
        }
    };
</script>



<!-- <h2><?= $page_title ?></h2> -->

<style>
.container {
    font-family: 'Segoe UI', sans-serif;
    margin-top: 20px;
}
.profile-card {
    background: #f9f9f9;
    padding: 20px;
    border-left: 5px solid #009879;
    margin-bottom: 20px;
    border-radius: 5px;
}
.tab-container {
    margin-top: 20px;
}
.tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 10px;
}
.tabs button {
    padding: 10px 20px;
    border: none;
    background: #eee;
    cursor: pointer;
    border-radius: 3px;
    font-weight: bold;
}
.tabs button.active {
    background: #009879;
    color: #fff;
}
.tab-content {
    display: none;
}
.tab-content.active {
    display: block;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
th, td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}
thead {
    background: #f0f0f0;
}
</style>

<div class="container">
    <div class="profile-card">
        <h3><?= $patient->name ?> (<?= ucfirst($patient->gender) ?>, <?= $patient->age ?> yrs)</h3>
        <p><strong>Contact:</strong> <?= $patient->contact ?></p>
        <p><strong>Address:</strong> <?= $patient->address ?></p>
    </div>

    <div class="tab-container">
        <div class="tabs">
            <button class="tab-btn active" data-tab="visits">Visit History</button>
            <button class="tab-btn" data-tab="prescriptions">Prescriptions</button>
            <button class="tab-btn" data-tab="tests">Tests</button>
        </div>

        <div id="visits" class="tab-content active">
            <h4>Visit History</h4>
            <?php if ($visits): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Department</th>
                            <th>Symptoms</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($visits as $v): ?>
                        <tr>
                            <td><?= $v->visit_date ?></td>
                            <td><?= $v->department_name ?? '—' ?></td>
                            <td><?= $v->symptoms ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No visits yet.</p>
            <?php endif; ?>
        </div>

        <div id="prescriptions" class="tab-content">
            <h4>Prescriptions</h4>
            <?php if ($prescriptions): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Diagnosis</th>
                            <th>Medicines</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prescriptions as $p): ?>
                        <tr>
                            <td><?= $p->date ?></td>
                            <td><?= $p->diagnosis ?></td>
                            <td><?= $p->medicines ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No prescriptions found.</p>
            <?php endif; ?>
        </div>

        <div id="tests" class="tab-content">
            <h4>Tests</h4>
            <?php if ($tests): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Test Name</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tests as $t): ?>
                        <tr>
                            <td><?= $t->test_date ?></td>
                            <td><?= $t->test_name ?></td>
                            <td><?= $t->result ?? 'Pending' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No tests assigned.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(tab => tab.classList.remove('active'));

            btn.classList.add('active');
            document.getElementById(btn.dataset.tab).classList.add('active');
        });
    });
</script>

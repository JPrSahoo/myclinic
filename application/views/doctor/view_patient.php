<h2><?= $page_title ?></h2>

<?php foreach ($visits as $visit): ?>
    <div style="background:#f9f9f9; border-left:4px solid #009879; padding:15px; margin-bottom:20px;">
        <h4>Visit Date: <?= $visit->visit_date ?> | Department: <?= $visit->department_name ?></h4>
        <p><strong>Symptoms:</strong> <?= $visit->symptoms ?></p>

        <?php if ($visit->prescriptions): ?>
            <h5>Prescriptions</h5>
            <ul>
                <?php foreach ($visit->prescriptions as $pres): ?>
                    <li><strong>Date:</strong> <?= $pres->date ?> | <strong>Diagnosis:</strong> <?= $pres->diagnosis ?><br>
                        <strong>Medicines:</strong> <?= $pres->medicines ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><em>No prescriptions.</em></p>
        <?php endif; ?>

        <?php if ($visit->tests): ?>
            <h5>Tests</h5>
            <ul>
                <?php foreach ($visit->tests as $test): ?>
                    <li><strong><?= $test->test_name ?></strong> — <?= $test->result ?? 'Pending' ?> (<?= $test->test_date ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><em>No tests.</em></p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

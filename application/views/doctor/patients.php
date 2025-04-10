<h2><?= $page_title ?></h2>

<style>
.table-wrapper {
    margin-top: 20px;
    overflow-x: auto;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    font-size: 16px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
}

.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th, .styled-table td {
    padding: 12px 15px;
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-child(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:hover {
    background-color: #d1f0e6;
    cursor: pointer;
}

.styled-table td a {
    color: #007bff;
    text-decoration: none;
}

.styled-table td a:hover {
    text-decoration: underline;
}
</style>

<div class="table-wrapper">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $p): ?>
                <tr>
                    <td><?= $p->id ?></td>
                    <td><?= $p->name ?></td>
                    <td><?= $p->age ?></td>
                    <td><?= ucfirst($p->gender) ?></td>
                    <td><?= $p->contact ?></td>
                    <td>
                        <a href="<?= site_url('doctor/patient/' . $p->id) ?>">View</a> |
                        <a href="<?= site_url('doctor/patient/' . $p->id . '/prescribe') ?>">Prescribe</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

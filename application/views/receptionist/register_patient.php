<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
    <style>
        .form-card {
            max-width: 98%;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
            padding:15px 20px;
        }

        .tabs {
            display: flex;
            background-color: #2c3e50;
        }

        .tab-button {
            flex: 1;
            padding: 14px;
            background: #2c3e50;
            color: #ecf0f1;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .tab-button.active {
            background: #34495e;
        }

        .tab-content {
            display: none;
            padding: 25px;
        }

        .active-tab {
            display: block;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 18px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group.full {
            flex: 100%;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background: #fdfdfd;
            font-size: 14px;
        }

        .form-footer {
            padding: 20px;
            text-align: right;
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
        }

        .btn {
            background: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn:hover {
            background: #2980b9;
        }
        .select2-selection{
            height: 40px !important;
        }
        .select2-selection__rendered{
            line-height: 38px !important;
        }
        .select2-selection__arrow, .select2-selection__clear{
            height: 40px !important;
        }
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
    </style>



<h1><?= $page_title ?? 'Patient Registration' ?></h1>

    <div id="registerForm">
        <div class="form-card">
            <!-- <div class="tabs">
                <button class="tab-button active" onclick="openTab(event, 'patientInfo')">
                    <i class="fas fa-user"></i> Patient Info
                </button>
                <button class="tab-button" onclick="openTab(event, 'medicalInfo')">
                    <i class="fas fa-notes-medical"></i> Medical Info
                </button>
            </div> -->

            <!--<form action="<?= base_url('receptionist/register_patient') ?>" method="post">
                <div id="patientInfo" class="tab-content active-tab">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option value="">-- Select --</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full">
                            <label>Address</label>
                            <input type="text" name="address">
                        </div>
                    </div>
                </div>

                <div id="medicalInfo" class="tab-content">
                    <div class="form-row">
                        <div class="form-group full">
                            <label>Symptoms</label>
                            <textarea name="symptoms" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group full">
                            <label>Department</label>
                            <select name="department" required>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept->id ?>"><?= $dept->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Register Patient</button>
                </div>
            </form>-->

            <form action="<?= base_url('receptionist/register_patient') ?>" method="post">
                <div class="form-row">
                    <p style="font-size:16px;">Date : <?php echo date("d/m/Y");?></p>
                    <!-- <p style="font-size:16px;"> <?php echo  date("l");?></p> -->
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" min="0" max="100" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="number" name="contact" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Adress</label>
                        <textarea row="5" name="address"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Symptoms</label>
                        <textarea row="5" name="symptoms"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Department</label>
                        <select id="dept_id" name="dept_id" class="form-control select2">
                            <option value="">Select Department</option>
                            <?php foreach (get_departments() as $dept): ?>
                                <option value="<?= $dept->id ?>"><?= $dept->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Doctor</label>
                        <select id="doctor_id" name="doctor_id" class="form-control select2">
                            <option value="">Doctor</option>
                            <?php foreach (get_doctors() as $doc): ?>
                                <!-- <option value="<?= $doc->id ?>"><?= $doc->name ?></option> -->
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Register Patient</button>
                </div>
            </form>

        </div>
    </div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    function openTab(evt, tabId) {
        let tabContents = document.getElementsByClassName("tab-content");
        for (let i = 0; i < tabContents.length; i++) {
            tabContents[i].classList.remove("active-tab");
        }

        let tabButtons = document.getElementsByClassName("tab-button");
        for (let i = 0; i < tabButtons.length; i++) {
            tabButtons[i].classList.remove("active");
        }

        document.getElementById(tabId).classList.add("active-tab");
        evt.currentTarget.classList.add("active");
    }
    document.addEventListener("DOMContentLoaded", function () {
        const flash = document.querySelector('.alert');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity 0.5s ease-out';
                flash.style.opacity = '0';
                setTimeout(() => {
                    flash.style.display = 'none';
                }, 500);
            }, 2000); // Disappear after 4 seconds
        }
    });
</script>

<script>
    $(document).ready(function () {
        var base_url = '<?= base_url();?>';
        $('#dept_id').select2({
            placeholder: 'Search or select a department',
            allowClear: true,
            width: '100%'
        });
        $('#doctor_id').select2({
            placeholder: 'Search or select a doctor',
            allowClear: true,
            width: '100%'
        });
        
        $('#dept_id').on('change', function () {
            var dept_id = $(this).val();
            if (dept_id) {
                $.ajax({
                    url: base_url + 'get-doctors-by-department',
                    type: 'POST',
                    data: { dept_id: dept_id },
                    dataType: 'json',
                    success: function (doctors) {
                        $('#doctor_id').empty().append('<option value="">Select Doctor</option>');
                        $.each(doctors, function (i, doc) {
                            $('#doctor_id').append('<option value="' + doc.id + '">' + doc.name + '</option>');
                        });
                    }
                });
            } else {
                $('#doctor_id').empty().append('<option value="">Select Doctor</option>');
            }
        });
    });
</script>

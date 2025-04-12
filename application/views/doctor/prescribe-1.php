<style>
    .prescription-form {
        max-width: 700px;
        margin: 30px auto;
        padding: 25px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        font-family: "Segoe UI", sans-serif;
    }

    .prescription-form h3 {
        text-align: center;
        margin-bottom: 20px;
        color: #009879;
    }

    .prescription-form label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .prescription-form textarea,
    .prescription-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        resize: vertical;
    }

    .prescription-form textarea{
        width: 97%;
    }

    .prescription-form select[multiple] {
        height: 120px;
    }

    .prescription-form button {
        background-color: #009879;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        width: 100%;
    }

    .prescription-form button:hover {
        background-color: #007f68;
    }

    .alert-success {
        background-color: #e6f9f0;
        color: #155e3b;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-left: 5px solid #28a745;
        border-radius: 6px;
    }
.search-dropdown {
    position: relative;
    width: 100%;
    margin-bottom: 15px;
}

.search-dropdown input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

.dropdown-options {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    width: 97%;
    max-height: 200px;
    overflow-y: auto;
    padding: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    z-index: 999;
}

.search-dropdown.open-down ~ .dropdown-options {
    top: 100%;
    border-radius: 0 0 6px 6px;
}

.search-dropdown.open-up .dropdown-options {
    bottom: 100%;
    border-radius: 6px 6px 0 0;
}

.dropdown-options label {
    display: block;
    margin-bottom: 5px;
}

.search-dropdown.active .dropdown-options {
    display: block;
}
#dropdownOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 998;
}
</style>

<div id="dropdownOverlay" style="display:none;"></div>
<div class="prescription-form">
    <h3>Prescribe for <?= $patient->name ?></h3>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Diagnosis</label>
        <select onchange="document.getElementById('diagnosis').value=this.value">
            <option value="">-- Select Common Diagnosis --</option>
            <option value="Fever and cold">Fever and cold</option>
            <option value="Abdominal pain">Abdominal pain</option>
            <option value="Diabetes check-up">Diabetes check-up</option>
        </select>
        <textarea id="diagnosis" name="diagnosis" rows="3"></textarea>

        <label for="medicines">Medicines</label>
        <div class="search-dropdown" data-dropdown="true">
            <input type="text" placeholder="Search and select" onfocus="showDropdown(this)" onkeyup="filterDropdown(this)">
            <div class="dropdown-options">
                <?php foreach ($tests as $test): ?>
                    <label>
                        <input type="checkbox" name="tests[]" value="<?= $test->id ?>">
                        <?= $test->name ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <ol class="selected-list" style="margin-top: 10px;"></ol>
        </div>
        <ol id="selectedTestsList" style="margin-top: 10px;"></ol>

        <label for="tests">Suggested Tests (Optional)</label>
        <!-- <div class="search-dropdown" id="testDropdown">
            <input type="text" placeholder="Search and select tests" onclick="showOptions()" onkeyup="filterOptions(this.value)">
            <div class="dropdown-options" id="testOptions">
                <?php foreach ($tests as $test): ?>
                    <label>
                        <input type="checkbox" name="tests[]" value="<?= $test->id ?>">
                        <?= $test->name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div> -->
        

        <div class="search-dropdown" data-dropdown="true">
            <input type="text" placeholder="Search and select" onfocus="showDropdown(this)" onkeyup="filterDropdown(this)">
            <div class="dropdown-options">
                <?php foreach ($tests as $test): ?>
                    <label>
                        <input type="checkbox" name="tests[]" value="<?= $test->id ?>">
                        <?= $test->name ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <ol class="selected-list" style="margin-top: 10px;"></ol>
        </div>
        <ol id="selectedTestsList" style="margin-top: 10px;"></ol>


        <button type="submit">Save Prescription</button>
    </form>
</div>

<script>
function showDropdown(input) {
    const dropdown = input.closest('[data-dropdown]');
    const optionsBox = dropdown.querySelector('.dropdown-options');

    // Remove open classes
    dropdown.classList.remove('open-up', 'open-down');

    // Space check
    const rect = input.getBoundingClientRect();
    const spaceBelow = window.innerHeight - rect.bottom;
    const spaceAbove = rect.top;

    dropdown.classList.add(spaceBelow < 220 && spaceAbove > spaceBelow ? 'open-up' : 'open-down');
    dropdown.classList.add('active');

    document.getElementById('dropdownOverlay').style.display = 'block';
}

function filterDropdown(input) {
    const query = input.value.toLowerCase();
    const dropdown = input.closest('[data-dropdown]');
    const options = dropdown.querySelectorAll('.dropdown-options label');

    options.forEach(label => {
        const text = label.textContent.toLowerCase();
        label.style.display = text.includes(query) ? '' : 'none';
    });
}

function updateSelectedList(dropdown) {
    const checkboxes = dropdown.querySelectorAll('.dropdown-options input[type="checkbox"]:checked');
    const list = dropdown.querySelector('.selected-list');
    list.innerHTML = '';

    checkboxes.forEach(box => {
        const li = document.createElement('li');
        li.textContent = box.parentElement.textContent.trim();
        list.appendChild(li);
    });
}

// Global close on outside click or Escape
document.addEventListener('mousedown', function (e) {
    document.querySelectorAll('[data-dropdown].active').forEach(dropdown => {
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove('active', 'open-up', 'open-down');
            document.getElementById('dropdownOverlay').style.display = 'none';
        }
    });
});

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
            dropdown.classList.remove('active', 'open-up', 'open-down');
        });
        document.getElementById('dropdownOverlay').style.display = 'none';
    }
});

// Hook listeners after DOM load
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
        dropdown.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', () => updateSelectedList(dropdown));
        });
    });
});
</script>



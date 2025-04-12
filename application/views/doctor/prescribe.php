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

    .prescription-form input,
    .prescription-form textarea,
    .prescription-form select, .textbox {
        width: 97%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        resize: vertical;
    }
    .textbox ol {
        font-weight: 500;
        padding-left: 0px;
    }
    .prescription-form select {
        width: 100%;
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

    /* Overlay */
    .modal-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 999;
        display: none;
    }

    .modal-overlay.show {
        display: block;
    }

    /* Sliding Modal */
    .slide-modal {
        position: fixed;
        top: 0;
        right: 0;
        width: 50%;
        height: 100%;
        background: #fff;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.2);
        transform: translateX(100%);
        transition: transform 0.4s ease-in-out;
        z-index: 1000;
        overflow-y: auto;
        padding: 20px;
        font-family: "Segoe UI", sans-serif;
    }

    .slide-modal.open {
        transform: translateX(0);
    }

    .slide-modal label {
        display: block;
        margin-bottom: 8px;
    }

    .selected-list {
        margin-left: 20px;
        margin-bottom: 15px;
    }
    .selected-list li {
        position: relative;
        padding-right: 25px;
        margin-bottom: 10px;
    }

    .selected-list li .remove-item {
        position: absolute;
        right: 5px;
        top: 0;
        font-weight: bold;
    }


</style>

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


        <label for="tests">Suggested Tests (Optional)</label>
        <!-- <input type="text" class="modal-trigger" data-type="tests" placeholder="Click to select tests" readonly> -->
         <div class="textbox modal-trigger" data-type="tests">
            <span>Click to select tests</span>
            <ol class="selected-list" data-type="tests"></ol>
            <input type="hidden" name="tests[]" id="selectedTestIds">
         </div>
       

        <!-- <label>Medicines</label>
        <input type="text" class="modal-trigger" data-type="medicines" placeholder="Click to select medicines" readonly>
        <input type="hidden" name="medicines_ids">
        <ol class="selected-list" data-type="medicines"></ol> -->
        

        <button type="submit">Save Prescription</button>
    </form>
</div>

<!-- Overlay -->
<div id="modalOverlay" class="modal-overlay" onclick="closeModal()"></div>

<!-- Modal -->
<div id="genericModal" class="slide-modal">
    <h4 id="modalTitle">Select Options</h4>
    <div class="modal-options" id="modalOptions">
        <!-- Dynamic checkboxes go here -->
    </div>
    <div style="text-align: right; margin-top: 15px;">
        <button type="button" onclick="applySelection()">OK</button>
        <button type="button" onclick="closeModal()">Cancel</button>
    </div>
</div>

<script>
    let activeInput = null;
    let activeList = null;
    let activeHidden = null;
    let currentType = null;

    const modalData = {
        tests: <?= json_encode(array_map(function($t) { return ['id' => $t->id, 'name' => $t->name]; }, $tests)) ?>,
        medicines: [
            { id: 1, name: 'Paracetamol' },
            { id: 2, name: 'Ibuprofen' },
            { id: 3, name: 'Amoxicillin' }
        ]
    };

    document.querySelectorAll('.modal-trigger').forEach(input => {
        input.addEventListener('click', function (e) {
            // Prevent opening modal if click originated from inside a remove-item
            if (e.target.closest('.remove-item')) return;

            activeInput = this;
            activeList = this.parentElement.querySelector('.selected-list');
            activeHidden = this.parentElement.querySelector('input[type="hidden"]');
            currentType = this.dataset.type;

            openModal(currentType);
        });
    });


    function openModal(type) {
        const modal = document.getElementById('genericModal');
        const optionsContainer = document.getElementById('modalOptions');
        const modalTitle = document.getElementById('modalTitle');

        modalTitle.textContent = 'Select ' + (type.charAt(0).toUpperCase() + type.slice(1));
        optionsContainer.innerHTML = '';

        modalData[type].forEach(item => {
            const label = document.createElement('label');
            label.innerHTML = `
                <input type="checkbox" value="${item.id}" data-name="${item.name}">
                ${item.name}
            `;
            optionsContainer.appendChild(label);
        });

        modal.classList.add('open');
        document.getElementById('modalOverlay').classList.add('show');
    }

    function closeModal() {
        document.getElementById('genericModal').classList.remove('open');
        document.getElementById('modalOverlay').classList.remove('show');
    }

    function applySelection() {
        const checkboxes = document.querySelectorAll('#modalOptions input:checked');
        const selectedNames = [];
        const selectedIds = [];

        activeList.innerHTML = '';

        checkboxes.forEach(cb => {
            const li = document.createElement('li');
            li.innerHTML = `
                ${cb.dataset.name}
                <span class="remove-item" style="color: red; margin-left: 10px; cursor: pointer;">&times;</span>
            `;
            li.dataset.id = cb.value;
            activeList.appendChild(li);
            selectedNames.push(cb.dataset.name);
            selectedIds.push(cb.value);
        });

        activeInput.value = selectedNames.join(', ');
        if (activeHidden) {
            activeHidden.value = selectedIds.join(',');
        }

        closeModal();
    }
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-item')) {
            e.preventDefault();
            e.stopPropagation(); // Prevent modal from reopening

            const li = e.target.closest('li');
            const list = li.parentElement;
            const hiddenInput = list.parentElement.querySelector('input[type="hidden"]');
            const inputBox = list.parentElement.querySelector('.modal-trigger');

            li.remove();

            // Update hidden input and visible input
            const remainingItems = Array.from(list.querySelectorAll('li')).map(item => ({
                id: item.dataset.id,
                name: item.querySelector('.item-name').textContent
            }));

            hiddenInput.value = remainingItems.map(item => item.id).join(',');
            inputBox.value = remainingItems.map(item => item.name).join(', ');
        }
    });




    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });
</script>

document.addEventListener('DOMContentLoaded', () => {
    // 1. Table CRUD (Add, Edit, Delete)
    const tableContainer = document.querySelector('.table-container');
    
    if (tableContainer) {
        tableContainer.addEventListener('click', (e) => {
            // Delete Action
            if (e.target.textContent === 'Delete' || e.target.classList.contains('delete-btn')) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    const row = e.target.closest('tr');
                    if (row) row.remove();
                }
            }
            
            // Edit / Save Action
            const isEditAction = e.target.textContent === 'Edit' || 
                               e.target.textContent === 'Save' || 
                               e.target.textContent === 'View Details' || 
                               e.target.classList.contains('edit-btn');
                               
            if (isEditAction) {
                const row = e.target.closest('tr');
                const btn = e.target;
                
                if (btn.textContent === 'Edit' || btn.textContent === 'View Details') {
                    // Turn row into editable
                    const cells = row.querySelectorAll('td:not(:last-child)');
                    cells.forEach(cell => {
                        // Don't make badges editable to keep it simple
                        if(!cell.querySelector('.badge')) {
                            cell.contentEditable = "true";
                            cell.style.backgroundColor = "#fef9e7";
                            cell.style.outline = "1px dashed #ccc";
                        }
                    });
                    btn.textContent = 'Save';
                    btn.classList.remove('btn-secondary');
                    btn.classList.add('btn-primary');
                } else if (btn.textContent === 'Save') {
                    // Save changes
                    const cells = row.querySelectorAll('td:not(:last-child)');
                    cells.forEach(cell => {
                        if(!cell.querySelector('.badge')) {
                            cell.contentEditable = "false";
                            cell.style.backgroundColor = "";
                            cell.style.outline = "none";
                        }
                    });
                    btn.textContent = 'Edit';
                    btn.classList.remove('btn-primary');
                    btn.classList.add('btn-secondary');
                    
                    // Show a quick visual feedback
                    btn.textContent = 'Saved!';
                    setTimeout(() => btn.textContent = 'Edit', 1500);
                }
            }
        });
    }

    // Handle Add New Button
    const addBtns = document.querySelectorAll('header .btn-primary');
    addBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tbody = document.querySelector('table tbody');
            if (!tbody) return;
            
            const thead = document.querySelector('table thead tr');
            if (!thead) return;
            const colCount = thead.children.length;
            
            const tr = document.createElement('tr');
            let html = '';
            
            // Generate empty editable cells
            for(let i=0; i<colCount-1; i++) {
                html += `<td contenteditable="true" style="background-color: #fef9e7; outline: 1px dashed #ccc;">Data Baru</td>`;
            }
            
            // Add action buttons
            html += `<td>
                <button class="btn btn-primary edit-btn">Save</button>
                <button class="btn delete-btn" style="color: var(--status-red-text); margin-left: 0.5rem; background: none; border: none; cursor: pointer;">Delete</button>
            </td>`;
            
            tr.innerHTML = html;
            tbody.insertBefore(tr, tbody.firstChild);
        });
    });

    // 2. Settings Form / Generic Form Save
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            // Ignore login form redirection
            if (form.getAttribute('action') === 'dashboard.php') {
                return;
            }
            e.preventDefault();
            const btn = form.querySelector('button[type="submit"]');
            if (btn) {
                const originalText = btn.textContent;
                btn.textContent = 'Berhasil Disimpan!';
                btn.style.backgroundColor = 'var(--status-green-text)';
                btn.style.color = 'white';
                setTimeout(() => {
                    btn.textContent = originalText;
                    btn.style.backgroundColor = '';
                }, 2000);
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filterP-input');
    const tableRows = document.querySelectorAll('.table__tr');

    filterInput.addEventListener('keyup', function() {
        const filterValue = filterInput.value.toLowerCase();

        tableRows.forEach(row => {
            const nameCell = row.querySelector('td:first-child');
            const emailCell = row.querySelector('td:nth-child(2)');
            const subjectsCell = row.querySelector('td:nth-child(3)');

            const nameValue = nameCell.textContent.toLowerCase();
            const emailValue = emailCell.textContent.toLowerCase();
            const subjectsValue = subjectsCell.textContent.toLowerCase();

            if (
                nameValue.includes(filterValue) ||
                emailValue.includes(filterValue) ||
                subjectsValue.includes(filterValue)
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

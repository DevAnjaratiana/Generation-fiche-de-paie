
document.addEventListener('DOMContentLoaded', function () {
const employeeSelect = document.getElementById('employee_id');
const moisSelect = document.getElementById('mois');
const anneeInput = document.getElementById('annee');

employeeSelect.addEventListener('change', function () {
    const employeeId = this.value;
    if (!employeeId) return;

    const url = `/pay_slips/employee-data?employee_id=${employeeId}`;

    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
        .then(res => res.json())
        .then(data => {


        })
        .catch(err => console.error(err));
});

});

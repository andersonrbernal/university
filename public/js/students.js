const btnSave = document.querySelector('#btn-save');
btnSave.addEventListener('click', save, false);

const studentForm = {
    formId: 'form',
    url: '/insertstudent',
}

async function save() {
    const json = await insert(studentForm.formId, studentForm.url);
    if (json.status) {
        alert(0, "Student successfully registered.", "Success!", "students");
    } else {
        alert(1, json.msg, "Failure!", "")
    }
}


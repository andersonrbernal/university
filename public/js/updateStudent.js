const btnUpdate = document.querySelector('#btn-update');

btnUpdate.addEventListener('click', updateStudent, false);

async function updateStudent() {
    const studentForm = {
        formId: 'form',
        url: '/updatestudent',
    }
    const json = await insert(studentForm.formId, studentForm.url);
    if (json.status) {
        alert(0, "Estudante salvo com sucesso.", "Sucesso!", "students");
    } else {
        alert(1, json.msg, "Falha!", "")
    }
}

const btnSave = document.querySelector('#btn-save');
btnSave.addEventListener('click', insertStudent, false);

async function insertStudent() {
    const studentForm = {
        formId: 'form',
        url: '/insertstudent',
    }
    const json = await insert(studentForm.formId, studentForm.url);
    if (json.status) {
        alert(0, "Estudante cadastrado com sucesso.", "Sucesso!", "students");
    } else {
        alert(1, json.msg, "Falha!", "")
    }
}
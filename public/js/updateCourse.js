const btnUpdate = document.querySelector('#btn-update');

btnUpdate.addEventListener('click', updateStudent, false);

async function updateStudent() {
    const studentForm = {
        formId: 'form',
        url: '/updatecourse',
    }
    const json = await insert(studentForm.formId, studentForm.url);
    if (json.status) {
        alert(0, "Curso salvo com sucesso.", "Sucesso!", "courses");
    } else {
        alert(1, json.msg, "Falha!", "")
    }
}

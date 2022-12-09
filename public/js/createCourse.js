const btnSave = document.querySelector('#btn-save');
btnSave.addEventListener('click', insertCouse, false);

async function insertCouse() {
    const courseForm = {
        formId: 'form',
        url: '/insertcourse',
    }
    const json = await insert(courseForm.formId, courseForm.url);
    if (json.status) {
        alert(0, "Curso cadastrado com sucesso.", "Sucesso!", "courses");
    } else {
        alert(1, json.msg, "Falha!", "")
    }
}

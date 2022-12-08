const btnSave = document.querySelector('#btn-save');
btnSave.addEventListener('click', save, false);

const courseForm = {
    formId: 'form',
    url: '/insertcourse',
}

async function save() {
    const json = await insert(courseForm.formId, courseForm.url);
    if (json.status) {
        alert(0, "Course successfully registered.", "Success!", "courses");
    } else {
        alert(1, json.msg, "Failure!", "")
    }
}


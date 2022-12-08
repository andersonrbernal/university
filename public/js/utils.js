async function insert(formId, url) {
    try {
        const form = document.querySelector(formId);
        const data = new FormData(form);
        const opt = {
            method: 'POST',
            mode: 'cors',
            body: data,
            cache: 'default'
        }
        const response = await fetch(url, opt);

        let json = await response.json();
        return json;
    } catch (err) {
        throw err;
    }
}

function remove(id, url) {
    try {
        // Value from input receives the ID paramter
        document.getElementById('id').value = id;
        const form = document.getElementById('formID');
        const data = new FormData(form);
        const opt = {
            method: 'POST',
            mode: 'cors',
            body: data,
            cache: 'default'
        };
        const response = fetch(url, opt)
            .then((res) => {
                if (res.ok) { location.reload() }
            })
    } catch (err) {
        console.log(err);
    }
}

function numberLimiter(input, maxValue, minValue) {
    if (input.value > minValue) {
        input.value = minValue;
    }
    if (input.value < maxValue) {
        input.value = maxValue
    }
}

function alert(status, message, title, link, pattern = true) {
    let msg = document.getElementById("msg").innerText;
    document.getElementById("title").innerHTML = title;
    document.getElementById("msg").innerHTML = message;
    // Success message
    if (status == 0) {
        document.getElementById("alert").className = 'alert alert-success';
        // document.getElementById("loading").className = 'col-2 d-none';
    }
    // Error message
    if (status == 1) {
        document.getElementById("alert").className = 'alert alert-danger animate__animated animate__shakeX animate__delay-0s';
        // document.getElementById("loading").className = 'col-2 d-none ';
    }
    // Error message
    if (status == 2) {
        document.getElementById("alert").className = 'alert alert-info';
        // document.getElementById("loading").className = 'col-2';
    }
    if (pattern === true) {
        setTimeout(() => {
            document.getElementById("alert").className = 'alert alert-warning';
            document.getElementById("title").innerHTML = 'Warning!';
            document.getElementById("msg").innerHTML = msg;
            // document.getElementById("loading").className = 'col-2 d-none';
        }, 980);
    }
    // Redirects user after 500ms
    setTimeout(() => {
        if ((link != '') && (link != undefined)) {
            // Redirects user to the givien page
            window.location.replace(link);
        }
    }, 1500);
}

function message(status, pmessage, ptitle, link, alert_id, message_id, id_title, id_loading, pattern = true) {
    const alt = document.getElementById(alert_id).innerText;
    const msg = document.getElementById(message_id).innerText;
    const title = document.getElementById(id_title).innerHTML = ptitle;
    const message = document.getElementById(message_id).innerHTML = pmessage;
    const loading = document.getElementById(id_loading).innerHTML = pmessage;
    // Success Message
    if (status == 0) {
        alt.className = 'callout callout-success';
        loading.className = 'col-2 d-none';
    }
    // Error message
    if (status == 1) {
        alt.className = 'callout callout-danger animate__animated animate__shakeX animate__delay-0s';
        loading.className = 'col-2 d-none ';
    }
    // Error message
    if (status == 2) {
        alt.className = 'callout callout-info';
        loading.className = 'col-2';
    }
    if (pattern === true) {
        setTimeout(() => {
            alt.className = 'callout callout-warning';
            title.innerHTML = 'Atenção!';
            message.innerHTML = msg;
            loading.className = 'col-2 d-none';
        }, 980);
    }
    // Redirects user after 500ms
    setTimeout(() => {
        if ((link != '') && (link != undefined)) {
            // Redirects user to the givien page
            window.location.replace(link);
        }
    }, 2000);
}

function createLoadingButton() {
    const btnLoading = document.createElement("button");
    btnLoading.textContent = 'Loading';
    btnLoading.className = 'btn btn-primary d-none';
    btnLoading.type = 'button';
    btnLoading.disabled = true;
    return btnLoading;
}

function createSpinner() {
    const spinnerSpan = document.createElement("span");
    spinnerSpan.setAttribute('class', 'spinner-border spinner-border-sm');
    spinnerSpan.setAttribute('aria-hidden', 'true');
    spinnerSpan.setAttribute('role', 'status');
    return spinnerSpan;
}

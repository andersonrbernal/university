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

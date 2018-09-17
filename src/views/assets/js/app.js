const form = document.getElementById('form');
const divSuccess = document.getElementById('msgSuccess');
const divError = document.getElementById('msgError');

form.addEventListener('submit', e => {
    e.preventDefault();
    fetch("http://localhost/api-maps/api/find", {
        method: "POST",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body:  JSON.stringify({
            rua: form.street.value,
            numero: form.number.value,
            cep: form.zipCode.value,
            cidade: form.city.value,
            bairro: form.district.value
        })
    }).then(response => {
        response.json().then(json => {
            if(response.status === 200){
                divSuccess.innerHTML = `<b>Latitude:</b> ${json.lat} <br> <b>Longitude:</b> ${json.lng}`;
                divSuccess.style.display = 'block';
                divError.style.display = 'none';
                form.reset();
            }else{
                divError.textContent = json.message;
                divError.style.display = 'block';
                divSuccess.style.display = 'none';
            }
        });
    });
})



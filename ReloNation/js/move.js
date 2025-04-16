document.addEventListener('DOMContentLoaded', function() {
    let urlParams = new URLSearchParams(window.location.search);
    let typeUser = urlParams.get('type');
    let inputcity = document.querySelector("#city");
    let inputFrom = document.querySelector("#from");
    let inputTo = document.querySelector("#to");
    let btn = document.querySelector(".btn");
    let rep = document.querySelector(".result");

    if (typeUser === 'moving') {
        inputcity.style.display = 'none';
    } else {
        inputFrom.style.display = 'none';
        inputTo.style.display = 'none';
        btn.innerHTML = "Get Cleaning!";
    }

    document.querySelector("#serviceForm").addEventListener("submit", function(event) {
        event.preventDefault();

        let form = event.target;
        let formData = new FormData(form);

        let obj = {
            name: form.elements.name.value,
            email: form.elements.email.value,
            phone: form.elements.phone.value,
            date: form.elements.date.value,
            type: typeUser
        };

        if (typeUser === 'moving') {
            obj.from = form.elements.from.value;
            obj.to = form.elements.to.value;
        } else {
            obj.city = form.elements.city.value;
        }

        formData.append("data", JSON.stringify(obj));

        fetch("../php/move.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status === "error") {
                rep.innerHTML = `<input type='text' disabled value='${data.message}' style='background:#d64040e2; color:#fff;'>`;
            } else {
                window.location.href = "../html/Noti.html";
            }
        })
    });
});

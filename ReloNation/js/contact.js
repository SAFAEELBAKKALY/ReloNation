const form = document.querySelector("form");
let btn = document.querySelector(".btn");
let rep = document.querySelector(".reponce");

form.addEventListener("submit", e =>{
    e.preventDefault();
})

btn.addEventListener("click", function(){
    
    let obj = {
        name : form.elements.name.value,
        mail : form.elements.mail.value,
        subject : form.elements.subject.value
    }
    fetch("../php/contactus.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(obj)
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data.status === 400) {
            rep.innerHTML = `<input type='text' disabled value='${data.message}' style='background:#d64040e2; color:#fff;'>`;
        } else {
            rep.innerHTML = `<input type='text' disabled value='${data.message}' style='background:#1fc51fb1; color:#fff;'>`;
        }
    })
})
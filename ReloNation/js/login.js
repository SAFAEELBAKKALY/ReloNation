const form = document.querySelector("form");
let btn = document.getElementById("btn");
let rep = document.getElementById("reponce");

form.addEventListener("submit", e =>{
    e.preventDefault();
})

btn.addEventListener("click", function(){
    let email = form.elements.email.value;
    let password = form.elements.password.value;

    let xml = new XMLHttpRequest();
    xml.open("POST", "../php/login.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send("email="+email +"&password="+password);
    xml.onload = function (){
        if(xml.readyState === XMLHttpRequest.DONE){
            if(xml.status === 200){
                let data = JSON.parse(xml.responseText)
                console.log(data);
                if(data["success"] == "admin"){
                    window.location.href = `../php/dashboard.php`;
                }else if(data["success"] == "user"){
                    window.location.href = `../php/user.php`;
                }
                else{
                    rep.innerHTML = `<input type='text' disabled value='${data["err"]}' style='background:#d64040e2; color:#fff;'>`;
                }
            }
        }
    }
})

window.addEventListener('load', ()=>{
    const form = document.querySelector('#formulario')
    const email = document.getElementById('email')
    const pass = document.getElementById('password')
    

    form.addEventListener('submit', (e)=>{
        e.preventDefault()
        validaCampos()
    })

    
    const validaCampos=()=>{
        const emailValor =email.value.trim()
        const passValor = pass.value.trim()

        if(!emailValor){
            validaFalla(email, 'Campo Vacío')
        }else if(!validaEmail(emailValor)){
            validaFalla(email, "El email no es válido")
        }else{
            validaOk(email)
            form.submit();
        }

        const er = /^(?=.*[a-z])(?=.*[A-Z]).{6,}$/ 

        if(!passValor){
            validaFalla(pass, 'Campo Vacío')
        }else if(passValor.length < 6){
            validaFalla(pass, 'Debe tener 6 caracteres como mínimo')
        }else if(!passValor.match(er)){
            validaFalla(pass, "Debe tener al menos una mayuscula, minuscula y un número")
        }else{
            validaOk(pass)
            form.submit();
        }
    }


    const validaFalla = (input, msje)=>{
        const formControl = input.parentElement
        const aviso = formControl.querySelector('p')
        aviso.innerText = msje
        formControl.className = 'form-control falla'
    }

    const validaOk = (input, msje)=>{
        const formControl = input.parentElement
        formControl.className = 'form-control ok'
    }

    const validaEmail = (email) => {
        return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
    }

   

})
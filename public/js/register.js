document.querySelector('#registerForm').addEventListener('submit', (e)=> {
    e.preventDefault();
    let data = new FormData(e.target);
    fetch('/register', {
        method: 'POST',
        body: data,
        cache: 'no-cache'
    })
    .then(async response => {
        if (response.ok) {
            return response.text()
        }else{
            const error = await response.text();
            throw new error('Error!');
        }
    })    
    .then((data)=>{ 
        let simb = data.indexOf('!');
        let msg = data.slice(0, simb+1);
        console.log(msg);
        swal('', msg, "success");        
    })    
    .then(e.target.reset())
    .catch((error)=>{
        console.log(error);
    })
});


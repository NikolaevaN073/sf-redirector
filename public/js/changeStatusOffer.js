const offerList = document.querySelector('#offerList');
const btns = offerList.querySelectorAll('button');

btns.forEach((btn) => {
    btn.addEventListener('click', (e)=> {

        let data = new FormData();
        data.append('id', e.target.id);

        fetch('/customer', {
            method: 'POST',
            body: data,
            cache: 'no-cache'
        })
        .then(async response => {
            if (response.ok) {
                return response.text()
            }else{
                const error = await response.json();
                throw new error('Error!');
            }
        })
        .then((data)=>{
            let offerStatus = data.substring(1, 2);
            if (offerStatus === 'N') {
                btn.className = "btn btn-outline-success btn-sm px-4";
                btn.innerText = 'Активировать';
            } else if (offerStatus === 'A') {
                btn.className = "btn btn-outline-danger btn-sm px-3"
                btn.innerText = 'Деактивировать';
            }
        })    
        .catch((error)=>{
            console.log(error);
        })   
       
    })
})

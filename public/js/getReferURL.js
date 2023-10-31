const offerList = document.querySelector('#userOfferList');
const links = offerList.querySelectorAll('mark');
const span = offerList.querySelector('span');

links.forEach((link) => {
    link.addEventListener('click', (e)=> {
        e.preventDefault;
        let data = new FormData();
        data.append('offer_id', e.target.id);
        data.append('user_id', span.innerText);

        fetch('/webmaster', {
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
            let simb = data.indexOf('<');
            let strURL = data.slice(0, simb);
            let url = JSON.parse(strURL);
            swal('', url, "success");
        
        })
        .catch((error)=>{
            console.log(error);
        })   
       
    })
})


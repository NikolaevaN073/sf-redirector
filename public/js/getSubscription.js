const allOffersList = document.querySelector('#allOffersList');
const btns = allOffersList.querySelectorAll('button');

btns.forEach((btn) => {
    btn.addEventListener('click', (e)=> {

        let data = new FormData();
        data.append('offer_id_to_subscription', e.target.id); 

        fetch('/webmaster', {
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
           
        .then((data) => {
            let simb = data.indexOf('}');
            let offerData = data.slice(0, simb+1);
            offerData = JSON.parse(offerData);        
            //addOffer(offerData);
            console.log(offerData);            
        })
        .then((data)=>{            
            btn.className = "btn btn-outline-success btn-sm px-4 disabled";
            btn.innerText = 'Вы подписаны';            
        }) 
        .catch((error)=>{
            console.log(error);
        })   
       
    })
});

function addOffer (data) {

    const userOfferList = document.querySelector('#userOfferList');
    let newRow = userOfferList.insertRow();
    let newCell1 = newRow.insertCell(0);
    let newCell2 = newRow.insertCell(1);
    let newCell3 = newRow.insertCell(2);
    let newCell4 = newRow.insertCell(3);
    let newCell5 = newRow.insertCell(4);   

    newCell1.innerHTML = data.category;  
    newCell2.innerHTML = data.offer_name; 
    newCell3.innerHTML = data.price.toFixed(2) +' руб.'; 

    let aDiv = document.createElement('div');
    aDiv.className = 'd-flex justify-content-end';    
    let pA = document.createElement('a');
    let pmark = document.createElement('mark');
    pmark.className = 'btn btn-outline-secondary btn-sm px-3';
    pmark.id = data.id;
    pmark.innerText = 'Получить ссылку';
    newCell5.appendChild(aDiv);     
    aDiv.appendChild(pA);   
    pA.appendChild(pmark);
    
    let btnDiv = document.createElement('div');
    btnDiv.className = 'd-flex justify-content-end';    
    let pButton = document.createElement('button');
    pButton.className = 'btn btn-outline-danger btn-sm px-3';
    pButton.innerText = 'Отписаться';
    newCell5.appendChild(btnDiv);
    btnDiv.appendChild(pButton);   
}
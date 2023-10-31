const userOfferList = document.querySelector('#userOfferList');
const buttons = userOfferList.querySelectorAll('button');

buttons.forEach((button) => {
    button.addEventListener('click', (e)=> {

        let data = new FormData();
        data.append('user_offer_id', e.target.id); 

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
            addOffer(offerData);
            console.log(offerData);            
        })
        .then((data)=>{            
            button.className = "btn btn-outline-success btn-sm px-4 disabled";
            button.innerText = 'Вы отписались';            
        }) 
        .catch((error)=>{
            console.log(error);
        })   
       
    })
});

function addOffer (data) {

    const allOffersList = document.querySelector('#allOffersList');
    let newRow = allOffersList.insertRow();
    let newCell1 = newRow.insertCell(0);
    let newCell2 = newRow.insertCell(1);
    let newCell3 = newRow.insertCell(2);
    let newCell4 = newRow.insertCell(3);  

    newCell1.innerHTML = data.offer_name;  
    newCell2.innerHTML = data.category; 
    newCell3.innerHTML = data.price.toFixed(2) +' руб.';  
    
    let btnDiv = document.createElement('div');
    btnDiv.className = 'd-flex justify-content-end';    
    let pButton = document.createElement('button');
    pButton.className = 'btn btn-outline-success btn-sm px-4';
    pButton.innerText = 'Подписаться';
    newCell4.appendChild(btnDiv);
    btnDiv.appendChild(pButton);   
}
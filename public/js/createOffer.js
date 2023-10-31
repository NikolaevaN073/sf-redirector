document.querySelector('#offerCreateForm').addEventListener('submit', (e)=> {
    e.preventDefault();
    let data = new FormData(e.target);
    fetch('/customer', {
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
        let simb = data.indexOf('}');
        let offerData = data.slice(0, simb+1);
        offerData = JSON.parse(offerData);        
        addOffer(offerData);
        console.log(offerData);
    })
    .then(e.target.reset())
    .catch((error)=>{
        console.log(error);
    })
});

function addOffer (data) {

    const offerListTable = document.querySelector('#offerList');
    let newRow = offerListTable.insertRow();
    let newCell1 = newRow.insertCell(0);
    let newCell2 = newRow.insertCell(1);
    let newCell3 = newRow.insertCell(2);
    let newCell4 = newRow.insertCell(3);
   

    newCell1.innerHTML = data.offer_name;    
    newCell2.innerHTML = data.price.toFixed(2)+' руб.';    
    newCell3.innerHTML = 0;  
    
    let btnDiv = document.createElement('div');
    btnDiv.className = 'd-flex justify-content-end';    
    let pButton = document.createElement('button');
    pButton.className = 'btn btn-outline-success btn-sm px-4';
    pButton.innerText = 'Активировать';
    newCell4.appendChild(btnDiv);
    btnDiv.appendChild(pButton);   
}
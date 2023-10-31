document.querySelector('#formStatisticCustomer').addEventListener('submit', (e)=> {
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
        let dataToShow = data.slice(0, simb+1);
        dataToShow = JSON.parse(dataToShow);        
        showForCustomer(dataToShow);
    })
    .then(e.target.reset())
    .catch((error)=>{
        console.log(error);
    })
});

function showForCustomer (data) {

    const formStatisticCustomer = document.querySelector('#formStatisticCustomer');
    let div = document.createElement('div');
    let pCount = document.createElement('p');
    let pCost = document.createElement('p');

    pCount.innerText = 'Количество переходов: ' + data.count;
    pCost.innerText = 'Расходы за выбранный период : ' + data.cost + ' руб.';

    formStatisticCustomer.appendChild(div);
    div.appendChild(pCount); 
    div.appendChild(pCost);     
}
document.querySelector('#formStatisticSystem').addEventListener('submit', (e)=> {
    e.preventDefault();
    let data = new FormData(e.target);
    fetch('/admin', {
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
        showForAdmin(dataToShow);
        console.log(data);
    })
    .then(e.target.reset())
    .catch((error)=>{
        console.log(error);
    })
});

function showForAdmin (data) {

    const formStatisticSystem = document.querySelector('#formStatisticSystem');
    let div = document.createElement('div');
    let pLinks = document.createElement('p');
    let pClicks = document.createElement('p');
    let pDenial = document.createElement('p');
    let pProfit = document.createElement('p');

    pLinks.innerText = 'Количество выданных ссылок за все время: ' + data.links;
    pClicks.innerText = 'Количество переходов за выбранный период: ' + data.clicks;
    pDenial.innerText = 'Количество отказов за выбранный период: ' + data.denial;
    pProfit.innerText = 'Доход системы за выбранный период : ' + data.profit + ' руб.';

    formStatisticSystem.appendChild(div);
    div.appendChild(pLinks); 
    div.appendChild(pClicks); 
    div.appendChild(pDenial); 
    div.appendChild(pProfit);     
}


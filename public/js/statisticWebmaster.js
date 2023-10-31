document.querySelector('#formStatisticWebmaster').addEventListener('submit', (e)=> {
    e.preventDefault();
    let data = new FormData(e.target);
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
    .then((data)=>{
        let simb = data.indexOf('}');
        let dataToShow = data.slice(0, simb+1);
        dataToShow = JSON.parse(dataToShow);        
        showForWebmaster(dataToShow);
    })
    .then(e.target.reset())
    .catch((error)=>{
        console.log(error);
    })
});

function showForWebmaster (data) {

    const formStatistic = document.querySelector('#formStatisticWebmaster');
    let div = document.createElement('div');
    let pCount = document.createElement('p');
    let pProfit = document.createElement('p');

    pCount.innerText = 'Количество переходов: ' + data.count;
    pProfit.innerText = 'Доход за выбранный период : ' + data.profit + ' руб.';

    formStatistic.appendChild(div);
    div.appendChild(pCount); 
    div.appendChild(pProfit);     
}


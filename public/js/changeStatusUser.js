const usersList = document.querySelector('#usersList');
const btnsUser = usersList.querySelectorAll('button');

btnsUser.forEach((btnUser) => {
    btnUser.addEventListener('click', (e)=> {

        let data = new FormData();
        data.append('user_id', e.target.id);

        fetch('/admin', {
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
            let userStatus = data.substring(1, 2);
            if (userStatus === 'N') {
                btnUser.className = "btn btn-outline-success btn-sm px-4";
                btnUser.innerText = 'Активировать';
                document.querySelector('#userStatus').innerHTML 
            } else if (userStatus === 'A') {
                btnUser.className = "btn btn-outline-danger btn-sm px-3"
                btnUser.innerText = 'Деактивировать';
            }
        })    
        .catch((error)=>{
            console.log(error);
        })   
       
    })
})

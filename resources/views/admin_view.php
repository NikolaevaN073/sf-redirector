<?php if(isset($_SESSION['isLoggedIn'])) : ?>
<div class="container my-5" id="pageBegin"> 
    <div class="d-flex justify-content-end">            
        <a href="/logout" class="btn btn-outline-danger px-5" type="submit">Выход</a>           
    </div>
    <h4 class="my-3 textalign-left color-broun">Страница администратора</h4>
    <p>
        <a class="btn btn-danger px-5 my-5" 
            data-bs-toggle="collapse" 
            href="#collapseAllUsers" 
            role="button" 
            aria-expanded="false" 
            aria-controls="collapseExample">
                Список пользователей
        </a> 
    </p>
    <div class="collapse my-5" id="collapseAllUsers">
        <div class="card card-body">
        
            <table class="table table-striped table-hover" id="usersList">
                <thead>
                    <tr>      
                        <th scope="col">Идентификатор</th>                 
                        <th scope="col">Имя</th>
                        <th scope="col">Логин</th> 
                        <th scope="col">Группа</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data as $user) : ?> 
                    <tr >                            
                        <td>
                            <p id="userID"><?=$user['id']?></p>
                        </td>
                        <td>
                            <p id="userName"><?=$user['name']?></p>
                        </td>
                        <td>
                            <p id="userLogin"><?=$user['login']?></p>
                        </td>
                        <td>
                            <p id="userRole"><?=$user['role_name']?></p>
                        </td>                
                        <td>
                            <div class="d-flex justify-content-end" >
                                <button type="button"                                         
                                    <?php if ($user['status'] === 'A') : ?>
                                        class="btn btn-outline-danger btn-sm px-3"
                                    <?php elseif ($user['status'] === 'N') : ?>
                                        class="btn btn-outline-success btn-sm px-4" 
                                    <?php endif; ?>  
                                    id="<?=$user['id']?>" >
                                    <?php if ($user['status'] === 'A') : ?>
                                        Деактивировать
                                    <?php elseif ($user['status'] === 'N') : ?>
                                        Активировать
                                    <?php endif; ?>  
                                </button>                                    
                            </div>
                        </td>                            
                    </tr>                       
                <?php endforeach ?>
                </tbody>                
            </table>   
        </div>   
    </div>

    <h4 class="my-5 color-broun textalign-left" id="Statistic">Статистика</h4>  
    <div class="col-sm-7">
        <form method="post" id="formStatisticSystem">   
            
            <h5>Выбор периода</h5>                                                    
            <label for="daySystem" class="form-label my-3">Статистика за один день. Выберите день</label>
            <input type="date" class="form-control" id="date" name="daySystem" placeholder="Дата">

            <label for="monthSystem" class="form-label my-3">Статистика за один месяц. Выберите месяц</label>            
            <select class="form-select" aria-label="Default select" name="monthSystem">
                <option selected></option>
                <option value="2023-01-01/2023-01-31">Январь</option>
                <option value="2023-02-01/2023-02-28">Февраль</option>
                <option value="2023-03-01/2023-03-31">Март</option>
                <option value="2023-04-01/2023-04-30">Апрель</option>
                <option value="2023-05-01/2023-05-31">Май</option>
                <option value="2023-06-01/2023-06-30">Июнь</option>
                <option value="2023-07-01/2023-07-31">Июль</option>
                <option value="2023-08-01/2023-08-31">Август</option>
                <option value="2023-09-01/2023-09-30">Сентябрь</option>
                <option value="2023-10-01/2023-10-31">Октябрь</option>
                <option value="2023-11-01/2023-11-30">Ноябрь</option>
                <option value="2023-12-01/2023-12-31">Декабрь</option>
            </select>    

            <label for="yearSystem" class="form-label my-3">Статистика за один год. Выберите год</label> 
            <select class="form-select" aria-label="Default select" name="yearSystem">
                <option selected></option>
                <option value="2023-01-01/2023-12-31">2023</option>                            
            </select>               
            
            <button type="submit" 
                class="btn btn-danger my-5" 
                id="statisticToShow" 
                name="submit">  
                    Показать
            </button>            
        </form>
    </div>
    <div class="d-flex justify-content-end">         
        <a class="btn btn-secondary btn-block m-3"  href="#pageBegin" role="button">Наверх</a>   
    </div>
<? else :?>
<?php header("Location:" . URL); ?>    
<?php endif ?>
</div>     
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
    crossorigin="anonymous">
</script>
<script src="public/js/changeStatusUser.js"></script>
<script src="public/js/statisticSystem.js"></script>

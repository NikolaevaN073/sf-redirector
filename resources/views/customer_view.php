<?php if(isset($_SESSION['isLoggedIn'])) : ?>
    <?php if ($data['status'] === 'N') : ?>
    <div class="alert alert-dark" role="alert">
        <h4>
            Данные пользователя на проверке. Дождитесь ответа администратора
        </h4>
    </div>
    <?php elseif ($data['status'] === 'A') : ?>
    <div class="container my-5" id="pageBegin"> 

        <div class="d-flex justify-content-end">
            <a href="#MyOffers" class="btn btn-danger px-5 mx-3" type="submit">Мои офферы</a> 
            <a href="#Statistic" class="btn btn-danger px-5 mx-3" type="submit">Статистика</a>    
            <a href="/logout" class="btn btn-outline-danger px-5 mx-3" type="submit">Выход</a>           
        </div>

        <div class="col-sm-7">        
            <h4 class="my-3 textalign-left color-broun">Добавление оффера</h4>

            <form method="post" id="offerCreateForm">
                <label for="category" class="form-label">Выберите тему</label>
                <select class="form-select" aria-label="Default select" name="category_id">
                    <option selected>---</option>
                    <?php 
                    $categories = $data['categories'];
                    foreach ($categories as $category) : ?>                    
                        <option value="<?=$category['id']?>" id="category" required>
                            <?=$category['category_name']?>
                        </option>                     
                    <?php endforeach ?>                            
                </select>
                <label for="name" class="form-label">Введите название</label>
                <input type="text" 
                    class="form-control mb-2" 
                    name="offer_name" 
                    placeholder="Name" 
                    id="offerName" 
                    required
                >
                <label for="price" class="form-label">Введите стоимость</label>
                <input type="number" 
                    class="form-control mb-2" 
                    name="price" 
                    placeholder="RUB" 
                    id="price" 
                    required
                >
                <label for="url" class="form-label">Введите ссылку</label>
                <input type="text" 
                    class="form-control mb-2" 
                    name="url" 
                    placeholder="url" 
                    id="url" 
                    required
                >                
                
                <button type="submit" 
                    class="btn btn-danger my-5" 
                    id="createOffer" 
                    name="submit">
                        Создать
                </button>
                <input type="reset" class="btn btn-outline-danger mx-3" value="Очистить форму">
            </form>
        </div>              
        
    <div> 
        <h4 class="my-3 textalign-left color-broun" id="MyOffers">Мои офферы</h4>   
        <?php if (!$data['offers']) : ?>     
            <h5>
                У Вас пока нет ни одного оффера. Создайте новый оффер
            </h5>     
        <?php else : ?>
        <table class="table table-striped table-hover" id="offerList">
            <thead>
                <tr>                        
                    <th scope="col">Наименование</th>
                    <th scope="col">Стоимость перехода</th>
                    <th scope="col">Подписки</th>  
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $offers = $data['offers']; 
                foreach($offers as $offer) : ?> 
                    <tr >                            
                        <td>
                            <p id="offerName"><?=$offer['offer_name']?></p>
                        </td>
                        <td>
                            <p id="offerPrice">
                                <?=number_format(round($offer['price'], 2), 2, '.', '')?> руб.
                            </p>
                        </td>
                        <td>
                            <p id="offerInUse"><?=$offer['count_of_a']?></p>
                        </td>
                                                    
                        <td>
                            <div class="d-flex justify-content-end" >
                                <button type="button"                                         
                                    <?php if ($offer['status'] === 'A') : ?>
                                        class="btn btn-outline-danger btn-sm px-3"
                                    <?php elseif ($offer['status'] === 'N') : ?>
                                        class="btn btn-outline-success btn-sm px-4" 
                                    <?php endif; ?>  
                                    id="<?=$offer['id']?>" >
                                    <?php if ($offer['status'] === 'A') : ?>
                                        Деактивировать
                                    <?php elseif ($offer['status'] === 'N') : ?>
                                        Активировать
                                    <?php endif; ?>  
                                </button>                                    
                            </div>
                        </td>                            
                    </tr>                       
                <?php endforeach ?>
            </tbody>                
        </table>
        <?php endif ?>
    </div>   
    <div>
        <h4 class="my-5 textalign-left color-broun" id="Statistic">
            Статистика
        </h4>   
    </div>

    <div class="col-sm-7">        
        <h5 class="my-3 textalign-left color-broun">
            Выберите оффер и статистику за день, за месяц, или за год
        </h5>

        <form method="post" id="formStatisticCustomer">
            <label for="offer" class="form-label">Выберите оффер</label>
            <select class="form-select" aria-label="Default select" name="customerStatistic" required>                
                <option selected></option>
                <?php             
                foreach($offers as $offer) : ?>                   
                    <option value="<?=$offer['id']?>" id="offer" required>
                        <?=$offer['offer_name']?>
                    </option>                     
                <?php endforeach ?>                            
            </select>
            
            <label for="day" class="form-label my-3">Статистика за один день. Выберите день</label>
            <input type="date" class="form-control" id="date" name="day" placeholder="Дата">

            <label for="month" class="form-label my-3">Статистика за один месяц. Выберите месяц</label>            
            <select class="form-select" aria-label="Default select" name="month">
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

            <label for="year" class="form-label my-3">Статистика за один год. Выберите год</label> 
            <select class="form-select" aria-label="Default select" name="year">
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
    </div>
        <div class="d-flex justify-content-end">  
            
            <a class="btn btn-secondary btn-block m-3"  href="#pageBegin" role="button">Наверх</a>   
        </div>
    </div>     
    <?php endif ?>
<? else :?>
<?php header("Location:" . URL); ?>    
<?php endif ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
    crossorigin="anonymous">
</script>
<script src="public/js/createOffer.js"></script>
<script src="public/js/changeStatusOffer.js"></script>
<script src="public/js/statisticCustomer.js"></script>

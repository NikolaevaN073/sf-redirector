<?php if(isset($_SESSION['isLoggedIn'])) : ?>    
<div class="container my-5" id="pageBegin"> 
    <div class="d-flex justify-content-end">            
        <a href="/logout" class="btn btn-outline-danger px-5" type="submit">Выход</a>           
    </div>
    <?php if ($data['status'] === 'N') : ?>
    <div class="alert alert-dark" role="alert">
        <h4>
            Данные пользователя на проверке. Дождитесь ответа администратора
        </h4>
    </div>
    <?php elseif ($data['status'] === 'A') : ?>
    <p>
        <a class="btn btn-danger px-5 my-5" 
            data-bs-toggle="collapse" 
            href="#collapseAllOffers" 
            role="button" 
            aria-expanded="false" 
            aria-controls="collapseExample">
                Посмотреть доступные предложения
        </a> 
    </p>
    <div class="collapse my-5" id="collapseAllOffers">
        <div class="card card-body">           
    
            <table class="table table-striped table-hover" id="allOffersList">
                <thead>
                    <tr>                        
                        <th scope="col">Наименование</th>
                        <th scope="col">Тема</th>
                        <th scope="col">Стоимость перехода</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $offers = $data['all_offers']; 
                    foreach($offers as $offer) : ?> 
                        <tr >                            
                            <td>
                                <p id="offerName"><?=$offer['offer_name']?></p>
                            </td>
                            <td>
                                <p id="category"><?=$offer['category_name']?></p>
                            </td>
                            <td>
                                <p id="offerPrice">
                                    <?=number_format(round($offer['price'], 2), 2, '.', '')?> руб.
                                </p>
                            </td>                       
                            <td>
                                <div class="d-flex justify-content-end" >
                                    <button type="button"                                         
                                        class="btn btn-outline-success btn-sm px-4" 
                                        id="<?=$offer['id']?>" >
                                            Подписаться                                  
                                    </button>                                    
                                </div>
                            </td>                            
                        </tr>                       
                    <?php endforeach ?>
                </tbody>                
            </table>  
        </div>
    </div>     

    <div> 
        <h4 class="my-3 textalign-left color-broun" id="MyOffers">Мои офферы</h4>   
        <?php if (!$data['user_offers']) : ?>     
            <h5>
                У Вас пока нет ни одного оффера. Подпишитесь на оффер
            </h5>     
        <?php else : ?>    
        <table class="table table-striped table-hover" id="userOfferList">
            <thead>
                <tr>      
                    <th scope="col">Тема</th>                  
                    <th scope="col">Наименование</th>
                    <th scope="col">Стоимость перехода</th>
                    <th scope="col"></th> 
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $user_offers = $data['user_offers']; 
                foreach($user_offers as $user_offer) : ?> 
                    <tr >    
                        <td>
                            <p id="category"><?=$user_offer['category_name']?></p>
                        </td>                     
                        <td>
                            <p id="offerName"><?=$user_offer['offer_name']?></p>
                        </td>
                        <td>
                            <p id="offerPrice">
                                <?=number_format(round($user_offer['price'], 2), 2, '.', '')?> руб.
                            </p>
                        </td>
                        <td>
                            <p>
                                <span class="d-none userID">
                                    <?=$_COOKIE['user_id']?>
                                </span>
                            </p>
                        </td> 
                        <td>
                            <div class="d-flex justify-content-center " >
                                <a href="#">
                                    <mark class="btn btn-outline-secondary btn-sm px-3"                                                      
                                        id="<?=$user_offer['id']?>" >  
                                            Получить ссылку                                   
                                    </mark>     
                                </a>                               
                            </div>
                        </td>                                                     
                        <td>
                            <div class="d-flex justify-content-end" >
                                <button type="button"  
                                    class="btn btn-outline-danger btn-sm px-3"  
                                    id="<?=$user_offer['id']?>" >  
                                        Отписаться                                   
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
        
        <div class="col-sm-7">            
            <h5 class="my-3 textalign-left color-broun">
                Выберите оффер и статистику за день, за месяц, или за год
            </h5>

            <form method="post" id="formStatisticWebmaster">
                <label for="offer" class="form-label">Выберите оффер</label>
                <select class="form-select" aria-label="Default select" name="webmasterStatistic" required>                
                    <option selected></option>
                    <?php             
                    foreach($user_offers as $user_offer) : ?>                   
                        <option value="<?=$user_offer['id']?>" id="offer" required>
                            <?=$user_offer['offer_name']?>
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
                
                <button type="submit" class="btn btn-danger my-5" id="statisticToShow" name="submit">
                    Показать
                </button>                
            </form>
        </div>              
    </div>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary btn-block m-3"  href="#pageBegin" role="button">Наверх</a>   
    </div>    
    <? else :?>
    <?php header("Location:" . URL); ?>
    <?php endif ?>
</div>      
<?php endif ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" 
    crossorigin="anonymous">
</script>
<script src="public/js/getSubscription.js"></script>
<script src="public/js/deleteSubscription.js"></script>
<script src="public/js/getReferURL.js"></script>
<script src="public/js/statisticWebmaster.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>


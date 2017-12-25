<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<main class="main main_base">

    <!-- Шапка с изображение заводика-->
    <div class="main__header">
        <div class="container">

            <!-- Блок с заголовками-->
            <div class="container__block">
                <div class="title title_main">Найдите лучшую цену </div>
                <div class="title title_main">на металлолом в вашем районе</div>
            </div>

            <!-- Блок с текстами	-->
            <div class="container__block">
                <div class="text">Сравните цены на ближайших к вам площадках</div>
                <div class="text">и выберите самый выгодный вариант</div>

                <!-- Кнопочка вызова модального окна-->
                <button id="modal_get_by_scrap" class="btn btn_theme-orange" type="button">Сдать металлолом</button>
            </div>
        </div>
    </div>

    <!-- Модуль поиска-->
    <div class="main__search">
        <div class="container">
            <div class="section">

                <!-- Форма-->
                <form class="form wrap" action="">

                    <!-- Блок с инпутом по городам-->
                    <div class="form__block form__block_city">
                        <input class="form__input form__input_base" type="text">
                    </div>

                    <!-- Блок с инпутом по категориям-->
                    <div class="form__block form__block_category">
                        <input class="form__input form__input_base" type="text">
                    </div>

                    <!-- Кнопка найти-->
                    <input class="btn btn_theme-blue" type="submit" value="Найти площадки">
                </form>
            </div>
        </div>
    </div>

    <!-- Лучшие площадки-->
    <div class="main__best-playground">
        <div class="container">
            <div class="container__header">
                <h2 class="title title_medium">Лучшие площадки в Санкт-Петербурге</h2>
            </div>

            <!-- Блок-карточки-->
            <div class="cards">
                <!-- Блок, содержащий карточки локации-->
                <div class="cards__blocks wrap">
                    <div class="cards__block section">
                        <div class="cards__map"><img src="https://placeimg.com/640/480/any" alt="Изображение"></div>
                        <div class="cards__description">
                            <!-- Заголовок-->
                            <div class="cards__title">
                                <p class="text text_big">«Форсаж» Черный лом</p>
                            </div>
                            <!-- Пункт с описанием-->
                            <div class="cards__item wrap">
                                <div class="icon-mark"></div>
                                <p class="text text_medium"> Санкт-Петербург,  улица Прогонная, д. 7</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-clock"></div>
                                <p class="text text_medium"> 09:00 – 18:00</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-phone"></div>
                                <p class="text text_medium"> Показать телефон</p>
                            </div>
                        </div>
                    </div>
                    <div class="cards__block section">
                        <div class="cards__map"><img src="https://placeimg.com/640/480/any" alt="Изображение"></div>
                        <div class="cards__description">
                            <!-- Заголовок-->
                            <div class="cards__title">
                                <p class="text text_big">«Форсаж» Черный лом</p>
                            </div>
                            <!-- Пункт с описанием-->
                            <div class="cards__item wrap">
                                <div class="icon-mark"></div>
                                <p class="text text_medium"> Санкт-Петербург,  улица Прогонная, д. 7</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-clock"></div>
                                <p class="text text_medium"> 09:00 – 18:00</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-phone"></div>
                                <p class="text text_medium"> Показать телефон</p>
                            </div>
                        </div>
                    </div>
                    <div class="cards__block section">
                        <div class="cards__map"><img src="https://placeimg.com/640/480/any" alt="Изображение"></div>
                        <div class="cards__description">
                            <!-- Заголовок-->
                            <div class="cards__title">
                                <p class="text text_big">«Форсаж» Черный лом</p>
                            </div>
                            <!-- Пункт с описанием-->
                            <div class="cards__item wrap">
                                <div class="icon-mark"></div>
                                <p class="text text_medium"> Санкт-Петербург,  улица Прогонная, д. 7</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-clock"></div>
                                <p class="text text_medium"> 09:00 – 18:00</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-phone"></div>
                                <p class="text text_medium"> Показать телефон</p>
                            </div>
                        </div>
                    </div>
                    <div class="cards__block section">
                        <div class="cards__map"><img src="https://placeimg.com/640/480/any" alt="Изображение"></div>
                        <div class="cards__description">
                            <!-- Заголовок-->
                            <div class="cards__title">
                                <p class="text text_big">«Форсаж» Черный лом</p>
                            </div>
                            <!-- Пункт с описанием-->
                            <div class="cards__item wrap">
                                <div class="icon-mark"></div>
                                <p class="text text_medium"> Санкт-Петербург,  улица Прогонная, д. 7</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-clock"></div>
                                <p class="text text_medium"> 09:00 – 18:00</p>
                            </div>
                            <div class="cards__item wrap">
                                <div class="icon-phone"></div>
                                <p class="text text_medium"> Показать телефон</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Секция статистики-->
    <div class="main__statistics">
        <div class="container">

            <!-- Три статистики-->
            <div class="section section_left wrap">

                <!-- Всего площадок-->
                <div class="section__block section__block_1 wrap">
                    <div class="section__icon icon-factory"></div>
                    <div class="section__amount">12 865</div>
                    <div class="section__caption">Всего площадок</div>
                </div>

                <!-- Всего заявок-->
                <div class="section__block section__block_2 wrap">
                    <div class="section__icon icon-documents"><span class="path1"></span><span class="path2"></span></div>
                    <div class="section__amount">2 865</div>
                    <div class="section__caption">Всего заявок</div>
                </div>

                <!-- Всего площадок-->
                <div class="section__block section__block_3 wrap">
                    <div class="section__icon icon-circle"></div>
                    <div class="section__amount">865</div>
                    <div class="section__caption">Заявок сегодня</div>
                </div>
            </div>
            <div class="section section_right">
                <div class="chart wrap">
                    <div class="chart__title">
                        <div class="text text_big">Динамика сделок</div>
                    </div>
                    <canvas id="chart__main"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Лучшая цена-->
    <div class="main__best-price">
        <div class="container">

            <!-- Блок с заголовком и подпиской-->
            <div class="container__header wrap">
                <div class="title title_medium">Лучшие цены на металл в Санкт-Петербурге</div>

                <!-- Блок с подпиской-->
                <div class="texticon wrap">
                    <div class="texticon__text">Подписаться на дайджест цен:</div>
                    <div class="texticon__icon icon-mail"></div>
                </div>
            </div>

            <!-- Таблица-->
            <div class="table wrap">

                <!-- Первая колонка-->
                <div class="table__column table__column_one wrap">

                    <!-- Блок с заголовком-->
                    <div class="table__header">
                        <div class="table__htext table__htext_big">Металл</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">

                        <!-- Иконка-стрелочка. Вверх или вниз-->
                        <div class="table__icon table__icon_up icon-pointer_up_right"></div>
                        <div class="table__block">
                            <div class="table__rtext table__rtext_big">Стальной лом 3А</div>
                            <div class="table__rtext table__rtext_small">12 апреля, 12:32</div>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">

                        <!-- Иконка-стрелочка. Вверх или вниз-->
                        <div class="table__icon table__icon_down icon-pointer_down_right"></div>
                        <div class="table__block">
                            <div class="table__rtext table__rtext_big">Стальной лом 6А</div>
                            <div class="table__rtext table__rtext_small">12 апреля, 12:32</div>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">

                        <!-- Иконка-стрелочка. Вверх или вниз-->
                        <div class="table__icon table__icon_up icon-pointer_up_right"></div>
                        <div class="table__block">
                            <div class="table__rtext table__rtext_big">Стальной лом 6А</div>
                            <div class="table__rtext table__rtext_small">12 апреля, 12:32</div>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">

                        <!-- Иконка-стрелочка. Вверх или вниз-->
                        <div class="table__icon table__icon_down icon-pointer_down_right"></div>
                        <div class="table__block">
                            <div class="table__rtext table__rtext_big">Лом электротехнического алюминия</div>
                            <div class="table__rtext table__rtext_small">12 апреля, 12:32</div>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">

                        <!-- Иконка-стрелочка. Вверх или вниз-->
                        <div class="table__icon table__icon_up icon-pointer_up_right"></div>
                        <div class="table__block">
                            <div class="table__rtext table__rtext_big">Стальной лом 6А</div>
                            <div class="table__rtext table__rtext_small">12 апреля, 12:32</div>
                        </div>
                    </div>
                </div>

                <!-- Вторая колонка-->
                <div class="table__column table__column_two wrap">

                    <!-- Блок с заголовком-->
                    <div class="table__header">
                        <div class="table__htext table__htext_big">Прошлая цена</div>
                        <div class="table__htext table__htext_small">руб/тонн</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">

                        <!-- Большой текст-->
                        <div class="table__rtext table__rtext_big">7 050</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">

                        <!-- Большой текст-->
                        <div class="table__rtext table__rtext_big">7 050</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">

                        <!-- Большой текст-->
                        <div class="table__rtext table__rtext_big">7 050</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">

                        <!-- Большой текст-->
                        <div class="table__rtext table__rtext_big">7 050</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">

                        <!-- Большой текст-->
                        <div class="table__rtext table__rtext_big">337 050</div>
                    </div>
                </div>

                <!-- Третья колонка-->
                <div class="table__column table__column_three wrap">

                    <!-- Блок с заголовком-->
                    <div class="table__header">
                        <div class="table__htext table__htext_big">Текущая цена</div>
                        <div class="table__htext table__htext_small">руб/тонн</div>
                    </div>

                    <!-- Ряд	-->
                    <div class="table__row">

                        <!-- Большой текст-->
                        <div class="table__rtext table__rtext_big">6 050</div>
                        <!-- Статус. Плюс или минус-->
                        <div class="table__rtext table__rtext_plus">+ 450 (6,04%)</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">
                        <div class="table__rtext table__rtext_big">6 050</div>
                        <!-- Статус. Плюс или минус-->
                        <div class="table__rtext table__rtext_minus">– 120 (1,52%)</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">
                        <div class="table__rtext table__rtext_big">6 050</div>
                        <!-- Статус. Плюс или минус-->
                        <div class="table__rtext table__rtext_plus">+ 450 (6,04%)</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">
                        <div class="table__rtext table__rtext_big">6 050</div>
                        <!-- Статус. Плюс или минус-->
                        <div class="table__rtext table__rtext_minus">– 120 (1,52%)</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row">
                        <div class="table__rtext table__rtext_big">6 050</div>
                        <!-- Статус. Плюс или минус-->
                        <div class="table__rtext table__rtext_plus">+ 450 (6,04%)</div>
                    </div>
                </div>

                <!-- Четвёртая колонка-->
                <div class="table__column table__column_four wrap">

                    <!-- Блок с заголовком-->
                    <div class="table__header">
                        <div class="table__htext table__htext_big">Динамика изменения</div>
                        <div class="table__htext table__htext_small">за месяц</div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">
                        <div class="chart__wrap">
                            <canvas id="chart__table-1"></canvas>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">
                        <div class="chart__wrap">
                            <canvas id="chart__table-2"></canvas>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">
                        <div class="chart__wrap">
                            <canvas id="chart__table-3"></canvas>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">
                        <div class="chart__wrap">
                            <canvas id="chart__table-4"></canvas>
                        </div>
                    </div>

                    <!-- Ряд-->
                    <div class="table__row wrap">
                        <div class="chart__wrap">
                            <canvas id="chart__table-5"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Подвал. Преимущества и отзывы.-->
    <div class="main__footer">
        <div class="container">
            <div class="container__block wrap">
                <div class="container__header">
                    <div class="title title_medium">Преимущества ЛомИнфо</div>
                </div>
                <!-- Блок-карточки-->
                <div class="cards">
                    <!-- Блок, содержащий карточки-->
                    <div class="cards__blocks wrap">
                        <!-- Первая карточка-->
                        <div class="cards__block cards__block_1 wrap">
                            <div class="notification">ломосдателям</div>
                            <div class="cards__description">
                                <div class="title title_medium">Продавайте</div>
                                <div class="text text_big">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div><a class="cards__link wrap" href="">
                                    <div class="text-bold text-bold_medium">Узнайте как продавать с Lominfo</div>
                                    <div class="icon-pointer_right"></div></a>
                            </div>
                        </div>
                        <!-- Вторая карточка-->
                        <div class="cards__block cards__block_2 wrap">
                            <div class="notification">площадкам</div>
                            <div class="cards__description">
                                <div class="title title_medium">Покупайте</div>
                                <div class="text text_big">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div><a class="cards__link wrap" href="">
                                    <div class="text-bold text-bold_medium">Узнайте как продавать с Lominfo</div>
                                    <div class="icon-pointer_right"></div></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container__block wrap">
                <div class="container__header">
                    <div class="title title_medium">Отзывы о ЛомИнфо</div>
                </div>
                <div class="section slider">
                    <div id="reviews">
                        <div class="slider__slide wrap">
                            <div class="text slider__text text_big">Искать основного отличительного признака различных классов общества в источнике дохода — значит выдвигать на первое место отношения распределения, которые на самом деле суть результат отношений производства.</div>
                            <div class="user slider__user"><img class="avatar slider__avatar avatar_small" src="https://placeimg.com/640/480/any" alt="">
                                <div class="text text_big">Савва Морозов</div>
                            </div>
                            <div class="text text_medium">Директор-распорядитель мануфактуры</div>
                            <div class="text text_medium">«Саввы Морозова сын и Ко»</div>
                        </div>
                        <div class="slider__slide wrap">
                            <div class="text slider__text text_big">Искать основного отличительного признака различных классов общества в источнике дохода — значит выдвигать на первое место отношения распределения, которые на самом деле суть результат отношений производства.</div>
                            <div class="user slider__user"><img class="avatar slider__avatar avatar_small" src="https://placeimg.com/640/480/any" alt="">
                                <div class="text text_big">Савва Морозов</div>
                            </div>
                            <div class="text text_medium">Директор-распорядитель мануфактуры</div>
                            <div class="text text_medium">«Саввы Морозова сын и Ко»</div>
                        </div>
                        <div class="slider__slide wrap">
                            <div class="text slider__text text_big">Искать основного отличительного признака различных классов общества в источнике дохода — значит выдвигать на первое место отношения распределения, которые на самом деле суть результат отношений производства.</div>
                            <div class="user slider__user"><img class="avatar slider__avatar avatar_small" src="https://placeimg.com/640/480/any" alt="">
                                <div class="text text_big">Савва Морозов</div>
                            </div>
                            <div class="text text_medium">Директор-распорядитель мануфактуры</div>
                            <div class="text text_medium">«Саввы Морозова сын и Ко»</div>
                        </div>
                        <div class="slider__slide wrap">
                            <div class="text slider__text text_big">Искать основного отличительного признака различных классов общества в источнике дохода — значит выдвигать на первое место отношения распределения, которые на самом деле суть результат отношений производства.</div>
                            <div class="user slider__user"><img class="avatar slider__avatar avatar_small" src="https://placeimg.com/640/480/any" alt="">
                                <div class="text text_big">Савва Морозов</div>
                            </div>
                            <div class="text text_medium">Директор-распорядитель мануфактуры</div>
                            <div class="text text_medium">«Саввы Морозова сын и Ко»</div>
                        </div>
                        <div class="slider__slide wrap">
                            <div class="text slider__text text_big">Искать основного отличительного признака различных классов общества в источнике дохода — значит выдвигать на первое место отношения распределения, которые на самом деле суть результат отношений производства.</div>
                            <div class="user slider__user"><img class="avatar slider__avatar avatar_small" src="https://placeimg.com/640/480/any" alt="">
                                <div class="text text_big">Савва Морозов</div>
                            </div>
                            <div class="text text_medium">Директор-распорядитель мануфактуры</div>
                            <div class="text text_medium">«Саввы Морозова сын и Ко»</div>
                        </div>
                        <div class="slider__slide wrap">
                            <div class="text slider__text text_big">Искать основного отличительного признака различных классов общества в источнике дохода — значит выдвигать на первое место отношения распределения, которые на самом деле суть результат отношений производства.</div>
                            <div class="user slider__user"><img class="avatar slider__avatar avatar_small" src="https://placeimg.com/640/480/any" alt="">
                                <div class="text text_big">Савва Морозов</div>
                            </div>
                            <div class="text text_medium">Директор-распорядитель мануфактуры</div>
                            <div class="text text_medium">«Саввы Морозова сын и Ко»</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
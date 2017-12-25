// FORM
	// Ошибка
		// При наведении курсора на иконку ошибки - появляется блок с сообщением
		// При отведении курсора от иконки ошибки - исчезает блок с сообщением
		// Появление и исчезновение иконки ошибки
	// input = password
		// Показать/скрыть пароль
		// Появление иконок пароля
	// RADIO и CHECKBOX
		// Добавление active-класса к label
		// Проверка на disabled

// MODAL

// VARS
var table__header_height,
	table__header_max_height,
	table__header_array = new Array(),
	table__row_height,
	table__row_max_height,
	table__row_array = new Array(),
	search__height,
	search__left_width,
	search_map_container,
	search__form_up,
	search__form_down,
	header__height,
	place__header_height,
	place__right_height;


$( document ).ready(function() {

// SEARCH PAGE 
	
	// HEIGHT
		// Блок main
		search__height = $(window).height();

		// Header
		header__height = $('.header').height();

		// Высота всего блока с поиском и картой
		$('.search').css('height',search__height - header__height);

		place__header_height = $('.place__header').height() + 20;
		place__right_height = $('.place__right').height();

	// STATE
		search__left_width = $('.search__left').width();
		search_map_container = $(window).width();

		$('.search__left').css('width',search__left_width);
		$('#map').css('width',search_map_container);
		$('.search__result').css('height',search__height - 172);
		$('.search__blocks').css('height',search__height - 172);
		$('.search__blocks').css('width',search__left_width + 30);
		
		
		if (place__right_height<240){
			$('.place__map').css('height', 264);
		}
		else{
			$('.place__map').css('height', place__right_height - place__header_height);
		}

		// BTN_FILTER CLICK
			$('.search__btn-filter').click(function(){
				$(this).fadeOut();
				$('.form__block_text').fadeOut();
				$('.form__input_city').css('flex',1);
				$('.form__block_category').fadeIn();
				$('.search__form').removeClass('noactive').addClass('active');
				$('.search__result').css('height',search__height - 172);
				$('.search__blocks').css('height',search__height - 430);
				$('.search__blocks').css('widht',search__left_width + 30);
			});

		// BTN_FORM_down CLICK
			$('.search__close-down').click(function(){
				$('.search__btn-filter').fadeIn();
				$('.form__block_text').fadeIn();
				$('.form__block_category').fadeOut();
				$('.search__form').removeClass('active').addClass('noactive');
				$('.search__result').css('height',search__height - 172);
				$('.search__blocks').css('height',search__height - 172);
				$('.search__blocks').css('widht',search__left_width + 30);
			});

		// BTN_FORM_left click	
			$('.search__close-left').click(function(){
				if($('.search__left').hasClass('active')){
					$('.search__left').removeClass('active');
					$('.search__left').css('width',0);
				}
				else{
					$('.search__left').addClass('active');
					$('.search__left').css('width',search__left_width);
				}
			});

		// PLACE BTN TABS
			$('.btns__tab').click(function(){
				if (!($(this).hasClass('active'))){
					$(this).parent().find('.active').removeClass('active');
					$(this).addClass('active');
				}
			});



// MODALS

// FUNCTIONS
    var modal = function(btn_id,modal_cls){
        $('#'+btn_id).click(function(){
            $('.'+modal_cls).addClass('modal_active');
            $('.modal_active')
                .css("display", "flex")
                .hide()
                .fadeIn(500);
            $('html body').css('overflow','hidden');
        });
    }

    // MODALS
    // Вызов окна
    // modal(id кнопки, class модального)


    // Кнопка везде одна, которая закрывает все окна
    $('.modal__btn').click(function(){
        $('.modal').fadeOut(500);
        $('.modal').removeClass('modal_active');
        $('html body').css('overflow','initial');
    })

// MODAL

    // modal('test','modal_reg');
    modal('modal_login','modal_login');
    modal('modal_reg','modal_reg');
    modal('modal_reg_pro','pro');
    modal('modal_get_by_scrap','modal_login');


// Calendar
	$('.sidebar__calendar').datepicker({
		inline: true, 
		dayNamesMin: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
		monthNames: [ "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь" ], 
		nextText: "",
		prevText: ""
	});

	$('.sidebar__calendar').find('.ui-state-active').removeClass('ui-state-active');

	$('.ui-state-active').click(function(){
		alert("1");
	})

// TABLE BEST PRICE

	var height_array = function(){ 
		$('.table__column').each(function(){
			// Нашёл блок с заголовком и забрал высоту + отступы
				table__header_height = $(this).find('.table__header').height() + 41;
				table__row_height = $(this).find('.table__row').height() + 61;
			// Закинул все значения в массив
				table__header_array.push(table__header_height);
				table__row_array.push(table__row_height);
		});
	}

	height_array();
	table__header_max_height = Math.max.apply(Math,table__header_array);
	table__row_max_height = Math.max.apply(Math,table__row_array);

	$('.table__column').each(function(){
		$(this).find('.table__header').css('height', table__header_max_height);
		$(this).find('.table__row').css('height', table__row_max_height);
	});

// ОТЗЫВЫ НА ГЛАВНОЙ
    $("#reviews").lightSlider({
    	item: 1,
    	slideMargin: 0,
    	loop: true,
    	controls: false
    });

// Слайдер на странице металлы
	/*var slider = $('#metals').lightSlider({
    	item: 1,
    	slideMargin: 0,
    	loop: false,
    	controls: false,
		pager: false,
		
		onSliderLoad: function (el) {
			var slide_array = new Array(),
				slide_col;

			$('.lslide').each(function(){
				slide_array.push(el);
				slide_col = slide_array.length;
			});
			
			$('.slider__current-number').text(1);
			$('.slider__number').text(slide_col);

		},
		onAfterSlide: function (el) {
			$('.slider__current-number').text(slider.getCurrentSlideCount());
		}
    });

	$('.slider__left').click(function(){
        slider.goToPrevSlide(); 
    });
    $('.slider__right').click(function(){
        slider.goToNextSlide(); 
    });*/
	

})
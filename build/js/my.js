// FUNCTIONS
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

// MODALS

// FUNCTIONS
	var modal = function(btn_id,modal_cls){
		$('#'+btn_id).click(function(){
			$('.'+modal_cls).addClass('modal_active');
			$('.modal__active')
				.css("display", "flex")
				.hide()
				.fadeIn(500);
			$('html body').css('overflow','hidden');
		});
	}

	/**
	 * [Показ элемента с указанием позиции и  эффекта появления]
	 * @param  {[obj]} position  [{ "left": leftPos, "top": topPos, "no_scroll": true};]
	 * @param  {[string]} namePopup [Индентификатор элемента] 
	 */
	function visiblePopup( position, namePopup){
		var inEffect = $(namePopup).attr('data-in-effect');

		$(namePopup).css({"position": "absolute", "display" : "block", "left": position.left, "top" : position.top });
		$(namePopup).addClass('active_popup');

		if(position.no_scroll){
			$('body').css('overflow', 'hidden');
		}

		if( !$(namePopup).hasClass('animated')){
			$(namePopup).addClass('animated');
		}

		$(namePopup).addClass( inEffect );
		$(namePopup).addClass( 'active_popup' );
	}
	
	/**
	 * [getPopupPosition description]
	 * @param  {[string]} namePopup [Индентификатор элемента]
	 * @param  {[bool]} isScroll [Убирать скролл body?]
	 * @return {[obj]}             [description]
	 */
	function getPopupPosition( namePopup , isScroll){
		var btn = $(namePopup);
		var offset = btn.offset();
		var topPos = offset.top + btn.outerHeight();
		var leftPos = ((offset.left) / $(window).outerWidth() * 100) - 4;
		leftPos = leftPos + '%';

		if(isScroll){
			return position = { "left": leftPos, "top": topPos, 'no_scroll': true};
		} else{
			return position = { "left": leftPos, "top": topPos, 'no_scroll': false};
		}
	}

	/**
	 * [Скрытие элемента с указанием эффекта ичезновения]
	 * @param  {[string]} namePopup [Индентификатор элемента]
	 * @param  {[bool]} no_scroll [вернуть возможность скролла]
	 *
	 * $(".btn_close").click(function(){
	 *  hiddenPopup( '.request-call__form', false);
	 * });
	 * 
	 */
	function hiddenPopup( namePopup, no_scroll ){
		var inEffect = $(namePopup).attr('data-in-effect');
		var outEffect = $(namePopup).attr('date-out-effect');

		$(namePopup).removeClass( inEffect );
		$(namePopup).addClass( outEffect );

		var returnOldParameters = function (namePopup, outEffect){
			$(namePopup).css({"position": "absolute", "display" : "none" });
			$(namePopup).removeClass( outEffect );
			$(namePopup).removeClass('active_popup');
		}

		if( outEffect != "" ){
			setTimeout(returnOldParameters, 500, namePopup, outEffect);
		} else{
			returnOldParameters(namePopup, outEffect);
		}

		$('.overlay-popup').css('display', 'none');
	}

$('.status-icon-js').hover(function(){
	$('.status__tooltip').fadeIn(500);
});

$('.status-icon-js').mouseleave(function(){
	$('.status__tooltip').fadeOut(500);
});


$('#temp').on('click', function(){
	var pos = getPopupPosition( $(this) , false);
	pos.top = pos.top + 15;
	visiblePopup( pos, '.popup');
	$('.overlay-popup').css('display', 'block');
});

$('.overlay-popup').on('click', function(){
	hiddenPopup('.active_popup', false);
});

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
	// Вызов окна
	// modal(id кнопки, class модального)
		modal('test','modal_reg');

	// Кнопка везде одна, которая закрывает все окна
	$('.modal__btn').click(function(){
		$('.modal').fadeOut(500);
		$('.modal').removeClass('modal_active');
		$('html body').css('overflow','initial');
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
	var slider = $('#metals').lightSlider({
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
    });
	
})
	
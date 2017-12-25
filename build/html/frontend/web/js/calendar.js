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
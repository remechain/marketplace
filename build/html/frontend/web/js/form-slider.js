$( function() {
    // Общее время, минимальное и максимальное
    var hours_max = 720, // 12 часов
        val_min_1 = 60,   // Минимальное время
        val_min_2 = 60,
        val_max_1 = 660,   // Максимальное время
        val_max_2 = 660,
        time_start_1 = 9,  // Начинало с
        time_start_2 = 9;

    $("#slider-1").slider({
        range: true,
        min: 0,
        max: hours_max,
        step: 15,
        values: [ val_min_1, val_max_1 ],
        slide: function (e, ui) {
            var hours1 = Math.floor(ui.values[0] / 60),
                hours2 = Math.floor(ui.values[1] / 60),
                minutes1 = ui.values[0] - (hours1 * 60),
                minutes2 = ui.values[1] - (hours2 * 60),
                hours_common = hours_max / 60; // Всего часов

            for(var i = 0; i<=hours_common; ++i){
                var temp_1,
                    temp_2;
                
                if(i<(10-time_start_1)){
                    if (i==hours1){
                        temp_1 = '0' + (time_start_1 + i);
                    }

                    if (i==hours2){
                        temp_2 = '0' + (time_start_1 + i);
                    }
                }

                if(i>=(10-time_start_1)){
                    if (i==hours1){
                        temp_1 = '' + (time_start_1 + i);
                    }

                    if (i==hours2){
                        temp_2 = '' + (time_start_1 + i);
                    }
                }

            }
            
            hours1= temp_1;
            hours2= temp_2;

            if (minutes1 == 0){
                minutes1 = '00';
            }

            if (minutes2 == 0){
                minutes2 = '00';
            }

            $(".slider-range .ui-slider-handle").attr("data-time-first", hours1 + ':' + minutes1);
            $(".slider-range .ui-slider-handle").attr("data-time-second", hours2 + ':' + minutes2);
            
        },
        create: function( event, ui ) {

            if ((val_min_1 / 60)<(10-time_start_1)){
                val_min_1 = '0' + (time_start_1 + val_min_1 / 60);
            }
            
            if ((val_max_1 / 60)<(10-time_start_1)){
                val_max_1 = '0' + (time_start_1 + val_max_1 / 60);
            }

            if ((val_max_1 / 60)>=(10-time_start_1)){
                val_max_1 = '' + (time_start_1 + val_max_1 / 60);
            }

            if ((val_min_1 / 60)>=(10-time_start_1)){
                val_min_1 = '' + (time_start_1 + val_min_1 / 60);
            }

            $(".slider-range .ui-slider-handle").attr("data-time-first", val_min_1 + ':00');
            $(".slider-range .ui-slider-handle").attr("data-time-second", val_max_1 +':00');
        }
    });

    $("#slider-2").slider({
        range: true,
        min: 0,
        max: hours_max,
        step: 15,
        values: [ val_min_2, val_max_2 ],
        slide: function (e, ui) {
            var hours1 = Math.floor(ui.values[0] / 60),
                hours2 = Math.floor(ui.values[1] / 60),
                minutes1 = ui.values[0] - (hours1 * 60),
                minutes2 = ui.values[1] - (hours2 * 60),
                hours_common = hours_max / 60; // Всего часов

            for(var i = 0; i<=hours_common; ++i){
                var temp_1,
                    temp_2;
                
                if(i<(10-time_start_2)){
                    if (i==hours1){
                        temp_1 = '0' + (time_start_2 + i);
                    }

                    if (i==hours2){
                        temp_2 = '0' + (time_start_2 + i);
                    }
                }

                if(i>=(10-time_start_2)){
                    if (i==hours1){
                        temp_1 = '' + (time_start_2 + i);
                    }

                    if (i==hours2){
                        temp_2 = '' + (time_start_2 + i);
                    }
                }

            }
            
            hours1= temp_1;
            hours2= temp_2;

            if (minutes1 == 0){
                minutes1 = '00';
            }

            if (minutes2 == 0){
                minutes2 = '00';
            }

            $(".slider-range .ui-slider-handle").attr("data-time-first", hours1 + ':' + minutes1);
            $(".slider-range .ui-slider-handle").attr("data-time-second", hours2 + ':' + minutes2);
            
        },
        create: function( event, ui ) {

            if ((val_min_2 / 60)<(10-time_start_2)){
                val_min_2 = '0' + (time_start_2 + val_min_2 / 60);
            }
            
            if ((val_max_2 / 60)<(10-time_start_2)){
                val_max_2 = '0' + (time_start_2 + val_max_2 / 60);
            }

            if ((val_max_2 / 60)>=(10-time_start_2)){
                val_max_2 = '' + (time_start_2 + val_max_2 / 60);
            }

            if ((val_min_2 / 60)>=(10-time_start_2)){
                val_min_2 = '' + (time_start_2 + val_min_2 / 60);
            }

            $(".slider-range .ui-slider-handle").attr("data-time-first", val_min_2 + ':00');
            $(".slider-range .ui-slider-handle").attr("data-time-second", val_max_2 +':00');
        }
    });
} );
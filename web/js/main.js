$( document ).ready( function() {

    $( '[data-toggle="tooltip"]' ).tooltip();
    $( '[data-toggle="popover"]' ).popover();

    var quickInputForm = $( '#quickInputForm' );
    var qf_activity_field = $( '#quickInputFormActivity' );
    var qf_minutes_field = $( '#quickInputFormMinutes' );
    var qf_note_field = $( '#quickInputFormNote' );
    var qf_time_field = $( '#quickInputFormTime' );
    var qf_position_field = $( '#quickInputFormPosition' );

    if ( quickInputForm.length ) {
        qf_activity_field.focus();
    }

    //handle enter key
    $( 'input' ).keypress( function ( e ) {
        var k = e.keyCode || e.which;
        if ( k == 13 ) {
            return false; // !!!
        }
    } );



    function quickInputCells()
    {
        quickInputForm.find( '.form-group' ).removeClass( 'has-error' );

        // Получаем данные полей
        var qf_activity = qf_activity_field.val().toUpperCase();
        var qf_minutes = Number( qf_minutes_field.val() );
        var qf_note = qf_note_field.val();
        var qf_time = qf_time_field.val();
        var qf_position = qf_position_field.val().split(',');

        // Валидация
        // Если ДЕЯТЕЛЬНОСТЬ пустая, то ОШИБКА
        if ( qf_activity == '' ) {
            qf_activity_field.parent( '.form-group' ).addClass( 'has-error' );
            qf_activity_field.focus();

            return false;
        }

        // Если ДЕЯТЕЛЬНОСТЬ не существует, то ошибка
        var activities = $.parseJSON( $( '#activitiesArray' ).val() );

        console.log( qf_activity );
        console.log( activities );

        var activity_id = 0;
        $.each( activities, function( index, value ) {
            console.log( value );
            console.log( qf_activity );
            if (value == qf_activity) {
                activity_id = index;
            }
        } );

        console.log( activity_id );

        // var activity_button = $( '.activity-btn[data-code="' + qf_activity + '"]' );
        if ( activity_id == 0 ) {
            qf_activity_field.parent( '.form-group' ).addClass( 'has-error' );
            qf_activity_field.focus();

            return false;
        }

        // Если МИНУТЫ пустая, то ОШИБКА
        // Если МИНУТЫ = 0, то ОШИБКА
        if ( ( qf_minutes == '' ) || ( qf_minutes == 0 ) ) {
            qf_minutes_field.parent( '.form-group' ).addClass( 'has-error' );
            qf_minutes_field.focus();

            return false;
        }

        // Если МИНУТЫ не кратны 5, то ОШИБКА
        if ( qf_minutes % 5 != 0 ) {
            qf_minutes_field.parent( '.form-group' ).addClass( 'has-error' );
            qf_minutes_field.focus();

            return false;
        }

        // Если ВРЕМЯ неправильного формата, то ОШИБКА
        if (qf_time != '') {
            var qf_time_array = qf_time.split(':');

            if (
                ( Number( qf_time_array[0] ) < 24 ) &&
                ( Number( qf_time_array[0] ) >= 0 )
            ) {
                qf_position[0] = Number(qf_time_array[0]);
            } else {
                qf_time_field.parent( '.form-group' ).addClass( 'has-error' );
                qf_time_field.focus();

                return false;
            }

            // Если ВРЕМЯ (минуты) не кратно 5, то ОШИБКА
            if (
                ( Number( qf_time_array[1] ) < 60 ) &&
                ( Number( qf_time_array[1] ) >= 0 ) &&
                ( Number( qf_time_array[1] ) % 5 == 0 )
            ) {
                qf_position[1] = Number(qf_time_array[1]) + 5;
            } else {
                qf_time_field.parent( '.form-group' ).addClass( 'has-error' );
                qf_time_field.focus();

                return false;
            }
        }

        for (var i = 5; i <= qf_minutes; i = i + 5) {
            var cell_id = '#minutesCell_' + qf_position[0] + '_' + qf_position[1];
            $( '.minutes' ).removeClass('current');

            $( cell_id + ' .text' ).text( qf_activity );
            $( cell_id + ' .hidden-activity_id' ).val( activity_id );

            if (qf_note != '') {

                $( cell_id + ' .hidden-note' ).val( qf_note );
                $( cell_id + ' .text' ).css({
                    'font-style' : 'italic'
                } );
            }

            qf_position[1] = Number(qf_position[1]) + 5;
            if (qf_position[1] > 60) {
                qf_position[0] = Number(qf_position[0]) + 1;
                qf_position[1] = qf_position[1] - 60;
            }

            qf_position_field.val( qf_position[0] + ',' + qf_position[1] );

            $( '#minutesCell_' + qf_position[0] + '_' + qf_position[1] ).addClass('current');
        }

        qf_activity_field.val('');
        qf_minutes_field.val('');
        qf_note_field.val('');
        qf_time_field.val('');

        qf_activity_field.focus();
    }

    quickInputForm.find( 'input' ).keypress( function ( e ) {
        var k = e.keyCode || e.which;
        if ( k == 13 ) {
            quickInputCells();
        }
    } );

    // Быстрая форма
    quickInputForm.find( '.btn-submit' ).click( function( e ) {
        e.preventDefault();
        quickInputCells();
    } );

} );

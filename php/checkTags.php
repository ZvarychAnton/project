<?php

$txt = $_POST['message'];
$tags = array(
    'i' => array(
        'open'  =>'<i[^>]*>'
      , 'close' => '</i>'
    )
,	'strong' => array(
        'open'  =>'<strong[^>]*>'
      , 'close' => '</strong>'
    )
,	'code' => array(
        'open'  =>'<code[^>]*>'
      , 'close' => '</code>'
    )
,	'strike' => array(
        'open'  =>'<strike[^>]*>'
      , 'close' => '</strike>'
    )
,	'a' => array(
        'open'  =>'<a[^>]*>'
      , 'close' => '</a>'
    )	
);

function checkTags($txt, $tags) {

    //
    // Возможные результаты
    //

    $result_true = 'validate';
    $result_false_match = 'несоответствие тэгов';
    $result_false_pars = 'ошибка во входных параметрах';
    

    //
    // Проверка входных параметров
    //

    $regexp = '/\.*';
    $re     = array();
    $search = array();
    foreach( $tags as $t => $v ) {

        // Обязательные элементы массива параметров
        if( empty( $v['open'] ) || empty( $v['close'] ) ) {
            return $result_false_pars;
        }

        // Попутно собираем термы в один регэксп
        $re[] = addcslashes($v['open'].'|'.$v['close'], '/');

        // Попутно формируем массив разбора -
        // ключ - открывающий тэг, значение - закрыващий
        if( !empty($search[$v['open']]) ) {

            // Не допускаются совпадения открывающих тэгов
            return $result_false_pars;

        }

        $search[$v['open']] = $v['close'];

    }
    $regexp .= join( '|', $re ).'/';

    //
    // Разбор входного текста
    //

    // Вырожденный случай - just for test
    if( strlen($txt) == 0 ) {
        return $result_true;
    }

    // Формируем массив разбора
    preg_match_all( $regexp, $txt, $out );
    $out = $out[0];

    // Разбираем массив с помощью стека
    $stack = array();
    foreach( $out as $tag ) {

        $open = false;
        foreach( $tags as $k => $v ) {

            if( preg_match( "/".addcslashes($v['open'], '/')."/", $tag ) ) {
                // Открывающий тэг - пишем в стек
                // соответствующий закрывающий тэг
                $stack[] = $search[ $v['open'] ];
                $open = true;
                break;
            }

        }

        if( !$open ) {

            // Закрывающий тэг - извлекаем
            // и проверяем последний элемент стека
            if( array_pop( $stack ) != $tag ) {
                return $result_false_match;
            }

        }

    } // разбор результатов поиска тэгов

    // Если стек после разбора непуст -
    // налицо несоответствие тэгов
    if( count( $stack ) > 0 ) {
        return $result_false_match;
    }

    // Все условия выполнены, тэги соответствуют
    return $result_true;

}
$result_funk = checkTags($txt,$tags);
echo $result_funk;
?>
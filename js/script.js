/**
 * Created by Maps_red on 05/08/2016.
 */

/* BOUTON CROSS */

$(document).on('touchstart mouseover', '#cross-menu', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#cross-menu").stop().animate({scale:'1.2',opacity:'0.5'},300);

        event.handled = true;
    } else {
        return false;
    }
});

$(document).on('touchend mouseout', '#cross-menu', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#cross-menu").stop().animate({scale:'1',opacity:'1'},300);

        event.handled = true;
    } else {
        return false;
    }
});


/* BOUTON MENU ARROW-2 */

$(document).on('touchstart mouseover', '#wrapper-title-2', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#fleche-nav-2").stop().animate({rotate: '90deg',opacity:'1'},300);

        event.handled = true;
    } else {
        return false;
    }
});

$(document).on('touchend mouseout', '#wrapper-title-2', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#fleche-nav-2").stop().animate({rotate: '0deg',opacity:'0.5'},300);

        event.handled = true;
    } else {
        return false;
    }
});

/* BOUTON MENU ARROW-3 */

$(document).on('touchstart mouseover', '#wrapper-title-3', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#fleche-nav-3").stop().animate({rotate: '90deg',opacity:'1'},300);

        event.handled = true;
    } else {
        return false;
    }
});

$(document).on('touchend mouseout', '#wrapper-title-3', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#fleche-nav-3").stop().animate({rotate: '0deg',opacity:'0.5'},300);

        event.handled = true;
    } else {
        return false;
    }
});

/* BOUTON MENU */

$(document).on('touchstart mouseover', '#stripes', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#stripes").stop().animate({scale:'1.2',opacity:'0.5'},300);

        event.handled = true;
    } else {
        return false;
    }
});

$(document).on('touchend mouseout', '#stripes', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#stripes").stop().animate({scale:'1',opacity:'1'},300);

        event.handled = true;
    } else {
        return false;
    }
});

/* BOUTON NEXT */

$(document).on('touchstart mouseover', '#oldnew-next', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#oldnew-next").stop().animate({scale:'1.2',opacity:'0.5'},300);

        event.handled = true;
    } else {
        return false;
    }
});

$(document).on('touchend mouseout', '#oldnew-next', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#oldnew-next").stop().animate({scale:'1',opacity:'1'},300);

        event.handled = true;
    } else {
        return false;
    }
});

/* BOUTON PREV */

$(document).on('touchstart mouseover', '#oldnew-prev', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#oldnew-prev").stop().animate({scale:'1.2',opacity:'0.5'},300);

        event.handled = true;
    } else {
        return false;
    }
});

$(document).on('touchend mouseout', '#oldnew-prev', function(event){

    event.stopPropagation();
    event.preventDefault();
    if(event.handled !== true) {

        $("#oldnew-prev").stop().animate({scale:'1',opacity:'1'},300);

        event.handled = true;
    } else {
        return false;
    }
});

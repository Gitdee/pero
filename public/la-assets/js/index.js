window.onload = function () {
    var lastFirstUpper = document.getElementsByClassName('lastFirstUpper');
    for (var i = 0; i < lastFirstUpper.length; i++) {

        lastFirstUpper[i].style.textTransform = 'capitalize';
        var oneWorld = lastFirstUpper[i].innerText.split(' ');
        for (var j = 0; j < oneWorld.length; j++) {
            if (oneWorld[j].length > 2) {
                var beforeLastLetter = oneWorld[j].slice(0, -1).toLowerCase();
                var lastLetter = oneWorld[j].slice(-1).toUpperCase();
                oneWorld[j] = beforeLastLetter + lastLetter;
            }
        }
        lastFirstUpper[i].innerText = '';
        for (var j = 0; j < oneWorld.length; j++) {
            lastFirstUpper[i].innerText = lastFirstUpper[i].innerText + ' ' + oneWorld[j];
        }
    }


    document.getElementById('adaptmenuicon').onclick = function () {
        var menublock = document.getElementById('top-nav');
        if ((menublock.style.display == 'none') || (menublock.style.display == '')) {
            menublock.style.display = 'block';
            document.getElementById('adaptmenuicon').classList.add("menu_state_open");
        }
        else {
            menublock.style.display = 'none';
            document.getElementById('adaptmenuicon').classList.remove("menu_state_open");
        }
    }

    document.getElementById('addmenuicon').onclick = function () {
        var menublock = document.getElementById('additional-top-nav');
        if ((menublock.style.display == 'none') || (menublock.style.display == '')) {
            menublock.style.display = 'block';
        }
        else {
            menublock.style.display = 'none';
        }
    }

    document.getElementById('programm-header').onclick = function () {
        var menublock = document.getElementById('programm-content');
        if ((menublock.style.display == 'none') || (menublock.style.display == '')) {
            menublock.style.display = 'block';
        }
        else {
            menublock.style.display = 'none';
        }
    }

    document.getElementById('chat-header').onclick = function () {
        var menublock = document.getElementById('chat-content');

show('chat-content');
    }

}


function show(id) {
    var div = document.getElementById(id);

    if (id == 'list-tv') {
        div.style.display = 'block';
        document.getElementById('list-radio').style.display = 'none';
        document.getElementById('but-rd').classList.add("active");
        document.getElementById('but-tv').classList.remove("active");
    } else if (id == 'list-radio') {
        div.style.display = 'block';
        document.getElementById('list-tv').style.display = 'none';
        document.getElementById('but-tv').classList.add("active");
        document.getElementById('but-rd').classList.remove("active");
    } else {
        if ((div.style.display == 'none') || (div.style.display == ''))
            div.style.display = 'block'
        else
            div.style.display = 'none';
    }
}
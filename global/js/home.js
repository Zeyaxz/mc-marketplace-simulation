function search() {
    var find, filter, menu, list, a, i, j;
    find = document.getElementById("find");
    filter = find.value.toUpperCase();
    menu1 = document.getElementById("menu1");
    list = menu1.getElementsByTagName("a");

    for (i = 0; i < list.length; i++) {
        a = list[i].getElementsByTagName("div")[0];
        if (a.innerText.toUpperCase().indexOf(filter) > -1) {
        list[i].style.display = "";
        } else {
        list[i].style.display = "none";
        }
    }
    
    menu2 = document.getElementById("menu2");
    list = menu2.getElementsByTagName("a");

    for (i = 0; i < list.length; i++) {
        a = list[i].getElementsByTagName("div")[0];
        if (a.innerText.toUpperCase().indexOf(filter) > -1) {
        list[i].style.display = "";
        } else {
        list[i].style.display = "none";
        }
    }

    menu3 = document.getElementById("menu3");
    list = menu3.getElementsByTagName("a");

    for (i = 0; i < list.length; i++) {
        a = list[i].getElementsByTagName("div")[0];
        if (a.innerText.toUpperCase().indexOf(filter) > -1) {
        list[i].style.display = "";
        } else {
        list[i].style.display = "none";
        }
    }

    menu4 = document.getElementById("menu4");
    document.getElementById("tes").classList.contains
    list = menu4.getElementsByTagName("a");

    for (i = 0; i < list.length; i++) {
        a = list[i].getElementsByTagName("div")[0];
        if (a.innerText.toUpperCase().indexOf(filter) > -1) {
        list[i].style.display = "";
        } else {
        list[i].style.display = "none";
        }
    }
}

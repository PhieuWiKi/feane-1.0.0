var curentCart = document.getElementById("numMenu").innerText;
if (curentCart == 0) {
  document.getElementById("numMenu").style.display = "none";
}

function myFun(idMenu) {
  cLogin();
  var xlmhttp = new XMLHttpRequest();
  xlmhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var curentCart = document.getElementById("numMenu").innerText;
      curentCart = parseInt(curentCart) + 1;
      document.getElementById("numMenu").innerText = curentCart;
      document.getElementById("numMenu").style.display = "block";
      var content = this.responseText;
      content = JSON.parse(content);
      if (content.status == 0) {
        var elem = document.createElement("div");
        elem.className = "item";
        elem.id = "sp" + idMenu;
        elem.innerHTML = content.content;
        if (
          document.getElementById("list_menu").childNodes[0].nodeName ==
            "#text" &&
          document.getElementById("list_menu").childNodes.length == 1
        ) {
          document.getElementById("list_menu").innerHTML = "";
          document.getElementById("list_menu").appendChild(elem);
        } else {
          document.getElementById("list_menu").appendChild(elem);
        }
      } else {
        var id_ = "sp" + idMenu;
        var curent = document.getElementById(id_).childNodes[5].innerText;
        curent = parseInt(curent) + 1;
        var price = content.content;
        price = parseInt(price) * curent;
        document.getElementById(id_).childNodes[5].innerText = curent;
        document.getElementById(id_).childNodes[7].innerText = "$" + price;
      }
    }
  };
  xlmhttp.open("GET", "update.php?id=" + idMenu, true);
  xlmhttp.send();
}

function showcart() {
  cLogin();
}

function xoa_(idMenu) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document
        .getElementById("list_menu")
        .removeChild(document.getElementById("sp" + idMenu));
        if (document.getElementById("list_menu").childNodes.length == 0) {
          document.getElementById("list_menu").innerText = "Khum có gì cả";
        } else {
          var check = 0;
          document.getElementById("list_menu").childNodes.forEach((element) => {
            if (element.nodeName != "#text") {
              check = 1;
            }
          });
          if (check == 0) {
            document.getElementById("list_menu").innerText = "Khum có gì cả";
          }
        }
        var curentCart = document.getElementById("numMenu").innerText;
          curentCart = parseInt(curentCart) - parseInt(this.responseText);
          document.getElementById("numMenu").innerText = curentCart;
          if(curentCart == 0){
            document.getElementById("numMenu").style.display = "none";
          }
    }
  };
  xmlhttp.open("GET", "delete.php?id=" + idMenu, true);
  xmlhttp.send();
}
function cLogin() {
  var a = document.getElementById("id_").value;
  if (a == "null") {
    location.replace("login.php");
  }
}

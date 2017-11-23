function afficher() {
    xhr = new XMLHttpRequest();
    xhr.open("POST","{{path('front_end_decremCovoiturage')}}",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send();
    xhr.onreadystatechange=function () {
        if ((xhr.readyState == 4) && ((xhr.status == 200) || (xhr.status == 0))) {
            document.getElementById("resultat").innerHTML = xhr.responseText;
      }
    }
}
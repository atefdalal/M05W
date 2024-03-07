function ajax() {
    var http=null;
    var http = new XMLHttpRequest();

    var reponseSERV="";
    http.open("GET","http://172.20.21.213/~dalal/M05SW/rest.php/mesure",false);
    http.onreadystatechange = function() {

        if (this.readyState == 4) {
            reponseSERV = JSON.parse(this.responseText);
            
            var tableau = "<table><tr><th>Instant</th><th>Vitesse</th><th>Regime</th></tr>";
            for(let i=0; i<reponseSERV.length;i++) {
                tableau=tableau+"<tr><td>"+reponseSERV[i]["instant"]+"</td><td>"+reponseSERV[i]["vitesse"]+"</td><td>"+reponseSERV[i]["regim"]+"</td></tr>"
                tableau=tableau+"<tr><td>"+reponseSERV[i]["instant"]+"</td><td>"+reponseSERV[i]["vitesse"]+"</td><td>"+reponseSERV[i]["regim"]+"</td></tr>"
            }
            tableau=tableau+"</table>";
            document.getElementById("section").innerHTML=tableau
            console.log(reponseSERV)
        }
    }
    http.send();
}
ajax();
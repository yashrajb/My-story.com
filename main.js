 var search = document.getElementById("search");
    var search_main = document.getElementById("search_main");
    search_main.style.display="none";
search.addEventListener('keyup',function(){
if(search.value==="" || search.value===null) {

     search_main.style.display="none";
          
}else {

      var xmlhttp = new XMLHttpRequest();
      search_main.style.display="block";

          xmlhttp.onreadystatechange = function() {

 if(xmlhttp.status==200) {

                document.getElementById("search_main").innerHTML = this.responseText;
                

              }

          }

          xmlhttp.open('GET','search.inc.php?que='+document.getElementById("search").value,true);
          xmlhttp.send();



    }

});
  


  

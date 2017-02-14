/**
 * Created by Aman Ullah on 1/28/2017.
 */
var timer = null;
document.addEventListener("DOMContentLoaded", function(event) {
    timer = setInterval(makeProgress,10);
    {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', server+'contents/plc/reply.php');
        xhr.onload = function() {
            if (xhr.status === 200) {
                setTimeout(function(){
                    window.location.replace("system.html?"+location.href.split("?")[1]);
                }, afterLoadingTime);
            }
        };
        xhr.send();
    }
});

var maxTime = maximumLoadingTime/10;
function makeProgress(){
    maxTime--;
    document.getElementById("progin").style.width = 100-((maxTime/1000)*100)+"%";
    if(maxTime == 0){
        clearInterval(timer);
        document.getElementById("serverLink").innerHTML = server;
        document.getElementById("container_1").style.display = "none";
        document.getElementById("container_2").style.display = "block";
    }
}
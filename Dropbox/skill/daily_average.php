
<!DOCTYPE HTML>
<title>graph</title>
<html>
<head>  
    <script src="Chart.min.js"></script>

<style>

    canvas{
        
        
        display: inline-block;
    }

    body{
        width: 50%;
        margin:auto;
    }

    a{
        margin:auto;
    }
</style>
<script>

window.onload= main;
var global_labels=[];
var global_data=[];

function main(){
    getProgress();
     
    var ctx = document.getElementById('myChart').getContext('2d');
    Chart.defaults.line.fill = false;
var myChart = new Chart(ctx, {
    type: 'line',
    data: {

        labels: global_labels,
        datasets: [{
            label: 'Quickest Time For Each Day',
            data: global_data,
            pointBackgroundColor:'rgba(255, 0, 0, 255)',
            borderColor:'rgba(255, 0, 0, 255)',
            backgroundColor:'rgba(255, 0, 0, 255)',
            fill:false,
            borderWidth: 1
        }]
    },
    options: {

        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});


}

 /**
    //---------------------------------------------------------------------
    // gets daily average form the database
    //---------------------------------------------------------------------
    */        
    var series2;
    function getProgress(){
      
        var xmlhttp;

            if (window.XMLHttpRequest){
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{
                // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            var globalEng='x';
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

                    result = (xmlhttp.responseText.split(":"));

                    result.pop(); //delete the last one since it is always empty
                    
                    console.log(result);

                    for(var i=0;i<result.length;i++){
                        var both = result[i].split(';');
                        var time=both[1];
                        var ms=both[0];
                        ms = Math.round(ms);
                       console.log(both);

                       global_labels.push(time);
                       global_data.push(ms);
                    }

                   
                   
                }
            };



            xmlhttp.open("GET","/Dropbox/skill/getProgress.php",
            false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();   

    }

    function makeFloat(duration){
        var milliseconds = parseInt((duration%1000)/100)
                            , seconds = parseInt((duration/1000)%60)
                            , minutes = parseInt((duration/(1000*60))%60)
                            , hours = parseInt((duration/(1000*60*60))%24);

        hours = (hours < 10) ? "0" + hours : hours;
        minutes = (minutes < 10) ? "0" + minutes : minutes;
        seconds = (seconds < 10) ? "0" + seconds : seconds;


        return parseFloat(minutes+'.'+seconds);
    }

</script>
</head>
<body>
  <canvas id="myChart" ></canvas>
<a href="http://offline.com/Dropbox/skill/skill.php">go back</a>

</body>

</html>

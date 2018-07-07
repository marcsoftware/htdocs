<!DOCTYPE HTML>
<title>graph</title>
<html>
<head>  
<script>
    
    var result;
    var series2;
    window.onload = function () {
        getProgress();

        var chartString= {
            animationEnabled: false,
            theme: "light2",
            title:{
                text: "Progress"
            },
            axisY:{
                includeZero: false
            },
            axisX:{
                  interval: 2,
                  intervalType: "day"
            },
            data: [],

            toolTip:{
                   contentFormatter: function ( e ) {
                                            return e.entries[0].dataPoint.y+' , '+e.entries[0].dataPoint.x.toLocaleDateString('en-US');  
                                     }  
            }
        };
        
         
        chartString.data.push(series2);
        
        
        var chart = new CanvasJS.Chart("chartContainer", chartString);

        chart.render();

         

    }


    /**
    //---------------------------------------------------------------------
    //
    //---------------------------------------------------------------------
    */        
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

                    result1 = (xmlhttp.responseText.split(":"));
                    result1.pop(); //delete the last one since it is always empty
                    result = result1.map(function(element,index,arr) {
                                      var both = element.split(',');
                                      var time=both[1];
                                      var ms=both[0];

                                      return {x:new Date(time),y:makeFloat(ms)}; //TODO how to pass this to chart
                                    });

                    series2 = { //dataSeries - second quarter
                                    type: "line",
                                    name: "f",
                               };



                    series2.dataPoints=result;
                   
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
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="simpleGraph.min.js"></script>
</body>
</html>
<!DOCTYPE HTML>
<title>graph</title>
<html>
<head>  
<script>
    
    var result;
    var series2;

var rawData=[];
    window.onload = function () {
        getProgress();

        var chartString= {
            animationEnabled: false,
            theme: "light2",
            title:{
                text: "Progress"
            },
            axisY:{
                includeZero: true,
                interval:5000
            },
            axisX:{
                  interval: 1,
                  intervalType: "day"
            },
            data: [{
        name: "Myrtle Beach",
        type: "spline",
        yValueFormatString: "#0.## °C",
        showInLegend: true,
        dataPoints: rawData
        }],

            toolTip:{
                   contentFormatter: function ( e ) {
                                            return e.entries[0].dataPoint.y+' , '+e.entries[0].dataPoint.x.toLocaleDateString('en-US');  
                                     }  
            }
        };
        
         
   

         
        
        var chart = new CanvasJS.Chart("chartContainer", chartString);

      

        chart.render();

         

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

                        rawData.push(
                           { x: new Date(time), y: ms }
                        );
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
<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script src="simpleGraph.min.js"></script>
</body>
</html>


 
 function init() {
 
    var x=document.getElementById("submit").addEventListener('click',saveUPC);
    getMissingDataPantry();
};


function saveUPC(){
    
    var handle = document.getElementById('inputUPC');
    
    saveUPCDatabase(handle.value);
}


/**
//---------------------------------------------------------------------
// send UPC numbers to the database
//---------------------------------------------------------------------
*/
function saveUPCDatabase(records){

    var xmlhttp;

    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

            
            

        }
    }


   records=records.replace(/\n/g,',');

 
    console.log("/Dropbox/diet/saveUPC.php?records="+records);

    xmlhttp.open("GET","/Dropbox/diet/saveUPC.php?records="+records,
    false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}


/**
//---------------------------------------------------------------------
// get empty UPC from the database
//---------------------------------------------------------------------
*/
function getMissingDataPantry(){

    var xmlhttp;

    if (window.XMLHttpRequest){
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders
            var list = (xmlhttp.responseText);
            list=list.replace(/\s/g,'');
            list=list.split('{END}');
            list.pop(); //delete last one since it is empty
            wrap(list);

        }
    }
    

    xmlhttp.open("GET","/Dropbox/diet/getMissingDataPantry.php",
    false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}

// turn the list from getMissingDataPantry() into an editable table
// input: list ->array of UPCs
//output: populates the 'missingData' html element with input-elements
function wrap(list){
    
    for(var i =0;i<list.length;i++){
        var fields = list[i].split(",");
        var UPC = fields[0];
        var name = fields[1];
        //upc |name| amount-per-serv-unit| amount-er-serv-label| cal-per-serv |servpercontainer
        var serving_size=fields[2]+''+fields[3];
        var cal_per_serv=fields[4];
        var serv_per_container=fields[5];
        var id = fields[6]
        document.getElementById('missingData').innerHTML+=
        `<input type=text 
            onchange="fix( ${id}  ,'name',this.value)"
            value=${name}>
        </input>
        <a href="https://www.google.com/search?q=${UPC}">🔎</a>
        <input type=text 
            onchange="fix( ${id} ,'upc',this.value,this)"
            value=${UPC}>
        </input>
        <input type=text 
            onchange="fix( ${id}  ,'amount_per_serv',this.value)"
            value=${serving_size}>
        </input>
        <input type=text 
            onchange="fix( ${id}  ,'cal_per_serv',this.value)"
            value=${cal_per_serv}>
        </input>
        <input type=text 
            onchange="fix( ${id}  ,'serv_per_container',this.value)"
            value=${serv_per_container}>
        </input>
        <br/>`;
    }
}

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */  
        function goToSearchPage(handle){
            var UPC = handle.nextSibling.nextSibling.value;
            
            var URL=`https://www.google.com/search?q=${UPC}`; 
            
            window.open(URL);
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */        
        //update a record in the database 
        //TODO needs to applya ratio and do math etc...
        function fix(id,field,value,handle){
           
            var xmlhttp;    

            if(field=='upc'){
                //if user edits the UPC then need to quicly update the hyperlink as well

                handle.previousSibling.previousSibling.href=`https://www.google.com/search?q=${value}`;
                handle.previousSibling.previousSibling.innerHTML=value;

            }    

            value=value.trim();
            if (window.XMLHttpRequest){
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{
                // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders
                    
                    result = (xmlhttp.responseText);
                    
                       

                    
                }
            };
            
            
            xmlhttp.open("GET","/Dropbox/diet/fixUPC.php?id="+id+'&field='+field+'&value='+value,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();

        }

/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/
//pre: make sure readCookie.php 
var item;
function wrapUSEthisasaguide(x,index){
    x= x.split("~");
    var id = x.pop(); // get the ID 

    
    
    
    var field = ['name','total_cals','total_amount','cal_per_serv','amount_per_serv','date']; // make sure this corresponds to the database/table diet 
                                                                                                // and the readCookie.php output

    
    
    //item object just contains just the word-labels.. array x contains the numerical values
  item = {};
    field[0]=field[0].trim();
     item = {
        'id': field[0],
        'name': field[1],
        'total_cals':field[2],
        'total_amount': field[3],
        'cal_per_serv': field[4],
        'amount_per_serv': field[5],
        'date': field[6]

        };

        
     if(x[2] && x[2].trim()==='0'){
        x[2]='';
        
     }
       
    var delete_button =`<span onclick="addOrRemove(${id},this)" >❌</span>`;   

    //draw header

    if(x[0].includes(':')){
        var input = `<input class="label" value="${x[0]}" name=${id} onchange="fix(${id},'name',this.value,item)"></input>`;
        document.getElementById('result').innerHTML+='<li >'+input+delete_button+`<p hidden>${x[6]+','+id}</p>`+`</li>`;
        return;
    }

    var line= '';
    for(var i =0; i < x.length-1 ; i++){
        line+=`<input value="${x[i]}" name=${id} onchange="recalculate(${id},'${field[i]}',this.value,item)"></input>`;
    }
    line+=delete_button+"";

    document.getElementById('result').innerHTML+=`<li> ░  <p hidden>${x[6]+','+id}</p>`+line+`  </li>`;

}
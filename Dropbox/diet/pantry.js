
window.onload=init();
 
 function init() {
 getMissingDataPantry();

    var x=document.getElementById("submit").addEventListener('click',saveUPC);
    
};


function saveUPC(){
    
    var handle = document.getElementById('inputUPC');
    
    saveUPCDatabase(handle.value);
    document.getElementById('missingData').innerHTML='';
    getMissingDataPantry();
    
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

            document.getElementById('loader').style.display = "none";

            

        }
    }


   records=records.replace(/\n/g,',');

    
    document.getElementById('loader').style.display = "block";
    

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
    true); // TODO This is badpractice. Turn false into true. //////
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
        //name[search UPC button],upc,servingsize,calperserv,servpercontainer
        var serving_size=fields[2]+''+fields[3];
        var cal_per_serv=fields[4];
        var serv_per_container=fields[5];
        var id = fields[6];
        var name_string=`name="${id}"`; //use t
         var delete_button =`<span onclick="addOrRemove(${id},this)" >❌</span>`;   
        document.getElementById('missingData').innerHTML+=
        `<input type=text  ${name_string}
            onchange="fix( ${id}  ,'name',this.value)"
            value=${name}>
        </input>
        <a href="https://www.google.com/search?q=${UPC}">🔎</a>
        <input type=text  ${name_string}
            onchange="fix( ${id} ,'upc',this.value,this)"
            value=${UPC}>
        </input>
        <input type=text  ${name_string}
            onchange="fix( ${id}  ,'amount_per_serv',this.value)"
            value=${serving_size}>
        </input>
        <input type=text  ${name_string}
            onchange="fix( ${id}  ,'cal_per_serv',this.value)"
            value=${cal_per_serv}>
        </input>
        <input type=text  ${name_string}
            onchange="fix( ${id}  ,'serv_per_container',this.value)"
            value=${serv_per_container}>
        </input>
        ${delete_button}
        <br/>`;
    }
}


   /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //pre: make sure readCookie.php 
        var item;
        function wrap2(x,index){
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
                var input = `<p hidden>${x[6]+','+id}</p><input class="label" value="${x[0]}" name=${id} onchange="fix(${id},'name',this.value,item)"></input>`;
                document.getElementById('result').innerHTML+='<li >'+input+delete_button+`</li>`;
                return;
            }

            var line= '';
            for(var i =0; i < x.length-1 ; i++){
                line+=`<input value="${x[i]}" name=${id} onchange="recalculate(${id},'${field[i]}',this.value,item)"></input>`;
            }
            line+=delete_button+"";

            document.getElementById('result').innerHTML+=`<li> ░  <p hidden>${x[6]+','+id}</p>`+line+`  </li>`;

        }



/**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //Add a food item to the diet database
        //arg: item should be an object with 5 fields.
        //
        function sendToDatabase(item){
                         
        
             
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
            }

            id=item.id || 0;
            name = item.name || false;
            
            //name upc amount_per_serv cal_per_serv serv_per_container
            
            amount_per_serv = item.amount_per_serv ;
            total_amount = item.total_amount;
            cal_per_serv = item.cal_per_serv;
            serv_per_container = item.serv_per_container;
            upc = item.upc;

            
            //validate everything
            id = validate('id',id);
            upc = validate('upc',upc);
            name = validate('name',name);
            amount_per_serv = validate('amount_per_serv',amount_per_serv);
            serv_per_container = validate('serv_per_container',serv_per_container);
            cal_per_serv = validate('cal_per_serv',cal_per_serv);
           
         

            
           
             

            string_date='&date='+stringDate();



            xmlhttp.open("GET","/Dropbox/diet/sendToDatabasePantry.php?"+upc+id+name+amount_per_serv+serv_per_container+cal_per_serv+string_date,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            
        }


//---------------------------------------------
//
//---------------------------------------------
function stringDate(){
    var today = new Date();
    today.setDate(today.getDate());
    var string_date = today.getFullYear()+'/'+(today.getMonth()+1)+'/'+(str_pad(today.getDate()));
    
    return string_date;

}

//---------------------------------------------
//
//---------------------------------------------
function str_pad(n) {
    return String("00" + n).slice(-2);
}


   /**
        //---------------------------------------------------------------------
        //  
        //---------------------------------------------------------------------
        */

        function validate(name,value){
             if(value!==null && value!==undefined && value.length != 0){
                return `&${name}=${value}`;
            }else{
                return '';
            }
        }


 /**
        //---------------------------------------------------------------------
        //  when user clicks delete button this functin is call. This function
        // decised whether to delete the item from the database or to re-add it
        //---------------------------------------------------------------------
        */
        function addOrRemove(id, handle){

            var delete_message='❌';
            var add_message='✅deleted. click to re-add.';
            var length =handle.innerHTML.length;

            if(length > 1){ //if user clicked re-add item
                handle.innerHTML=delete_message;
                var item=createItemObject(id);
                sendToDatabase(item);
                
                setDisabledTo(id,false);

            }else{//if user clicked detete item
                handle.innerHTML=add_message;
                deleteID(id);
                setDisabledTo(id,true);
            }
            
        }


      /**
        //---------------------------------------------------------------------
        //  get data from form and turn it into a programable-object
        //---------------------------------------------------------------------
        */
        function createItemObject(id){
            var record = document.getElementsByName(id);
             

             var item = {
                            'id':id,
                            'name':record[0].value,
                            'upc':record[1].value,
                            'amount_per_serv':record[2].value,
                            'cal_per_serv':record[3].value,
                            'serv_per_container':record[4].value
                        };
              
            
            return item;

        }


   /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function deleteID(id){
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

                        var result = xmlhttp.responseText;
 
                    }
                };

               
               
               
               
              
                
                xmlhttp.open("GET","/Dropbox/diet/deleteIDpantry.php?id="+id,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   
        }


        /**
        //---------------------------------------------------------------------
        //  disable all elements that have the name that matches the id.
        //---------------------------------------------------------------------
        */
        function setDisabledTo(id,status){
            var records = document.getElementsByName(id);
             

             for(var i=0;i<records.length;i++){
                records[i].disabled=status;
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
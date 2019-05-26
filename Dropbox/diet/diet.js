



    /**
    //---------------------------------------------------------------------
    //  Program starts here
    //---------------------------------------------------------------------
    */


    // TODO press enter to submit 
    $(document).ready(function(){
        
        init();

        var values = ["block","none"];

        $(document).keyup(function(e,element){ // keyboard event is only attached to "input" elements
            var target = (e.target.id);

            if(e.keyCode==13 && target !== 'name' ){ //13 is for the [ENTER] key
                                                      // and disable the shortcut if NAME element is in focus
                saveItem();
            }

        });





  


    });



        var date=0;
        

         /**submit
        //---------------------------------------------------------------------
        // gets values from the forms and generates an object , then clears the form
        // then passes the object to addNew()
        //---------------------------------------------------------------------
        */
        function saveItem(){
                var name =  document.getElementById('name').value;
                if(!name){
                    return; //dont save if not valid name
                }
                var total_cals =  document.getElementById('total_cals').value;
                
                var total_amount =  document.getElementById('total_amount').value;
                var cal_per_serv =  document.getElementById('cal_per_serv').value;
                var  amount_per_serv =  document.getElementById('amount_per_serv').value;
                


                var item = {
                            'name':name,
                            'total_cals':total_cals,
                            'total_amount':total_amount,
                            'cal_per_serv':cal_per_serv,
                            'amount_per_serv':amount_per_serv
                        };
                
                addNew(item); 
                
                sendToDatabase(item);

                clearForm();
                
                softReset(); //debug
                 
        }

        /**
        //---------------------------------------------------------------------
        // clears the form of users input from the submit-form at the top of the page
        //---------------------------------------------------------------------
        */
        function clearForm(){
            document.getElementById('total_cals').value='';
            document.getElementById('name').value='';

            document.getElementById('total_amount').value='';
            document.getElementById('cal_per_serv').value='';
            document.getElementById('amount_per_serv').value='';
        }


      

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */

        function strcmp(a, b) {

            if(typeof(b) == "undefined"){
                b='';
            }

            if(typeof(a) == "undefined"){
                a='';
            }

            a = a.toString();
            b = b.toString();
            a = a.trim();
            b = b.trim();
                
            
            if(a.match(b)){
                return true;
            }else{
                return false;
            }
            
            
            
        }

        /**
        //---------------------------------------------------------------------
        //find custom label in database and return the factor
        //returns factor for converting to oz.
        //
        //---------------------------------------------------------------------
        */

        var global_list;
        function getCustomLabel(item_name){
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
                    list=list.split(',');
                    list.pop(); //delete last one since it is empty
                    global_list=list;
                    list=removeDuplicates(list);
                    
               

                    populateLabelForm(list); 
                    
                    
      
                }
            };


          

            
         
            xmlhttp.open("GET","/Dropbox/diet/getCustomLabel.php?item_name="+item_name,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();

         }

        /**
        //---------------------------------------------------------------------
        //delete repeats from an array and return a new array
        //---------------------------------------------------------------------
        */         
        function removeDuplicates(arr){
                var unique_array = [];
                for(var i = 0;i < arr.length; i++){

                    if(arr[i].search(/[0-9\.]/)<0)
                    {
                        if(unique_array.indexOf(arr[i]) == -1){
                            unique_array.push(arr[i]);

                        }
                    }
                }
                return unique_array;
        }

        /**
        //---------------------------------------------------------------------
        //x: an array that contains an int and a label
        //---------------------------------------------------------------------
        */

        function convertToOz(x,target_label='oz'){

            var label =  ['cup','liter', 'quart','pint', 'g'      , 'oz' , 'tbsp' ];
            var factor = [ 8   , 33.814,  32    , 16   ,  0.035274,  1   ,  0.5]; //factor for converting to OZ
            
            var index = label.indexOf(x[1].toString().replace(/s(?:\s|$)/g,'')); //get rid of S at the end so that cups will match cup for example

            if(index === -1){
                //not mach in array label[] so can't be converted
                return false;
            }
            
            
            if(target_label !== 'oz' && x[1] !== 'oz'){
                
                       var copy = x.slice();

                       var intermediary= convertToOz(copy,'oz'); //todo check intermediary
                       x=intermediary;
                                
            }

            if(x[1] ==='oz' && target_label !== 'oz'){
                index=label.indexOf(target_label);
                
                x[0] = parseFloat(x[0]/factor[index]);
                x[1]=target_label;

            }else{
                x[0] = parseFloat(x[0]); 
                x[0] *= factor[index];
                x[1] ='oz'; 
            }
          
            return x;
         }
        

      
        /**
        //---------------------------------------------------------------------
        // makes labels compatible for doing algebra

        //---------------------------------------------------------------------
        */
        function doUnitConversion(item){
            
                    var consumed = removeLabel( item.total_amount);
                    var serving = removeLabel(item.amount_per_serv);
                    

                    
                    
                    consumed[1]+='';//convert to string;
                    serving[1]+='';//convert to string;
                    

                    
                   

                    var label = 1; //make INDEXs more readable
                    var unit = 0;

                    if(consumed[label]==='null' && item.total_cals  && serving[label] !== 'null'){ // assume that label is OZ
                        consumed[label]='oz'; 
                        item.total_amount=consumed[unit]+consumed[label];
                    }
                   

                    if(strcmp(consumed[label],serving[label])){ // compare the labels
                        //if labels match our job is done.
                        return;
                    }else if(!item.total_amount && !item.total_cals){
                        return; // nothing can be done
                    }


                    if(consumed[label] !== 'oz' && consumed[label] !== 'null' ){
                   
                        if(!convertToOz(consumed,consumed[label])){
                            //can't convert
                            getCustomLabel(item.name);

                             var index = global_list.indexOf(consumed[label]+'');
                          
                            if(index>=0){

                                item.cal_per_serv=global_list[index+2];
                                item.amount_per_serv=global_list[index+1]+' '+global_list[index];
                             
                            }                                
                        }else{
                            consumed = convertToOz(serving,consumed[label])
                            
                        }
                        item.amount_per_serv=consumed[unit]+' '+consumed[label]; 
                        
                    }else if(serving[label] !== 'oz' && serving[label] !== 'null' ){
                        
                        if(!convertToOz(serving,consumed[label])){
                            
                            getCustomLabel(item.name); 

                            var index = global_list.indexOf(serving[label]+'');
                            if(index>=0){

                                item.cal_per_serv=global_list[index+2];
                                item.amount_per_serv=global_list[index+1]+' '+global_list[index];
                               
                            }                                
                        }else{
                            serving = convertToOz(serving,consumed[label])
                        }


                        item.amount_per_serv=serving[unit]+' '+serving[label]; // y[0] in the number, and y[1] is the unit label
                        
                    
                    } 

                        
                    
                    

        }



        /**
        //---------------------------------------------------------------------
        // replace two strings at a time
        // arg: regex //comma separated words to be replaced
        // arg: new_text
        //---------------------------------------------------------------------
        */
        function quickReplace(regex,new_text){
            
            if(item == undefined){
                return;
            }

            regex= regex.split(',').join('|');
            regex= '('+regex+')';
            regex = new RegExp(regex);


            item.total_amount=item.total_amount.replace(regex,new_text);
            item.amount_per_serv=item.total_amount.replace(regex,new_text);
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function removeSynonyms(item){
            
            quickReplace('cups','cup');
            

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //Add a food item to the diet database
        //arg: item should be an object with 5 fields.
        //
        function addNew(item){
                      
            var xmlhttp;    

             if(item.name.includes(':')){
                item.total_cals='0';
                item.total_amount='0null';
                item.amount_per_serv='0null';
                item.cal_per_serv='0';
            
                
                return;

            }

            //copy any numerals in the name into the total_amount field
            moveNumerals(item);

            if(!item.amount_per_serv && !item.cal_per_serv){
                getStats(item.name);
                
                item.cal_per_serv=global_stats[3];
                item.amount_per_serv=global_stats[4];

            }




            //TODO needs to account for labels
            
           

            doBasicMath(item); // does simple arithmetic if present eg: 2.5*3 calories
          

            guess(item);

            removeSynonyms(item);

            doUnitConversion(item);// converts all labels to be compatable for algebra
           


            doAlgebra(item); //fills in all the gaps that it can.
            
            doMoveAround(item);

            
      
       
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        // if user types in '1 coke' automatically move the '1' to the total_amount field
        function moveNumerals(item){
                    var numerals = item.name.match(/[0-9]+/g);
                    if(numerals !== null){    
                        item.name=item.name.replace(/[0-9]/g,''); 
                        item.total_amount=numerals+=item.total_amount;
                    }
            
                        
        }



        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //get the last used label if nessasary 
        function guess(item){
            
            
            var result =removeLabel( item.total_amount);  
            var number = result[0];
            var label = result[1];
            
            if(number && label == 'null'){
                 getLastLabel(item.name); // global_last_label
                
                item.total_amount=item.total_amount.replace("null",'');
                item.total_amount=item.total_amount+global_last_label;
            
            }
            
            
        }


        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        var global_last_label;
        function getLastLabel(item_name){
          
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
                        global_last_label=(result);
                            
                    }
                };


                xmlhttp.open("GET","/Dropbox/diet/getLastLabel.php?item_name="+item_name,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

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
                            'total_cals':record[1].value,
                            'total_amount':record[2].value,
                            'cal_per_serv':record[3].value,
                            'amount_per_serv':record[4].value
                        };
              
            
            return item;

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
        function recalculate(id,handle){

             handle.style.display = "none";
             
             var item= createItemObject(id);
             var record = document.getElementsByName(id);
             
             for(var i=0;i<record.length;i++){
                record[i].style.backgroundColor='white';
                record[i].style.border = "thin solid black"; 
             }
       

             if(id){
                item.id=id;
             }

             addNew(item);

             sendToDatabase(item);   
             softReset();
        }



        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function color(handle){
             handle.style.backgroundColor='#ffdb99';
             handle.style.border = "thick solid black"; 

             var id = handle.name;
             var list = document.getElementsByName(id);
             var button = list[list.length-1];
             button.style.display = "inline";
             

           
        }
//---------------------------------------------
//
//---------------------------------------------
function stringDate(){
	var today = new Date();
    today.setDate(today.getDate()+date);
	var string_date = today.getFullYear()+'/'+(  str_pad(today.getMonth()+1)   )+'/'+(str_pad(today.getDate()));
	
	return string_date;

}


function str_pad(n) {
    return String("00" + n).slice(-2);
}

        /**
        //---------------------------------------------------------------------
        // if user filled out total_amount and total_cals but not amount_per_serv and not cal_per_serv
        //---------------------------------------------------------------------
        */
        function doMoveAround(item){
            if( (!isTrue(item.cal_per_serv) && !isTrue(item.amount_per_serv) ) && (isTrue(item.total_amount) && isTrue(item.total_cals))){
                item.cal_per_serv=item.total_cals;
                item.amount_per_serv=item.total_amount;
            }


            

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
            
            
            amount_per_serv = item.amount_per_serv ;
            total_amount = item.total_amount;
            cal_per_serv = item.cal_per_serv;

            total_cals=item.total_cals;
            //id
            if(id !==null && id!==undefined && id.length != 0){
                id='id='+id;
            }else{
                id='';
            }
            //name
             if(name!==null && name!==undefined && name.length != 0){
                name='&name='+name;
            }
            else{
                name='';
            }
            //total_cals
             if(total_cals!==null && total_cals!==undefined && total_cals.length != 0){
                if(total_cals.toString().indexOf(".")>=0){
                    try{
                        total_cals=total_cals.toFixed(2);
                    }catch(e){}
                }
                total_cals='&total_cals='+total_cals;
            }else{
                total_cals='';
            }
            //amount_per_serv

             if(amount_per_serv!==null && amount_per_serv!==undefined && amount_per_serv.length != 0){
                amount_per_serv='&amount_per_serv='+amount_per_serv;
            }else{
                amount_per_serv='';
            }
            //total moaunt
             if(total_amount!==null && total_amount!==undefined && total_amount.length != 0){
                total_amount='&total_amount='+total_amount;
            }else{
                total_amount='';
            }
            //calperserv
             if(cal_per_serv!==null && cal_per_serv!==undefined && cal_per_serv.length != 0){
                cal_per_serv='&cal_per_serv='+cal_per_serv;
            }else{
                cal_per_serv='';
            }

            string_date='&date='+stringDate();

            xmlhttp.open("GET","/Dropbox/diet/createcookie.php?"+id+name+total_cals+
                            amount_per_serv+total_amount+cal_per_serv+string_date,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            
        }

        /**
        //---------------------------------------------------------------------
        // 
        //---------------------------------------------------------------------
        */
        //arg: item object which represents food
        // take every property and does the basic math for example
        // if item.total is the string '2*10';
        // then this function will make item.total=10; 
        function doBasicMath(item){

            if(item.total_cals !== null &&item.total_cals !== undefined ){
                item.total_cals=doBasicMathOnEntry(item.total_cals)[0]; 
                
         
            }

            if(item.total_amount !== null &&item.total_amount !== undefined && item.total_amount.length !== 0){
               
                item.total_amount=doBasicMathOnEntry(item.total_amount)[1]; 
               
                
            }
            if(item.cal_per_serv !== null &&item.cal_per_serv !== undefined){
                item.cal_per_serv=doBasicMathOnEntry(item.cal_per_serv)[0]; 
            }
            if(item.amount_per_serv !== null &&item.amount_per_serv !== undefined){
                item.amount_per_serv=doBasicMathOnEntry(item.amount_per_serv)[1]; 
            }    
            
            

        }

        /**
        //---------------------------------------------------------------------
        // Evaluates the simple arithmatic, for example: '2*3/6' returns '1'
        //---------------------------------------------------------------------
        */
        function doBasicMathOnEntry(x){
           
            if(typeof(x) == "undefined" || x==='') {
                return 0;
            }
            
            x=x.toString();

            var label = x.match(/[a-zA-Z]+/g);
            
            var number = x.match(/[\d\+\-\*\/\.]+/g);
            number=number.join('');
            number = eval(number);
            
            number = number || 0; //if number is invalid make it a 0.
            
            if(label && (number ===0 )){
                number=1;
            }

            

      
            return [number,number+''+label];

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function removeLabel(ref){
           if(typeof(ref) == "undefined"){
                return 0;
            }
              var x = ref.slice();
                var label = '';
                var number = '';

                try{
                    label = x.match(/[a-zA-Z]+/g);
                                    
                    number = x.match(/[\d\.]+/g);

                }catch(e){
                    console.log('ERROR in removeLabel(): the arg x was probably undefined');
                }
                
                number = parseFloat(number);

                if(label === null){
                        label=' ';
                    }
                      

                return [number,label];
        }
        
        /**
        //---------------------------------------------------------------------
        // returns true if contains a number other than zero 
        //---------------------------------------------------------------------
        */
        function isTrue(x){
                   
            if(typeof(x) == "undefined"){
                return false;
            }
            x=x.toString();
            x=x.search(/[1-9\.]/g);

            if(x <=-1){
                return false;
            }else{
                return true;
            }
        }
        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //arg: item is an object that represents a food
        // if solves all varibles that can be solved for.   
        // total_cals  = cal_per_serv / amount_per_serv * total_amount
        // pre-condition: should call doUnitConversion(item) before this one to make sure units match
        function doAlgebra(item){

        
            if(isTrue(item.cal_per_serv) && isTrue(item.amount_per_serv) && (item.total_amount || item.total_cals)){
                //if true then we have enough info to work with
                
                

                if(isTrue(item.total_cals) && !isTrue(item.total_amount)){
                //TODO miscalcutales total_amount when total_cals is defined as 100cals 
                    var label = removeLabel(item.amount_per_serv)[1];
                    var unit = removeLabel(item.amount_per_serv)[0];
                    unit = parseFloat(unit);
                    item.total_amount=((item.total_cals/item.cal_per_serv)*unit)+label; 
                  
                    
                }else if(!isTrue(item.total_cals) && isTrue(item.total_amount)){
                    
                
                      var amount_per_serv=removeLabel(item.amount_per_serv)[0]; //unit
                      var label=String(removeLabel(item.amount_per_serv)[1]); //label
                      
                      var total_amount=removeLabel(item.total_amount)[0]; //unit
                      var total_amount_label=String(removeLabel(item.total_amount)[1]); //label
                
                      
                      
                      if(label.localeCompare(total_amount_label)){
                            
                            return; //labels don't match

                      }

                      item.total_cals = (total_amount / amount_per_serv) * item.cal_per_serv; //wrong
                    
                }

            }else if(item.total_cals && item.total_amount){
                

                if(!item.amount_per_serv && !item.cal_per_serv){
                    item.cal_per_serv= item.total_cals;
                    item.amount_per_serv= item.total_amount;

                }



            }

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */        
        //update a record in the database 
        //TODO needs to applya ratio and do math etc...
        function fix(id,field,value,item){
           
            var xmlhttp;    
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
            
            xmlhttp.open("GET","/Dropbox/diet/fixcookie.php?id="+id+'&field='+field+'&value='+value,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();

        }
        

        
        /**
        //---------------------------------------------------------------------
        // gets all the users data for the day
        //---------------------------------------------------------------------
        */
        function getData(){

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
                     document.getElementById('result').innerHTML=""; // delete previous results
                    result = (xmlhttp.responseText);

                    //result = .toString().split("\n");
                    var new_result=result.replace(/null/g,'');
                     new_result=(new_result.split("<br/>"));
                    
                    //get rid of the extra delte button
                    new_result.pop(); //delte the last element since it is always empty

                    if(new_result.length === 0){
                        new_result=[''];
                        return;
                    }
                    for(var i =0;i<new_result.length;i++){
                        
                        wrap(new_result[i],i);

                    }
                    
                     //TODO make this editable

                    
                }
            };


            //TODO pass the global var date
            
            xmlhttp.open("GET","/Dropbox/diet/readCookie.php?date="+date,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();
            
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //pre: make sure readCookie.php 
        var item;
        function wrap(x,index){
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
             var recalc_button =`<input type='button' onclick="recalculate(${id},this)" class='recalc' name=${id} value='recalculate & save'></input>`; 

            //draw header

            if(x[0].includes(':')){
                var input = `<p hidden>${x[6]+','+id}</p><input class="label" value="${x[0]}" name=${id} onchange="fix(${id},'name',this.value,item)"></input>`;
                document.getElementById('result').innerHTML+='<li >'+input+delete_button+`</li>`;
                return;
            }

            var line= '';
            for(var i =0; i < x.length-1 ; i++){
                line+=`<input value="${x[i]}" name=${id} onchange="color(this)"></input>`;
            }
            line+=delete_button+recalc_button+"";

            document.getElementById('result').innerHTML+=`<li> ░  <p hidden>${x[6]+','+id}</p>`+line+`  </li>`;

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

               
               
               
               
              
                
                xmlhttp.open("GET","/Dropbox/diet/deleteID.php?id="+id,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   
        }



        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        // function gets all the stats for the item_name and puts them in the form.
        var global_stats;
        function getStats(item_name){
               var xmlhttp;
console.log('getstats called');
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

                        var result = (xmlhttp.responseText.split("{END}"));
                        
                        
                        result=result[0].split(',');
                        
                        //echo $row["name"]." , ".$row[""]." , ".$row[""]." , ".$row[""]." , ".$row[""]."{END}";

                        //TODO should not fill in all the boxes.
                        global_stats=result;
                       
                     

                        
                    }
                };

               
               
               
               
              item_name=item_name.replace(/[0-9]+/g,'');
              
                
                xmlhttp.open("GET","/Dropbox/diet/getStats.php?item_name="+item_name,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function getSuggestions(entry){
            
          
            getStats(entry);
            autofillSubmitionForm(global_stats);
            getCustomLabel(entry);

        }


        /**
        //---------------------------------------------------------------------
        // program starts here
        //---------------------------------------------------------------------
        */

        var timouthandle;
        clearTimeout(timouthandle);
        function init(){
            document.title+='diet';
            debug=document.getElementById('debug');

            getData();
            

            document.getElementById('name').addEventListener("blur",    
                function(x){  //TODO this is laggy
                    
                        var entry = x.target.value;
                       
                       getSuggestions(entry);
                }



            );

            var DAILY_CALORIES = 2000;
            //make calorie bar
            var d = new Date();
            var hour = d.getHours()-7; // dont count sleeping in moring
            var min = d.getMinutes();
            
            var calPerMin = (DAILY_CALORIES / (24-9))/60; // calories burned per minute when resting
            var calPerHour = (DAILY_CALORIES / (24-9)); // calories burned hour minute when resting
            
            var burnedCal = (hour * calPerHour) + (min*calPerMin);
            
            consumedCal=0;
            //TODO calculate consumedCal
            var new_result = result.split("<br/>");
            
            for(var i=0;i<result.length-1 ;i++){
                
                try{
                    var line = new_result[i].split('~');
                    
                    
                    } catch(e){
                      
                    }
                    
                if(parseFloat(line[1]) !== undefined && !isNaN(parseFloat(line[1]))){
                    
                    consumedCal += parseFloat(line[1]); // TODO make this eval
                 
                }
            
            }
            
            
            document.getElementById('burnedCal').innerHTML=burnedCal.toFixed(2);
            document.getElementById('consumedCal').innerHTML=consumedCal.toFixed(2);
            var netCal = (DAILY_CALORIES-consumedCal).toFixed(2); // changed from burnedCal to daily_calories
            document.getElementById('netCal').innerHTML=netCal;
            
            
            var rate = netCal*(7*6);
            var word = ' loose ';
            if(rate<0){
             word=' gain ';
            }
            document.getElementById('rate').innerHTML=(word)+(rate/3500).toFixed(2);

            getAllSuggestions();
            
            
            
             
        }


        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function getAllSuggestions(){
            getAllHistory(); //TODO change these function so that they only populate global_suggestions
            getAllPantry();  //     and then make a function to render them.
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */

        //call this function instead of calling main
        function softReset(){

            getData();

            var DAILY_CALORIES = 2000;
            //make calorie bar
          

            // calculate consumedCal
            var new_result = result.split("<br/>");
            consumedCal=0;
            for(var i=0;i<result.length-1 ;i++){
                
                try{
                    var line = new_result[i].split('~');
                    
                    
                    } catch(e){
                      
                    }
                    
                if(parseFloat(line[1]) !== undefined && !isNaN(parseFloat(line[1]))){
                    
                    consumedCal += parseFloat(line[1]); // TODO make this eval
                 
                }
            
            }
            
            
         
            document.getElementById('consumedCal').innerHTML=consumedCal.toFixed(2);
            var netCal = (DAILY_CALORIES-consumedCal).toFixed(2);
            var rate = netCal*(7*6);
            var word = ' loose ';
            if(rate<0){
             word=' gain ';
            }
            
            document.getElementById('rate').innerHTML=(word)+(rate/3500).toFixed(2);

            //getAllHistory(); // TODO this line causes repeats to show up in the suggestion box
            
        }
        
        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */

        function changeDate(number){
            date +=number; // add or subtract depending on the variable NUMBER
            softReset();
            

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function resetDate(){

            date=0; //todays date

            softReset();
        }

    


        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function searchDatabase(item_name){
          
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
                    //this is the database
                };

               
               
               
               
              

                xmlhttp.open("GET","/Dropbox/diet/readDatabase.php?item_name="+item_name,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function searchHistory(item_name){
          
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

                        var result = (xmlhttp.responseText.split(","));
                        
                        populateForm(result);
                       
                    }
                };

                xmlhttp.open("GET","/Dropbox/diet/searchHistory.php?item_name="+item_name,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //populates the dropdown menu on the name element of the submition form.
        function populateForm(item_array){
                 var options='';
                 var pastOpts = document.getElementById('suggestions').options;
                 item_array=removeDuplicates(item_array.concat(pastOpts));
                 
                        var template = '<option value="ITEM_NAME" />';
                        for(var i=0;i<item_array.length;i++){
                            options+=template.replace("ITEM_NAME",item_array[i]);
                            
                        }  

                        var my_list=document.getElementById("suggestions");



                        if(my_list){
                            my_list.innerHTML = options;
                        }
        }


        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        //populates the dropdown menu on the name element of the submition form.
        function populateLabelForm(item_array){
                 var options='';
                        var template = '<option value="ITEM_NAME" />';
                        document.getElementById('more_labels').innerHTML=item_array;
                        for(var i=0;i<item_array.length;i++){
                            options+=template.replace("ITEM_NAME",item_array[i]);
                            
                        }  

                        var my_list1=document.getElementById("suggestion_labels");
                        if(my_list1){
                            my_list1.innerHTML = options;

                        }
        }

        /**
        //---------------------------------------------------------------------
        // gets a particular item  using identification code
        //---------------------------------------------------------------------
        */
        function interfaceUSDAcode(item_code){ //DISABLED
          
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

                        var result = (xmlhttp.responseText);
                        

                        autofillSubmitionForm([ 'no-name','', '', result,'100g' ]);
                       
                    }
                };

               
               
               
               
              
                //DISABLED
                //xmlhttp.open("GET","/Dropbox/diet/interfaceUSDAcode.php?item_code="+item_code,false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */        
        // pass an array filled with 4 numbers
        // and the four numbers will be places in the form at the top of the page.
        function autofillSubmitionForm(form_fields){

            result = form_fields;
            
              if(result[3] && result[4]){
                    document.getElementById('cal_per_serv').value = result[3]|| "";
                    document.getElementById('amount_per_serv').value = result[4]|| "";

                }else if(result[1] && result[2]){
                    document.getElementById('cal_per_serv').value = result[1] || "";
                    document.getElementById('amount_per_serv').value = result[2]|| "";
                }

        }
        
        /**
        //---------------------------------------------------------------------
        //  just gets all item names form history
        //---------------------------------------------------------------------
        */        
        function getAllHistory(){
          
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

                        var result = (xmlhttp.responseText.split(","));
                        result.pop();//delete the empty element at the end.

                        result = global_suggestions.concat(result);
                        result = removeDuplicates(result);
                        global_suggestions =(result);
                        var options='';
                        var template = '<option value="ITEM_NAME" />';
                        for(var i=0;i<result.length;i++){
                            options+=template.replace("ITEM_NAME",result[i]);
                            
                        }  

                        var my_list=document.getElementById("suggestions");
                        my_list.innerHTML += options;


                    }
                };

               
               
               
               
              

                xmlhttp.open("GET","/Dropbox/diet/getAllHistory.php",
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }


        /**
        //---------------------------------------------------------------------
        //  just gets all item names form pantry
        //---------------------------------------------------------------------
        */    
        var global_suggestions=[];    
        function getAllPantry(){
          
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

                        var result = (xmlhttp.responseText.split(","));

                        result.pop(); //delete the empty element at the end.
                        result = global_suggestions.concat(result);

                        
                        result = removeDuplicates(result);
                        global_suggestions =(result);
                        var options='';
                        var template = '<option value="ITEM_NAME" />';
                        for(var i=0;i<result.length;i++){
                            options+=template.replace("ITEM_NAME",result[i]);
                            
                        }  

                        var my_list=document.getElementById("suggestions");
                        my_list.innerHTML = options;


                    }
                };

               
               
               
               
              

                xmlhttp.open("GET","/Dropbox/diet/getAllPantry.php",
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }


        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function interfaceUSDA(item_name){// DISABLED
                
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

                        var result = (xmlhttp.responseText.split("`"));
                        

                        var options='';
                        var template = '<option value="ITEM_NAME" />';
                        for(var i=0;i<result.length;i++){
                            options+=template.replace("ITEM_NAME",result[i]);
                            
                        }  

                        var my_list=document.getElementById("suggestions");
                        my_list.innerHTML += options;
                        
                        


                    }
                };

                //DISABLED HERE
                //xmlhttp.open("GET","/Dropbox/diet/interfaceUSDA.php?item_name="+item_name,false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }
        

    
    


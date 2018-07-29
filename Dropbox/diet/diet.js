



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

            if(e.keyCode==13 ){ //13 is for the [ENTER] key
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


         /**submit
        //---------------------------------------------------------------------
        // Called when user edits an ITEM
        //---------------------------------------------------------------------
        */
        function changeItem(){

                //TODO call from the ELEMENTS in the RESULT menu
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
                
                document.getElementById('total_cals').value='';
                document.getElementById('name').value='';
                
                document.getElementById('total_amount').value='';
                document.getElementById('cal_per_serv').value='';
                document.getElementById('amount_per_serv').value='';
                
                softReset(); //debug
                 
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
                console.log(x+' : no match');
                return false;
            }
            
            
            if(target_label !== 'oz' && x[1] !== 'oz'){
                
                       console.log('special: but still need to convert to oz as intermediary.');
                       var copy = x.slice();

                       var intermediary= convertToOz(copy,'oz'); //todo check intermediary
                       x=intermediary;
                       alert(intermediary);           
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
            console.log(x+'   ----   ');
            return x;
         }
        

      
        /**
        //---------------------------------------------------------------------
        // makes labels compatible for doing algebra
        //---------------------------------------------------------------------
        */
        function doUnitConversion(item){
            
                    var x = removeLabel( item.total_amount);
                    var y = removeLabel(item.amount_per_serv);
                    

                    
                    
                    x[1]+='';//convert to string;
                    y[1]+='';//convert to string;

                    
                    if(x[1]==='null' && item.total_cals  && y[1] !== 'null'){
                        x[1]='oz';
                        item.total_amount=x[0]+x[1];
                    }
                   
                    if(!strcmp(x[1],y[1])){ // compare the labels


                        if(y[1] !== 'oz' && y[1] !== 'null' ){
                            
                            if(!convertToOz(y,x[1])){
                                
                                getCustomLabel(item.name); 

                                var index = global_list.indexOf(y[1]+'');
                                if(index>=0){

                                    item.cal_per_serv=global_list[index+2];
                                    item.amount_per_serv=global_list[index+1]+' '+global_list[index];
                                }                                
                            }
                            item.amount_per_serv=y[0]+' '+y[1]; // y[0] in the number, and y[1] is the unit label
                        }
                        
                        if(x[1] !== 'oz' && x[1] !== 'null' ){
                            if(!convertToOz(x,x[1])){
                                
                                getCustomLabel(item.name);

                                 varindex = global_list.indexOf(x[1]+'');
                                if(index>=0){

                                    item.cal_per_serv=global_list[index+2];
                                    item.amount_per_serv=global_list[index+1]+' '+global_list[index];
                                }                                
                            }
                            item.total_amount=x[0]+' '+x[1]; // x[0] in the number, and x[1] is the unit label
                        }

                        
                    
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
                sendToDatabase(item);
                
                return;

            }

            //copy any numerals in the name into the total_amount field
            moveNumerals(item);

            if(!item.amount_per_serv && !item.cal_per_serv){
                getStats(item.name);
                //alert(global_stats[3]+'---'+global_stats[4]);
                item.cal_per_serv=global_stats[3];
                item.amount_per_serv=global_stats[4];

            }




            //TODO needs to account for labels
            
            doBasicMath(item); // does simple arithmetic if present eg: 2.5*3 calories
            

            guess(item);

            removeSynonyms(item);

            doUnitConversion(item); // converts all labels to be compatable for algebra


            doAlgebra(item); //fills in all the gaps that it can.

            doMoveAround(item);

            sendToDatabase(item);
       
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
                console.log('-------'+global_last_label);
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

                var globalEng='x';
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
        function recalculate(id,field,value,item){
              
             var item= createItemObject(id);
             var record = document.getElementsByName(id);
             

              
            //need to delete extra fields so that we know which fields need to be recalculated  
            if(field==='total_amount' && isTrue(item.cal_per_serv)){
                
                item.total_cals +='';
             }else if(field==='total_cals' && isTrue(item.cal_per_serv)){
                itemtotal_amount ='';
                
             }else if(field==='cal_per_serv'){
                
                item.total_cals='';
             }else if(field==='amount_per_serv'){
                
                item.total_cals='';
             }
            
             if(!isTrue(item.cal_per_serv)){
                item.amount_per_serv='';
             }


             addNew(item);
                   
             softReset();
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
            name = item.name || 0;
            total_cals=parseInt(total_cals);
            if(isNaN(total_cals)){
                total_cals=0;
            }
            
            
            amount_per_serv = item.amount_per_serv || 0;
            total_amount = item.total_amount|| 0;
            cal_per_serv = item.cal_per_serv|| 0;

            total_cals=item.total_cals||0;

            xmlhttp.open("GET","/Dropbox/diet/createcookie.php?id="+id+"&name="+name+'&total_cals='+total_cals+'&amount_per_serv='+
                            amount_per_serv+'&total_amount='+total_amount+'&cal_per_serv='+cal_per_serv,false); // TODO This is badpractice. Turn false into true. //////
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
         
          
           item.total_cals=doBasicMathOnEntry(item.total_cals)[0]; 
           
           item.total_amount=doBasicMathOnEntry(item.total_amount)[1]; 
           item.cal_per_serv=doBasicMathOnEntry(item.cal_per_serv)[0]; 
           item.amount_per_serv=doBasicMathOnEntry(item.amount_per_serv)[1]; 
                
            
            

        }

        /**
        //---------------------------------------------------------------------
        // Evaluates the simple arithmatic, for example: '2*3/6' returns '1'
        //---------------------------------------------------------------------
        */
        function doBasicMathOnEntry(x){
           
            if(typeof(x) == "undefined"){
                return 0;
            }
            x=x.toString();
            var label = x.match(/[a-zA-Z]+/g);
            
            var number = x.match(/[\d\+\-\*\/\.]+/g);
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
            
            xmlhttp.open("GET","/Dropbox/diet/fixcookie.php?id="+id+'&field='+field+'&value='+value+'&customer_name='+customer_name,false); // TODO This is badpractice. Turn false into true. //////
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
            
            xmlhttp.open("GET","/Dropbox/diet/readCookie.php?date="+date+'&customer_name='+customer_name,false); // TODO This is badpractice. Turn false into true. //////
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
                console.log('clicked re-add');
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
            
            if(entry.includes('[')){ // if item name has a '~' then the item is from the USDA database
                            //TODO calculate calories 
                            var code = entry.match(/\[.*\]/g);
                            code = code[0].replace(/[\[\]]/g,'');
                            interfaceUSDAcode(code);

                            
                        }else{

                            getStats(entry);
                            autofillSubmitionForm(global_stats);
                            getCustomLabel(entry);
            }   
        }


        /**
        //---------------------------------------------------------------------
        // program starts here
        //---------------------------------------------------------------------
        */

        var timouthandle;
        clearTimeout(timouthandle);
        function init(){
            
            debug=document.getElementById('debug');
            getData();
            

            document.getElementById('name').addEventListener("keyup",    
                function(x){
                    
                        var entry = x.target.value;
                        if(x.keyCode==9){ // tab key is 9
                            getSuggestions(entry); // if user hits tab key , immediately calculate calories
                            return;
                        }
                        clearTimeout(timouthandle);
                        
                        timouthandle = setTimeout(function() { getSuggestions(entry)}, 500);
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

            getAllHistory();
            
            
            
             
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

                var globalEng='x';
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

                var globalEng='x';
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

                var globalEng='x';
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

                var globalEng='x';
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200){ //TODO make return text using echo() in php file to prevent false green borders

                        var result = (xmlhttp.responseText.split(","));
                        
                        result = removeDuplicates(result);
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

                var globalEng='x';
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
        

    
    


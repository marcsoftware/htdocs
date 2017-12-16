

    /**
    //---------------------------------------------------------------------
    // 
    //---------------------------------------------------------------------
    */

    // TODO press enter to submit 
    $(document).ready(function(){
        var values = ["block","none"];

        $(document).keyup(function(e,element){ // keyboard event is only attached to "input" elements
            var target = (e.target.id);
            if(e.keyCode==13 && target !== 'name'){ //13 is for the [ENTER] key
                                                      // and disable the shortcut if NAME element is in focus
                saveItem();
            }

        });


    });



        var date=0;
        var customer_name='none';

         /**
        //---------------------------------------------------------------------
        // gets values from the forms and generates an object , then clears the form
        // then passes the object to addNew()
        //---------------------------------------------------------------------
        */
        function saveItem(){
                var name =  document.getElementById('name').value;
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
                
                main();
                 
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */

        function strcmp(a, b) {

            a = a.toString(), b = b.toString();
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
        //
        //---------------------------------------------------------------------
        */
        function convertToOz(x){
            

            var label = ['NO MATCH','cup','liter','quart','pint','g','oz'];
            var factor = [0,8,33.814,32,16,0.035274,1]; //factor for converting to OZ
            
            var index = label.indexOf(x[1].toString()); 
            
            x[0] = parseInt(x[0]); 
            x[0] *= factor[index];
            x[1] ='oz'; 
         }
        
        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function doUnitConversion(item){
            
                    var x = removeLabel( item['total_amount']);
                    var y = removeLabel(item['amount_per_serv']);
                    
                    if(!strcmp(x[1],y[1])){ // compare the labels

                        if(x[1] !== 'oz'){
                            convertToOz(x);
                            item['total_amount']=x[0]+' '+x[1]; // x[0] in the number, and x[1] is the unit label
                        }

                        if(y[1] !== 'oz'){
                            convertToOz(y);
                            item['amount_per_serv']=y[0]+' '+y[1]; // y[0] in the number, and y[1] is the unit label
                        }

                        

                       
                    
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
        function addNew(item){
                         
            var xmlhttp;    

            //TODO needs to account for labels
            doBasicMath(item);
            doUnitConversion(item);
            doAlgebra(item);
             
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


            name = item['name'] || 0;
            total_cals = item['total_cals']|| 0;
            amount_per_serv = item['amount_per_serv']|| 0;
            total_amount = item['total_amount']|| 0;
            cal_per_serv = item['cal_per_serv']|| 0;

            
         
            xmlhttp.open("GET","/Dropbox/diet/createcookie.php?name="+name+'&total_cals='+total_cals+'&amount_per_serv='+
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
           
            

           item['total_cals']=doBasicMathOnEntry(item['total_cals'])[0]; 
           item['total_amount']=doBasicMathOnEntry(item['total_amount'])[1]; 
           item['cal_per_serv']=doBasicMathOnEntry(item['cal_per_serv'])[0]; 
           item['amount_per_serv']=doBasicMathOnEntry(item['amount_per_serv'])[1]; 
                
            
            

        }

        /**
        //---------------------------------------------------------------------
        // Evaluates the simple arithmatic, for example: '2*3/6' returns '1'
        //---------------------------------------------------------------------
        */
        function doBasicMathOnEntry(x){
            var label = x.match(/[a-zA-Z]+/g);
            
            var number = x.match(/\d+/g);
            number = eval(number);
            number |= 0; //if number is invalid make it a 0.
            
            return [number,number+''+label];

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function removeLabel(x){
                var label = '';
                var number = '';


                try{
                    label = x.match(/[a-zA-Z]+/g);
                    number = x.match(/\d+/g);
                    


                }catch(e){
                    console.log('ERROR in removeLabel(): the arg x was probably undefined');
                }

                number = parseInt(number);
                return [number,label]
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

           
            if(item.cal_per_serv && item.amount_per_serv){
                
                if(item.total_cals && !item.total_amount){
                
                    var label = removeLabel(item.amount_per_serv)[1];
                    item.total_amount=item.total_cals/cal_per_serv+label; 
                

                }else if(!item.total_cals && item.total_amount){
                    
                
                      var amount_per_serv=removeLabel(item.amount_per_serv)[0];
                      
                      var total_amount=removeLabel(item.total_amount)[0];
                
                      var label = amount_per_serv[1];
                     item.total_cals = (total_amount / amount_per_serv * item.cal_per_serv);
                     
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
            }
            
            xmlhttp.open("GET","/Dropbox/diet/fixcookie.php?id="+id+'&field='+field+'&value='+value+'&customer_name='+customer_name,false); // TODO This is badpractice. Turn false into true. //////
            xmlhttp.send();

        }
        

        
        /**
        //---------------------------------------------------------------------
        //
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
                    var new_result=(result.split("<br/>"));
                    
                    for(var i =0;i<new_result.length;i++){
                        wrap(new_result[i]);

                    }
                    
                    ; //TODO make this editable

                    
                }
            }


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
        function wrap(x){
            x= x.split("~");
            var id = x.pop(); // get the ID 


            
            
            var field = ['name','total_cals','total_amount','cal_per_serv','amount_per_serv','date']; // make sure this corresponds to the database/table diet 
                                                                                                        // and the readCookie.php output

            //TODO 
            item = new Object();
             item = {
                'id': field[0],
                'name': field[1],
                'total_cals':field[2],
                'total_amount': field[3],
                'cal_per_serv': field[4],
                'amount_per_serv': field[5],
                'date': field[6]

                };
            for(var i =0; i < x.length; i++){
                document.getElementById('result').innerHTML+=`<input value="${x[i]}" onchange="fix(${id},'${field[i]}',this.value,item)"></input>`;
            }
            
            document.getElementById('result').innerHTML+="<br/>";

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        // function gets all the stats for the item_name and puts them in the form.
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
                        autofillSubmitionForm(result);
                        

                        
                    }
                };

               
               
               
               
              

                xmlhttp.open("GET","/Dropbox/diet/getStats.php?item_name="+item_name,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function main(){
            
            getData();
            

            document.getElementById('name').addEventListener("focusout",    
                function(x){
                    var entry = x.target.value;
                    if(entry.includes('[')){ // if item name has a '~' then the item is from the USDA database
                        //TODO calculate calories 
                        var code = entry.match(/\[.*\]/g);
                        code = code[0].replace(/[\[\]]/g,'');
                        interfaceUSDAcode(code);

                        
                    }else{
                        getStats(entry);
                    }
                }



            );

            var DAILY_CALORIES = 2000;
            //make calorie bar
            var d = new Date();
            var hour = d.getHours()-8; // dont count sleeping in moring
            var min = d.getMinutes();
            
            var calPerMin = (DAILY_CALORIES / (24-8))/60; // calories burned per minute when resting
            var calPerHour = (DAILY_CALORIES / (24-8)); // calories burned hour minute when resting
            
            var burnedCal = (hour * calPerHour) + (min*calPerMin);
            
            consumedCal=0;
            //TODO calculate consumedCal
            var new_result = result.split("<br/>");

            for(var i=0;i<result.length-1 ;i++){
                
                try{
                    var line = new_result[i].split(',');
                    
                    
                    } catch(e){
                      
                    }
                    
                if(line[1] !== undefined){
                    consumedCal += parseInt(line[1])*parseInt(line[2]); // TODO make this eval
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
            interfaceUSDA();
            
        }
        
        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */

        function changeDate(number){
            date +=number; // add or subtract depending on the variable NUMBER
            main();
            

        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function resetDate(){

            date=0; //todays date
            main();
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function getSuggestions(){ // THIS FUNCTION DOES NOT WORK
            var input = document.getElementById('name').value;
            var suggestions = document.getElementById('suggestions').options;
            

            var in_a_row=true; // this fixes a bug, that breaks the dropdown menu when length equals 3

            if(input.length==3 && !in_a_row){ //only get if exactly equal to 3 since we dont need extra php calls.
                searchHistory(input);
                interfaceUSDA(input);
                
                in_a_row=false;
                
            }else if(input.length ){
                in_a_row=true;
               
            }
            

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
                        var template = '<option value="ITEM_NAME" />';
                        for(var i=0;i<item_array.length;i++){
                            options+=template.replace("ITEM_NAME",item_array[i]);
                            
                        }  

                        var my_list=document.getElementById("suggestions");
                        my_list.innerHTML = options;
        }

        /**
        //---------------------------------------------------------------------
        //
        //---------------------------------------------------------------------
        */
        function interfaceUSDAcode(item_code){
          
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

               
               
               
               
              

                xmlhttp.open("GET","/Dropbox/diet/interfaceUSDAcode.php?item_code="+item_code,
                false); // TODO This is badpractice. Turn false into true. //////
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
                    document.getElementById('total_cals').value = result[1] || "";
                    document.getElementById('total_amount').value = result[2]|| "";
                }

        }
        
        /**
        //---------------------------------------------------------------------
        //
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
        function interfaceUSDA(item_name){
                
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


                xmlhttp.open("GET","/Dropbox/diet/interfaceUSDA.php?item_name="+item_name,
                false); // TODO This is badpractice. Turn false into true. //////
                xmlhttp.send();   

        }
        

    
    


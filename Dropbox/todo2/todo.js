
// TODO this conflics whith the auto-adjust textarea height 
/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
$(window).keypress(function(event) {
    if (!(event.which == 115 && event.ctrlKey) && !(event.which == 19)) return true;
    
    event.preventDefault();
    return false;
});



window.filter='active';
window.projectName='';
lastProject='';
lastFilter='';

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    function saveItem(){
            var name =  'none';
            var project =  document.getElementById('project').value;
            
            var body =  document.getElementById('body').value.replace(/\n/g,"\\r");
       
            
            
            update(name,project,body);
            
              
              document.getElementById('project').value='';
              document.getElementById('body').value='';
             
            
            main();
             
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//turns quotes into codes to prevent errors
function encode(x){
    try{
        x= x.replace(/\'/g,"\\\'");
        x=x.replace(/\"/g,'\\\"');
        x=x.replace(/&/g,'⅋'); // replace & because they break in the update function.
        x=x.replace(/#/g,'⌗'); // replace # because they break in the update function.
        x=x.replace(/\+/g,'✚'); // replace # because they break in the update function.
        x=x.replace(/\[\]/g,'    ⏸ ');
        return x;
    }catch(e){
        //do nothing
    }
    return x;
}
    
/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/    
function update(name,project,body){
          
        name = (name) || 0;
        project = (project) || 0;
        body = (body) || 0;
        

        body= encode(body);
        project= encode(project);
        name= encode(name);

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
                
                result = (xmlhttp.responseText);
                
                   

                
            }
        }

        xmlhttp.open("GET","/Dropbox/todo/createcookie.php?name="+name+'&project='+project+'&body='+body,false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();
        
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/    
    // get todo list form the database
    function getData(filter='active',projectName=''){
        

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
                var new_result=(result.split("{END}"));
                new_result.pop();
                
                for(var i =0;i<new_result.length;i++){
                    wrap(new_result[i]);

                }


                
                 //TODO make this editable

                
            }
        }


        xmlhttp.open("GET","/Dropbox/todo2/readCookie.php?filter="+filter+'&projectName='+projectName,false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();
        
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    // get list of project names and then wrap them
    function getProjectNames(){

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
               //  document.getElementById('menu').innerHTML=""; // delete previous results
                result = (xmlhttp.responseText);
                
                document.getElementById('menu').innerHTML='';
                //result = .toString().split("\n");
                var new_result=(result.split("{END}"));
                new_result.pop();
                
                for(var i =0;i<new_result.length;i++){
                    makeProjectTab(new_result[i]);

                }


                
                 //TODO make this editable

                
            }
        }


        xmlhttp.open("GET","/Dropbox/todo2/getProjectNames.php",false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();
        
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    //pre: make sure readCookie.php before calling this function
    function wrap(x){
        x= x.split("{comma}");
        var id = x.shift(); // get the ID 
        
        
        var field = ['project','name','body','date','isDone']; // make sure this corresponds to the database/table 
                                                    // and the readCookie.php output

        
     
        // display each record from manager table to the user 
        var inputProject = document.createElement("input");
        inputProject.type = "text";
        var inputName = document.createElement("input");
        inputName.type = "text";
        var inputBody = document.createElement("textarea");
        
        var inputDate = document.createElement("input");
        inputDate.type = "text";
        var inputMark = document.createElement("input");
        inputMark.type = "button";

        inputProject.onchange="fix(${id},'${field[0]}',this.value)";
        inputName.onchange="fix(${id},'${field[1]}',this.value)";
       // inputBody.onchange="fix(${id},'${field[2]}',this.value)";
        inputDate.onchange="fix(${id},'${field[3]}',this.value)";
        x[4]=Number(x[4]);
        x[4]=Boolean(x[4]);
        inputMark.mousedown="fix(${id},'${field[4]}',this.value)";

        inputProject.value=x[0];
        inputName.value=x[1];
        inputBody.value=x[2];
        inputDate.value=x[3];
        inputMark.value=x[4];

        //
        inputProject.className='big';
        inputName.className='big';
        inputBody.className='big';
        inputDate.className='big';
        
        
        //add event listeners
        inputProject.addEventListener("blur", function( event ) {
            fix(id,field[0],this.value)
            //event.target.style.background = "pink";    
        }, true);

        inputName.addEventListener("blur", function( event ) {
            fix(id,field[1],this.value)
            //event.target.style.background = "pink";    
        }, true);

        inputBody.addEventListener("blur", function( event ) {
            fix(id,field[2],this.value)
            //event.target.style.background = "pink";    
        }, true);


        inputDate.addEventListener("blur", function( event ) {
            fix(id,field[3],this.value)
            //event.target.style.background = "pink";    
        }, true);

        inputMark.addEventListener("click", function( event ) {
            markDone(id,field[4],this)
            //event.target.style.background = "pink";    
        }, true);

        //render the elements
        var container = document.getElementById('result');

        container.appendChild(inputProject);
        //container.appendChild(inputName);
        container.appendChild(inputBody);
        //container.appendChild(inputDate);
        //container.appendChild(inputMark);

        linebreak = document.createElement("br");
        container.appendChild(linebreak);







    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    //TODO This function turn a <p> into a <textarea> that can be edited by the user.
    function turnIntoTextarea(x){

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/    
    //make tab to filter by project name
    function makeProjectTab(x){

        
        // display each record from manager table to the user
                
        var result=`<input type='button' class='filter' value='${x}' onclick="setProject(this)"> </input>`;

        document.getElementById('menu').innerHTML+=`${result}`;

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    function setProject(x){
        try{
            lastProject.style.background='lightgrey';
        }catch(e){
            //
        }
        x.style.background='#468FDF';
        window.projectName=x.value;

        getStats(window.projectName);
        getData(window.filter,window.projectName);
        lastProject=x; //save

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/    
    function getStats(projectName=''){


        


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
                
                result = (xmlhttp.responseText);
                document.getElementById('stats').innerHTML=` ${result} `;
                //result = .toString().split("\n");
                
                


                
                 //TODO make this editable

                
            }
        }


        xmlhttp.open("GET","/Dropbox/find/getStats.php?projectName="+projectName,false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    function setFilter(x){

        try{
            lastFilter.style.background='lightgrey';
        }catch(e){
            //
        }
        x.style.background='#468FDF';
        window.filter=x.value;
        getData(window.filter,window.projectName);
        lastFilter=x;

         //this makes textarea size adjust to show all contents
        $('#result').on( 'change keyup keydown paste cut focus load', 'textarea', function (){
            $(this).height(0).height(this.scrollHeight);
        }).find( 'textarea' ).change();

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    //
    function markDone(id,field,handle){
        value = handle.value;

        if(value==='true'){
            value=false;
        }else{
            value=true;
        }

        

        handle.value=value;
        fix(id,field,value);
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
    function adjustHeight(handle){
        handle.height=handlge.scrollHeight;

    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/    
    //update a record in the database 
    function fix(id,field,value){

        value=encode(value);

        try{
            value = value.replace(/\n/g,'\\r');
        }catch(e){

            //
        }
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
                
                result = (xmlhttp.responseText);
                
                   

                
            }
        }
        
        xmlhttp.open("GET","/Dropbox/todo2/fixcookie.php?id="+id+'&field='+field+'&value='+value,false); // TODO This is badpractice. Turn false into true. //////
        xmlhttp.send();

    }
    
/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    //adjust textarea so that all text is shown without need of a scroll bar
    function textAreaAdjust(o) {

  
    }

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/

    function main(){
        

        getProjectNames();
        setFilter(document.getElementById('startblue'));
        //make calorie bar
        var d = new Date();
        setProject( document.getElementById('startblue2'));
        
        //this makes textarea size adjust to show all contents
        $('#result').on( 'change keyup keydown paste cut focus load', 'textarea', function (){
            $(this).height(0).height(this.scrollHeight);
        }).find( 'textarea' ).change();
        //TODO calculate consumedCal
       
        
        
      
        
        
    
        
    }
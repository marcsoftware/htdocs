

var modeNames = [];
var fileNames = [];
var FilePath = '../pure_code/material'; //TODO bug : need to update this thooghout this file


//    http://localhost/Dropbox/pure_code/material
var path_to_modes='../pure_code/modes';
var folder_history = [];


var file_stats=[];
var mode = 'code_type.php'; //default choice



/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//input: fileName
//       this is a arrya that contains a list of filenames with extneion at end e.g. index:file docs:dir
// output:
//      buttons will be drawn on the webpage
function makeButtons(){

    document.getElementById("menu").innerHTML=""; //clear the menu


    readFolder(FilePath);


    for(i=0;i<fileNames.length;i++){

        if(fileNames[i].charAt(0)==='.'){
                            // skip if file is a hidden file. hidden files always start with a dot example '.hidden'
            continue;       // skip this interation if file name is '.' or '..'
                            // these file names will cause clones in the cookie database


        }
        document.getElementById("menu").innerHTML+=wrapButton(fileNames[i])+"   "+getStats(fileNames[i])+'<br/>';

    }

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function makeModesMenu(){
   //TODO how to handle the checked? ans: with already defined cookie functin
   var label = '<label for="FILENAME">FILENAME'
   var template=label+'<input type = "radio" id = "FILENAME" name = "mode" value = "FILENAME" checked="" onclick="refreshMenu()"></label><br/>';
   var new_template='';
   var name='';
    getModesFolder(path_to_modes);

    var buttons=[];
    for(var i=0;i<modeNames.length;i++){

        name=modeNames[i];
        if(name.match(":dir")){
            continue; // skip this interation
        }

        name=name.replace(":file",'');
        new_template=template.replace(/FILENAME/g,name);
        buttons.push(new_template);
    }

    document.getElementById('modesMenu').innerHTML=buttons.join(' ');
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// format milliseoncds into a readable format
function msToTime(s) {

    function addZ(n) {
        return (n<10? '0':'') + n;
    }

    var ms = s % 1000;
    s = (s - ms) / 1000;
    var secs = s % 60;
    s = (s - secs) / 60;
    var mins = s % 60;
    var hrs = (s - mins) / 60;

    //return addZ(hrs) + ':' + addZ(mins) + ':' + addZ(secs) + '.' + ms;
    return addZ(hrs) + ':' + addZ(mins) + ':' + addZ(secs);
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// set cookie for it has not been set from a previous session
function initCookie(){



   if(document.cookie.search(/\w/g)<0){

        saveCookie();

    }else{
       FilePath=getCookie('folder');
       mode=getCookie('mode');
       document.getElementById('code_type.php').checked = true; //Default mode is 

    }


}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//this functin finds the last folder the user was looking at.
function saveCookie(){

  setCookie('folder',FilePath,10);

  mode= document.querySelector('input[name = "mode"]:checked').value; //TODO temp disbale
  setCookie('mode',mode,10);


}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function parseCookie(){
    return document.cookie;
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// from w3schools :(
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// from w3schools :(
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
   //gets stats for a single file
// input: name is the name of a file
// pre-condition: file_stats must contain stats for all files in the current folder
function getStats(name){
    name=name.replace(":file","");
    var index = file_stats.indexOf(name);
    if(index >=0){
        //return msToTime( file_stats[index+1])+' '+numToImage(file_stats[index+2]);
        return numToImage(file_stats[index+2]);
    }else{
        return "";
    }



}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function numToImage(number){
    if(number == '0'){
        //return '<img src="http://127.0.1.1/Dropbox/pure_code/x.png" alt="checkmark" style="width:20px;height:20px;">';
        return 'X';
    }else{
        return '<img src="http://127.0.1.1/Dropbox/pure_code/check.jpg" alt="checkmark" style="width:20px;height:20px;">';
    }

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// this functin is called by an href element. that element has properties name and value
// value should have the filename
// name should be the filepath
/// mode : global variable
function nextPage(handle){

    // these variables come from the href elements properties


    name = handle.rel;
    path = handle.name;

    //make url
    var page_template='/Dropbox/pure_code/modes/MODE?fileName=FILENAME&folder=PATH&mode=MODE';
    var new_page = page_template.replace(/FILENAME/g,name);
    new_page = new_page.replace(/PATH/g,path);
    new_page = new_page.replace(/MODE/g,mode);
    //new_page = "http://127.0.1.1"+new_page;


    //go to a new web page

    window.location.href=new_page; 

    

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//this button dirtermiens if a string corresponds to a file or a dir
// files end with :file folders end with :dir
// e.g. test.html:file desktop:dir
function wrapButton(name){

    var file_template = "<a   class='hyperlink' onclick='nextPage(this)' rel='FILENAME' name='PATH'>FILENAME</a>";
    var img_template = '<img src="cover" HEIGHT="10px" WIDTH="10px" alt="" style="">';
    img_template= img_template.replace(/FILEPATH/g,FilePath);
    img_template= img_template.replace(/FILENAME/g,name);

    var folder_template = img_template+"<input type='button' onclick=\"newMenu('FILENAME')\" value='FILENAME'></input>";
    var path = FilePath;
    path= path.replace("/var/www/html","");

    if(name.match(":dir")){ //if arg name is the name of a folder

        name=name.replace(/:dir/g,""); //delete extension
        var folder = folder_template.replace(/FILENAME/g,name);
        return folder;

    }else if(name.match(":file")){ //if arg name is the name of a file

        name=name.replace(":file",""); //delete extension
        var file = file_template.replace(/FILENAME/g,name); //
        file = file.replace(/PATH/g,path);

        return file;

    }else{
        //alert(name +' <--- var name should end with :dir or :file'); // for example index.html:file user/desktop:dir
        console.log("ERROR: name has to end with ~~~:file or ~~~:dir");


        return "";

    }

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//TODO adapt this function to call readFolder.php
// side effect: stored filenames in the global variable
//              files names also have the filetype appedned to it  ':file' ':dir'
function readFolder(path){

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


            fileNames =xmlhttp.responseText.split(',');

            fileNames.pop(); //delete the last element since it will always be empty
            fileNames.sort();


        }
    }

    xmlhttp.open("GET","/Dropbox/pure_code/readFolder.php?path="+path,false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// file that contain the game_modes
 function getModesFolder(path){

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


            modeNames =xmlhttp.responseText.split(',');

            modeNames.pop(); //delete the last element since it will always be empty
            modeNames.sort();


        }
    }

    xmlhttp.open("GET","/Dropbox/pure_code/readFolder.php?path="+path,false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
// redraw the user menu after a change.
function refreshMenu(){
    mode= document.querySelector('input[name = "mode"]:checked').value; // TODO temp disable

    getFolderStats(FilePath);
    saveCookie();
    makeButtons();
    var folder_name = FilePath.replace("/var/www/html/Dropbox/pure_code/material/","");
    var arrows =['‣','→','⇨','⇢','⇲','⊳','▶','xxxxxxxxxxx'];
    var s='&nbsp;'; // s is for Space
    folder_name=folder_name.replace(/[/]/g,s+s+arrows[6]+s+s);
    document.getElementById('filepath').innerHTML=folder_name; // display curretn location to user
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function newMenu(path=null){

    if(path===null){
    }else{
        FilePath += '/'+path;
        }

    refreshMenu();


}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function moveLeft(){
    // get current folder
    var place = FilePath.match(/\/[^/]*$/g);
    FilePath = FilePath.replace(/\/[^/]*$/g,''); // delete current folder

    folder_history.push(place);

    refreshMenu();
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function moveRight(){

    if(folder_history.length>0){
        var place = folder_history.pop();
        FilePath+=place;
        refreshMenu();
    }

}


/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
//TODO change this function so that it looks up each file-name in the cookie database
function getFolderStats(path){

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

            console.log(xmlhttp.responseText);
                file_stats =xmlhttp.responseText.split(',');

            file_stats.pop(); //delete the last element since it will always be empty


        }
    }

     var new_path = FilePath.replace('/var/www/html',''); //delete un-needed part

    xmlhttp.open("GET","/Dropbox/pure_code/getFolderStats.php?folder="+new_path+"&mode="+mode+"&customer_name="+,false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function main(){
makeModesMenu();
    initCookie();
    newMenu();

     document.getElementById('code_type.php').checked = true; //Default mode is 
}

/**
//-----------------------------------------------------------
//
//-----------------------------------------------------------
*/
function goHomePage(){
    FilePath = '../pure_code/material';
    refreshMenu();
}
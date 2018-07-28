YUI().use('dd-constrain', 'dd-proxy', 'dd-drop', function(Y) {
    //Listen for all drop:over events
    Y.DD.DDM.on('drop:over', function(e) {
        //Get a reference to our drag and drop nodes
        var drag = e.drag.get('node'),
            drop = e.drop.get('node');

        //Are we dropping on a li node?
        if (drop.get('tagName').toLowerCase() === 'li') {
            //Are we not going up?
            if (!goingUp) {
                drop = drop.get('nextSibling');
            }
            //Add the node to this list
            e.drop.get('node').get('parentNode').insertBefore(drag, drop);
            //Resize this nodes shim, so we can drop on it later.
            e.drop.sizeShim();


        }

        
    });
    //Listen for all drag:drag events
    Y.DD.DDM.on('drag:drag', function(e) {
        //Get the last y point

        var y = e.target.lastXY[1];
        //is it greater than the lastY var?
        if (y < lastY) {
            //We are going up
            goingUp = true;

        } else {
            //We are going down.
            goingUp = false;
        }
        //Cache for next check
        
        lastY = y;

    });
    //Listen for all drag:start events
    Y.DD.DDM.on('drag:start', function(e) {
        //Get our drag object
        var drag = e.target;
        //Set some styles here
        drag.get('node').setStyle('opacity', '.25');
        drag.get('dragNode').set('innerHTML', drag.get('node').get('innerHTML'));
        drag.get('dragNode').setStyles({
            opacity: '.5',
            borderColor: drag.get('node').getStyle('borderColor'),
            backgroundColor: drag.get('node').getStyle('backgroundColor')
        });
    });
    //Listen for a drag:end events
    Y.DD.DDM.on('drag:end', function(e) {
        var drag = e.target;
        //Put our styles back
        drag.get('node').setStyles({
            visibility: '',
            opacity: '1'
        });
    });
    //Listen for all drag:drophit events
    Y.DD.DDM.on('drag:drophit', function(e) {
        
        var drop = e.drop.get('node'),
            drag = e.drag.get('node');

        //if we are not on an li, we must have been dropped on a ul
        if (drop.get('tagName').toLowerCase() !== 'li') {
            if (!drop.contains(drag)) {
                drop.appendChild(drag);
            }
        }
      
        //dropped
        getChange( drag);
    });

    //Static Vars
    var goingUp = false, lastY = 0;

    //Get the list of li's in the lists and make them draggable
    var lis = Y.Node.all('#play ul li');
    lis.each(function(v, k) {
        var dd = new Y.DD.Drag({
            node: v,
            target: {
                padding: '0 0 0 20'
            }
        }).plug(Y.Plugin.DDProxy, {
            moveOnEnd: false
        }).plug(Y.Plugin.DDConstrained, {
            constrain2node: '#play'
        });
    });

    //Create simple targets for the 2 lists.
    var uls = Y.Node.all('#play ul');
    uls.each(function(v, k) {
        var tar = new Y.DD.Drop({
            node: v
        });
    });

});



/*
//--------------------------------------------------
//  figure out which records moved
//---------------------------------------------------
*/

function getChange(yui_ref){
    
    var id=yui_ref.get('id');
    alert(id);
    var ref=document.getElementById(id);
    var info=(ref.children[0].innerHTML.split(',')); 

    var after =ref.nextSibling.children[0].innerHTML.split(','); 
    var before = ref.previousSibling.children[0].innerHTML.split(','); 

    var median = (getMedian(before[0],after[0]));

    info[0]=median;
    database_id=info[1];
    info.join(',');
    ref.children[0].innerHTML=info;

    fix(database_id,'custom_sort',median);


}


/**
//---------------------------------------------------------------------
//
//---------------------------------------------------------------------
*/        
//update a record in the database 
//TODO needs to applya ratio and do math etc...
function fix(id,field,value){
   
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
    };
    
    alert("/Dropbox/diet/fixcookie.php?id="+id+'&field='+field+'&value='+value);
    xmlhttp.open("GET","/Dropbox/diet/fixcookie.php?id="+id+'&field='+field+'&value='+value,false); // TODO This is badpractice. Turn false into true. //////
    xmlhttp.send();

}

/*
//--------------------------------------------------
//  
//---------------------------------------------------
*/

function getMedian(x,y){
    var dis= parseInt(y)-parseInt(x);
    
    dis=parseFloat(dis/2);
    return parseInt(x)+dis;

}
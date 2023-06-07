function AddComment() {
    console.log('test')
    let FormAddComment = document.getElementById('sectionformCom')
    let buttonAddComment = document.getElementById('buttonAddComment')
    FormAddComment.hidden = !FormAddComment.hidden
}

function AddPost() {
    console.log('test')
    let FormAddPost = document.getElementById('sectionformPost')
    FormAddPost.hidden = !FormAddPost.hidden
}

function displayDivInfo(text){
    if(text){
        //Détection du navigateur
        is_ie = (navigator.userAgent.toLowerCase().indexOf("msie") != -1) && (navigator.userAgent.toLowerCase().indexOf("opera") == -1);
         
        //Création d'une div provisoire
        var divInfo = document.createElement('div');
        divInfo.style.position = 'absolute';
        document.onmousemove = function(e){
            x = (!is_ie ? e.pageX-window.pageXOffset : event.x+document.body.scrollLeft);
            y = (!is_ie ? e.pageY-window.pageYOffset : event.y+document.body.scrollTop);
            divInfo.style.left = x+15+'px';
            divInfo.style.top = y+15+'px';
        }
        divInfo.id = 'divInfo';
        divInfo.innerHTML = text;
        document.body.appendChild(divInfo);
    }
    else{
        document.onmousemove = '';
        document.body.removeChild(document.getElementById('divInfo'));
    }
}

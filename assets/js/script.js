function ajaxRequest(url, method, callback){
    let xhr = new XMLHttpRequest();
    let data = {key1 :'test', key2: 'test2'};

    xhr.onreadystatechange = function(){
        if(xhr.readyState === 4 && xhr.status === 200){
            // console.log(xhr);
            // let response = JSON.parse(xhr.responseText);
            callback(xhr.responseText);
        }
    }

    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-type', 'application/json')
    xhr.send(JSON.stringify(data));
}

document.querySelector('button').addEventListener(
    'click',
    function(e){
        e.preventDefault();
        blindtest();
    },
    false
)

function blindtest(){
    var currentURL = window.location.href;

    // Obtenez le chemin absolu du répertoire racine
    var absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);

    let url = absoluteRootPath + 'blindtestApi.php';

    ajaxRequest(url, 'POST', function(response){
        console.log(response);
    })
}

function timer(){

}

function skip(){

}

function getResponse(){

}

function pauseMusic(){

}
let buttons = document.querySelectorAll('[data-params]');

buttons.forEach(function(button){
    button.addEventListener('click', function(e){
        let data = button.getAttribute('data-params');
        console.log(data);
        e.preventDefault();
    })
})

function blindtest(){
    let currentURL = window.location.href;
    let absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
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
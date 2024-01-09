const buttons = document.querySelectorAll('[data-params]');

buttons.forEach(function(button){
    button.addEventListener('click', function(e){
        let data = button.getAttribute('data-params');
        e.preventDefault();
        blindtestOptions(data);
    })
})

function blindtestOptions(param){
    let currentURL = window.location.href;
    let absoluteRootPath = currentURL.substring(0, currentURL.lastIndexOf("/") + 1);
    let url = absoluteRootPath + 'blindtestApi.php';


    ajaxRequest(url, 'POST', param, function(response){
        console.log(response.disconnected);
    })
}

function resetTimer(){

}

function startTimer(){

}

function skip(){

}

function getResponse(){

}

function pauseMusic(){

}
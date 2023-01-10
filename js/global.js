function spinner(state, targetId = "Title"){
    if(state){
        let spinnerWrapper = document.createElement("div");
        spinnerWrapper.classList.add("spinnerWrapper");
        let spinner = document.createElement("img");
        spinner.src = "assets/spinner.svg";
        spinnerWrapper.appendChild(spinner);
        document.querySelector('body').insertBefore(spinnerWrapper, document.getElementById(targetId));
    }else{
        document.querySelector('.spinnerWrapper').remove();
    }
}
export default class Form {

    init() {
        const clauses = document.querySelectorAll(".wpcf7-form .clause");
        
        clauses.forEach(clause => {
            const btn = clause.querySelector(".read-more-btn");          
            const hide = clause.querySelector(".more.hide");
            const hideMobile = clause.querySelector(".hide-mobile.hide");

            if(btn && (hide || hideMobile)){
                const btnMoreText = btn.innerText;
                btn.onclick = function(event) {                                      
                    if(hide){
                        hideElement(hide,btn,btnMoreText);
                    }
                        
                    if(hideMobile){
                        hideElement(hideMobile,btn,btnMoreText);
                    }
                        
                }
            }
        });

        function hideElement(element, btn, btnMoreText) {
            if(element.classList.contains("hide"))
                btn.innerText = "zwiń";
            else
                btn.innerText = btnMoreText;
    
            element.classList.toggle("hide");
        }
    }
}
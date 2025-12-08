        let menu_links = document.querySelectorAll(".sidebar-menu a");

menu_links.forEach(link => {
    
    
    link.addEventListener("click", function() {
        menu_links.forEach(l => l.classList.remove("active"));
        this.classList.add("active");
    });
});
let modal = document.querySelector(".modal")
const form = modal.querySelector('form');
    modal.addEventListener('show.bs.modal' , function(){
form.reset();
    })

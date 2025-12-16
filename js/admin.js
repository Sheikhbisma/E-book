document.addEventListener('DOMContentLoaded', () => {
  let modal = document.querySelector("#addbooks");
    const form = document.querySelector('#addbooks form');

    modal.addEventListener('show.bs.modal', function(){
      form.reset();
    });

  // Your other code
  let menu_links = document.querySelectorAll(".sidebar-menu a");
  menu_links.forEach(link => {
    link.addEventListener("click", function() {
      menu_links.forEach(l => l.classList.remove("active"));
      this.classList.add("active");
    });
  });

 
});

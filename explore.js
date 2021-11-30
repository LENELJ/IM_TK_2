var navbar = document.querySelector(".navbar").querySelectorAll("a");
console.log(navbar);

navbar.forEach(element => {
    element.addEventListener("click",function(){
        navbar.forEach(nav=>nav.classList.remove("active"))

        this.classList.add("active");
    });
});

// //fetch all images ajex request
// fetch();
// function fetch(){
//     $.ajax({
//         url:"explore.php",
//         method:"post",
//         data: {fetch_all_images: 1 },
//         success:function(response){
//             console.log(response);
//         },
//     });
// }



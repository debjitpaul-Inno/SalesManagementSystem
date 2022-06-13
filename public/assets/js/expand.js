// $('#revExpand').click(function(){
//     if($("#revenew").hasClass("card-expand") === true){
//         document.getElementById("revenew").classList.remove("card-expand");
//     }else{
//         document.getElementById("revenew").classList.add("card-expand");
//     }
// })


$('.expandBtn').click(function(){
    // console.log(document.getElementById("revenew"))
    let element = $(this).parent('div').parent('div').parent('div')[0];
    if($(element).hasClass("card-expand") === true){
        console.log('true')
        element.classList.remove("card-expand");
    }else{
        console.log('false')
        element.classList.add("card-expand");
    }
})

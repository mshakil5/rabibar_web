
 

 function activeImpression (event){
   //  let impression  = document.getElementById('impression');
   //  impression.classList.toggle('active');

   console.log(event.target.classList.toggle('active'))
 
 }


 function winClose() {
  let g = document.getElementById("winner");
   g.style.display = "none" 
   location.reload();
   return false;
}
 
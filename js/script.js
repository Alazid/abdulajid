document.addEventListener("DOMContentLoaded", function(){

const form = document.getElementById("formAwal");

if(form){

form.addEventListener("submit", function(e){

const jumlah =
document.querySelector("input[name='jumlah']").value;

if(jumlah <= 0){

alert("Jumlah data harus lebih dari 0");

e.preventDefault();

}

});

}

});

document.getElementById('enviaY').onclick=function(){
   let n= document.getElementById('nombreY').value;

   var formData = new FormData();
   formData.append('nombre', n);
    console.log(formData)
      return fetch("compruebaNuevoYac.php", {
        method: "POST",
        mode: "cors",
        body: formData,
      })
      .then(response => response.json())
.then(data => {
    console.log(data)
          if(data=="OK"){
            Swal.fire({
                title:'Una vez guardados, estos datos no se podrán modificar.',
                text: "¿Desea continuar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Sí, quiero continuar'
                })
                .then((result) => {
                 console.log(result);
                 if(result.isConfirmed==true){
                    document.getElementById('cuadrInt').submit();
                
                }
                 })
          }else{
            Swal.fire({
                title:'Parece que ya existe un yacimiento con ese nombre.',
                button:'OK',
                icon: "warning"})
                .then(()=>{
                    return;
                })
          }
        })

}
// document.getElementById('cancelY').onclick=function(){
// window. history. back()
// }
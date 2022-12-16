
async function anadePart(e){
    const { value: email } = await Swal.fire({
        title: 'Introduce el email del participante que quieres agregar.',
        text:'Recuerda que solo puedes incluir usuarios ya registrados',
        input: 'email',
        inputPlaceholder: 'ej:direccion@gmail.com',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        
    })
      
      if (email) {
        console.log(e)
        idYac=$($(e)).val();
        //Swal.fire(`Entered email: ${email}`)
        var formData = new FormData();
   formData.append('nuevoPart', email);
   formData.append('yacAc',idYac);
      console.log(formData)
        return fetch('anadePart.php', {
            method: "POST",
            mode: "cors",
            body: formData,
          })
          .then(response => response.json())
          .then(data => {
              console.log(data)
                    if(data=="OK"){
                      Swal.fire({
                          title:'Participante añadido.',
                          icon: "success"
                          }).then(()=>{
                            window.location.reload();
                          })
                        }else{
                            Swal.fire({
                                title:'Ha ocurrido un error con la inserción.',
                                text:'Por favor, contacte con los administradores',
                                icon: "warning"
                                })

                        }})
      }
}
function eliminaPart(e){
   let idUsu=$($(e)).val();
    let idYa=$($($(e).parent().parent().parent()).children()[0]).val();
    console.log(idYa)
    var formData = new FormData();
    formData.append('idUsu', idUsu);
   formData.append('idYac',idYa);
      console.log(formData)
        return fetch('eliminaPart.php', {
            method: "POST",
            mode: "cors",
            body: formData,
          })
          .then(response => response.json())
          .then(data => {
              console.log(data)
                    if(data=="OK"){
                        
                      Swal.fire({
                          title:'Participante eliminado.',
                          icon: "success"
                          }).then(()=>{
                            window.location.reload();
                          })
                        }else{
                            Swal.fire({
                                title:'Ha ocurrido un error y no se ha podido eliminar el usuario.',
                                text:'Reinténtelo, y si el problema persiste, contacte con los administradores',
                                icon: "error"
                                })

                        }})
      }
      function abandonaExc(e){
        let idY=$($(e)).val();
        console.log(idY);
        var formData = new FormData();
   formData.append('idYac',idY);
      console.log(formData)
        return fetch('eliminaPart.php', {
            method: "POST",
            mode: "cors",
            body: formData,
          })
          .then(response => response.json())
          .then(data => {
              console.log(data)
                    if(data=="OK"){
                        
                      Swal.fire({
                          title:'Has abandonado la excavación.',
                          icon: "success"
                          }).then(()=>{
                            window.location='../menu.php';
                          })
                        }else{
                            Swal.fire({
                                title:'Ha ocurrido un error y no se ha podido abandonar la excavación.',
                                text:'Reinténtelo, y si el problema persiste, contacte con los administradores',
                                icon: "warning"
                                })

                        }})
      }




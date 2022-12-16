function eliminaReg(e) {
  let idEnt = $($(e)).val();
  var formData = new FormData();
  formData.append("idEnt", idEnt);

  return fetch("eliminaEnt.php", {
    method: "POST",
    mode: "cors",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      if (data == "OK") {
        Swal.fire({
          title: "Enterramiento eliminado.",
          icon: "success",
        }).then(() => {
          window.location.reload();
        });
      } else {
        Swal.fire({
          title:
            "Ha ocurrido un error y no se ha podido eliminar el enterramiento.",
          text: "Reinténtelo, y si el problema persiste, contacte con los administradores",
          icon: "error",
        });
      }
    });
}
function editaReg(e) {
  let idEnt = $($(e)).val();
  let idY=$($($(e).parent()).children()[0]).val();
  location.href = "editaEnt.php?idEnt=" + idEnt + '&idY='+idY;
}


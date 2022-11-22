function UpdateTable(id_carrinho, table) {
  console.log("iniciou")
  console.log(`id: ${id_carrinho}, table: ${table}`)
  $.post("registro_feito.php", 
  { id: id_carrinho,
    table: table }, 
  (retorno)=>{
    if(retorno == ""){
      window.location.reload();
      return
    }
    alert(retorno)
  })
}
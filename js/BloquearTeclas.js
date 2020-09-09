
var block={
  'no_numeros':/[^\d]/g
}

function validar(o,w){
  o.value = o.value.replace(block[w],'');
}


const masks = {
  cpf (value){
    return value
    .replace(/\D/g, '')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d)/, '$1.$2')
    .replace(/(\d{3})(\d)/, '$1-$2')
    .replace(/(-\d{2})\d+?$/, '$1')
  },
  data (value){
    return value
    .replace(/\D/g, '')
    .replace(/(\d{2})(\d)/, '$1/$2')
    .replace(/(\d{2})(\d)/, '$1/$2')
    .replace(/(\/\d{4})\d+?$/, '$1')
  },
  preco (value){
    return value
    .replace(/\D/g, '')
    .replace(/([0-9]{2})$/g, ",$1")
  },
  telefone (value){
    return value
    .replace(/\D/g, '')
    .replace(/(\d{2})(\d)/, '($1) $2.')
    .replace(/(\d{4})(\d)/, '$1-$2')
    .replace(/(-\d{4})\d+?$/, '$1')
  }
}




document.querySelectorAll('input').forEach(($input) => {
  const field = $input.dataset.js

  $input.addEventListener('input', (e) => {
    e.target.value = masks[field](e.target.value)
  }, false)
})

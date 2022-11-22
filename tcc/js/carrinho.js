function adicionarAoCarrinho(id_pro, nome_pro, img, preco){

//puxa o carrinho
const content = document.getElementById('itens')

//cria a imagem
const imgPronta = document.createElement('img')
imgPronta.src = img

//cria um span com o código do produto, para facilitar quando for enviar ao banco 
const span = document.createElement('span')
span.style.display = 'none'
span.innerText = id_pro

//o nome do produto
const nomePro = document.createElement('h1')
nomePro.innerText = nome_pro

//puxa a observação
const obsInput = document.getElementById('obs_'+ id_pro)
//salva o texto dela
obs = obsInput.value
//e reseta
obsInput.value = '' 

//cria a observação
const observacao = document.createElement('h2')
observacao.innerText = obs

//cria uma div e insere o nome e observação
const div2 = document.createElement('div')
div2.appendChild(nomePro)
div2.appendChild(observacao)

//puxa a quantidade
const quantInput = document.getElementById('quantidade_'+ id_pro)
//salva seu valor
quantidade = quantInput.value
//e reseta
quantInput.value= 1

//cria a quantidade
const quant = document.createElement('h3')
quant.innerText = quantidade

//cria o preço de cada produto
const precoPronto = document.createElement('h4')
precoPronto.innerText = preco

const btnDel = document.createElement("button")
btnDel.innerText = 'x'

btnDel.addEventListener("click", (element)=>{
    element.path[2].remove()

})

const divBtn = document.createElement('div')
divBtn.appendChild(precoPronto)
divBtn.appendChild(btnDel)

// e cria uma div
const div = document.createElement('div')
div.classList.add('itemPedido')


//em seguida insere todas as informações nela
div.appendChild(span)
div.appendChild(imgPronta)
div.appendChild(div2)
div.appendChild(quant)
div.appendChild(divBtn)

//e coloca dentro do carrinho
content.appendChild(div)

//puxa o span do valor total
valorTotal = document.getElementById('valorTotal')
//salva o valor e a quantidade em int
valor = parseFloat(valorTotal.innerText)
quantidade = parseInt(quantidade)
preco = parseInt(preco)
//faz a conta para o novo preço final 
valorTotal.innerText = valor+(quantidade*preco)        

}
function puxaInfos (id_pro){
    const img = document.getElementById('img_'+id_pro).src
    const nome = document.getElementById('nome_'+id_pro).innerText
    const preco = document.getElementById('preco_'+id_pro).innerText

    adicionarAoCarrinho(id_pro, nome, img, preco)

}
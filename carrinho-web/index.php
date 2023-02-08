<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .w-45 {
            width: 45%;
            margin-left: 3%;
        }

        .flex-row {
            display: flex;
            flex-direction: row;
        }

        div {
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }

        button {
            margin: 0.1rem 0.2rem;
        }
    </style>
</head>

<body>
    <div class="flex-row">
        <div class="w-45">
            <ul>
                <li>
                    <div>
                        <h5>Produto 1</h5>
                        <button type="button" data-product-name="Produto 1" data-product-value="1.51">Adicionar</button>
                    </div>
                </li>
                <li>
                    <div>
                        <h5>Produto 2</h5>
                        <button type="button" data-product-name="Produto 2" data-product-value="2.52">Adicionar</button>
                    </div>
                </li>
                <li>
                    <div>
                        <h5>Produto 3</h5>
                        <button type="button" data-product-name="Produto 3" data-product-value="3.53">Adicionar</button>
                    </div>
                </li>
                <li>
                    <div>
                        <h5>Produto 4</h5>
                        <button type="button" data-product-name="Produto 4" data-product-value="4.54">Adicionar</button>
                    </div>
                </li>
                <li>
                    <div>
                        <h5>Produto 5</h5>
                        <button type="button" data-product-name="Produto 5" data-product-value="5.55">Adicionar</button>
                    </div>
                </li>
                <li>
                    <div>
                        <h5>Produto 6</h5>
                        <button type="button" data-product-name="Produto 6" data-product-value="6.56">Adicionar</button>
                    </div>
                </li>
            </ul>
        </div>

        <div class="w-45">
            <div>
                <h3>Carrinho</h3>
                <h4>Total de itens no carrinho: <span count-items>0</span></h4>
            </div>
            <ul item-list=""></ul>
            <div>
                <!-- Isso poderia estar no checkout -->
                <input type="text" name="cupum" placeholder="Cupom">
                <button type="button" data-action="go-to-checkout">Adicionar cupom</button>
            </div>

            <div>
                <button type="button" data-action="go-to-checkout">Finalizar pedido</button>
            </div>
        </div>
    </div>

    <script>
        (() => {
            let cartItems = []

            let appendItemToList = (item) => {
                let itemsListElement = document.querySelector('[item-list]')

                if (!item || !itemsListElement || !('name' in item) || !('value' in item)) {
                    return
                }

                let li = document.createElement('li')

                li.innerHTML = `${item.name} ------ ${item.value}`

                itemsListElement.append(li)
            }

            let updateCountItems = () => {
                let countItemsElement = document.querySelector('[count-items]')

                if (!countItemsElement) {
                    return
                }

                countItemsElement.innerText = cartItems.length
            }

            let updateItemList = () => {
                let itemsListElement = document.querySelector('[item-list]')

                if (!itemsListElement) {
                    return
                }

                itemsListElement.innerHTML = ''

                cartItems.forEach(item => appendItemToList(item))
            }

            let addNewItem = (item) => {
                if (!item || !('name' in item) || !('value' in item)) {
                    return
                }
                cartItems.push(item)
                updateCountItems()
                updateItemList()
            }

            document.querySelectorAll('button[data-product-name]')
                .forEach(btnAdicionarItem => {
                    btnAdicionarItem.addEventListener('click', event => {
                        let item = {
                            name: event.target.dataset.productName,
                            value: event.target.dataset.productValue,
                        }

                        addNewItem(item)
                    })
                })
        })()
    </script>
</body>

</html>

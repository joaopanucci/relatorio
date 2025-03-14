let productId = 1;
let remainingProducts = 0;
let products = [];

function prepareProductRows() {
    const cidade = document.getElementById('cidadeSelect').value;
    const quantidade = document.getElementById('quantidadeInput').value;

    if (!cidade) {
        alert('Por favor, selecione uma cidade.');
        return;
    }

    if (quantidade <= 0) {
        alert('A quantidade deve ser um número positivo.');
        return;
    }

    remainingProducts = quantidade;
    alert(`Preparado para registrar ${quantidade} produtos. Use o leitor de código de barras para registrar cada produto.`);
}

document.addEventListener('keydown', function(event) {
    if (remainingProducts > 0 && event.key === 'Enter') {
        const codigoBarras = prompt('Escaneie o código de barras:');
        if (codigoBarras) {
            addProductRow(codigoBarras);
            remainingProducts--;
        }
    }
});

function addProductRow(codigoBarras) {
    const cidade = document.getElementById('cidadeSelect').value;
    const table = document.getElementById('productTable');
    const row = table.insertRow();
    row.innerHTML = `
        <td>${productId}</td>
        <td><input type="text" value="${codigoBarras}" id="codigoBarras${productId}" readonly></td>
        <td><input type="text" placeholder="opcional" id="nome${productId}"></td>
        <td><input type="text" value="${cidade}" id="cidade${productId}" readonly></td>
        <td><input type="number" value="1" id="quantidade${productId}" readonly></td>
    `;
    products.push({
        id: productId,
        codigoBarras: codigoBarras,
        nome: '',
        cidade: cidade,
        quantidade: 1
    });
    productId++;
}

function saveProduct(id) {
    const codigoBarras = document.getElementById(`codigoBarras${id}`).value;
    const nome = document.getElementById(`nome${id}`).value;
    const cidade = document.getElementById(`cidade${id}`).value;
    const quantidade = document.getElementById(`quantidade${id}`).value;

    const data = new FormData();
    data.append('action', 'adicionar');
    data.append('codigoBarras', codigoBarras);
    data.append('nome', nome);
    data.append('cidade', cidade);
    data.append('quantidade', quantidade);

    fetch('api.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Produto salvo com sucesso!');
        } else {
            alert('Erro ao salvar produto: ' + data.message);
        }
    });
}

function removeProduct(id) {
    const data = new FormData();
    data.append('action', 'remover');
    data.append('id', id);

    fetch('api.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Produto removido com sucesso!');
            document.getElementById('productTable').deleteRow(id - 1);
        } else {
            alert('Erro ao remover produto: ' + data.message);
        }
    });
}

function sendAllProducts() {
    const data = new FormData();
    data.append('action', 'adicionarEmMassa');
    data.append('produtos', JSON.stringify(products));

    fetch('api.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Todos os produtos foram salvos com sucesso!');
            products = [];
            document.getElementById('productTable').innerHTML = '';
        } else {
            alert('Erro ao salvar produtos: ' + data.message);
        }
    });
}

function uploadCSV() {
    const form = document.getElementById('uploadForm');
    const formData = new FormData(form);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Produtos importados com sucesso!');
            // Atualizar a tabela de produtos aqui, se necessário
        } else {
            alert('Erro ao importar produtos: ' + data.message);
        }
    });
}

function generateReport() {
    const data = new FormData();
    data.append('action', 'gerarRelatorio');
    data.append('produtos', JSON.stringify(products));

    fetch('relatorio.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'relatorio.pdf';
        document.body.appendChild(a);
        a.click();
        a.remove();
    });
}
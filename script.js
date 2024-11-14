// Variables de referencia
const productForm = document.getElementById("productForm");
const productTable = document.getElementById("productTable").getElementsByTagName("tbody")[0];

// Almacenamiento de productos en memoria (localStorage)
let products = JSON.parse(localStorage.getItem("products")) || [];
let editingProductId = null;

// Función para agregar o editar producto
productForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const productName = document.getElementById("productName").value;
    const productPrice = document.getElementById("productPrice").value;
    const productDate = document.getElementById("productDate").value;

    if (!productName || !productPrice || !productDate) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Validar precio
    const price = parseFloat(productPrice);
    if (isNaN(price) || price <= 0) {
        alert("Por favor, ingresa un precio válido.");
        return;
    }

    // Si estamos editando un producto
    if (editingProductId !== null) {
        // Editar producto
        products = products.map(product => {
            if (product.id === editingProductId) {
                return {
                    ...product,
                    name: productName,
                    price: price.toFixed(2),
                    date: productDate
                };
            }
            return product;
        });
        editingProductId = null;
    } else {
        // Agregar un nuevo producto
        const newProduct = {
            id: Date.now(), // Usamos un ID único basado en el tiempo
            name: productName,
            price: price.toFixed(2),
            date: productDate
        };
        products.push(newProduct);
    }

    // Guardar en localStorage
    localStorage.setItem("products", JSON.stringify(products));

    renderProductTable();
    productForm.reset(); // Limpiar el formulario
});

// Función para eliminar un producto
function deleteProduct(productId) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        products = products.filter(product => product.id !== productId);
        localStorage.setItem("products", JSON.stringify(products)); // Actualizar localStorage
        renderProductTable();
    }
}

// Función para editar un producto
function editProduct(productId) {
    const product = products.find(product => product.id === productId);
    if (product) {
        document.getElementById("productName").value = product.name;
        document.getElementById("productPrice").value = product.price;
        document.getElementById("productDate").value = product.date;
        editingProductId = productId;
    }
}

// Función para renderizar la tabla de productos
function renderProductTable() {
    // Limpiar la tabla antes de volver a renderizar
    productTable.innerHTML = "";

    // Mostrar cada producto en la tabla
    products.forEach(product => {
        const row = productTable.insertRow();
        row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>$${product.price}</td>
            <td>${product.date}</td>
            <td>
                <button onclick="editProduct(${product.id})">Editar</button>
                <button onclick="deleteProduct(${product.id})">Eliminar</button>
            </td>
        `;
    });
}

// Inicializar la tabla de productos (si ya hay productos en el array)
renderProductTable();
e();

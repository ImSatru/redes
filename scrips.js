// Variables de referencia
const employeeForm = document.getElementById("employeeForm");
const employeeTable = document.getElementById("employeeTable").getElementsByTagName("tbody")[0];

// Almacenamiento de empleados en memoria
let employees = [];
let editingEmployeeId = null;

// Función para agregar o editar empleado
employeeForm.addEventListener("submit", (event) => {
    event.preventDefault();

    const employeeName = document.getElementById("employeeName").value;
    const employeePosition = document.getElementById("employeePosition").value;
    const employeeEmail = document.getElementById("employeeEmail").value;
    const employeeHireDate = document.getElementById("employeeHireDate").value;

    // Verificar si los campos están vacíos
    if (!employeeName || !employeePosition || !employeeEmail || !employeeHireDate) {
        alert("Por favor, completa todos los campos.");
        return;
    }

    // Si estamos editando un empleado
    if (editingEmployeeId !== null) {
        // Editar el empleado existente
        employees = employees.map(employee => {
            if (employee.id === editingEmployeeId) {
                return {
                    ...employee,
                    name: employeeName,
                    position: employeePosition,
                    email: employeeEmail,
                    hireDate: employeeHireDate
                };
            }
            return employee;
        });
        editingEmployeeId = null;
    } else {
        // Agregar un nuevo empleado
        const newEmployee = {
            id: Date.now(), // Usamos un ID único basado en el tiempo
            name: employeeName,
            position: employeePosition,
            email: employeeEmail,
            hireDate: employeeHireDate
        };
        employees.push(newEmployee); // Agregar a la lista de empleados
    }

    renderEmployeeTable(); // Renderizar la tabla después de agregar o editar un empleado
    employeeForm.reset(); // Limpiar el formulario
});

// Función para eliminar un empleado
function deleteEmployee(employeeId) {
    if (confirm("¿Estás seguro de que deseas eliminar este empleado?")) {
        employees = employees.filter(employee => employee.id !== employeeId); // Eliminar de la lista
        renderEmployeeTable(); // Renderizar la tabla después de eliminar
    }
}

// Función para editar un empleado
function editEmployee(employeeId) {
    const employee = employees.find(employee => employee.id === employeeId);
    if (employee) {
        document.getElementById("employeeName").value = employee.name;
        document.getElementById("employeePosition").value = employee.position;
        document.getElementById("employeeEmail").value = employee.email;
        document.getElementById("employeeHireDate").value = employee.hireDate;
        editingEmployeeId = employeeId; // Establecer el ID del empleado que estamos editando
    }
}

// Función para renderizar la tabla de empleados


// Inicializar la tabla de empleados (si ya hay empleados en el array)
renderEmployeeTable();


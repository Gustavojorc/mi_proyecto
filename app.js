const express = require('express');
const mysql = require('mysql');
const cors = require('cors');

const app = express();
app.use(express.json());
app.use(cors()); // Habilita CORS para todas las solicitudes

const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'refaccionaria',
  port: 3307 // si estás usando un puerto distinto, como en XAMPP
});

db.connect((err) => {
  if (err) {
    console.error('Error al conectar con la base de datos:', err);
    return;
  }
  console.log('Conectado a la base de datos');
});

// Endpoint para agregar producto
app.post('/agregar_producto', (req, res) => {
  const { nombre, descripcion, precio } = req.body;
  
  if (!nombre || !descripcion || !precio) {
    return res.status(400).json({ success: false, message: 'Datos incompletos' });
  }

  const query = 'INSERT INTO productos (nombreP, descripcionP, precioP) VALUES (?, ?, ?)';
  db.query(query, [nombre, descripcion, precio], (err, result) => {
    if (err) {
      console.error('Error al agregar producto:', err);
      return res.status(500).json({ success: false, error: err });
    }
    res.status(200).json({ success: true, message: 'Producto agregado correctamente' });
  });
});

app.listen(3001, () => {
  console.log('Servidor escuchando en http://localhost:3001');
});

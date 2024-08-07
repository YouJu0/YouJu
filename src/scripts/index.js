import express from "express";
import logger from "morgan";
import { createServer } from "node:http";
import { Server } from "socket.io";

const port = process.env.PORT ?? 3000;
const app = express();
const sv = createServer(app);
const io = new Server(sv, {connectionStateRecovery: {
  // establece la duracion max para recuperacion de msg
  maxDisconnectionDuration: 2 * 60 * 1000,
}});

io.on('connection', (socket) => {
  //muestra si el usuario se desconecto
  socket.on("disconnect", () => {console.log("usuario desconectado");});
  //manda los msg a todos los usuarios
     socket.on("chat msg", (msg) => {
      io.emit("chat msg", msg);      
      });
});



// Datos que quieres enviar
const data = {
  msg: msg,
};

// Enviar los datos usando fetch
fetch('../pages/apis/guardarDatos.php', {
  method: 'POST',
  headers: {
      'Content-Type': 'application/json'
  },
  body: JSON.stringify(data)
})
.then(response => response.json()) // Convertir la respuesta en JSON
.then(data => {
  console.log('Success:', data);
})
.catch((error) => {
  console.error('Error:', error);
});


app.use(logger("dev"));

app.get("/", (req, res) => {
  res.sendFile(process.cwd() + "/src/pages/foro.html");
});

sv.listen(port, () =>{
  console.log(`server running in ${port}`)
})





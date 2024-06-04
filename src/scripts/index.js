import express from "express";
import logger from "morgan";
import { createServer } from "node:http";
import { Server } from "socket.io";

const port = process.env.PORT ?? 3000;

const app = express();
const server = createServer(app);
const io = new Server(server, { connectionStateRecovery: {} });
io.on("connection", (socket) => {
  console.log("usuario conectado");
  socket.on("disconnect", () => {
    console.log("usuario desconectado");
  });
  socket.on("chat msg", (msg) => {
    io.emit("chat msg", msg);
  });
});
app.use(logger("dev"));

app.get("/", (req, res) => {
  res.sendFile(process.cwd() + "/src/pages/foro.html");
});
console.log(port);

server.listen(port, () => {
  console.log(`server runing on port ${port}`);
});
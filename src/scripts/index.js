import express from "express";
import { createServer } from 'node:http';
import { Server } from 'socket.io';
//import logger from "logger";
const port = process.env.PORT ?? 3000;
const app = express();
const server = createServer(app)
const io = new Server(server, {
  connectionStateRecovery: {}
})
//app.use(logger("dev"));

app.get("/", (req, res) => {
  res.send("<h2> titulp </h2>");
});
console.log(port);
app.listen(port, () => {
  console.log(`server runing on port ${port}`);
});

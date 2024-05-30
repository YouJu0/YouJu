import express from "express";
//import logger from "logger";
const port = process.env.PORT ?? 3202;
const app = express();
//app.use(logger("dev"));

app.get("/", (req, res) => {
  res.send("<h2> titulp </h2>");
});
console.log(port);
//app.listen(port, () => {
// console.log(`server runing on port ${port}`);
//});

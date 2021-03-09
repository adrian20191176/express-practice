const express = require('express');

const app = express();

app.get('/hi',hi)

function hi(req,res){
    res.end("hi");
}

const port = process.env.PORT || 1337;

app.listen(port, ()=> console.log(`listinenin ${port}`));
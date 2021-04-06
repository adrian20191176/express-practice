const fs = require('fs');
const express = require('express');

const app = express();

app.get('/hi',hi)
app.get('/json',jo)
app.get('/echo',respondEcho)
app.get('/static/*',respondStatic)

function hi(req,res){
    res.end("hi");
}

function jo(req,res){
    res.json({nam:'hi',age:8});
}

function respondEcho(req,res){
    const {input = ''} = req.query;
    res.json({
        normal:input,
        shouty:input.toUpperCase(),
        count:input.length,
    })
}

function respondStatic(req,res){
    const fileName = `${__dirname}/public/${req.params[0]}`
    fs.createReadStream(fileName)
        .on('error',() => respondNotFound(req,res))
        .pipe(res)
}

const port = process.env.PORT || 1337;

app.listen(port, ()=> console.log(`listinenin ${port}`));
const fs  = require('fs');
const express = require('express');
const EventEmitter = require('events');
const tf = require("@tensorflow/tfjs");

const port = process.env.PORT || 1337;

const app = express();

app.get('*',respondStatic);

app.listen(port,() => console.log(`Port Listenin at ${port}`) );

function respondStatic(req,res){
    loadHostedPretrainedModel('https://raw.githubusercontent.com/SCAARD-2021/ReachHigh/main/model/model.json').then(
        (moel) => {
            const model = moel;
            console.log(8);
            
  let a= 1;
  let b= 1;
  let input_xs = tf.tensor2d([
      [a,b]
  ]);
  let output = model.predict(input_xs);   
  const outputData = output.dataSync();
  console.log(outputData);
        }
    );
    // const model = await tf.loadLayersModel(tf.io.httpRequest('https://github.com/SCAARD-2021/ReachHigh/blob/main/model/model.json', {fetch: myCustomFetch}));
}

function loadHostedPretrainedModel(url) {
    try {
      const model = tf.loadLayersModel(url);
      
      // We can't load a model twice due to
      // https://github.com/tensorflow/tfjs/issues/34
      // Therefore we remove the load buttons to avoid user confusion.
      return model;
    } catch (err) {
      console.error(err);
    }
  }

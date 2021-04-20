const tf = require('@tensorflow/tfjs');
const fetch = require("node-fetch");


const PAD_INDEX = 0;  // Index of the padding character.
const OOV_INDEX = 2;  // Index fo the OOV character.
const HOSTED_URLS = {
  model:
      'https://storage.googleapis.com/tfjs-models/tfjs/sentiment_cnn_v1/model.json',
  metadata:
      'https://storage.googleapis.com/tfjs-models/tfjs/sentiment_cnn_v1/metadata.json'
};
var sentimentMetadata = null;
var indexFrom = null;
var model = null;
var maxLen = null;
var wordIndex = null;
var vocabularySize = null;

  function start(){
    model = loadHostedPretrainedModel(HOSTED_URLS.model);
    sentimentMetadata = loadHostedMetadata(HOSTED_URLS.metadata);
    
    indexFrom = sentimentMetadata['index_from'];
    maxLen = sentimentMetadata['max_len'];
    wordIndex = sentimentMetadata['word_index'];
    console.log(8)
    console.log(wordIndex)
    vocabularySize = sentimentMetadata['vocabulary_size'];
  }

  function padSequences(
    sequences, maxLen, padding = 'pre', truncating = 'pre', value = PAD_INDEX) {
  // TODO(cais): This perhaps should be refined and moved into tfjs-preproc.
  return sequences.map(seq => {
    // Perform truncation.
    if (seq.length > maxLen) {
      if (truncating === 'pre') {
        seq.splice(0, seq.length - maxLen);
      } else {
        seq.splice(maxLen, seq.length - maxLen);
      }
    }

    // Perform padding.
    if (seq.length < maxLen) {
      const pad = [];
      for (let i = 0; i < maxLen - seq.length; ++i) {
        pad.push(value);
      }
      if (padding === 'pre') {
        seq = pad.concat(seq);
      } else {
        seq = seq.concat(pad);
      }
    }

    return seq;
  });
}

function urlExists(url) {
  try {
    const response = fetch(url, {method: 'HEAD'});
    return response.ok;
  } catch (err) {
    return false;
  }
}

function loadHostedPretrainedModel(url) {
  try {
    const mdel = tf.loadLayersModel(url);
    return mdel;
  } catch (err) {
    console.error(err);
  }
}

async function loadHostedMetadata(url) {
  try {
    let metadataJson = null;
    await fetch(url).then(value =>{ metadataJson = value});
    console.log(metadataJson)
    const metadata = metadataJson.json();
    return metadata;
  } catch (err) {
    console.error(err);
  }
}


  function predict(text) {
    // Convert to lower case and remove all punctuations.
    const inputText =
        text.trim().toLowerCase().replace(/(\.|\,|\!)/g, '').split(' ');
    // Convert the words to a sequence of word indices.
    console.log(inputText)
    const sequence = 5;
    // inputText.map(word => {
    //   let wrdIndex = wordIndex[word] + indexFrom;
    //   if (wrdIndex > vocabularySize) {
    //     wrdIndex = OOV_INDEX;
    //   }
    //   return wrdIndex;
    // });
    // Perform truncation and padding.
    const paddedSequence = padSequences([sequence], this.maxLen);
    const input = tf.tensor2d(paddedSequence, [1, this.maxLen]);

    const beginMs = performance.now();
    const predictOut = this.model.predict(input);
    const score = predictOut.dataSync()[0];
    predictOut.dispose();
    const endMs = performance.now();

    return {score: score, elapsed: (endMs - beginMs)};
  }

  start()
  console.log(6)
  console.log(predict("Bd is good guy!"));

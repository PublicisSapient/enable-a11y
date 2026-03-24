import {FFmpeg} from '/node_modules/@ffmpeg/ffmpeg/dist/esm/index.js';
import {fetchFile, toBlobURL} from '/node_modules/@ffmpeg/util/dist/esm/index.js';
import { WhisperWasmService, ModelManager, convertFromArrayBuffer, convertFromFile } from '/node_modules/@timur00kh/whisper.wasm/dist/index.es.js';

const status = document.getElementById('status');
const input = document.getElementById('videoInput');
const button = document.getElementById('convertBtn');
const downloadLink = document.getElementById('downloadLink');

// initialize ffmpeg
const ffmpeg = new FFmpeg();

// Initialize the whisper service
const whisper = new WhisperWasmService({ logLevel: 1 });
const modelManager = new ModelManager({ logLevel: 1 });

const isSupported = await whisper.checkWasmSupport();
if (!isSupported) {
  const goToCanIUse = window.confirm('Your browser does not support WebAssembly.  Would you like to find out which browsers do suppor it?');

  if (goToCanIUse) {
    location.href='https://caniuse.com/?search=web+assembly';
  } else {
    throw new Error('WebAssembly is not supported');
  }
}




async function loadFFmpeg() {
	if (ffmpeg.loaded) 
		return;
	

	status.textContent = 'Loading FFmpeg core...';

	const baseURL = '/node_modules/@ffmpeg/core/dist/esm';

	ffmpeg.on('log', ({message}) => {
		status.textContent = message;
	});

	console.log('crossOriginIsolated:', window.crossOriginIsolated);
	console.log('SharedArrayBuffer exists:', typeof SharedArrayBuffer !== 'undefined');

	await ffmpeg.load({
		coreURL: await toBlobURL(`${baseURL}/ffmpeg-core.js`, 'text/javascript'),
		wasmURL: await toBlobURL(`${baseURL}/ffmpeg-core.wasm`, 'application/wasm')
	});

	status.textContent = 'FFmpeg loaded.';
}

const convertVideoToWav = async (file, output = 'output.wav', events = {}) => {
	if (events.writeInput) {
	  events.writeInput();
	}
  
	await ffmpeg.writeFile('input', await fetchFile(file));
  
	if (events.extractAudio) {
	  events.extractAudio();
	}
  
	await ffmpeg.exec([
	  '-i', 'input',
	  '-vn',
	  '-ar', '16000',
	  '-ac', '1',
	  '-c:a', 'pcm_s16le',
	  output
	]);
  
	if (events.readOutput) {
	  events.readOutput();
	}
  
	const wavBytes = await ffmpeg.readFile(output);
	return wavBytes;
};

let modelLoaded = false;

const caption = async (audioData) => {
  if (!modelLoaded) {
    let modelData;

    try {
      status.textContent = 'Downloading model...';
      modelData = await modelManager.loadModel('tiny', true, (progress) => {
        status.textContent = `Loading model: ${progress}%`;
      });
      console.log('model bytes:', modelData.length);

      status.textContent = 'Initializing Whisper model...';
      await whisper.initModel(modelData);
      modelLoaded = true;
      console.log('initModel ok');
    } catch (err) {
      console.error('model setup failed', err);
      throw err;
    }
  }

  try {
    console.log('Transcribing...');
    status.textContent = 'Transcribing...';
	console.log('audioData constructor:', audioData.constructor.name);
	console.log('audioData length:', audioData.length);
	console.log('first 10 samples:', Array.from(audioData.slice(0, 10)));
	console.log('threads requested:', 1);
	console.log('SharedArrayBuffer exists:', typeof SharedArrayBuffer !== 'undefined');
    const result = await whisper.transcribe(audioData, undefined, {
      language: 'en',
      threads: 1,
      translate: false,
      restartModelOnError: true
    });

    console.log(result);
    return result;
  } catch (err) {
    console.error('transcribe failed', err);
    throw err;
  }
};


const submitVideoEvent = async (e) => {
	const file = input.files ?. [0];
	if (! file) {
		status.textContent = 'Choose a video file first.';
		return;
	}

	try {
		button.disabled = true;
		downloadLink.style.display = 'none';

		const { audioData } = await convertFromFile(file, { normalize: true });
		await caption(audioData);
		/*
		await loadFFmpeg();

		const audioData = await prepareAudioForWhisper(file, 'output.wav', {
			writeInput: () => {
				status.textContent = 'Writing input file...';
			},
			extractAudio: () => {
				status.textContent = 'Extracting audio...';
			},
			readOutput: () => {
				status.textContent = 'Reading output...';
			}

		});

		status.textContent = 'Done. WAV created locally in your browser.';


		const maxSeconds = 30;
		const maxSamples = 16000 * maxSeconds;
		const shortAudioData = audioData.length > maxSamples
		? audioData.slice(0, maxSamples)
		: audioData;

		console.log('full duration seconds:', audioData.length / 16000);
		console.log('test duration seconds:', shortAudioData.length / 16000);

		await caption(shortAudioData); */
        //await caption(audioData);
	} catch (err) {
		console.error(err);
		//status.textContent = 'Conversion failed: ' + err.message;
        throw new Error("Conversion Error: " + err.message);
	} finally {
		button.disabled = false;
	}
};

// Events on page
button.addEventListener('click', submitVideoEvent);

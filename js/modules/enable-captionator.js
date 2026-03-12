import {FFmpeg} from '/node_modules/@ffmpeg/ffmpeg/dist/esm/index.js';
import {fetchFile, toBlobURL} from '/node_modules/@ffmpeg/util/dist/esm/index.js';
import { WhisperWasmService, ModelManager, convertFromFile, convertFromArrayBuffer } from '/node_modules/@timur00kh/whisper.wasm/dist/index.es.js ';

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

	await ffmpeg.load({
		coreURL: await toBlobURL(`${baseURL}/ffmpeg-core.js`, 'text/javascript'),
		wasmURL: await toBlobURL(`${baseURL}/ffmpeg-core.wasm`, 'application/wasm'),
		workerURL: await toBlobURL(`${baseURL}/ffmpeg-core.worker.js`, 'text/javascript')
	});

	status.textContent = 'FFmpeg loaded.';
}

const prepareAudioForWhisper = async (file, output, events = {}) => {

	if (events.writeInput) {
		events.writeInput();
	}

	await ffmpeg.writeFile('input', await fetchFile(file));

	if (events.extractAudio) {
		events.extractAudio();
	}

	await ffmpeg.exec([
		'-i',
		'input',
		'-vn',
		'-ar',
		'16000',
		'-ac',
		'1',
		'-c:a',
		'pcm_s16le',
		'output.wav'
	]);

	if (events.readOutput) {
		events.readOutput();
	}

	const data = await ffmpeg.readFile('output.wav');

	
	return data;
}

const caption = async (wavData) => {
    // Load a model
    const modelData = await modelManager.loadModel('base'); // e.g. 'tiny', 'small', 'medium-q5_0', 'large-q5_0'
    await whisper.initModel(modelData);
    console.log('init');

    // Create a transcription session for streaming
    const session = whisper.createSession();
    console.log('session created');

    const arrayBuffer =
        wavData.buffer.slice(
            wavData.byteOffset,
            wavData.byteOffset + wavData.byteLength
        );
    console.log('created array buffer');

    const { audioData } = await convertFromArrayBuffer(arrayBuffer, {
        normalize: true
    });

    console.log('converted audio');

    // Process audio in chunks
    const stream = session.streaming(audioData, {
        language: 'en',
        threads: 4,
        translate: false,
        sleepMsBetweenChunks: 100,
    });
    console.log('streaming');

    for await (const segment of stream) {
        status.textContent = `[${segment.timeStart}ms - ${segment.timeEnd}ms]: ${segment.text}`;
    }
}

const submitVideoEvent = async (e) => {
	const file = input.files ?. [0];
	if (! file) {
		status.textContent = 'Choose a video file first.';
		return;
	}

	try {
		button.disabled = true;
		downloadLink.style.display = 'none';

		await loadFFmpeg();

		const wavData = await prepareAudioForWhisper(file, 'output.wav', {
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
        await caption(wavData);
	} catch (err) {
		console.error(err);
		//status.textContent = 'Conversion failed: ' + err.message;
        throw "Conversion Error. " + err.message;
	} finally {
		button.disabled = false;
	}
};

// Events on page
button.addEventListener('click', submitVideoEvent);

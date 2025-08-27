// enscribe-vimeo.js
import {register, getCueData, speak} from './enscribe.js';

let vimeoReady;
function loadVimeoAPI() {
	if (vimeoReady) 
		return vimeoReady;
	
	vimeoReady = new Promise((res) => {
		const s = document.createElement('script');
		s.onload = res;
		s.src = 'https://player.vimeo.com/api/player.js';
		document.head.appendChild(s);
	});
	return vimeoReady;
}

const mod = {
	getVolume: (p) => p.vimeo.getVolume(),
	setVolume: (p, v) => p.vimeo.setVolume(v),
	control: (p, action) => p.vimeo[action](),

	async updateSource(p, which) {
		const src = which === 'AD' ? p.ADSource : p.standardSource;
		const cur = await p.vimeo.getCurrentTime();
		const paused = await p.vimeo.getPaused();
		await p.vimeo.loadVideo(src);
		await p.vimeo.setCurrentTime(cur);
		if (! paused) 
			p.vimeo.play();
		
	},

	async setup(p) { // Load API + proxy VTT in hidden <video>
		await loadVimeoAPI();
		const {enscribeAdVideoSource, enscribeVttPath} = p.element.dataset;
		// If not using an alternate AD video, build a proxy descriptions track
		if (!enscribeAdVideoSource) {
			const v = Object.assign(document.createElement('video'), {
				ariaHidden: 'true'
			});
			const t = Object.assign(document.createElement('track'), {
				kind: 'descriptions',
				label: 'Audio Descriptions',
				srclang: 'en',
				src: enscribeVttPath
			});
			v.appendChild(t);
			const tt = v.textTracks[0];
			tt.mode = 'hidden';
			t.addEventListener('load', () => {
				console.log('loaded');
				p.ADTrack = tt;


				if (p.ADTrack) {
				for (const cue of p.ADTrack.cues) {
					const {content, pause, play} = getCueData(cue);
					p.vimeo.addCuePoint(cue.startTime, {content, pause});
				}
				p.vimeo.on('cuepoint', (e) => p.enabled && speak(e.data.content, e.data.pause, e.data.play, p));
				}

			}, {once: true});
			t.addEventListener('error', () => {console.error(`${enscribeVttPath} couldn't load.`)})
			document.body.appendChild(v);
		}

		p.vimeo = new Vimeo.Player(p.element);

	}
};

register('vimeo', mod);
export default mod;

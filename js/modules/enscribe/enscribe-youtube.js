// enscribe-youtube.js
import { register, getCueData, speak } from './enscribe.js';

let ytReady;
function loadYT() {
  if (ytReady) return ytReady;
  ytReady = new Promise((res) => {
    window.onYouTubeIframeAPIReady = res;
    const s = document.createElement('script');
    s.src = 'https://www.youtube.com/iframe_api';
    document.head.appendChild(s);
  });
  return ytReady;
}

const mod = {
  getVolume: (p) => Promise.resolve(p.youtube.getVolume() / 100),
  setVolume: (p, v) => p.youtube.setVolume(Math.round(v * 100)),
  control: (p, action) => p.youtube[action + 'Video'](),

  async updateSource(p, which) {
    const id = which === 'AD' ? p.ADSource : p.standardSource;
    const cur = p.youtube.getCurrentTime();
    const paused = p.youtube.getPlayerState() === 2;
    p.youtube.loadVideoById(id, cur);
    const poll = setInterval(() => {
      if (p.youtube.getPlayerState() === -1) {
        paused ? p.youtube.pauseVideo() : p.youtube.playVideo();
        clearInterval(poll);
      }
    }, 100);
  },

  async setup(p) {
    // If not using an alternate AD video, build a proxy descriptions track
    if (!p.element.dataset.adVideoSource) {
      const v = Object.assign(document.createElement('video'), {
				ariaHidden: 'true'
			});
      const t = Object.assign(document.createElement('track'), {
        kind: 'descriptions', label: 'Audio Descriptions', srclang: 'en'
      });
      v.appendChild(t);
      t.addEventListener('load', () => { 
        console.log('youtube loaded');
        p.ADTrack = tt; 
        console.log('p', p.ADTrack)
      }, { once: true });
      
      t.src =  p.element.dataset.enscribeVttPath;

      const tt = v.textTracks[0];
      console.log('tt', tt, v.outerHTML);
      tt.mode = 'hidden';
      
      document.body.appendChild(v);
    }

    await loadYT();
    p.youtube = new YT.Player(p.element.id, {
      events: {
        onStateChange: (e) => {
          if (e.data !== YT.PlayerState.UNSTARTED && !p._pollStarted && !p.element.dataset.enscribeVideoSource) {
            p._pollStarted = true;
            const tick = () => {
              if (!p.enabled || p.ADPlaying || !p.youtube?.getCurrentTime) return;
              const now = p.youtube.getCurrentTime();
              if (p._lastTime != null && now < p._lastTime - 0.2) p._recentCue = undefined;
              p._lastTime = now;
              for (const c of p.ADTrack.cues) {
                if (p._recentCue === c.startTime) continue;
                if (Math.abs(now - c.startTime) <= 0.1) {
                  p._recentCue = c.startTime;
                  return speak(...Object.values(getCueData(c)), p);
                }
              }
            };
            p._ytInterval = setInterval(tick, 100);
          }
        }
      }
    });
  }
};

register('youtube', mod);
export default mod;

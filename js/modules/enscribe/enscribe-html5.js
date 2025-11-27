// enscribe-html5.js
import { register, getCueData, speak, sanatizeTrack } from './enscribe.js';

const mod = {
  getVolume: (p) => Promise.resolve(p.element.volume),
  setVolume: (p, v) => { p.element.volume = v; },
  control: (p, action) => p.element[action](),
  setHTML5TrackMode: (p) => { if (p.ADTrack) p.ADTrack.mode = p.enabled ? 'showing' : 'disabled'; },

  async updateSource(p, which) {
    const src = which === 'AD' ? p.ADSource : p.standardSource;
    const v = p.element, s = v.querySelector('source');
    const time = v.currentTime, paused = v.paused;
    s.src = src; v.load(); v.currentTime = time; if (!paused) v.play();
  },

  async setup(p) {
    // If not using an alternate AD video, hook the main descriptions track
    for (const t of p.element.textTracks) {
      if (t.kind === 'descriptions') { p.ADTrack = t; break; }
    }
    p.trackEl = p.element.querySelector('track[kind="descriptions"]');
    if (!p.element.dataset.adVideoSource && p.ADTrack) {
      p.ADTrack.addEventListener('cuechange', (e) => {
        if (p.ADPlaying) return;
        const cue = e.currentTarget.activeCues[0];
        if (cue) speak(...Object.values(getCueData(cue)), p);
      });

      p.trackEl.addEventListener('load', () => { 
        sanatizeTrack(p.ADTrack);
      });
    }
    // Keep captions state consistent
    p.element.textTracks?.addEventListener?.('change', () => { mod.setHTML5TrackMode(p); });
  }
};

register('html5', mod);
export default mod;

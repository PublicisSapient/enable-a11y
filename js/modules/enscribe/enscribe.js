/* enscribe.js — ES module core */

const en = {
    players: new Map(),
    mods: new Map(),     // type -> module (html5|vimeo|youtube|…)
    urls: new Map(),     // type -> absolute URL to plugin file
    ready: false
  };
  
  // Base-path from this file
  const isES6Module = !(document.currentScript);
  const baseURL = new URL('.', isES6Module ? import.meta.url : location.origin + location.pathname.replace(/\/[^/]*$/, '/') + enableRootDir);
  // Default URL resolver: ./enscribe-${type}.js next to enscribe.js
  const defaultURLFor = (type) => new URL(`./enscribe-${type}.js`, baseURL).href;
  
  // Public: allow apps to override plugin URL mapping
  export function setPluginURL(type, url) {
    en.urls.set(type, new URL(url, baseURL).href);
  }
  
  // Public: register a plugin module {setup, control, getVolume, setVolume, updateSource, ...}
  export function register(type, mod) {
    en.mods.set(type, mod);
  }
  
  // Helpers used by plugins
  export function htmlToText(html) {
    const d = document.createElement('div');
    d.appendChild(html.cloneNode(true));
    return d.textContent || '';
  }
  
  export function getCueData(cue) {
    const h = cue.getCueAsHTML();
    return { content: htmlToText(h), pause: !!h.querySelector('span.pause'), play: !!h.querySelector('span.play') };
  }

  async function getUtterance(text, player, preferredLocales) {
    if (player?.element?.getAttribute("data-enscribe-use-readium") === "true") {
      // Lazy-load Readium integration only when needed
      const { makeUtterance } = await import("./enscribe-voice.js");
      return await makeUtterance(text, preferredLocales);
    }
  
    // Fallback: plain SpeechSynthesisUtterance without Readium
    const u = new SpeechSynthesisUtterance(text);
    return u;
  }

  export async function speakDescription(text, player, opts = {}) {
    const u = await getUtterance(text, player, preferred);
    if (opts.rate != null)  u.rate = opts.rate;
    if (opts.pitch != null) u.pitch = opts.pitch;
    if (opts.volume != null)u.volume = opts.volume;
    speechSynthesis.speak(u);
  }
  
  // Speak + (optional) pause/duck
  export async function speak(content, pause, play, player) {
    console.log('speak', content, pause, play, player)
    const mod = en.mods.get(player.type);
    if (!mod) return;
  
    //const u = new SpeechSynthesisUtterance(content);
    const preferred = [
          navigator.language,
          navigator.language?.split("-")[0],
          "en-US"
        ];
    const u = await getUtterance(content, player, preferred);
    if (mod.getVolume) u.volume = await mod.getVolume(player);
  
    const el = player.element;
    const shouldPause = !play && (pause || el.hasAttribute('data-enscribe-global-pause'));
    const duckAttr = el.getAttribute('data-enscribe-ducking');
    const shouldDuck = !shouldPause && duckAttr != null;
    let prev;
  
    if (shouldDuck && mod.getVolume && mod.setVolume) {
      prev = await mod.getVolume(player);
      await mod.setVolume(player, +duckAttr || 0.25);
    }
  
    player.ADPlaying = true;
    speechSynthesis.speak(u);
    if (shouldPause && mod.control) mod.control(player, 'pause');
  
    u.onend = async () => {
      if (shouldPause && mod.control) mod.control(player, 'play');
      if (shouldDuck && mod.setVolume) await mod.setVolume(player, prev);
      setTimeout(() => (player.ADPlaying = false), 100);
    };
  }
  
  // Utility: script loader (rarely needed now that we use import(); still here if you want it)
  export function loadScript(src) {
    return new Promise((r) => {
      const s = document.createElement('script');
      s.onload = r;
      s.src = src;
      document.head.appendChild(s);
    });
  }
  
  // Dynamic import for a given type
  async function ensure(type) {
    if (en.mods.has(type)) return;
    const url = en.urls.get(type) || defaultURLFor(type);
    const mod = await import(url);
    // plugin can either default-export the module object or export {plugin}
    register(type, mod.default || mod.plugin || mod);
  }
  
  // Map DOM -> players
  export function createPlayerMappings() {
    document.querySelectorAll('[data-enscribe]').forEach((el) => {
      const type = el.dataset.enscribe;
      let standardSource = el.querySelector('source')?.src || el.src;
      if (type === 'youtube') {
        const m = /embed\/([^?]+)/.exec(el.src);
        standardSource = m ? m[1] : '';
      }
      en.players.set(el.id, {
        element: el,
        type,
        standardSource,
        ADSource: el.dataset.enscribeVideoSource,
        enabled: false,
        ADPlaying: false,
      });
    });
  }
  
  // Public: let apps manually toggle a player by id
  export function setEnabled(playerId, enabled) {
    const p = en.players.get(playerId);
    if (!p) return;
    p.enabled = enabled;
    const mod = en.mods.get(p.type);
    if (p.type === 'html5' && mod?.setHTML5TrackMode) mod.setHTML5TrackMode(p);
  }
  
  // Hook up UI buttons
  export function setupToggleButtons() {
    document.querySelectorAll('[data-enscribe-button-for]').forEach((btn) => {
      btn.addEventListener('click', async (e) => {
        const el = e.currentTarget;
        const {enscribeButtonFor} = el.dataset;
        const p = en.players.get(enscribeButtonFor);

        if (!p) {
          console.error(`No enscribe video with id ${enscribeButtonFor}.`);
          return;
        }
        p.enabled = !p.enabled;
        el.classList.toggle('active');
        el.setAttribute('aria-label', `Turn ${p.enabled ? 'off' : 'on'} audio descriptions`);
        const mod = en.mods.get(p.type);
        if (p.ADSource && mod?.updateSource) {
          await mod.updateSource(p, p.enabled ? 'AD' : 'standard');
        } else if (p.type === 'html5' && mod?.setHTML5TrackMode) {
          mod.setHTML5TrackMode(p);
        }
      });
    });
  }
  
  // Public: initialize everything (dynamic plugin loading by type)
  export async function init() {
    if (en.ready) return;
    en.ready = true;
  
    createPlayerMappings();
  
    // Load & setup each player’s plugin
    for (const p of en.players.values()) {
      await ensure(p.type);
      const mod = en.mods.get(p.type);
      if (mod?.setup) await mod.setup(p, { speak, getCueData });
    }
  
    setupToggleButtons();
  }

  init();
  
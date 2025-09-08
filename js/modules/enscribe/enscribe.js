/* enscribe.js — ES module core */

const en = {
  players: new Map(),
  mods: new Map(),     // type -> module (html5|vimeo|youtube|…)
  urls: new Map(),     // type -> absolute URL to plugin file
  ready: false
};

let ttsPrimed = false;

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
function htmlToText(html) {
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

async function speakDescription(text, player, opts = {}) {
  const u = await getUtterance(text, player, preferred);
  if (opts.rate != null) u.rate = opts.rate;
  if (opts.pitch != null) u.pitch = opts.pitch;
  if (opts.volume != null) u.volume = opts.volume;
  speechSynthesis.speak(u);
}

// Speak + (optional) pause/duck
export async function speak(content, pause, play, player) {
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

// Dynamic import for a given type
async function ensure(type) {
  if (en.mods.has(type)) return;
  const url = en.urls.get(type) || defaultURLFor(type);
  const mod = await import(url);
  // plugin can either default-export the module object or export {plugin}
  register(type, mod.default || mod.plugin || mod);
}


// Map DOM -> players
function createPlayerMappings() {
  document.querySelectorAll('[data-enscribe]').forEach((el) => {
    const type = el.dataset.enscribe;
    let standardSource = el.querySelector('source')?.src || el.src;
    let enabled = false;
    if (type === 'youtube') {
      const m = /embed\/([^?]+)/.exec(el.src);
      standardSource = m ? m[1] : '';
    }

    const controlButton = document.querySelector(`[data-enscribe-ad-control="${el.id}"]`);

    if (controlButton.checked !== undefined) {
      enabled = controlButton.checked;
    } else if (controlButton.hasAttribute('aria-checked')) {
      enabled = (controlButton.getAttribute('aria-checked') === 'true')
    }

    en.players.set(el.id, {
      element: el,
      type,
      standardSource,
      ADSource: el.dataset.enscribeAdVideoSource,
      enabled,
      ADPlaying: false,
    });
  });
}

async function updateADState(p, adControl) {

  if (adControl.checked !== undefined) {
    adControl.checked = p.enabled;
  } else if (adControl.hasAttribute('aria-checked')) {
    adControl.setAttribute('aria-checked', p.enabled ? 'true' : 'false');
  }

  const mod = en.mods.get(p.type);
  if (p.ADSource && mod?.updateSource) {
    await mod.updateSource(p, p.enabled ? 'AD' : 'standard');
  } else if (p.type === 'html5' && mod?.setHTML5TrackMode) {
    mod.setHTML5TrackMode(p);
  }
}

// Hook up UI buttons
function setupToggleButtons() {
  document.querySelectorAll('[data-enscribe-ad-control]').forEach((btn) => {
    btn.addEventListener('click', async (e) => {
      const el = e.currentTarget;
      const { enscribeAdControl } = el.dataset;
      const p = en.players.get(enscribeAdControl);
      if (!p) {
        console.error(`No enscribe video with id ${enscribeAdControl}.`);
        return;
      }
      p.enabled = !p.enabled;
      updateADState(p, el)
    });
  });
}

// Safari will not work correctly if the time allocated for the audio
// description is not larger than 300 ms, so we ensure the AD is that length.
export function sanatizeTrack(ADTrack) {
  const { cues } = ADTrack;
  for (let i = 0; i < cues.length; i++) {
    const { startTime, endTime } = cues[i];
    if (endTime - startTime < 0.3) {
      cues[i].endTime = startTime + 0.3;
    }
  }
}

/* Needed by iOS Safari. SpeechSynthesis needs to be initiated by a user click */
function primeTTSOnce() {
  if (ttsPrimed) return;
  ttsPrimed = true;

  const u = new SpeechSynthesisUtterance(' ');
  u.volume = 0;               // inaudible warm-up

  // Some iOS builds ignore the first .speak unless .cancel was called
  try { speechSynthesis.cancel(); } catch { }
  try { speechSynthesis.speak(u); } catch { }
  // Optional: small timeout then cancel again to clear the queue
  setTimeout(() => { try { speechSynthesis.cancel(); } catch { } }, 150);
}

function docClickEvent(e) {
  primeTTSOnce();
  //speechSynthesis.cancel();
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

    const adControl = document.querySelector(`[data-enscribe-ad-control=${p.element.id}]`);
    if (!adControl) {
      console.error(`Video with ID ${p.element.id} does not have an AD control.`);
    }
    updateADState(p, adControl);
  }

  setupToggleButtons();
  document.body.addEventListener('click', (e) => docClickEvent())
}

init();

// enscribe-voice.js — tiny wrapper around Readium Speech (Option A)
// Project layout note: this file lives in /es6 and node_modules/ is a sibling directory.
// So we import Readium Speech via a relative path that works in the browser:
//   ../node_modules/readium-speech/mjs/voices.js
// If your server does not expose /node_modules, either add an import map or copy the
// module under a public /vendor path and update the import accordingly.

import { getVoices, getSpeechSynthesisVoices } from "../node_modules/readium-speech/mjs/voices.js";

const VOICE_CACHE_KEY = "enscribe.readium.voiceURI";
let cachedId = null; // voiceURI or name
let voicesWatchAttached = false;

function lsGet(key) { try { return localStorage.getItem(key); } catch { return null; } }
function lsSet(key, val) {
  try { if (val) localStorage.setItem(key, val); else localStorage.removeItem(key); } catch {}
}

function preferredLocalesFrom(navigatorObj = navigator) {
  const lang = navigatorObj?.language;
  const base = lang && lang.split("-")[0];
  return [lang, base, "en-US"].filter(Boolean);
}

async function ensureVoicesReady() {
  try { await getSpeechSynthesisVoices(); } catch {}
}

function findVoiceById(id) {
  if (!id) return null;
  const list = window.speechSynthesis?.getVoices?.() || [];
  return list.find(v => v.voiceURI === id || v.name === id) || null;
}

async function chooseBestId(preferred) {
  await ensureVoicesReady();
  const ranked = await getVoices(preferred);
  const id = ranked?.[0]?.voiceURI || ranked?.[0]?.name || null;
  if (id) { cachedId = id; lsSet(VOICE_CACHE_KEY, id); }
  return id;
}

function attachVoicesChangedWatcher(preferred) {
  if (voicesWatchAttached || !window.speechSynthesis?.addEventListener) return;
  voicesWatchAttached = true;
  let t;
  window.speechSynthesis.addEventListener("voiceschanged", () => {
    clearTimeout(t);
    t = setTimeout(() => { void chooseBestId(preferredLocalesFrom()); }, 250);
  });
}

export async function pickBestVoice(preferred = preferredLocalesFrom()) {
  attachVoicesChangedWatcher(preferred);
  await ensureVoicesReady();

  // 1) try cached id
  if (!cachedId) cachedId = lsGet(VOICE_CACHE_KEY);
  let v = findVoiceById(cachedId);
  if (v) return v;

  // 2) rank via Readium and map back to a live voice
  const id = await chooseBestId(preferred);
  v = findVoiceById(id);
  if (v) return v;

  // 3) ultimate fallback: any voice matching the base language
  const baseSet = new Set(preferred.map(l => l.toLowerCase().split("-")[0]));
  const list = window.speechSynthesis?.getVoices?.() || [];
  return list.find(vo => baseSet.has((vo.lang||"").toLowerCase().split("-")[0])) || list[0] || null;
}

export async function makeUtterance(text, preferred = preferredLocalesFrom()) {
  await ensureVoicesReady();
  const u = new SpeechSynthesisUtterance(text);
  const best = await pickBestVoice(preferred);
  if (best) u.voice = best;
  return u;
}

// Optional: expose ranked list for a settings UI
export async function getRankedVoices(preferred = preferredLocalesFrom()) {
  await ensureVoicesReady();
  const ranked = await getVoices(preferred);
  const live = window.speechSynthesis.getVoices();
  return ranked.map(r => ({
    reco: r,
    voice: live.find(v => v.voiceURI === r.voiceURI || v.name === r.name) || null
  }));
}

export function setPreferredVoice(idOrName) {
  cachedId = idOrName || null;
  lsSet(VOICE_CACHE_KEY, cachedId);
}

export function getPreferredVoice() {
  return cachedId || lsGet(VOICE_CACHE_KEY);
}

export function clearPreferredVoice() {
  cachedId = null;
  lsSet(VOICE_CACHE_KEY, null);
}

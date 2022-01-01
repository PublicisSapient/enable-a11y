import { ablePlayerCustomizations, AblePlayerInstances } from '../modules/ablePlayerCustomizations.js';
import pauseAnimControl from '../modules/pause-anim-control.js'
import './ana-tudor/elastic-collision.js'


// Expose pauseAnimControl to showcode.
window.pauseAnimControl = pauseAnimControl;


// Expose AblePlayerInstances object globally so pauseAnimControl.js
// can pause Ableplayer videos.
window.AblePlayerInstances = AblePlayerInstances;


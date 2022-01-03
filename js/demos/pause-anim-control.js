import { AblePlayerInstances } from '../modules/ablePlayerCustomizations.js';
import {  PauseAnimControlDef} from '../modules/pause-anim-control.js';
import './ana-tudor/elastic-collision.js';
import showcode from '../libs/showcode.js';


// Expose pauseAnimControl to showcode.
showcode.addJsObj('pauseAnimControl', PauseAnimControlDef);

// Expose AblePlayerInstances object globally so pauseAnimControl.js
// can pause Ableplayer videos.
window.AblePlayerInstances = AblePlayerInstances;


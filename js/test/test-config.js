"use strict";

import failOnConsole from 'jest-fail-on-console'

failOnConsole();

const { argv } = process;
const filenameWithoutPath = argv[argv.length - 1];


jest.setTimeout(10000);

const config = {
  "BASE_URL": `http://localhost:8888`,
  "KEYPRESS_TIMEOUT": 250,
  "KEYPRESS_FAST_TIMEOUT": 100,
  "DESKTOP_WIDTH": 1024,
  "DESKTOP_HEIGHT": 768,
  "MOBILE_WIDTH": 400,
  "MOBILE_HEIGHT": 800
};

export default config; 
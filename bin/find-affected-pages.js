#!/usr/bin/env node
/**
 * Find which HTML pages reference a given set of CSS/JS assets.
 * No external dependencies.
 *
 * Usage examples:
 *   node find-affected-pages.js --dir ./public --files "css/site.css,js/app.js"
 *   node find-affected-pages.js --dir ./dist --list ./targets.txt --match basename
 *   node find-affected-pages.js --dir ./public --list ./targets.txt --results-relative
 *   node find-affected-pages.js --dir ./public --list ./targets.txt --just-pages
 *   node find-affected-pages.js --dir ./public --list ./targets.txt --just-pages --quiet
 *
 * Options:
 *   --dir <path>            Root directory to scan (recursively) for .html files (required)
 *   --files <csv>           Comma-separated list of target asset paths (css/js)
 *   --list <file>           Text file with one target asset path per line (alternative to --files)
 *   --match <mode>          Matching mode: "suffix" (default) or "basename"
 *   --exts <csv>            Extra HTML-like extensions to include (default: ".html,.htm")
 *   --results-relative      Output only filenames (no paths) for pages and assets
 *   --just-pages            Output only the list of affected pages (no assets like js or CSS files)
 *   --quiet                 Machine-friendly output:
 *                            - default: CSV "page,assets"
 *                            - with --just-pages: one page per line
 */
const fs = require('fs');
const path = require('path');

function parseArgs(argv) {
	const args = {};
	for (let i = 2; i < argv.length; i++) {
		const a = argv[i];
		if (a === '--dir') 
			args.dir = argv[++ i];
		 else if (a === '--files') 
			args.files = argv[++ i];
		 else if (a === '--list') 
			args.list = argv[++ i];
		 else if (a === '--match') 
			args.match = argv[++ i];
		 else if (a === '--exts') 
			args.exts = argv[++ i];
		 else if (a === '--quiet') 
			args.quiet = true;
		 else if (a === '--results-relative') 
			args.resultsRelative = true;
		 else if (a === '--just-pages') 
			args.justPages = true;
		 else {
			console.error(`Unknown arg: ${a}`);
			process.exit(2);
		}
	}
	return args;
}

function readTargetList({files, list}) {
	let targets = [];
	if (files) {
		targets = targets.concat(files.split(',').map(s => s.trim()).filter(Boolean));
	}
	if (list) {
		const txt = fs.readFileSync(list, 'utf8');
		targets = targets.concat(txt.split(/\r?\n/).map(s => s.trim()).filter(Boolean));
	}
	if (targets.length === 0) {
		console.error('Error: provide --files or --list with at least one target asset.');
		process.exit(2);
	}
	// Normalize to forward slashes for consistent suffix matching
	targets = targets.map(t => t.replace(/\\/g, '/'));
	return targets;
}

function walkFiles(root, extsSet, out =[]) {
	const entries = fs.readdirSync(root, {withFileTypes: true});
	for (const e of entries) {
		const full = path.join(root, e.name);
		if (e.isDirectory()) {
			walkFiles(full, extsSet, out);
		} else {
			const ext = path.extname(e.name).toLowerCase();
			if (extsSet.has(ext)) 
				out.push(full);
			

		}
	}
	return out;
}

function stripHtmlComments(s) {
	return s.replace(/<!--[\s\S]*?-->/g, '');
}

function extractAssetUrls(html) {
	const results = [];
	const linkRe = /<link\b[^>]*?\bhref\s*=\s*(['"])(.*?)\1/gi;
	const scriptRe = /<script\b[^>]*?\bsrc\s*=\s*(['"])(.*?)\1/gi;
	const styleBlockRe = /<style\b[^>]*>([\s\S]*?)<\/style>/gi;
	const importRe = /@import\s+(?:url\(\s*(['"]?)(.*?)\1\s*\)|(['"])(.*?)\3)/gi;

	let m;
	while ((m = linkRe.exec(html))) 
		results.push(m[2]);
	

	while ((m = scriptRe.exec(html))) 
		results.push(m[2]);
	


	let sb;
	while ((sb = styleBlockRe.exec(html))) {
		const block = sb[1];
		let im;
		while ((im = importRe.exec(block))) {
			const candidate = im[2] || im[4];
			if (candidate) 
				results.push(candidate);
			

		}
	}

	return results.map(u => u.split('#')[0].split('?')[0].replace(/\\/g, '/'));
}

function buildMatchers(targets, mode) {
	if (mode === 'basename') {
		const names = new Set(targets.map(t => path.posix.basename(t)));
		return {
			test: (assetUrl) => names.has(path.posix.basename(assetUrl)),
			describe: 'basename'
		};
	}
	// default: suffix
	return {
		test: (assetUrl) => targets.some(t => assetUrl.endsWith(t)),
		describe: 'suffix'
	};
}

function displayPath(p, relativeOnly) {
	if (! relativeOnly) 
		return p;
	

	return path.basename(p);
}

function isPageTarget(target, extsSet) {
	const ext = path.posix.extname(target.toLowerCase());
	return extsSet.has(ext || '');
}(function main() {
	const args = parseArgs(process.argv);
	if (! args.dir) {
		console.error('Error: --dir <path> is required.');
		process.exit(2);
	}

	const targets = readTargetList(args);

	const exts = (args.exts || '.html,.htm').split(',').map(s => s.trim().toLowerCase()).filter(Boolean);
	const extsSet = new Set(exts);
	// Split targets: those that are pages (by extension) vs assets
	const pageTargets = targets.filter(t => isPageTarget(t, extsSet));
	const assetTargets = targets.filter(t => ! isPageTarget(t, extsSet));
	
	// Matcher for assets (unchanged behavior)
	const matchMode = (args.match || 'suffix').toLowerCase();
	const matcher = buildMatchers(assetTargets.length ? assetTargets : targets, matchMode);


	const rootDir = path.resolve(args.dir);
	const htmlFiles = walkFiles(rootDir, extsSet);



	// Build a matcher for page targets using the same mode
	const pageMatcher = buildMatchers(
        pageTargets.map(t => path.posix.basename(t)),
        'suffix' // endsWith('file.php') is fine once we reduced to basenames
      );


	const pageToAssets = new Map(); // page -> Set(assets that matched)
	const assetToPages = new Map(); // asset -> Set(pages)

	for (const f of htmlFiles) {
		const raw = fs.readFileSync(f, 'utf8');
		const html = stripHtmlComments(raw);
		const urls = extractAssetUrls(html);

		const matches = new Set();
		for (const u of urls) {
			if (assetTargets.length ? matcher.test(u) : matcher.test(u)) {
				matches.add(u);
			}
		}
		if (matches.size > 0) {
			pageToAssets.set(f, matches);
			for (const m of matches) {
				if (! assetToPages.has(m)) 
					assetToPages.set(m, new Set());
				

				assetToPages.get(m).add(f);
			}
		}
	}

	// Force-include pages that appear in the target list (by ext) even if they had no asset matches.
	if (pageTargets.length > 0) {
		// For each discovered HTML file, check if it matches any page target under the selected mode.
		for (const f of htmlFiles) {
			// Normalize to forward slashes for consistent suffix/basename matching
			const normalized = f.replace(/\\/g, '/');

			if (pageMatcher.test(normalized)) {
				if (! pageToAssets.has(f)) {
					pageToAssets.set(f, new Set()); // include page with empty asset list
				}
			}
		}
	}

	// No matches?
	if (pageToAssets.size === 0) {
		if (args.quiet) {
			if (args.justPages) {
				// nothing to print
				process.exit(0);
			}
			// default quiet prints CSV header even if empty set
			console.log('page,assets');
			process.exit(0);
		}
		console.log(`Scanned ${
			htmlFiles.length
		} HTML file(s) under: ${rootDir}`);
		console.log(`Matching mode: ${
			matcher.describe
		}`);
		console.log(`Targets (${
			targets.length
		}):`);
		for (const t of targets) 
			console.log(`  - ${t}`);
		

		console.log('\nNo pages reference the specified assets.');
		process.exit(0);
	}

	// JUST PAGES mode
	if (args.justPages) {
		const pages = [... pageToAssets.keys()].map(p => displayPath(p, args.resultsRelative));
		if (args.quiet) {
			// one page per line, no header
			for (const p of pages) 
				console.log(p);
			

			process.exit(0);
		}
		console.log(`Pages affected (${
			pages.length
		}):`);
		for (const p of pages) 
			console.log(`• ${p}`);
		

		process.exit(0);
	}

	// Normal outputs
	if (args.quiet) {
		// CSV: page,assets (assets pipe-separated)
		console.log('page,assets');
		for (const [page, assets] of pageToAssets) {
			const pageOut = displayPath(page, args.resultsRelative);
			const assetsOut = [...assets].map(a => displayPath(a, args.resultsRelative)).join('|');
			console.log(`${pageOut},${assetsOut}`);
		}
		process.exit(0);
	}

	// Pretty output
	console.log(`Scanned ${
		htmlFiles.length
	} HTML file(s) under: ${rootDir}`);
	console.log(`Matching mode: ${
		matcher.describe
	}`);
	console.log(`Targets (${
		targets.length
	}):`);
	for (const t of targets) 
		console.log(`  - ${t}`);
	

	console.log('');

	console.log('Pages affected:');
	for (const [page, assets] of pageToAssets) {
		console.log(`\n• ${
			displayPath(page, args.resultsRelative)
		}`);
		for (const a of assets) {
			console.log(`   - ${
				displayPath(a, args.resultsRelative)
			}`);
		}
	}

	console.log('\nSummary (asset → pages):');
	for (const [asset, pages] of assetToPages) {
		console.log(`\n${
			displayPath(asset, args.resultsRelative)
		}`);
		for (const p of pages) {
			console.log(`   - ${
				displayPath(p, args.resultsRelative)
			}`);
		}
	}
})();

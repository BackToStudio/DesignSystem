/**
 * Captures screenshots of each component HTML file using Puppeteer.
 * Usage: node capture.mjs
 *
 * Reads HTML files from ./html/ and outputs PNGs to ./png/
 *
 * Set CHROME_PATH env var to specify the Chrome/Chromium binary.
 * Falls back to common locations.
 */

import puppeteer from 'puppeteer-core';
import { readdir } from 'fs/promises';
import { resolve, basename } from 'path';
import { existsSync } from 'fs';

const HTML_DIR = resolve(import.meta.dirname, 'html');
const PNG_DIR = resolve(import.meta.dirname, 'png');

function findChrome() {
    if (process.env.CHROME_PATH) return process.env.CHROME_PATH;

    const candidates = [
        '/usr/bin/google-chrome-stable',
        '/usr/bin/google-chrome',
        '/usr/bin/chromium-browser',
        '/usr/bin/chromium',
        // Playwright-managed Chromium (dev environments)
        '/root/.cache/ms-playwright/chromium-1194/chrome-linux/chrome',
    ];
    for (const path of candidates) {
        if (existsSync(path)) return path;
    }
    throw new Error('Chrome/Chromium not found. Set CHROME_PATH env var.');
}

async function main() {
    const files = (await readdir(HTML_DIR)).filter(f => f.endsWith('.html'));

    if (files.length === 0) {
        console.error('No HTML files found. Run render-components.php first.');
        process.exit(1);
    }

    const executablePath = findChrome();
    console.log(`Using Chrome: ${executablePath}`);

    const browser = await puppeteer.launch({
        executablePath,
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox', '--disable-gpu'],
    });

    for (const file of files.sort()) {
        const page = await browser.newPage();
        await page.setViewport({ width: 600, height: 400, deviceScaleFactor: 2 });

        const htmlPath = resolve(HTML_DIR, file);
        await page.goto(`file://${htmlPath}`, { waitUntil: 'networkidle0', timeout: 10000 });

        // Auto-fit: measure actual content height
        const bodyHeight = await page.evaluate(() => document.body.scrollHeight);
        await page.setViewport({ width: 600, height: bodyHeight + 48, deviceScaleFactor: 2 });

        const pngName = basename(file, '.html') + '.png';
        const pngPath = resolve(PNG_DIR, pngName);

        await page.screenshot({
            path: pngPath,
            fullPage: true,
            omitBackground: false,
        });

        console.log(`  ${pngName}`);
        await page.close();
    }

    await browser.close();
    console.log(`\nDone! ${files.length} screenshots saved to ${PNG_DIR}`);
}

main().catch(err => {
    console.error(err);
    process.exit(1);
});

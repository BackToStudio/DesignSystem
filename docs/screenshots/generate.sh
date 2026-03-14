#!/bin/bash
# Generates component screenshots: renders HTML then captures PNGs.
# Usage: bash docs/screenshots/generate.sh
#
# This script is called by CI to keep screenshots up to date.

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
PROJECT_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"

echo "==> Rendering component HTML..."
php "$SCRIPT_DIR/render-components.php"

echo "==> Installing capture dependencies..."
cd "$SCRIPT_DIR"
npm install --prefer-offline --no-audit --no-fund 2>/dev/null

echo "==> Capturing screenshots..."
node capture.mjs

echo "==> Done! Screenshots are in docs/screenshots/png/"

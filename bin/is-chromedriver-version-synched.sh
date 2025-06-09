#!/bin/bash

# Step 1: Get local chromedriver version from node_modules
LOCAL_CHROMEDRIVER_VERSION=$(sed -n 's/.*"version": "\(.*\)".*/\1/p' node_modules/chromedriver/package.json | head -n 1)

if [ -z "$LOCAL_CHROMEDRIVER_VERSION" ] || [ "$LOCAL_CHROMEDRIVER_VERSION" == "null" ]; then
  echo "❌ Could not find chromedriver version in node_modules."
  exit 1
fi

echo "🔍 Local ChromeDriver version: $LOCAL_CHROMEDRIVER_VERSION"

# Step 2: Extract Chrome version from push_actions.yml
CHROME_URL=$(grep "google-chrome-stable_" .github/workflows/push-actions.yml | grep -Eo 'https://[^ ]+google-chrome-stable_[0-9.]+-[0-9]+_amd64.deb' | head -n 1)


if [ -z "$CHROME_URL" ]; then
  echo "❌ Could not find Chrome .deb URL in push_actions.yml."
  exit 1
fi

CHROME_VERSION=$(echo "$CHROME_URL" | sed -E 's/.*google-chrome-stable_([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)-.*/\1/')


if [ -z "$CHROME_VERSION" ]; then
  echo "❌ Could not extract Chrome version from URL: $CHROME_URL"
  exit 1
fi

echo "🔍 Chrome version in GitHub Actions: $CHROME_VERSION"

# Step 3: Compare the major.minor.build versions (ignore patch for compatibility)
CHROMEDRIVER_BASE=$(echo "$LOCAL_CHROMEDRIVER_VERSION" | cut -d '.' -f1-3)
CHROME_BASE=$(echo "$CHROME_VERSION" | cut -d '.' -f1-3)

if [ "$CHROMEDRIVER_BASE" == "$CHROME_BASE" ]; then
  echo "✅ ChromeDriver and Chrome versions match (base: $CHROME_BASE)"
  exit 0
else
  echo "❌ Version mismatch!"
  echo "    ChromeDriver: $CHROMEDRIVER_BASE"
  echo "    Chrome:       $CHROME_BASE"
  exit 2
fi

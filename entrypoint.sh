#!/bin/sh

# Exit immediately if a command exits with a non-zero status.
set -e

# --- Configuration ---
GEOIP_DIR="/geoip"
STATIC_DB_NAME="dbip-country-lite.mmdb" # The static name Caddyfile will use
DB_PATH="$GEOIP_DIR/$STATIC_DB_NAME"
CURRENT_MONTH=$(date +%Y-%m)
REMOTE_FILENAME="dbip-country-lite-${CURRENT_MONTH}.mmdb"
DOWNLOAD_URL="https://download.db-ip.com/free/${REMOTE_FILENAME}.gz"

# --- Logic ---
# To force an update, simply delete the old .mmdb file from your geoip volume.
if [ ! -f "$DB_PATH" ]; then
    echo "GeoIP database not found. Downloading the latest version for ${CURRENT_MONTH}..."

    # Download, decompress, and save the database with the static name.
    wget -q -O - "$DOWNLOAD_URL" | gunzip > "$DB_PATH"

    echo "Download complete. Database saved to $DB_PATH"
else
    echo "GeoIP database already exists. Skipping download."
fi

# --- Start Caddy ---
# This is the crucial final step. `exec "$@"` replaces the script process
# with the Caddy server process (the CMD from the Dockerfile).
echo "Starting Caddy..."
exec "$@"
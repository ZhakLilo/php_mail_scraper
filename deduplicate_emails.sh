#!/usr/bin/env bash

# Input file of emails:
INPUT_FILE="new_emails_found.txt"

# Declare an associative array (requires Bash 4+).
declare -A emails

while IFS= read -r email; do
    # Define the canonical version (all lowercase).
    canon=$(echo "$email" | tr '[:upper:]' '[:lower:]')

    # If this canonical form hasn't been stored yet, store the current email.
    if [[ -z "${emails[$canon]}" ]]; then
        emails[$canon]="$email"
    else
        # If this new email is purely lowercase, override.
        if ! grep -q '[[:upper:]]' <<< "$email"; then
            emails[$canon]="$email"
        fi
    fi
done < "$INPUT_FILE"

# Output the results.
# This will print one line per canonical email.
for key in "${!emails[@]}"; do
    echo "${emails[$key]}"
done

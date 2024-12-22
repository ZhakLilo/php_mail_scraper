<?php
// Input file containing the list of domains
$inputFile = 'domains.txt';
// Output file to save emails
$outputFile = 'emails_found.txt';

// Function to scrape emails from a URL
function scrapeEmails($url) {
    $content = @file_get_contents($url); // Suppress warnings for unreachable URLs
    if ($content === FALSE) {
        return [];
    }
    // Regex to find emails
    preg_match_all('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', $content, $matches);
    return $matches[0];
}

// Read the domain list
$domains = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (!$domains) {
    die("Error: Unable to read the domain list.\n");
}

// Open the output file
$outputHandle = fopen($outputFile, 'w');
if (!$outputHandle) {
    die("Error: Unable to open the output file for writing.\n");
}

foreach ($domains as $domain) {
    $url = "http://$domain"; // Assuming domains are without http/https
    echo "Scraping: $url\n";
    $emails = scrapeEmails($url);
    if (!empty($emails)) {
        foreach ($emails as $email) {
            fwrite($outputHandle, $email . PHP_EOL);
        }
        echo "Found emails: " . implode(', ', $emails) . "\n";
    } else {
        echo "No emails found on $url\n";
    }
}

// Close the output file
fclose($outputHandle);

echo "Scraping completed. Emails saved to $outputFile.\n";
?>

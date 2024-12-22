# PHP Mail Scraper tool

The mail scraper tool needs a file named domains.txt with one domain per line.

The output is saved in emails_found.txt file as one mail per line

ToDo:

- If there is image with @  (usually for different image size) in the name it is considered as an email and saved.
- Email addresess with the same content but different letter capitalizations are considered for different emails

Quick and dirty `bash` fix to remove images from the list:

`cat emails_found.txt | uniq | grep -v .png | grep -v .jpg | grep -v .webp | grep -v .svg >> new_emails_found.txt`

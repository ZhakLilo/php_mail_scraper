# PHP Mail Scraper tool

The mail scraper tool needs a file named `domains.txt` with one domain per line.

The output is saved in the `emails_found.txt` file as one mail per line

ToDo:

- If there is an image with @  (usually for different image sizes) in the name it is considered as an email and saved.
- Email addresses with the same content but different letter capitalizations are considered for different emails

Quick and dirty `bash` fix to remove images from the list:
```
cat emails_found.txt | uniq | grep -v .png | grep -v .jpg | grep -v .webp | grep -v .svg | grep -v .jpeg >> new_emails_found.txt
```
The `deduplicate_emails.sh` script addresses the second issue. Feeding the script with the list of the emails named `new_emails_found.txt` and executing it in the following manner:
```
./deduplicate_emails.sh > cleaned_emails.txt
```
It will provide a list without duplicating mail addresses. 

Don't forget to make the script executable by using the `chmod 755` command.

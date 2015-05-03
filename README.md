# XLStoSQL

## Introduction
Tired of writting long lines of SQL code to create tables for a data base? Now, imagine typing all that data from an Excel file.. Yeah wasted time. Well not any more using this PHP module.

## How To
1. To create the SLQ snippet run "index.php"
2. Select the file and then click on "Upload"
3. Your SQL snippet will be printed!

**WARNING YOU .XLS FILE WILL BE DELETED AFTER THE PROCESS, INSIDE THE PROJECT FOLDER**
_To know more about read the notes section_

## Notes
  -The file that is in charge of creating the SQL snippet is named **fileHandler.php**
 
  -If you want to avoid deleting the .xls file remove line 152 of *fileHandler.php**

## Spreadsheet Reader
For reading the spreadsheet we use the __*"spreadsheet-reader"*__ by __Nuovo__. Our creation is the production of the SQL lines using the reader from Nuovo. [Here is the link to the original repo.](https://github.com/nuovo/spreadsheet-reader)

## Licence

All of the code in this library is licensed under the **MIT** license. The Spreadsheet Reader code is owned by Nuovo.

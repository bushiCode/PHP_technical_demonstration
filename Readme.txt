For all programs, run "index.php"

"data_import" program requires connection to MySQL server to run. 
If you would like to test this program then you can run XAMPP or access a server you have and change the connection settings in the included "db_connection.php" file. 
The program comes with pre-generated ouput files so it does not need to be run in order to view the output, but deleting these will allow you to run the program and test the outputs work.

## Anagram program

This is a simple program that takes two strings as an argument, and returns true if they are an anagram of each other,
and false otherwise. This program uses the definition of an anagram in that an anagram is "A  word or phrase made by using the letters of another word or phrase in a different 
order."

## IP Filtering program

This program takes an IP address as an argument and returns whether the address is within a given list.
The list includes the following types of address:
1. A single address.
2. A range of addresses.
3. CIDR range.

## Data Import program

This program reads in an external CSV file, which comprises a list of cars anfd their various qualities.
Each car is stored into a database, removing any duplicates using the vehicle registration as the primary key.

Once we have stored our data, the program performs the following operations:
1. Filters the cars by fuel type, and creates an exported CSV, one for each fuel type of the vehicles.
2. Provides a list of vehicles that match a particular valid registration style (Two letters, followed by two numbers, a space, and then three letters).
3. Provides a count of the number of vehicles that do not have a valid registration.

## FizzBuzz

This is a program I created to demonstrate how I would write "the worst implementation" of the exercise "FizzBuzz".

The objectives of FizzBuzz are:
1. Write a program that prints the integers from 1 to 100 (inclusive).
2. For multiples of three, print Fizz.
3. For multiples of five, print Buzz.
4. For multiples of both three and five, print FizzBuzz.
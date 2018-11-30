CSE305 Final Project Documentation - IMDBc (Internet Movie Database clone)

Author: Kuba Gasiorowski (Just me!)
ID: 109776237

---- PART 1 ----

Tools used: draw.io

Image location: ./cse305hw1.jpg

The point of this design was to create two levels, one in which users
could interact with the database, and the film database itself. The 
article table was created as a medium between the two levels.

Note that some details of this design had to be changed. For example, in 
the diagram there are entities for almost every type of crew in a film. 
I realized pretty quickly during development that this made no sense, and 
it would be simpler to create an intermediate table and set the role as an 
attribute, or a reference to a 'role' table.


---- PART 2 ----

Tools used: A personal linux VM, MySQL

All database tables can be found in ./private/sql/build/tables.
All the rest of the database files (setup/teardown scripts, test data etc.)
can be found in ./private/sql/build

The database schema was implemented almost entirely in accordance with the
ER diagram developed in part 1. However, some things needed to be changed due
to unforseen complications (such as what is stated above). Also, for example,
I changed the way that certain attributes were constrained - for a few tables
I had several lengthy and complex triggers to validate one or two attributes.
I decided to change one to an ENUM, and move the others to separate tables and 
just reference those tables in the original tables.

---- PART 3 ----

Tools used: 
scotch box (https://box.scotch.io) (A preconfigured VM linux environment that may be used for quick web development)
MySQL
PHP+HTML

All source can be found in ./public/ and ./private/php/.  

Transactions by php file:

Please note that all actual SQL queries can be found in func.php.
This is where all functions are defined.

---------- createAccount.php ----------
	
	In this file, the transaction that occurs is fairly simple.
It takes the username that was given in the form and queries the
database to see if any user with that username already exists. 
If it does, it returns an error, otherwise the specified user is
insert into the database. Note that there is no current function
for new admins to be created. This must be done by hand in the 
backend of the server.


---------- login.php ----------
	
	This is a simple login page. Since the emphasis of this project
wasn't security, I just implemented a simple session with no timeout,
and passwords are stored as plaintext in the database for the sake
of simplicity. Please note that in the real world this would get me
fired real fast.
	The script queries the database for the username/password combination
given in the web form. If there is some record which matches these,
then the script retrieves the unique user ID (uid) and stores that
as well as the username in the session.

---------- user.php ----------
	
	This script loads all the data it can about the user currently
logged in. This includes information directly describing user, IE
firstname, lastname, email. This information can be updated by using
the first webform on the page. When the submit button is pressed, the
script UPDATES the current user's information to match what is given
in the form.
	The script also includes a list of articles authored by the current
user.
	Finally, if the user happens to be an admin, a list of pending edits 
is displayed. The admin may review the edits and approve any number of 
them. When the edit is approved, the changes are committed to the article.

---------- article.php ---------- 

	This script loads all the data of an article and prints it neatly to
the webpage. 
	Additionally, it queries the database for some other info as well.
If the article is about a person, it retrieves all credits for that person
and displays them in a table. If it is a film, it displays all credits
associated with that film (aka, cast/crew).
	Clicking on the edit button allows the current user to edit the current
article. 

---------- edit.php ---------- 

	This script is generally loaded with an article. Note that the user must
be logged in in order to submit any edits (thus the system does not accept
anonymous edits). Upon submission, a new edit is INSERTED into the edits table,
which an admin can then approve in their user page. 
	However, this page is also used to create new articles that don't exist
yet for existing films/personnel. In this case, passing an article by it's ID
is impossible since it doesn't exist yet. Instead it is referenced by the 
films/personnel's ID. However, this process is identical to editing an
existing article.

---------- approve.php ---------- 

	Here an edit is approved. If the article exists, then the script UPDATES
the existing article with the edit's content. If the article does not exist,
then a new article is INSERTED with the edited contents instead.

---------- index.php ---------- 

	This is probably the most complicated script of them all. The way this 
works is the following:

1. The user loads the page and sets some filters. User submits.
2. The script checks which filters are set, and adds it to an array of filters.
3. For every filter it finds, the script then adds constrictions to a select
	statement which retrieves all articles, filtered by whatever the user input was.
4. The resulting set of articles is printed in a neat fashion, each with a link
	to that article's page.

	
	OTHER IMPORTANT THINGS

Please note the use of views in this application. It was my intent to make use
of views for two reasons: 
1. To simplify queries which would otherwise require several joins
2. To be able to change the backend structure without having to worry about frontend
instability. 

The views were intended to act as an entry point to the DBMS. Also note that
I created a new user and granted it permissions to operate only on the views.
I also had to give it permissions for the original article table, because the
article view is non-updatable or insertable.

	SOME THINGS I WANTED TO IMPLEMENT, BUT DIDNT HAVE ENOUGH TIME To

Image upload - With the current implementation, you can change the imagename
of an article, but you can't actually upload a new image. My next step was
to implement some form where image upload was supported.

Edit history - Users can currently see which articles they have originally
authored, but not ones that they have edited. This would probably involve
creating an additional table, since multiple tables can be edited by multiple
users (many-to-many relationship)






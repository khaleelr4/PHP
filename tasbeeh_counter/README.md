# tasbeeh_counter
This Project is designed for making the Tasbeeh Counter.

# Tech Used:
    {Front End}:
    1) HTML 
    2) CSS
    3) Javascript
    4) JQuery
    {Back End}:
    5) PHP

# Note:
1. Before running this project, remember to go in the config.php file in app/config folder and delete the port :8080 in URLHOME constant string, or if your localhost is any other port 
rather than the default one, you can also change that as well.

2. You can find all the front end libraries in 
   public/libraries

# Rules for importing database:
1) When you pull the data from the git, you'll receive the latest copy of the database and if provided and import it to your phpmyadmin interface. Before importing the database to your mysql admin, keep this in mind
to remove the _[numberswritternafterit] or in other words, rename it and remove the number after _ and also remove the underscore with it.

2) Go to PHPMYADMIN, remove the current databse you are using, dont worry about it becuase if you want to use
it again, the old version will be always available in the previous commits. 

3) Make the databse with the same name in phpmyadmin, and import the database pulled recently to your phpmyadmin.


# Required:
Need to include proper phone number validation where ever used both in client side and server side

# TODO:
1. When the notification is popped up, how many seconds ago the notification was created must be shown as well
2. Need a Professional and Good Loader for this project


# References:
 1. The loader being used anywhere in the code where it resides in view/includes is being referenced from w3 schools
 2. To get the IP Address of the Client, https://jsonip.com is used.
    It is a free API that only gives you a small object that contains the IP address of the client.
 3. MD5 algorithm buid in of PHP is used to encrypt the password.
    Link: https://www.w3schools.com/php/func_string_md5.asp
 4. Dropdown DDSlick Jquery Library is used to show the image of ayat with its name and description
    Link: https://designwithpc.com/Plugins/ddSlick
 5. Roboto Google Fonts is used for counter font family


# Github School:
  1. Basic Commands:
    0. To stage the code to git
       git add.
    1. To commit the code
       git commit -m "[your_message_to_your_commit]"
    2. To Push the code
       git push -u origin master
    3. To Pull the code
       git pull
  2. Make a New Branch:
    1. New Branch
       git branch [your_branch_name]
    2. Checkout to New Branch
       git checkout -b [your_branch_name]
    3. Merge your Branch
       To merge your branch, you need to the checkout to the branch to where you want to your new branch to merge to.
       For instance:
       You Have a main branch and a new branch called new_branch
       so, you want to merge your new branch to the main
       Steps:
       1. Checkout to the main branch from your new branch
       2. Then write the following branch:
          git merge [your_branch_name] 
    4. To check your current branch
       1. git branch
    5. When you need to create a branch that inherits from the some branch branch, for instance
       git checkout -b ＜new-branch＞ ＜existing-branch＞
       Reference:
       https://www.atlassian.com/git/tutorials/using-branches/git-checkout#:~:text=The%20git%20branch%20command%20can,to%20switch%20to%20that%20branch.
    6. TO push the branch to the remote after commiting
       git push origin <your_branch_name>
        
    # Note:
    Keep this in mind that before checking out to new branch, commit your code else your work can get lost. 


# spaces in html

1.Regular space: &nbsp;
2.Two spaces gap: &ensp;
3.Four spaces gap: &emsp;


# New Concepts
   1. Constants Directory Added on 16/09/2021 at 11:40 am.
      In the directory, you'll see the messages.php that contains those large messages that contains those messages to displayed in multiple sites in the website.
   2. md5 algorithm is used to encrypt the password of the user.





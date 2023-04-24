# Coffee-shop-chain

This is a database for a hypothetical coffee shop chain

GITHUB LINK
https://github.com/Yayan57/Coffee-shop-chain

User Accounts-

Customer- From landing page go to sign up, enter credentials, click customer box, and sign in.
    To register, just click the customer box and click register, enter information asked.

Employee- From landing page go to sign up, enter credentials, click employee box, and sign in.

Manager- Hidden away from the general users, scroll to the bottom of the landing page(footer) and in the text there is a link to manager login. Click manager login and enter credentials to sign in.

------------------------------------------------------------------------------------------------------------------------------------------

This project was made with an azure server running the database and website, the database was created and modified in mysql workbench, and the website was mostly created with php, css, and html.

------------------------------------------------------------------------------------------------------------------------------------------

In order to properly install and run the files you must have a installation of php, xampp, mySql workbench in order to run on localhost.

------------------------------------------------------------------------------------------------------------------------------------------

-File Guide-

Home: \
landing.php - This is the landing page for when you first enter the website. \
login.php - The login page for both customer and employee. \
about.php - Tells what the website and company is about. \
menuguest.php - Shows menu but since the user isn't logged in they can't order.\
Header and footer in includes folder (Can vary depending on user) 

Manager: \
managerlogin.php - Login page for manager. \
managerhome.php - Home page for manager shows triggers. \
reports.php - Generates reports. \
logout.php - Ends user session. \
managerheader.php - Header for all manager functionality. \
mfooter.php - Thi is where the manager login is located. 

Employee: \
employeehome.php - Home page for employee, shows recent transactions. \
inventoryregister.php - Allows user to view, create, delete, or add aditional inventory. \
inventory_submit.php - php backend for inventoryregister.php. \
inventory.php - Displays the full inventory and all relevant information. \
profile.php - Displays the profile information of either the employee or customer.\
logout.php - Ends user session.

Customer: \
cart.php - Presents selected items and total price. And also allows customer to specify branch, preferred payment method, and carryout options. \
checkout.php - Confirm and send order request. \
login.php - Customer must create an account and login to order. \
menu.php -  Pull items and details from current inventory to create menu. \
profile.php - View and update Customer and Employee account information. \
register.php - Create and provide account information for Customer and Employee.

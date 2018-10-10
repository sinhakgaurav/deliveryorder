Application will be accessible on http://localhost:8080

By default it will behave as a get request handler irrespective of the http request method and will show the list of top 10 orders

you will find every system configuration related files under /system_files folder
	deliveryorder.sql
	general manual command to configure application on linux : readme_instructions.txt
	virtualhost file : deliveryorder.com.conf

We have a auth module under /app/modules/auth to be used for authentication explicitly using any kind of client library or our own custom authentication

We have a config variable under /app/bootstrap.php for:
    allowed http request methods : $_ENV['allowedRequest']
    order status : $_ENV['orderStatusArray']
    not required indexes in the request body(for processing the request on controller) : $_ENV['not_required']
    
We have a .env file under /app/config folder having
	for putting bypassing token authentication : BYPASS_TOKEN
        Auth token key : TOKEN
	DB Authentication details
	Google Access token : API_KEY_GOOGLE

token is required to be placed in header of the request 

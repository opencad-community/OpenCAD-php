# openCad
Open source Computer Aided Dispatch System for GTAV RolePlay Communities. This system is built off PHP

# Install Notes
1. Move the HIDE directory to somewhere outside of www access
2. Create a properties directory
3. Create a config.ini file

Contents of file should be (change the connection_file_location to the correct spot):

>[main]
>
>connection_file_location = "/HIDE/connections.php"
>
>[strings]
>
>community = "COMMUNITY"

4. Modify connections.php with correct MySQL Connection values

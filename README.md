# openCad
Open source Computer Aided Dispatch System for GTAV RolePlay Communities. This system is built off PHP

# ABANDONED BY ORIGINAL CREATOR
I no longer have the time to continue updating this software, and am no longer affiliated with the community I first designed it for. Perhaps here and there I'll contribute to it if I get bored, but I highly recommend someone to fork this repo and continue on your way of developing it.

# Install Notes
1. Move the HIDE directory to somewhere outside of www access
2. Create a properties directory under the root/openCad directory
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

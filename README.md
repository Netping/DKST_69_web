DKST_69_web
===========

Folder structure:
================
/firmware/ - DKST 69 firmware image and manufacturing tools for flashing the board with the firmware
/src/ - DKST 69 web sources

Flashing the firmware image onto the DKST 69 board
==================================================
Prerequisites: Windows 7 PC with an unused working USB port

1. Unpack file MFGTool.zip. Executable file MFGTool.exe in /MFGTool folder is the flashing utility.
The firmware images (bootloader, kernel and root file system) are located at /Profiles/MX28 Linux Update/OS Firmware/Files

2.  Connect Top USB port (USB0) of the ( EV-iMX287-NANO-MB ) to the PCs USB port (need to use USB plug A on both ends)

3. Short DKST 69 board ( EV-iMX287-NANO ) contact "RE" to ground. Contact "RE" is a "through hole" in the corner of the module near the fixing screw.
Example of "ground" on the board: the metal outside of USB and ethernet jacks, pin 2 of UEXT connector.

4. Power up the board (5V DC), middle pin is +5V

5. Keeping RE shorted to ground, push and release "reset" button the the EV-iMX287-NANO-MB board

6. At that moment Windows detects a new HID device

7. Remove the "RE" connection to ground

8. Start MFGTool.exe

9. Click "Start" in the MFGTool.exe UI

10. Wait for the completion of the process - message "Operations Complete". Note, flashing takes significant time, sometimes the UI provides no feedback about what it is doing.

11. Exit the MFGTool.exe, disconnect USB cable from the board and reboot the board (disconnect and reconnect power)

Testing the web interface
=========================
By default, the board is configured with IP address 192.168.0.1
After the board boots (this may take a minute) Using your browser, open page http://192.168.0.1

It is also possible to log on to the Linux command prompt of the board using ssh:
from a Linux host: ssh root@192.168.0.1
user: root, password admin

From a Windows host: use putty, IP 192.168.0.1, 
user: root, password admin

Uploading web source files
==========================
To change something in the Web UI, you need to put files in the target folder /var/www/

You can do it using ssh scp tool. For example to upload a new version of index.html:

On Linux:
scp index.html root@192.168.0.1:/var/www/
when asked for password enter admin

On Windows use pscp utility (putty scp) which can be downloaded from here http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html
pscp index.html root@192.168.0.1:/var/www/
when asked for password enter admin

NOTE: on Windows it may be necessary to add system path to the pscp.exe

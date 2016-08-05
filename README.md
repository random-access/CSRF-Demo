## CSRF-Demo ##

Demo of cross-site request forgery (CSRF), written for the course Security for Systems Engineering at TU Wien. 

Folder structure: 
* **exploit**: Contains the exploit website, a readme with installation instructions and install / uninstall scripts for debian-based systems
* **patches**: Contains the patch file that transforms the content under src-vuln into the content under src-fixed
* **src-fixed**: Contains the patched website which got secured against CSRF attacks
* **src-vuln**: Contains the website vulnerable to CSRF attacks

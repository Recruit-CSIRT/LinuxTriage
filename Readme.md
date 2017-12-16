R-CSIRT Linux Triage tool  
  ====  
  <hr />  
  Linux Server Triage tool written in Shell Script.    
  <hr />  
    
  ## Description    
  Linux Server Triage tool for CSIRT.       
  * Collect not only 'log files' but also 'config file'
  * Find Suspicious Script and Binary on Web Server.    
  * Include : Web Server Contents backup function    
  Operation Check :       
  	Linux : Ubuntu 14.04, CentOS 7.0    
           
  ## Requirements  
  No Requirement for Default Usage.  
  If you use [ClamAV](https://www.clamav.net) and [RKhunter](http://rkhunter.sourceforge.net) scan,  
  Please put these installers into *option* directory.    
  clamav-0.99.2 and rkhunter-1.4.4 had already set.  

  ## Usage  
    
  *1. Check your config on this shellscript*  
    
  Dynamic Configs setting 
    WEBROOT=/var/www/                       ###### web server document root dir 
    WEBSERVICE=/etc/apache2/                ###### web server installed directory  
    WEBROOT2=                               ###### web server2 document root dir  
    WEBSERVICE2=/etc/nginx/                 ###### web server2 installed directory  
    STARTDATE="2010-01-01"                  ###### start date score for getting log rotation file   
    ENDDATE="2017-12-01"                    ###### end date score for getting log rotation file  
   
    
   Static Configs setting
    EXCLUDES_PATHS=./options/excludes.txt   ###### exclude paths from the directory listing. Each path should be on a new line.    
    SaveCWD=1                               ###### SAVE OUTPUT FILE TO WORKING DIRECTORY (SAME AS SCRIPT)     
    STORAGETEST=1                           ###### STORAGE TEST VARIABLES : STORAGETEST: 1=enable    
    MINSPACE=1000000                        ###### MINSPACE(KB): Set to minimum number of KB required to keep temp files locally    
    IRCASE=`hostname`                       ###### basename of results archive    
    LOC=/tmp/$IRCASE                        ###### output destination, change according to needs    
    TMP=$LOC/$IRCASE'-tmp.txt'          	###### tmp file to redirect results    
    ERROR_LOG=$LOC/0_SCRIPT-ERRORS.txt  	###### redirect stderr    
    PHPBACKDOOR=./options/backdoorscan.php  ###### phpbackdoor script    
    HASHFLAG=1                              ###### HashFlag 1= get binary hash    
    CLAMAVFLAG=0                            ###### clamavFlag 1= install clamav and scan full    
    RKHUNTERFLAG=0                          ###### rkhunterFlag 1= install rkhunter and scan    
    MESSAGEFLAG=1                           ###### messageFlag 1= collect mail log    
    BACKUPFLAG=0							###### BACKUPFLAG 1= copy web server conf, contents for backup: Hardening purpose    
     
    
  *2. Excluded Folders*  
  Edit and Add it in ./options/excludes.txt  
  Last LF(\n) doesn't need.  
    
  *3. Execute*  
  `$ sudo bash rcsirt-linux_triage.sh`  
    
  *4. Pull tar.gz file created.*     
  	Inside file: See source code.  
  		ERROR LOG => 0_SCRIPT-ERRORS.txt    
  		Output tree LOG => 1_OUTPUT-TREE.txt  
    
  *Recruit-CSIRT does not assume any responsibility about using this tool.*      
  **you can take advantage on Self-responsibility**  
    
  ## Licence  
  MIT  
    
  ## Future Vision   
  We 'd like to decide WEBROOT and WEBSERVICE **automatically** , which is the Target Web server's Document Root Directory and Config Directory.  
  If you have good ideas to archive it. Please Comment us.  
    
  ## Author  
  Tatsuya Ichida  ([icchida](https://github.com/icchida))   
  Ref: r-csirt  ([r-csirt](https://github.com/r-csirt))   

  ## Refer Other Triage Tools and Thanks  
  * [ir-triage-toolkit](https://github.com/rshipp/ir-triage-toolkit)    		
  * [Fastir_Collector_Linux](https://github.com/SekoiaLab/Fastir_Collector_Linux)    
  * [ir-rescue(-nix)](https://github.com/diogo-fernan/ir-rescue)  

  And Others some tools.  /options/backdoorscan.php was got on Internet, We didn't develop by ourselves.  
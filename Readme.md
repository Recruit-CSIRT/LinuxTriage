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
  
0. Set the rcsirt-linux_triage.sh and options folder in the same directory which Linux server you want to do triage in.  
        
1. Check configs(const variable) on shell script top. 
        
2. Excluded Folders  
  Edit and Add it in ./options/excludes.txt  
  Last LF(\n) doesn't need.  
    
3. Execute  
  `$ sudo bash rcsirt-linux_triage.sh`  
    
4. Pull tar.gz file created.    
  	Output files : Please See source code.  
  		ERROR LOG => 0_SCRIPT-ERRORS.txt    
  		Output files tree LOG => 1_OUTPUT-TREE.txt  
    
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

  And Others some tools.  /options/backdoorscan.php was got from Internet, We didn't develop it by ourselves.  

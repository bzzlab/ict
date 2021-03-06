## ICT teaching material
<small>Author: [Daniel Garavaldi](mailto:daniel.garavaldi@bzz.ch)</small>

### Intro
Sharing the teaching material with new ICT teacher leads to a new directory structure.
On the one hand the website [http://ict.bzzlab.ch](http://ict.bzzlab.ch) with its 
includes and design shouldn't be ammended. On the other hand the teaching material is
personel and should be changed any time without interfering with teaching data of other teachers.

### New directory structure
* <code>lp</code> means Lehrperson (teacher)
* <code>lp01</code> means Lehperson 01 (Elena M.), 02 (Daniel G.)
* in the directory <code>data</code> all relevant teaching material is stored.

The proposed directory structure looks as follows: 
```
.git            
.idea
archive
inc             
lib             
downloads       
logs
data/
    lp01/
        exam            
        feedbacks                   
        org             
        ressourcen      
        themen 
    lp02/
        exam            
        feedbacks       
        org             
        ressourcen      
        themen          
.gitignore      
content.php     
content2.php    
index.html      
index.php       
readme.md (this document)     
sftp-config.json
view_code.php   
view_code2.php  
view_loes.php   
view_src.php    
```


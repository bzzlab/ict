<?php
require_once(__DIR__ . '/SiteURL.php');
require_once(__DIR__ . '/Teacher.php');
require_once(__DIR__ . '/Semester.php');

class Navigation
{

    private $site = null;
    private $semester = null;
    private $teacher = null;

    /**
     * Navigation constructor.
     */
    public function __construct()
    {
        $this->site = new SiteURL();
        $this->semester = new Semester();
        $this->teacher = new Teacher();
    }

    public function clearSettings($type){

        if ($type == "all" || $type == "cookie"){
            $this->teacher->setCookieValue(CookieIO::INVALID);
            $this->semester->setCookieValue(CookieIO::INVALID);
        }

        if ($type == "all" || $type == "session"){
            $this->teacher->setSessionValue(SessionIO::INVALID);
            $this->semester->setSessionValue(SessionIO::INVALID);
        }
    }

    public function setHiddenSessions(){
        $lp = $this->teacher->getSessionValue();
        if (strlen($lp) > 0){
            echo "<input type='hidden' id='lp_key' value='".$lp."'/>";
        }
        $sem = $this->semester->getSessionValue();
        if (strlen($sem) > 0){
            echo "<input type='hidden' id='sem_key' value='".$sem."'/>";
        }
    }


    public function readSettings() : bool {
        //read teacher (lp) cookie
        $lp = $this->teacher->getCookieValue();
        if ($lp == CookieIO::INVALID) {
            return false;
        }
        //read semester cookie
        $sem = $this->semester->getCookieValue();
        if ($sem == CookieIO::INVALID) {
            return false;
        }

        /*  All cookies could be read.
         *  Now check if the values are allowed
        */
        $lpArray = $this->teacher->getAllowedValues();
        if (!in_array($lp, $lpArray)) {
            return false;
        }
        $semArray = $this->semester->getAllowedValues();
        if (!in_array($sem, $semArray)) {
            return false;
        }

        //set sessions
        $this->teacher->setSessionValue($lp);
        $this->semester->setSessionValue($sem);
        $this->semester->redirect($lp,$sem);
        return true;
    }

    /**
     * Get the site-title depending of the selected semester
     * @return string: site-tile
     */
    public function getSiteTitle(): string
    {
        $result = "<title>ICT - BZZ</title>";
        $lp = $this->teacher->getSessionValue();
        $sem = $this->semester->getSessionValue();
        if ($lp == SessionIO::INVALID){
            return $result;
        }

        if ($sem == SessionIO::INVALID){
            return $result;
        }
        return sprintf("<title>ict-%s - bzz</title>", strtoupper($sem));
    }

    /**
     * Set top navigation
     * @return array
     */
    public function getTopNavigationSites()
    {
        $sem = $this->semester->getSessionValue();
        $base_url = "content.php?file=org/" . $sem;
        $topNavList = array("Home" => $base_url . "/home.md",
            "Agenda" => $base_url . "/agenda.md",
            "Organisation" => $base_url . "/organisation.md",
            "Lernziele" => $base_url . "/lernziele.md",
            "Semester" => "index.php?clear=all");


        //Change url for specific semester
        if(strcmp($sem, "08")==0 || strcmp($sem, "04")==0 ||
            strcmp($sem, "07")==0 ||
            strcmp($sem,"03")==0) {
            $base_url = "content.php?inc=1&file=org/" . $sem;
            $topNavList["Agenda"] = $base_url . "/agenda.md";
        }

        if((strcmp($sem, "05")==0))
        {
            //remove the last element
            array_pop($topNavList);
            //add element for Musterlösung
            $topNavList += ["Lösungen" => $base_url . "/loesungen.md"];
            //add again Menu "Semster" that should appear as last element
            $topNavList += ["Semester" => "index.php"];
        }
        return $topNavList;
    }

    public function getDropDownMenuSites()
    {
        $sem = $this->semester->getSessionValue();
        $base_url = "content.php?file=org/" . $sem;

        $topNavList = array(
            "Selfhtml" => "https://wiki.selfhtml.org",
            "Can I use" => "http://caniuse.com/"
        );

        if ((strcmp($sem, "06")==0))
        {
            //remove the last element
            //array_pop($topNavList);
            //add element for Musterlösung
            $topNavList += ["MySQL Commands" => "https://www.tutorialspoint.com/mysql/index.htm"];
            $topNavList += ["Probelektion" => $base_url . "/probelektion.md"];
        }
        return $topNavList;

    }

    public function setLinksOfTopNavigation()
    {
        $part = $this->site->getPartFromURL(SiteURL::QUERY);
        $siteList = $this->getTopNavigationSites();
        //to highlight the selected menu-item
        $active = "class='active'";
        foreach ($siteList as $siteCaption => $siteUrl) {
            if ($this->site->contains(strtolower($siteCaption), $part)) {
                printf("<li %s><a href='%s'>%s</a></li>", $active, $siteUrl, $siteCaption);
            } else {
                printf("<li><a href='%s'>%s</a></li>", $siteUrl, $siteCaption);
            }
        }
    }

    public function setDropDownMenuNavigation()
    {
        $siteList = $this->getDropDownMenuSites();
        foreach ($siteList as $siteCaption => $siteUrl) {
            printf("<li><a href='%s' target='_blank'>%s</a></li>", $siteUrl, $siteCaption);
        }
    }

    //Setze TopNavigation abhängig vom Content
    public function setTopNavigation()
    {
        $nav = array("inc/nav.inc", "inc/nav_cont.inc");
        $result = 0; //default
        if (isset($_GET["top"])) {
            switch ($_GET["top"]) {
                case 1:
                    $result = 1;
                    break;
            }
        }
        return $nav[$result];
    }

    /**
     * Setze Links-Navigation abhängig vom Content
     * @return mixed
     */
    public function setLeftNavigation()
    {
        $nav = array("inc/cont.inc", "inc/cont_sidebar.inc");
        $result = 0; //default
        if (isset($_GET["ct"])) {
            switch ($_GET["ct"]) {
                case 1:
                    $result = 1;
                    break;
            }
        }
        return $nav[$result];
    }

}
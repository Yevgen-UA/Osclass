<?php
require_once dirname(__FILE__).'/../../../../oc-load.php';

//require_once('FrontendTest.php');

class OCadmin_administrators extends OCadminTest {
    
    /*           TESTS          */
    function testInsertAdministrator()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("//a[@id='administrators_new']");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Real name user one");
        $this->selenium->type("s_username","useradminone");
        $this->selenium->type("s_password", "useradminpass");
        $this->selenium->type("s_email", "admin@mail.com");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been added"),"Add administrator");
    }

    function testInsertAdministratorTwice()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("//a[@id='administrators_new']");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Real name user one");
        $this->selenium->type("s_username","useradminone");
        $this->selenium->type("s_password", "useradminpass");
        $this->selenium->type("s_email", "admin@mail.com");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("Email already in use"),"Add administrator with existing email");
    }

    function testInsertAdministratorFail()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("//a[@id='administrators_new']");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","");
        $this->selenium->type("s_username","");
        $this->selenium->type("s_password", "");
        $this->selenium->type("s_email", "");
        $this->selenium->click("//input[@type='submit']");
        sleep(4);
        $this->assertTrue($this->selenium->isTextPresent("Name: this field is required"),"Add aministrator existing username");
        $this->assertTrue($this->selenium->isTextPresent("Username: this field is required"),"Add aministrator existing username");
        $this->assertTrue($this->selenium->isTextPresent("Email: this field is required"),"Add aministrator existing username");
        
        $this->selenium->type("s_email", "admin(at)mailcom");
        $this->selenium->click("//input[@type='submit']");
        sleep(4);
        $this->assertTrue($this->selenium->isTextPresent("Invalid email address"),"Add aministrator existing username");
        
        $this->selenium->type("s_name","Real name user one");
        $this->selenium->type("s_username","useradminone");
        $this->selenium->type("s_password", "useradminpass_");
        $this->selenium->type("s_email", "admin_@mail.com");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("Username already in use"),"Add aministrator existing username");
    }

    function testEditYourProfile()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("link=Your Profile");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Administrator updated");
        $this->selenium->type("s_username","adminUpdated");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been updated"),"Edit administrator's profile");

        $this->selenium->click("link=Administrators");
        $this->selenium->click("link=Your Profile");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Administrator");
        $this->selenium->type("s_username","adminnewtest");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been updated"),"Edit administrator's profile");
    }

    function testEditAdministrator()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("link=Manage administrators");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->mouseOver("//table/tbody/tr[contains(.,'useradminone')]");
        $this->selenium->click("//table/tbody/tr[contains(.,'useradminone')]/td/div/a[text()='Edit']");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Real name user one NEW");
        $this->selenium->type("s_username","useradminoneNEW");
        $this->selenium->type("old_password", "useradminpass");
        $this->selenium->type("s_password"  , "useradminpassNEW");
        $this->selenium->type("s_password2" , "useradminpassNEW");
        $this->selenium->type("s_email", "admin@mail.com");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been updated"),"Edit administrator (other)");
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("link=Manage administrators");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->mouseOver("//table/tbody/tr[contains(.,'useradminone')]");
        $this->selenium->click("//table/tbody/tr[contains(.,'useradminone')]/td/div/a[text()='Edit']");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Real name user one NEW");
        $this->selenium->type("s_username","useradminoneNEW");
        $this->selenium->type("s_email", "newadmin@mail.com");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been updated"),"Edit administrator (other 2)");
    }

    function testEditAdministratorFailPasswMatch()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("link=Manage administrators");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->mouseOver("//table/tbody/tr[contains(.,'useradminone')]");
        $this->selenium->click("//table/tbody/tr[contains(.,'useradminone')]/td/div/a[text()='Edit']");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->type("s_name","Real name user one NEW");
        $this->selenium->type("s_username","useradminoneNEW");
        $this->selenium->type("old_password", "useradminpassNEW");
        $this->selenium->type("s_password", "bsg");
        $this->selenium->type("s_password2" , "useradminpassNEW");
        $this->selenium->click("//input[@type='submit']");
        sleep(4);
        $this->assertTrue($this->selenium->isTextPresent("Password: enter at least 5 characters"),"Edit administrator password");
        
        $this->selenium->type("s_password", "valkiria");
        $this->selenium->click("//input[@type='submit']");
        sleep(4);
        $this->assertTrue($this->selenium->isTextPresent("Passwords don't match"),"Edit administrator password");
        
        $this->selenium->type("s_password"  , "useradminpassNEW");
        $this->selenium->type("s_password2" , "useradminpassNEW");
        $this->selenium->type("s_email", "admin@mail.com");
        $this->selenium->click("//input[@type='submit']");
        $this->selenium->waitForPageToLoad("30000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been updated"),"Edit administrator password");
    }


    function testDeleteAdministrator()
    {
        $this->loginWith() ;
        $this->selenium->open( osc_admin_base_url(true) );
        $this->selenium->click("link=Administrators");
        $this->selenium->click("link=Manage administrators");
        $this->selenium->waitForPageToLoad("10000");
        $this->selenium->click("//table/tbody/tr/td[contains(.,'useradminone')]/div/a[text()='Delete']");
        $this->selenium->waitForPageToLoad("10000");
        $this->assertTrue($this->selenium->isTextPresent("The admin has been deleted correctly"),"Delete administrator");
    }
}
?>
